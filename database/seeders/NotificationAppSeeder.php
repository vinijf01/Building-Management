<?php

namespace Database\Seeders;

use App\Models\NotificationApp;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            NotificationApp::create([
                'user_id' => $user->id,
                'type' => 'booking',
                'title' => 'Contoh Notifikasi',
                'message' => 'Ini notifikasi contoh untuk user pertama.',
            ]);
        }
    }
}
