<?php

namespace Database\Seeders;

use App\Models\Properties;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property = Properties::first();
    if ($property) {
        Schedules::create([
            'property_id' => $property->id,
            'start_date' => Carbon::now()->addDays(1)->toDateString(), // hanya tanggal
            'end_date' => Carbon::now()->addDays(1)->addHours(4)->toDateString(), // hanya tanggal
        ]);
    }
    }
}
