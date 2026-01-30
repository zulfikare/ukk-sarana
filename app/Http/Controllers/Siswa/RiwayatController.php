<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatController extends Controller
{
    public function index()
    {
        $nis = session('nis');
        
        $pengaduans = Pengaduan::where('nis', $nis)
                              ->with('kategori')
                              ->orderBy('created_at', 'desc')
                              ->paginate(10);
        
        return view('siswa.riwayat.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $nis = session('nis');
        
        if ($pengaduan->nis !== $nis) {
            abort(403, 'Unauthorized');
        }
        
        return view('siswa.riwayat.show', compact('pengaduan'));
    }
}
