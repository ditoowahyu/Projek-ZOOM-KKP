<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(
            ['email' => 'admin@contoh.com'], // biar tidak dobel kalau seed ulang
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'nrp' => 'NRP001',
                'no_hp' => '081234567890',
            ]
        );

        // User biasa
        User::updateOrCreate(
            ['email' => 'user@contoh.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'nrp' => 'NRP002',
                'no_hp' => '089876543210',
            ]
        );
    }
}
