<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\AspirasiController;
use App\Http\Controllers\Siswa\RiwayatController;

Route::middleware(['auth.siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    // Aspirasi
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{pengaduan}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{pengaduan}', [AspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{pengaduan}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{pengaduan}', [RiwayatController::class, 'show'])->name('riwayat.show');
});
