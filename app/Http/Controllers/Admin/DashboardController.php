<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalKategori = Kategori::count();
        $totalPengaduan = Pengaduan::count();
        $pengaduanMenunggu = Pengaduan::where('status', 'Menunggu')->count();
        $pengaduanProses = Pengaduan::where('status', 'Proses')->count();
        $pengaduanSelesai = Pengaduan::where('status', 'Selesai')->count();

        return view('admin.dashboard.index', compact(
            'totalSiswa',
            'totalKategori',
            'totalPengaduan',
            'pengaduanMenunggu',
            'pengaduanProses',
            'pengaduanSelesai'
        ));
    }
}
