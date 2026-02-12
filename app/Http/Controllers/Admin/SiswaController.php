<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function show(Siswa $siswa)
    {
        return view('admin.siswa.show', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|digits:10|unique:siswas,nis',
            'nama' => 'nullable|string|max:100',
            'kelas' => 'required|string|max:20',
            'keterangan' => 'required|string|max:10',
            'username' => 'required|string|max:50|unique:siswas,username',
            'password' => 'nullable|string|min:6',
        ], [
            'nis.digits' => 'Kolom NIS harus 10 angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'nis.required' => 'NIS wajib diisi.',
            'password.min' => 'Kolom password minimal 6 karakter.',
        ]);

        $data = $request->only(['nis', 'nama', 'kelas', 'keterangan', 'username']);
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|digits:10|unique:siswas,nis,' . $siswa->nis . ',nis',
            'nama' => 'nullable|string|max:100',
            'kelas' => 'required|string|max:20',
            'keterangan' => 'required|string|max:10',
            'username' => 'required|string|max:50|unique:siswas,username,' . $siswa->nis . ',nis',
            'password' => 'nullable|string|min:6',
        ], [
            'nis.digits' => 'Kolom NIS harus 10 angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'nis.required' => 'NIS wajib diisi.',
            'password.min' => 'Kolom password minimal 6 karakter.',
        ]);

        $oldNis = $siswa->nis;
        $newNis = $request->nis;

        DB::transaction(function () use ($siswa, $request, $oldNis, $newNis) {
            if ($oldNis !== $newNis) {
                try {
                    // Try updating the parent first (preferred if FK supports ON UPDATE CASCADE)
                    $siswa->update($request->only(['nis', 'nama', 'kelas', 'keterangan']));
                } catch (QueryException $e) {
                    // If update fails due to foreign key constraint (child rows exist),
                    // create a new siswa, move child rows, then delete the old siswa.
                    $sqlState = $e->getCode();
                    if ($sqlState == '23000') {
                        // Create the new siswa record
                        $data = $request->only(['nis', 'nama', 'kelas', 'keterangan', 'username']);
                        if ($request->filled('password')) {
                            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
                        }
                        Siswa::create($data);

                        // Move child aspirasis to the new nis
                        DB::table('aspirasis')->where('nis', $oldNis)->update(['nis' => $newNis]);

                        // Delete the old siswa
                        $siswa->delete();
                    } else {
                        throw $e;
                    }
                }
            } else {
                // No nis change, just update
                $updateData = $request->only(['nis', 'nama', 'kelas', 'keterangan', 'username']);
                if ($request->filled('password')) {
                    $updateData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
                }
                $siswa->update($updateData);
            }
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
