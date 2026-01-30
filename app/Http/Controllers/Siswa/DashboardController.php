<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $nis = session('nis');
        
        $totalPengaduan = Pengaduan::where('nis', $nis)->count();
        $pengaduanProses = Pengaduan::where('nis', $nis)->where('status', 'proses')->count();
        $pengaduanSelesai = Pengaduan::where('nis', $nis)->where('status', 'selesai')->count();
        
        return view('siswa.dashboard', compact('nis', 'totalPengaduan', 'pengaduanProses', 'pengaduanSelesai'));
    }
}
