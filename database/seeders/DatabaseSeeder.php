<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $this->call(SiswaSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(PengaduanSeeder::class);
        $this->call(InputAspirasiSeeder::class);
    }
}
