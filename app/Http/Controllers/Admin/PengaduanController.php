<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['kategori', 'siswa']);

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $pengaduans = $query->paginate(10);
        $kategoris = Kategori::all();
        $siswas = \App\Models\Siswa::all();

        return view('admin.pengaduan.index', compact('pengaduans', 'kategoris', 'siswas'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        $kategoris = Kategori::all();
        return view('admin.pengaduan.edit', compact('pengaduan', 'kategoris'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengaduan.show', $pengaduan->id_aspirasi)
                       ->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string',
        ]);

        $pengaduan->update($request->only(['id_kategori', 'status', 'feedback']));

        return redirect()->route('admin.pengaduan.show', $pengaduan->id_aspirasi)
                       ->with('success', 'Pengaduan berhasil diperbarui');
    }

    public function export()
    {
        $pengaduan = Pengaduan::with(['kategori'])->get();
        return view('admin.pengaduan.export', compact('pengaduan'));
    }
}
