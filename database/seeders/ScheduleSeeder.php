<?php

namespace Database\Seeders;

use App\Models\Schedules;
use App\Models\Bookings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Bookings::all();

        foreach ($bookings as $index => $booking) {
            $startDate = Carbon::parse($booking->start_date)->addHours(9); // mulai jam 09:00
            $endDate   = $startDate->copy()->addHours(4); // durasi 4 jam

            Schedules::create([
                'property_id' => $booking->property_id,
                'booking_id'  => $booking->id,
                'start_date'  => $startDate->toDateTimeString(),
                'end_date'    => $endDate->toDateTimeString(),
                'status'      => 'booked',
            ]);
        }
    }
}
