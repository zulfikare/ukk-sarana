<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard');
    }
    if (session('user_type') === 'siswa') {
        return redirect('/siswa/dashboard');
    }
    return redirect('/login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Pengaduan Listing (tanpa authentication)
Route::get('/pengaduan', [\App\Http\Controllers\PengaduanController::class, 'index'])->name('daftar-pengaduan');

// Admin Routes
require __DIR__ . '/admin.php';

// Siswa Routes
require __DIR__ . '/siswa.php';
