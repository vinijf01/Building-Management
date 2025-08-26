<?php

namespace Database\Seeders;

use App\Models\Bookings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateBookingCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bookings::whereNull('booking_code')->orWhere('booking_code', '')
            ->get()
            ->each(function ($booking) {
                $booking->booking_code = 'book-' . rand(10000000, 99999999);
                $booking->save();
            });
    }
}
