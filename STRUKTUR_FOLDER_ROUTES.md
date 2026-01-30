# Dokumentasi Struktur Folder dan Routes - UKK Sarana

## 📋 Ringkasan Perubahan

Telah dilakukan reorganisasi lengkap struktur folder untuk memisahkan role **Admin** dan **Siswa** agar lebih rapi dan terorganisir. Struktur sekarang mengikuti prinsip **Separation of Concerns** dengan namespace dan folder yang terpisah untuk setiap role.

---

## 🗂️ Struktur Folder Baru

### Controllers
```
app/Http/Controllers/
├── Admin/
│   ├── DashboardController.php    (Dashboard dengan statistik)
│   ├── SiswaController.php         (CRUD Siswa)
│   ├── KategoriController.php      (CRUD Kategori)
│   └── PengaduanController.php     (Manajemen Pengaduan)
└── Siswa/
    ├── DashboardController.php     (Dashboard Siswa)
    ├── AspirasiController.php      (Create & Store Aspirasi)
    └── RiwayatController.php       (View Riwayat Pengaduan)
```

### Views
```
resources/views/
├── admin/
│   ├── components/
│   │   └── sidebar.blade.php       (Sidebar Admin)
│   ├── dashboard/
│   │   └── index.blade.php         (Dashboard Admin)
│   ├── siswa/
│   │   ├── index.blade.php         (Daftar Siswa)
│   │   ├── create.blade.php        (Form Tambah Siswa)
│   │   └── edit.blade.php          (Form Edit Siswa)
│   ├── kategori/
│   │   ├── index.blade.php         (Daftar Kategori)
│   │   ├── create.blade.php        (Form Tambah Kategori)
│   │   └── edit.blade.php          (Form Edit Kategori)
│   └── pengaduan/
│       ├── index.blade.php         (Daftar Pengaduan dengan Filter)
│       └── show.blade.php          (Detail & Update Status Pengaduan)
└── siswa/
    ├── components/
    │   └── sidebar.blade.php       (Sidebar Siswa)
    ├── dashboard.blade.php         (Dashboard Siswa)
    ├── aspirasi/
    │   └── create.blade.php        (Form Input Aspirasi)
    └── riwayat/
        ├── index.blade.php         (Daftar Riwayat Pengaduan)
        └── show.blade.php          (Detail Pengaduan)
```

### Routes
```
routes/
├── web.php                         (Main routes + Login/Logout)
├── admin.php                       (Admin routes dengan prefix /admin)
└── siswa.php                       (Siswa routes dengan prefix /siswa)
```

---

## 🔐 Middleware & Authentication

### Registered Middleware
Semua middleware terdaftar di `bootstrap/app.php`:
```php
'auth.admin' => \App\Http\Middleware\AuthAdmin::class,
'auth.siswa' => \App\Http\Middleware\AuthSiswa::class,
```

### Authentication Method
- **Admin**: Menggunakan Laravel Built-in `Auth::check()` dengan User model
- **Siswa**: Menggunakan Session-based auth dengan `session('user_type') === 'siswa'`

---

## 🚀 Routes & Navigation

### Main Routes (`/`)
| Method | Route | Controller | Description |
|--------|-------|-----------|-------------|
| GET | / | - | Home redirect |
| GET | /login | - | Login form |
| POST | /login | - | Process login |
| POST | /logout | - | Process logout |

### Admin Routes (`/admin/*`)
| Method | Route | Name | Controller | Description |
|--------|-------|------|-----------|-------------|
| GET | /admin/dashboard | admin.dashboard | DashboardController@index | Admin Dashboard |
| GET | /admin/siswa | admin.siswa.index | SiswaController@index | List Siswa |
| GET | /admin/siswa/create | admin.siswa.create | SiswaController@create | Form Tambah |
| POST | /admin/siswa | admin.siswa.store | SiswaController@store | Store Siswa |
| GET | /admin/siswa/{id} | admin.siswa.show | SiswaController@show | Detail Siswa |
| GET | /admin/siswa/{id}/edit | admin.siswa.edit | SiswaController@edit | Form Edit |
| PUT | /admin/siswa/{id} | admin.siswa.update | SiswaController@update | Update Siswa |
| DELETE | /admin/siswa/{id} | admin.siswa.destroy | SiswaController@destroy | Delete Siswa |
| **KATEGORI** |
| GET | /admin/kategori | admin.kategori.index | KategoriController@index | List Kategori |
| GET | /admin/kategori/create | admin.kategori.create | KategoriController@create | Form Tambah |
| POST | /admin/kategori | admin.kategori.store | KategoriController@store | Store Kategori |
| GET | /admin/kategori/{id} | admin.kategori.show | KategoriController@show | Detail Kategori |
| GET | /admin/kategori/{id}/edit | admin.kategori.edit | KategoriController@edit | Form Edit |
| PUT | /admin/kategori/{id} | admin.kategori.update | KategoriController@update | Update Kategori |
| DELETE | /admin/kategori/{id} | admin.kategori.destroy | KategoriController@destroy | Delete Kategori |
| **PENGADUAN** |
| GET | /admin/pengaduan | admin.pengaduan.index | PengaduanController@index | List Pengaduan |
| GET | /admin/pengaduan/{id} | admin.pengaduan.show | PengaduanController@show | Detail Pengaduan |
| PATCH | /admin/pengaduan/{id}/status | admin.pengaduan.updateStatus | PengaduanController@updateStatus | Update Status |
| GET | /admin/pengaduan/export | admin.pengaduan.export | PengaduanController@export | Export Data |

