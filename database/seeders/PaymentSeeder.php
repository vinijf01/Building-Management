<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Payments;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $booking = Bookings::first();
        if ($booking) {
            Payments::create([
                'booking_id' => $booking->id,
                'payment_method' => 'bank_transfer',
                'payment_type' => 'full',
                'payment_status' => 'pending',
                'amount' => $booking->total_price,
                'proof_image' => null,
                'payment_due_date' => Carbon::now()->addDay()->toDateTimeString(),
            ]);
        }
    }
}
