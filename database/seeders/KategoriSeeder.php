<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'id_kategori' => 1,
            'ket_kategori' => 'Sarana',
            'deskripsi' => 'Sarana pendidikan adalah perangkat keras dan perlengkapan yang mendukung proses pembelajaran di sekolah',
        ]);

        Kategori::create([
            'id_kategori' => 2,
            'ket_kategori' => 'Prasarana',
            'deskripsi' => 'Prasarana pendidikan adalah fasilitas fisik dan infrastruktur yang menunjang kegiatan belajar mengajar',
        ]);
    }
}
