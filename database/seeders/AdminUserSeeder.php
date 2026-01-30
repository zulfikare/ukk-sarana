<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with username
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('password'),
            ]
        );

        // Tambahan user untuk testing
        User::firstOrCreate(
            ['username' => 'operator'],
            [
                'password' => Hash::make('password'),
            ]
        );
    }
}