### Siswa Routes (`/siswa/*`)
| Method | Route | Name | Controller | Description |
|--------|-------|------|-----------|-------------|
| GET | /siswa/dashboard | siswa.dashboard | DashboardController@index | Siswa Dashboard |
| GET | /siswa/aspirasi/create | siswa.aspirasi.create | AspirasiController@create | Form Input Aspirasi |
| POST | /siswa/aspirasi | siswa.aspirasi.store | AspirasiController@store | Store Aspirasi |
| GET | /siswa/riwayat | siswa.riwayat.index | RiwayatController@index | List Riwayat |
| GET | /siswa/riwayat/{id} | siswa.riwayat.show | RiwayatController@show | Detail Pengaduan |

---

## 📊 Admin Dashboard Features

### Statistik Ditampilkan:
1. **Total Siswa** - Jumlah siswa di database
2. **Total Kategori** - Jumlah kategori yang tersedia
3. **Total Pengaduan** - Semua pengaduan yang masuk
4. **Pengaduan Proses** - Pengaduan yang sedang ditangani

### Menu Navigasi Admin:
- Dashboard
- Manajemen Siswa
- Manajemen Kategori
- Pengaduan

---

## 👨‍🎓 Siswa Dashboard Features

### Statistik Ditampilkan:
1. **Total Pengaduan** - Total aspirasi yang sudah diinput
2. **Proses** - Aspirasi yang sedang diproses
3. **Selesai** - Aspirasi yang sudah selesai
4. **Aksi Cepat** - Tombol Input Aspirasi Baru

### Menu Navigasi Siswa:
- Dashboard
- Input Aspirasi
- Riwayat Pengaduan
- Logout

---

## 🔄 Form Features

### Admin - Form Siswa
- Input: NIS (Unique), Nama, Kelas, Jurusan
- Validasi: NIS harus unik, semua field wajib diisi

### Admin - Form Kategori
- Input: Nama Kategori (Unique)
- Validasi: Nama harus unik

### Admin - Pengaduan Management
- Filter: Kategori, Status, Nama Pelapor
- Update Status: Dari Menunggu → Proses → Selesai
- Status Changes: Otomatis set `tanggal_selesai` saat status jadi "Selesai"

### Siswa - Form Aspirasi
- Input: Kategori (dropdown), Isi Pengaduan (textarea)
- Validasi: Kategori wajib, Isi minimal 10 karakter
- Auto-fill: `siswa_id`, `pelapor` dari session

### Siswa - Riwayat Pengaduan
- Tampil: Daftar pengaduan siswa dengan status
- Filter: Hanya menampilkan pengaduan milik siswa yang login
- Authorization: Hanya pemilik bisa lihat detail (abort 403)

---

## 🛡️ Authorization & Access Control

### Admin Routes
- Middleware: `auth.admin`
- Check: `auth()->check()` - Harus login sebagai User (Admin)
- Access: Semua admin routes dilindungi

### Siswa Routes
- Middleware: `auth.siswa`
- Check: `session('user_type') === 'siswa'` - Harus login sebagai Siswa
- Access: Semua siswa routes dilindungi
- Detail Protection: `RiwayatController@show()` - Abort 403 jika bukan pemilik

---

## 📝 Database Relations

### Models & Fields
- **Pengaduan** ↔ **Siswa** (belongsTo)
  - `pengaduans.siswa_id` → Foreign Key
  
- **Pengaduan** ↔ **Kategori** (belongsTo)
  - `pengaduans.kategori_id` → Foreign Key

### New Fields in Pengaduan
- `siswa_id` - ID Siswa yang membuat pengaduan
- `isi_pengaduan` - Konten detail pengaduan
- `tanggal_selesai` - Waktu pengaduan selesai diproses

---

## ✅ Status Flow

```
PENDING (Menunggu)
    ↓
PROSES (Diproses)
    ↓
SELESAI (Selesai)
```

