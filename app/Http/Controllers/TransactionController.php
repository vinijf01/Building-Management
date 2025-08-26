<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil bookings sesuai customer yang login
        $transactions = Bookings::with(['property', 'payment'])
            ->where('customer_id', $user->id)
            ->orderBy('start_date', 'desc')
            ->get()
            ->map(function ($booking) {
                $start = Carbon::parse($booking->start_date);
                $end = Carbon::parse($booking->end_date);
                $days = $start->diffInDays($end);

                return [
                    'property' => $booking->property->name,
                    'rental_period' => $start->format('d M Y') . ' - ' . $end->format('d M Y'),
                    'total' => $booking->property->price * $days,
                    'status' => $booking->status,
                    'id' => $booking->booking_code,
                    'payment_status' => $booking->payment->payment_status ?? null,
                    'remark' => $booking->payment->remark ?? null,
                ];
            });


        return view('transactionHistory', compact('transactions'));
    }

    public function destroy($id)
    {
        // cari booking
        $booking = Bookings::where('booking_code', $id)->firstOrFail();

        // update status booking jadi cancelled
        $booking->update([
            'status' => 'cancelled',
        ]);

        // hapus record scheduled yang terkait dengan booking
        Schedules::where('booking_id', $booking->id)->delete();

        return redirect()->route('transactionHistory')
            ->with('success', 'Booking berhasil dibatalkan.');
    }


    public function showReceipt($id)
    {
        $booking = Bookings::with(['property', 'customer'])->where('booking_code', $id)
        ->firstOrFail();

        $start = \Carbon\Carbon::parse($booking->start_date);
        $end   = \Carbon\Carbon::parse($booking->end_date);
        $days  = $start->diffInDays($end);

        $total = $booking->property->price * $days;

        return response()->json([
            'id'            => $booking->booking_code,
            'property_name' => $booking->property->name,
            'customer'      => $booking->customer->name,
            'start_date'    => $start->format('d M Y'),
            'end_date'      => $end->format('d M Y'),
            'days'          => $days,
            'total_payment' => number_format($total, 0, ',', '.'),
            'status'        => ucfirst($booking->status),
        ]);
    }
}
