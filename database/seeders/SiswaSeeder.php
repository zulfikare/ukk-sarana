<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nis' => 12001,
            'nama' => 'Ahmad Hidayat',
            'kelas' => 'X A',
            'keterangan' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => 12002,
            'nama' => 'Budi Santoso',
            'kelas' => 'X B',
            'keterangan' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => 12003,
            'nama' => 'Cindy Wijaya',
            'kelas' => 'XI A',
            'keterangan' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => 12004,
            'nama' => 'Dewi Kusuma',
            'kelas' => 'XI B',
            'keterangan' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => 12005,
            'nama' => 'Eka Prasetyo',
            'kelas' => 'XII A',
            'keterangan' => 'Aktif',
        ]);
    }
}
