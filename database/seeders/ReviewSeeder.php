<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Reviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // contoh review, hanya jika booking sudah completed
        $booking = Bookings::first();
        if ($booking && $booking->status === 'completed') {
            Reviews::create([
                'booking_id' => $booking->id,
                'customer_id' => $booking->customer_id,
                'rating' => 5,
                'comment' => 'Sangat memuaskan!',
            ]);
        }
    }
}
