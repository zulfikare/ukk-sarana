<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengaduan;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaduan::create([
            'id_aspirasi' => 1,
            'id_kategori' => 1,
            'status' => 'Selesai',
            'feedback' => 1,
        ]);

        Pengaduan::create([
            'id_aspirasi' => 2,
            'id_kategori' => 1,
            'status' => 'Menunggu',
            'feedback' => null,
        ]);
    }
}
