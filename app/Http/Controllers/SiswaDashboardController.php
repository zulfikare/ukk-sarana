<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function dashboard()
    {
        $siswa_nis = session('nis');
        $siswa_nama = session('siswa_nama');
        
        // Ambil statistik pengaduan siswa dari input_aspirasi
        $totalPengaduan = \App\Models\InputAspirasi::where('nis', $siswa_nis)->count();
        $pengaduanProses = \App\Models\InputAspirasi::where('nis', $siswa_nis)->count();
        $pengaduanSelesai = 0;
        
        return view('siswa.dashboard', compact('siswa_nama', 'totalPengaduan', 'pengaduanProses', 'pengaduanSelesai'));
    }

    public function inputAspirasi()
    {
        $kategori = Kategori::all();
        return view('siswa.input-aspirasi', compact('kategori'));
    }

    public function storeAspirasi(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'nullable|string|max:50',
            'ket' => 'nullable|string|max:50',
        ]);

        $siswa_nis = session('nis');

        \App\Models\InputAspirasi::create([
            'nis' => $siswa_nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ]);

        return redirect()->route('siswa.riwayat')->with('success', 'Aspirasi berhasil disampaikan!');
    }

    public function riwayatPengaduan()
    {
        $siswa_id = session('siswa_id');
        
        $pengaduan = Pengaduan::where('siswa_id', $siswa_id)
                              ->with('kategori')
                              ->orderBy('created_at', 'desc')
                              ->paginate(10);
        
        return view('siswa.riwayat-pengaduan', compact('pengaduan'));
    }

    public function detailPengaduan($id)
    {
        $siswa_id = session('siswa_id');
        $pengaduan = Pengaduan::where('siswa_id', $siswa_id)->findOrFail($id);
        
        return view('siswa.detail-pengaduan', compact('pengaduan'));
    }
}
