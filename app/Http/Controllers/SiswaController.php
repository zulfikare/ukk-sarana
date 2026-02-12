<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('data-siswa', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|digits:10|unique:siswas',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ], [
            'nis.digits' => 'Kolom NIS harus 10 angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'nis.required' => 'NIS wajib diisi.',
            'password.min' => 'Kolom password minimal 6 karakter.',
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|digits:10|unique:siswas,nis,' . $siswa->nis . ',nis',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ], [
            'nis.digits' => 'Kolom NIS harus 10 angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'nis.required' => 'NIS wajib diisi.',
            'password.min' => 'Kolom password minimal 6 karakter.',
        ]);

        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
