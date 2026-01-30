<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InputAspirasi;

class InputAspirasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InputAspirasi::create([
            'id_pelaporan' => 1,
            'nis' => 12001,
            'id_kategori' => 1,
            'lokasi' => 'Ruang Kelas X A',
            'ket' => 'Fasilitas kelas kurang memadai',
        ]);

        InputAspirasi::create([
            'id_pelaporan' => 2,
            'nis' => 12002,
            'id_kategori' => 1,
            'lokasi' => 'Lab Komputer',
            'ket' => 'Komputer rusak dan perlu diperbaiki',
        ]);
    }
}
