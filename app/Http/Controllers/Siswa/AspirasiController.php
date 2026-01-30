<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AspirasiController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'nullable|string|max:50',
            'ket' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,gif,webp|max:5120',
        ]);

        $nis = session('nis');

        $data = [
            'nis' => $nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ];

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $nis . '.' . $file->getClientOriginalExtension();
            $file->storeAs('aspirasi', $filename, 'public');
            $data['gambar'] = $filename;
        }

        Pengaduan::create($data);

        return redirect()->route('siswa.riwayat.index')->with('success', 'Aspirasi berhasil disampaikan!');
    }

    public function edit(Pengaduan $pengaduan)
    {
        $nis = session('nis');
        
        // Authorization check
        if ($pengaduan->nis != $nis) {
            abort(403, 'Unauthorized');
        }

        $kategoris = Kategori::all();
        return view('siswa.aspirasi.edit', compact('pengaduan', 'kategoris'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $nis = session('nis');
        
        // Authorization check
        if ($pengaduan->nis != $nis) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'nullable|string|max:50',
            'ket' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,gif,webp|max:5120',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ];

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($pengaduan->gambar) {
                \Storage::disk('public')->delete('aspirasi/' . $pengaduan->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $nis . '.' . $file->getClientOriginalExtension();
            $file->storeAs('aspirasi', $filename, 'public');
            $data['gambar'] = $filename;
        }

        $pengaduan->update($data);

        return redirect()->route('siswa.riwayat.index')->with('success', 'Aspirasi berhasil diperbarui!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $nis = session('nis');
        
        // Authorization check
        if ($pengaduan->nis != $nis) {
            abort(403, 'Unauthorized');
        }

        // Delete image if exists
        if ($pengaduan->gambar) {
            \Storage::disk('public')->delete('aspirasi/' . $pengaduan->gambar);
        }

        $pengaduan->delete();

        return redirect()->route('siswa.riwayat.index')->with('success', 'Aspirasi berhasil dihapus!');
    }
}