Status Changes:
- Admin bisa ubah status dari Pending ke Proses atau sebaliknya
- Status "Selesai" secara otomatis set `tanggal_selesai` ke timestamp saat ini

---

## 🎯 Key Features per Role

### Admin
✅ Kelola data siswa (CRUD)
✅ Kelola kategori pengaduan (CRUD)
✅ Lihat semua pengaduan dengan filter
✅ Update status pengaduan
✅ Dashboard dengan statistik sistem
✅ Sidebar navigasi terorganisir

### Siswa
✅ Lihat dashboard dengan statistik personal
✅ Input aspirasi/keluhan dengan kategori
✅ Lihat riwayat semua pengaduan yang dibuat
✅ Lihat detail dan status setiap pengaduan
✅ Authorization: Hanya bisa lihat pengaduan milik sendiri
✅ Sidebar navigasi siswa

---

## 🚀 Cara Mengakses

### Admin Access
- URL: `http://localhost/admin/dashboard`
- Harus login terlebih dahulu sebagai Admin (User)
- Middleware: `auth.admin`

### Siswa Access
- URL: `http://localhost/siswa/dashboard`
- Session: `session('user_type') === 'siswa'`
- Middleware: `auth.siswa`

---

## 📂 File yang Dimodifikasi/Dibuat

### Routes
- ✅ `routes/web.php` - Diperbaharui (clean & minimal)
- ✅ `routes/admin.php` - Dibuat baru
- ✅ `routes/siswa.php` - Dibuat baru

### Controllers
- ✅ `App/Http/Controllers/Admin/DashboardController.php`
- ✅ `App/Http/Controllers/Admin/SiswaController.php`
- ✅ `App/Http/Controllers/Admin/KategoriController.php`
- ✅ `App/Http/Controllers/Admin/PengaduanController.php`
- ✅ `App/Http/Controllers/Siswa/DashboardController.php`
- ✅ `App/Http/Controllers/Siswa/AspirasiController.php`
- ✅ `App/Http/Controllers/Siswa/RiwayatController.php`

### Middleware
- ✅ `App/Http/Middleware/AuthAdmin.php` - Dibuat baru
- ✅ `bootstrap/app.php` - Updated dengan middleware alias

### Views - Admin (8 files)
- ✅ `resources/views/admin/components/sidebar.blade.php`
- ✅ `resources/views/admin/dashboard/index.blade.php`
- ✅ `resources/views/admin/siswa/index.blade.php`
- ✅ `resources/views/admin/siswa/create.blade.php`
- ✅ `resources/views/admin/siswa/edit.blade.php`
- ✅ `resources/views/admin/kategori/index.blade.php`
- ✅ `resources/views/admin/kategori/create.blade.php`
- ✅ `resources/views/admin/kategori/edit.blade.php`
- ✅ `resources/views/admin/pengaduan/index.blade.php`
- ✅ `resources/views/admin/pengaduan/show.blade.php`

### Views - Siswa (5 files)
- ✅ `resources/views/siswa/components/sidebar.blade.php`
- ✅ `resources/views/siswa/dashboard.blade.php` - Updated
- ✅ `resources/views/siswa/aspirasi/create.blade.php`
- ✅ `resources/views/siswa/riwayat/index.blade.php`
- ✅ `resources/views/siswa/riwayat/show.blade.php`

---

## 🔗 Dependencies & Relationships

### Component Include
Views menggunakan include untuk components:
```blade
@include('admin.components.sidebar')
@include('siswa.components.sidebar')
@include('components.topbar')
@include('components.footer')
```

### Route Helpers
Menggunakan named routes untuk navigation:
- `route('admin.dashboard')` - Admin Dashboard
- `route('admin.siswa.index')` - Daftar Siswa
- `route('siswa.dashboard')` - Siswa Dashboard
- `route('siswa.aspirasi.create')` - Form Input Aspirasi
- dll

---

## 📋 Checklist Implementasi

- ✅ Folder structure terorganisir
- ✅ Namespace separation (Admin & Siswa)
- ✅ Routes terpisah dengan prefix
- ✅ Middleware protection
- ✅ All Views created
- ✅ Navigation sidebars
- ✅ Dashboard dengan statistik
- ✅ Form CRUD lengkap
- ✅ Authorization checks
- ✅ Status management
- ✅ Filter & search features
- ✅ Responsive design (using Bootstrap)

---

## 🎓 Catatan

Struktur ini mengikuti **Laravel Best Practices** dengan prinsip:
- DRY (Don't Repeat Yourself)
- SOLID Principles (Single Responsibility)
- Clear Separation of Concerns
- Organized Namespacing
- Middleware-based Access Control

Semua fitur sudah siap digunakan dan ditest!

---

**Dibuat pada:** {{ date('d/m/Y H:i:s') }}
**Status:** ✅ Complete - Siap Deployment
