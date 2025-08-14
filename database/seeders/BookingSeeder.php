<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Properties;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $property = Properties::first();

        if ($customer && $property) {
            Bookings::create([
                'property_id' => $property->id,
                'customer_id' => $customer->id,
                'start_date' => Carbon::today()->addDays(7)->toDateString(),
                'end_date' => Carbon::today()->addDays(7)->toDateString(),
                'status' => 'pending_payment',
                'total_price' => $property->price,
            ]);
        }
    }
}
