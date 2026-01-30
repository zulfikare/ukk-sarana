<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Database\Seeder;

class DemoSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada siswa untuk testing
        $siswa = Siswa::firstOrCreate(
            ['nis' => '12001', 'kelas' => 'XII IPA 1'],
            ['nama' => 'John Doe', 'jurusan' => 'IPA']
        );

        $siswa2 = Siswa::firstOrCreate(
            ['nis' => '12002', 'kelas' => 'XII IPS 1'],
            ['nama' => 'Jane Smith', 'jurusan' => 'IPS']
        );

        // Pastikan ada kategori
        $kategoriRuang = Kategori::firstOrCreate(['nama' => 'Ruang Kelas']);
        $kategoriLab = Kategori::firstOrCreate(['nama' => 'Laboratorium']);
        $kategoriPerpus = Kategori::firstOrCreate(['nama' => 'Perpustakaan']);
        $kategoriToilet = Kategori::firstOrCreate(['nama' => 'Toilet']);
        $kategoriKantin = Kategori::firstOrCreate(['nama' => 'Kantin']);

        // Buat pengaduan demo untuk siswa 1
        Pengaduan::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategoriRuang->id,
                'pelapor' => 'John Doe',
                'isi_pengaduan' => 'AC di ruang kelas XII IPA 1 tidak dingin dan perlu segera diperbaiki. Suasana kelas menjadi tidak nyaman terutama saat jam siang hari.'
            ],
            ['status' => 'selesai', 'tanggal_selesai' => now()->subDays(5)]
        );

        Pengaduan::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategoriLab->id,
                'pelapor' => 'John Doe',
                'isi_pengaduan' => 'Beberapa peralatan di lab komputer tidak berfungsi dengan baik. Komputer nomor 5, 7, dan 10 sering hang dan lambat.'
            ],
            ['status' => 'proses']
        );

        Pengaduan::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategoriPerpus->id,
                'pelapor' => 'John Doe',
                'isi_pengaduan' => 'Pencahayaan di perpustakaan kurang terang. Beberapa lampu sudah mati dan perlu segera diganti untuk kenyamanan siswa yang sedang belajar.'
            ],
            ['status' => 'masuk']
        );

        // Buat pengaduan demo untuk siswa 2
        Pengaduan::firstOrCreate(
            [
                'siswa_id' => $siswa2->id,
                'kategori_id' => $kategoriToilet->id,
                'pelapor' => 'Jane Smith',
                'isi_pengaduan' => 'Toilet di lantai 2 dekat lab fisika tidak ada air. Sudah mengganggu aktivitas siswa beberapa hari terakhir.'
            ],
            ['status' => 'selesai', 'tanggal_selesai' => now()->subDays(2)]
        );

        Pengaduan::firstOrCreate(
            [
                'siswa_id' => $siswa2->id,
                'kategori_id' => $kategoriKantin->id,
                'pelapor' => 'Jane Smith',
                'isi_pengaduan' => 'Meja dan kursi di kantin banyak yang rusak dan kotor. Tolong dibersihkan dan diperbaiki untuk kenyamanan siswa makan siang.'
            ],
            ['status' => 'proses']
        );

        $this->command->info('Demo data seeder completed! Test login with:');
        $this->command->info('NIS: 12001, Kelas: XII IPA 1 (John Doe)');
        $this->command->info('NIS: 12002, Kelas: XII IPS 1 (Jane Smith)');
    }
}
