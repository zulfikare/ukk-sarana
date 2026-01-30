# Dokumentasi Fitur Role Siswa

## Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Fitur-fitur](#fitur-fitur)
3. [Instalasi & Setup](#instalasi--setup)
4. [Penggunaan](#penggunaan)
5. [Struktur File](#struktur-file)
6. [Endpoints API](#endpoints-api)

---

## Pengenalan

Fitur role siswa memungkinkan siswa untuk:
- Mengakses dashboard pribadi mereka
- Menginput aspirasi/keluhan tentang sarana dan prasarana sekolah
- Melihat riwayat pengaduan yang telah dibuat
- Melihat detail dan status pengaduan
- Logout dari sistem

---

## Fitur-fitur

### 1. **Dashboard Siswa**
- Menampilkan statistik pengaduan:
  - Total pengaduan yang dibuat
  - Jumlah pengaduan dalam proses
  - Jumlah pengaduan yang sudah selesai
- Quick action untuk membuat pengaduan baru
- Informasi penting tentang sistem
- Tombol bantuan

### 2. **Input Aspirasi**
- Form untuk menginput aspirasi/keluhan
- Pilihan kategori pengaduan
- Text area untuk isi pengaduan dengan validasi minimum 10 karakter
- Notifikasi sukses setelah pengaduan berhasil dikirim
- Panduan menulis aspirasi yang efektif

### 3. **Riwayat Pengaduan**
- Daftar semua pengaduan yang dibuat oleh siswa
- Pagination (10 item per halaman)
- Informasi yang ditampilkan:
  - Nomor urut
  - Tanggal dan waktu pengaduan
  - Kategori pengaduan
  - Ringkasan isi pengaduan
  - Status (Masuk, Proses, Selesai)
- Tombol untuk melihat detail pengaduan
- Tombol untuk membuat pengaduan baru

### 4. **Detail Pengaduan**
- Informasi lengkap pengaduan:
  - Tanggal pengaduan
  - Kategori
  - Nama pelapor
  - Status
  - Tanggal selesai (jika ada)
  - Waktu pemrosesan
  - Isi pengaduan lengkap
- Timeline status pengaduan:
  - Status Masuk
  - Status Proses
  - Status Selesai
- Informasi dan keterangan tentang status

### 5. **Sidebar Menu**
Menu navigasi khusus siswa yang terdiri dari:
- Dashboard
- Input Aspirasi
- Riwayat Pengaduan
- Logout

---

## Instalasi & Setup

### 1. **Jalankan Migration**
Untuk menambahkan field yang diperlukan ke database pengaduan:
```bash
php artisan migrate
```

### 2. **Struktur Database**
Table `pengaduans` akan ditambahkan field:
- `siswa_id` (unsigned big integer, nullable) - Foreign key ke table siswas
- `isi_pengaduan` (long text, nullable) - Isi lengkap pengaduan
- `tanggal_selesai` (timestamp, nullable) - Waktu pengaduan selesai

### 3. **Middleware Authentication**
Middleware `AuthSiswa` sudah terdaftar di `bootstrap/app.php` dengan alias `auth.siswa`

---

## Penggunaan

### Login sebagai Siswa
1. Buka halaman login (`/login`)
2. Pilih tab **Siswa**
3. Input NIS dan Kelas
4. Klik tombol **Login**

### Mengakses Dashboard Siswa
Setelah login, siswa akan diarahkan ke `/siswa/dashboard`

### Membuat Pengaduan Baru
1. Dari dashboard, klik tombol **"Input Aspirasi Baru"**
2. Pilih kategori pengaduan
3. Isi isi pengaduan (minimal 10 karakter)
4. Klik tombol **"Kirim Aspirasi"**

### Melihat Riwayat Pengaduan
1. Klik menu **"Riwayat Pengaduan"** di sidebar
2. Lihat daftar semua pengaduan yang telah dibuat
3. Klik tombol **"Lihat"** untuk melihat detail pengaduan

### Logout
1. Klik menu **"Logout"** di sidebar
2. Siswa akan dikembalikan ke halaman login

---

## Struktur File

### Controllers
```
app/Http/Controllers/
├── SiswaDashboardController.php       # Controller utama untuk fitur siswa
└── AuthController.php                  # Login/logout logic (sudah ada)
```

### Views
```
resources/views/
├── siswa/
│   ├── dashboard.blade.php             # Dashboard siswa
│   ├── input-aspirasi.blade.php        # Form input aspirasi
│   ├── riwayat-pengaduan.blade.php     # Daftar riwayat pengaduan
│   └── detail-pengaduan.blade.php      # Detail pengaduan
├── components/
│   ├── sidebar-siswa.blade.php         # Sidebar menu untuk siswa
│   ├── topbar.blade.php                # Topbar (shared)
│   └── footer.blade.php                # Footer (shared)
```

### Middleware
```
app/Http/Middleware/
├── AuthSiswa.php                       # Middleware untuk validasi session siswa
└── CheckAuth.php                       # Middleware lainnya (sudah ada)
```

### Models
```
app/Models/
├── Pengaduan.php                       # Model dengan relasi ke Siswa
├── Siswa.php                           # Model siswa
└── Kategori.php                        # Model kategori
```

### Routes
```
routes/
└── web.php                             # Route dengan prefix siswa dan middleware auth.siswa
```

### Migrations
```
database/migrations/
└── 2026_01_15_add_siswa_fields_to_pengaduans.php    # Migration untuk update table
```

---

## Endpoints API

### Rute Siswa (dengan middleware `auth.siswa`)

| Method | Endpoint | Controller | Fungsi |
|--------|----------|-----------|---------|
| GET | `/siswa/dashboard` | SiswaDashboardController@dashboard | Menampilkan dashboard siswa |
| GET | `/siswa/input-aspirasi` | SiswaDashboardController@inputAspirasi | Menampilkan form input aspirasi |
| POST | `/siswa/input-aspirasi` | SiswaDashboardController@storeAspirasi | Menyimpan pengaduan baru |
| GET | `/siswa/riwayat` | SiswaDashboardController@riwayatPengaduan | Menampilkan riwayat pengaduan |
| GET | `/siswa/detail/{id}` | SiswaDashboardController@detailPengaduan | Menampilkan detail pengaduan |

### Rute Auth (Umum)

| Method | Endpoint | Controller | Fungsi |
|--------|----------|-----------|---------|
| GET | `/login` | AuthController@showLoginForm | Form login |
| POST | `/login` | AuthController@login | Proses login |
| POST | `/logout` | AuthController@logout | Proses logout |

---

## Validasi Form

### Input Aspirasi
- **Kategori ID**: Required, harus ada di table kategoris
- **Isi Pengaduan**: Required, minimum 10 karakter, string

---

## Session Data

Ketika siswa login, session berikut disimpan:
```php
[
    'siswa_id' => 1,                    // ID siswa dari database
    'siswa_nama' => 'John Doe',         // Nama siswa
    'siswa_nis' => '12345',             // NIS siswa
    'siswa_kelas' => 'XII IPA 1',       // Kelas siswa
    'user_type' => 'siswa'              // Tipe user
]
```

---

## Keamanan

- Middleware `auth.siswa` memastikan hanya siswa yang sudah login yang bisa akses routes siswa
- Query pengaduan di-filter berdasarkan `siswa_id` dari session
- Form input memiliki validasi CSRF token
- Password tidak disimpan, hanya NIS dan kelas yang divalidasi

---

## Troubleshooting

### Halaman tidak ditemukan (404)
- Pastikan migration sudah dijalankan
- Periksa route di `routes/web.php`
- Clear cache: `php artisan config:cache && php artisan view:clear`

### Redirect ke login
- Pastikan session siswa sudah dibuat saat login
- Periksa middleware `AuthSiswa` di `app/Http/Middleware/AuthSiswa.php`
- Verifikasi alias middleware di `bootstrap/app.php`

### Data tidak muncul
- Pastikan siswa ID ada di database table `siswas`
- Periksa relasi di model `Pengaduan`
- Gunakan `dd(session())` untuk debug session data

---

## Pengembangan Lebih Lanjut

Fitur-fitur yang bisa ditambahkan di masa depan:
1. Export pengaduan ke PDF
2. Notifikasi email untuk update status pengaduan
3. File upload untuk bukti/dokumentasi
4. Rating/feedback untuk pengaduan yang sudah selesai
5. Pencarian dan filter pengaduan
6. Arsip pengaduan
7. Multiple pengaduan simultan dengan queue

---

## Catatan Penting

- User type siswa menggunakan session, bukan authentication Laravel standar
- Middleware `auth.siswa` mengecek kombinasi `user_type === 'siswa'` dan `siswa_id` yang ada
- Setiap pengaduan yang dibuat akan otomatis dikaitkan dengan siswa yang sedang login
- Status pengaduan diatur oleh admin melalui halaman admin yang terpisah

---

Dibuat: 15 Januari 2026
Versi: 1.0
