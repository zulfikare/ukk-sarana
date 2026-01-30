<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;

Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Master Data - Siswa
    Route::resource('/siswa', AdminSiswaController::class);

    // Master Data - Kategori
    Route::resource('/kategori', AdminKategoriController::class);

    // Pengaduan Management
    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan:id_aspirasi}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan:id_aspirasi}', [AdminPengaduanController::class, 'update'])->name('pengaduan.update');
    Route::patch('/pengaduan/{pengaduan:id_aspirasi}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::get('/pengaduan/export', [AdminPengaduanController::class, 'export'])->name('pengaduan.export');
});
