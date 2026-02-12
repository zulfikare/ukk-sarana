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
        // Unified login: try admin first, then siswa by username/password
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Try admin (users table)
        $user = \App\Models\User::where('username', $username)->first();
        if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            session(['user_type' => 'admin']);
            return redirect('/admin/dashboard')->with('success', 'Selamat datang Admin!');
        }

        // Try siswa
        $siswa = Siswa::where('username', $username)->first();
        if ($siswa && $siswa->keterangan === 'Aktif' && \Illuminate\Support\Facades\Hash::check($password, $siswa->password)) {
            session([
                'nis' => $siswa->nis,
                'kelas' => $siswa->kelas,
                'user_type' => 'siswa'
            ]);

            return redirect('/siswa/dashboard')->with('success', 'Selamat datang!');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->withInput($request->only('username'));
    }

    private function adminLogin(Request $request)
    {
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget(['nis', 'kelas', 'user_type']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}