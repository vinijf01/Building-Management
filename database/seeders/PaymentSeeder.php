<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Payments;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Bookings::all();

        foreach ($bookings as $booking) {
            Payments::create([
                'booking_id'       => $booking->id,
                'payment_method'   => 'bank_transfer',
                'payment_type'     => 'full',
                'payment_status'   => 'pending_verification',
                'amount'           => $booking->total_price,
                'proof_image'      => null,
                'payment_due_date' => Carbon::now()->addDay()->toDateTimeString(),
            ]);
        }
    }
}
