<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Properties;
use App\Models\Bookings;
use App\Models\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function beranda()
    {
        $all = Properties::orderBy('created_at', 'desc')->get();
        $eksklusif = Properties::where('category', 'eksklusif')->orderBy('created_at', 'desc')->take(4)->get();
        $reguler = Properties::where('category', 'reguler')->orderBy('created_at', 'desc')->take(4)->get();

        return view('welcome', compact('eksklusif', 'reguler', 'all'));
    }
    public function show($slug)
    {
        $product = Properties::where('slug', $slug)->firstOrFail();
        $relatedProducts = Properties::where('slug', '!=', $slug)->take(10)->get();

        return view('productDetail', compact('product', 'relatedProducts'));
    }

    public function collection(Request $request)
    {
        $query = Properties::query();

        if ($request->search) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(category) LIKE ?', ["%{$search}%"]);
            });
        }
        if ($request->room_type) {
            $query->where('category', $request->room_type);
        }

        if ($request->price_from) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->price_to) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->sort_price) {
            $query->orderBy('price', $request->sort_price);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // $all = $query->get();
        $all = $query->paginate(12)->appends($request->all());


        return view('products', compact('all'));
    }


    public function bookingForm($slug)
    {
        $product = \App\Models\Properties::where('slug', $slug)->firstOrFail();

        // get all blocked date ranges for this property
        $blockedRanges = Bookings::where('property_id', $product->id)
            ->whereIn('status', ['confirmed', 'pending_payment'])
            ->get(['start_date', 'end_date'])
            ->map(function ($b) {
                return [
                    'start' => \Carbon\Carbon::parse($b->start_date)->toDateString(), // YYYY-MM-DD
                    'end' => \Carbon\Carbon::parse($b->end_date)->toDateString(),
                ];
            });

        return view('bookingForm', compact('product', 'blockedRanges'));
    }

    public function bookingSave(string $slug, Request $request)
    {
        // 1) Find the property by slug
        $property = Properties::where('slug', $slug)->firstOrFail();

        // 2) Validate incoming dates
        $validated = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'], // end must be after start (at least next day)
        ], [
            'start_date.after_or_equal' => 'Start date cannot be before today.',
            'end_date.after' => 'End date must be at least the next day.',
        ]);

        // 3) Normalize to day boundaries:
        //    Treat end as checkout (exclusive); both stored as dates/datetimes.
        $start = Carbon::parse($validated['start_date'])->startOfDay();  // inclusive
        $end = Carbon::parse($validated['end_date'])->startOfDay();    // exclusive

        // 4) Calculate nights & total (server-side, do not trust client)
        $nights = $start->diffInDays($end); // e.g., 29->30 = 1 night
        if ($nights < 1) {
            return back()
                ->withErrors(['date_range' => 'End date must be at least the next day.'])
                ->withInput();
        }
        $total = $nights * (float) $property->price;

        // 5) Overlap check (half-open ranges): existing.start < new.end AND existing.end > new.start
        $overlapExists = Bookings::where('property_id', $property->id)
            ->whereIn('status', ['success_payment', 'pending_payment'])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_date', '<', $end)
                    ->where('end_date', '>', $start);
            })
            ->exists();

        if ($overlapExists) {
            return back()
                ->withErrors(['date_range' => 'Selected dates overlap with an existing booking.'])
                ->withInput();
        }

        // 6) Transaction: create booking, schedule, payment
        $booking = DB::transaction(function () use ($property, $start, $end, $total) {
            // a) bookings
            $booking = Bookings::create([
                'property_id' => $property->id,
                'customer_id' => Auth::id(),
                'start_date' => $start,  // inclusive
                'end_date' => $end,    // exclusive (checkout)
                'status' => 'pending_payment',
                'total_price' => $total,
            ]);

            // b) schedules
            Schedules::create([
                'property_id' => $property->id,
                'booking_id' => $booking->id,
                'start_date' => $start,  // inclusive
                'end_date' => $end,    // exclusive
                'status' => 'booked',
            ]);

            // c) payments
            Payments::create([
                'booking_id' => $booking->id,
                'payment_method' => 'bank_transfer',
                'payment_type' => 'full',
                'payment_status' => 'pending_verification',
                'amount' => $total,
                'proof_image' => null,
                'payment_due_date' => now()->addHours(24),
            ]);

            return $booking;
        });

        return redirect()
            ->route('booking.payment', ['id' => $booking->id]) // adjust to your route
            ->with('success', 'Booking created with id = ' . $booking->id . '. Please complete payment within 24 hours.');
    }

    public function bookingPayment($id)
{
    $booking = Bookings::query()
        ->with([
            'payment:id,booking_id,payment_method,payment_type,payment_status,amount,proof_image,payment_due_date,created_at,updated_at',
            'property:id,name,slug'
        ])
        ->where('booking_code', $id)
        ->firstOrFail(['id', 'booking_code', 'property_id', 'customer_id', 'start_date', 'end_date', 'status', 'total_price', 'created_at']);

    abort_if($booking->customer_id !== Auth::id(), 403, 'Unauthorized access to this booking.');

    if (!$booking->payment) {
        return back()->withErrors([
            'payment' => 'Payment record was not found for this booking. Please contact support.'
        ]);
    }

    $secondsRemaining = now()->diffInSeconds($booking->payment->payment_due_date, false);

    return view('bookingPayment', [
        'booking' => $booking,
        'payment' => $booking->payment,
        'secondsRemaining' => $secondsRemaining,
        'paymentDetails'   => [
            'account_number' => env('PAYMENT_ACCOUNT_NUMBER', 'account_number'),
            'account_name'   => env('PAYMENT_ACCOUNT_NAME', 'account_name'),
            'bank_name'      => env('PAYMENT_BANK_NAME', 'bank_name'),
        ],
    ]);
}


public function uploadPaymentProof(Bookings $booking, Request $request)
{
    // Ownership guard
    abort_if($booking->customer_id !== Auth::id(), 403, 'Unauthorized');

    // Ensure booking has a payment row loaded (or fetch it)
    $payment = $booking->payment; // relationship: hasOne(Payment::class, 'booking_id')
    if (!$payment) {
        return back()->withErrors(['payment' => 'Payment record not found.']);
    }

    // Validate image (max ~5MB)
    $data = $request->validate([
        'proof_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
    ]);

    // Hapus file lama kalau ada
    if ($payment->proof_image && Storage::disk('public')->exists($payment->proof_image)) {
        Storage::disk('public')->delete($payment->proof_image);
    }

    // Simpan file baru
    $path = $request->file('proof_image')->store('payments/proofs', 'public');

    // Update payment
    $payment->update([
        'proof_image' => $path,
        'payment_status' => 'pending_verification', // bisa disesuaikan
    ]);

    return back()->with('success', 'Payment proof uploaded successfully. Please wait for verification.');
}


}
