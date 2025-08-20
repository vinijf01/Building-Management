<?php

namespace Database\Seeders;

use App\Models\Properties;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyewa = User::where('role', 'penyewa')->first();

        if ($penyewa) {
            Properties::create([
                'penyewa_id' => $penyewa->id,
                'name' => 'Gedung Serbaguna A',
                'slug' => Str::slug('Gedung Serbaguna A'),
                'description' => 'Gedung cocok untuk seminar, workshop, dan pesta kecil.',
                'cover_image' => null,
                'category' => 'eksklusif',
                'price' => 1000000,
            ]);

            Properties::create([
                'penyewa_id' => $penyewa->id,
                'name' => 'Ruang Meeting B',
                'slug' => Str::slug('Ruang Meeting B'),
                'description' => 'Ruang meeting dengan kapasitas 20 orang.',
                'cover_image' => null,
                'category' => 'reguler',
                'price' => 250000,
            ]);
        }
    }
}
