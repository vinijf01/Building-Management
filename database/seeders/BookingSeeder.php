<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Properties;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $properties = Properties::take(10)->get();

        if ($customer && $properties->count()) {
            foreach ($properties as $index => $property) {
                $startDate = Carbon::today()->addDays($index + 1);
                $endDate = $startDate->copy()->addDay();

                // buat booking
                $booking = Bookings::create([
                    'property_id' => $property->id,
                    'customer_id' => $customer->id,
                    'start_date'  => $startDate->toDateString(),
                    'end_date'    => $endDate->toDateString(),
                    'status'      => 'pending_payment',
                    'total_price' => $property->price,
                ]);

                // sekaligus buat schedule dengan status booked
                $booking->schedules()->create([
                    'property_id' => $property->id,
                    'start_date'  => $startDate->toDateString(),
                    'end_date'    => $endDate->toDateString(),
                    'status'      => 'booked',
                ]);
            }
        }
    }
}
