<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $loginType = $request->input('login_type', 'admin');

        if ($loginType === 'admin') {
            return $this->adminLogin($request);
        } elseif ($loginType === 'siswa') {
            return $this->siswaLogin($request);
        }

        return back()->withErrors(['general' => 'Tipe login tidak valid.']);
    }

    private function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Manual authentication without using Auth::attempt()
        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            session(['user_type' => 'admin']);
            return redirect('/admin/dashboard')->with('success', 'Selamat datang Admin!');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->withInput($request->only('username'))
            ->with('active_tab', 'admin');
    }

    private function siswaLogin(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->first();

        if ($siswa && $siswa->keterangan === 'Aktif') {
            // Buat session untuk siswa
            session([
                'nis' => $siswa->nis,
                'user_type' => 'siswa'
            ]);

            return redirect('/siswa/dashboard')->with('success', 'Selamat datang!');
        }

        return back()
            ->withErrors(['nis' => 'NIS tidak ditemukan atau akun tidak aktif.'])
            ->withInput($request->only('nis'))
            ->with('active_tab', 'siswa');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget(['nis', 'user_type']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}