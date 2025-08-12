<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Penyewa User',
            'email' => 'penyewa@example.com',
            'phone_number' => '08123456788',
            'password' => Hash::make('password'),
            'role' => 'penyewa'
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'phone_number' => '08123456787',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
    }
}
