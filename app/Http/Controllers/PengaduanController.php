<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('kategori');

        // Filter berdasarkan kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $query->orderBy($sortBy, $sortDirection);

        $pengaduans = $query->paginate(10);
        $kategoris = Kategori::all();
        $siswas = \App\Models\Siswa::all();

        return view('daftar-pengaduan', compact('pengaduans', 'kategoris', 'siswas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'keterangan' => 'required',
        ]);

        Pengaduan::create($request->all());
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        $kategoris = Kategori::all();
        return view('pengaduan.edit', compact('pengaduan', 'kategoris'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'keterangan' => 'required',
            'status' => 'required|in:Menunggu,Proses,Selesai',
        ]);

        $pengaduan->update($request->all());
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diupdate');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }

    public function selesai(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'Selesai']);
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diselesaikan');
    }

    public function export(Request $request)
    {
        // Ambil data pengaduan yang sudah difilter (sama dengan index method)
        $query = Pengaduan::with('kategori', 'siswa');

        // Filter berdasarkan kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian keterangan
        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan tanggal spesifik
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter berdasarkan periode (bulan dan tahun)
        if ($request->filled('periode')) {
            // Periode format: YYYY-MM
            $periode = explode('-', $request->periode);
            if (count($periode) == 2) {
                $tahun = $periode[0];
                $bulan = $periode[1];
                $query->whereYear('created_at', $tahun)
                      ->whereMonth('created_at', $bulan);
            }
        }

        // Filter berdasarkan siswa
        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        $pengaduans = $query->get();

        // Untuk sementara, redirect dengan pesan dan info jumlah data
        $message = 'Fitur export PDF akan segera diimplementasikan. ';
        $message .= 'Data yang akan diexport: ' . $pengaduans->count() . ' pengaduan';

        if ($request->filled('id_kategori') || $request->filled('status') || $request->filled('search') ||
            $request->filled('periode') || $request->filled('tanggal') || $request->filled('nis')) {
            $message .= ' (dengan filter aktif)';
        }

        return redirect()->route('daftar-pengaduan', $request->query())
                        ->with('info', $message);
    }
}
