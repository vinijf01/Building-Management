<?php

namespace Database\Seeders;

use App\Models\Properties;
use App\Models\User;
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
            $properties = [
                ['Gedung Serbaguna A', 'Gedung cocok untuk seminar, workshop, dan pesta kecil.', 'eksklusif', 1000000],
                ['Ruang Meeting B', 'Ruang meeting dengan kapasitas 20 orang.', 'reguler', 250000],
                ['Gedung Pernikahan C', 'Gedung besar untuk acara pernikahan dan resepsi.', 'eksklusif', 3000000],
                ['Ruang Kelas D', 'Ruang kelas untuk pelatihan atau kursus.', 'reguler', 500000],
                ['Studio Musik E', 'Studio musik dengan peralatan lengkap.', 'eksklusif', 750000],
                ['Ruang Podcast F', 'Ruang kedap suara untuk podcast dan rekaman.', 'reguler', 400000],
                ['Gedung Pameran G', 'Gedung luas untuk pameran seni dan produk.', 'eksklusif', 2000000],
                ['Ruang Serbaguna H', 'Ruang fleksibel untuk berbagai kegiatan.', 'reguler', 600000],
                ['Ruang Komputer I', 'Ruang dengan fasilitas komputer lengkap.', 'reguler', 550000],
                ['Gedung Konser J', 'Gedung besar untuk konser dan pertunjukan musik.', 'eksklusif', 5000000],
            ];

            foreach ($properties as [$name, $description, $category, $price]) {
                Properties::create([
                    'penyewa_id' => $penyewa->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $description,
                    'cover_image' => null,
                    'category' => $category,
                    'price' => $price,
                ]);
            }
        }
    }
}
