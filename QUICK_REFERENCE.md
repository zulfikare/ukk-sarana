# 🎯 QUICK REFERENCE - Role Siswa

## 🔗 URL Routes

| Path | Method | Controller | Nama Route |
|------|--------|-----------|-----------|
| `/siswa/dashboard` | GET | SiswaDashboardController@dashboard | siswa.dashboard |
| `/siswa/input-aspirasi` | GET | SiswaDashboardController@inputAspirasi | siswa.input-aspirasi |
| `/siswa/input-aspirasi` | POST | SiswaDashboardController@storeAspirasi | siswa.store-aspirasi |
| `/siswa/riwayat` | GET | SiswaDashboardController@riwayatPengaduan | siswa.riwayat |
| `/siswa/detail/{id}` | GET | SiswaDashboardController@detailPengaduan | siswa.detail-pengaduan |

## 🔐 Middleware

- **Tipe**: Session-based Authentication
- **Middleware**: `auth.siswa`
- **Location**: `app/Http/Middleware/AuthSiswa.php`
- **Registered in**: `bootstrap/app.php`

**Check**:
```php
session('user_type') === 'siswa' && session('siswa_id')
```

## 📄 Template Files

| File | Purpose |
|------|---------|
| `siswa/dashboard.blade.php` | Statistik & info |
| `siswa/input-aspirasi.blade.php` | Form input pengaduan |
| `siswa/riwayat-pengaduan.blade.php` | List semua pengaduan |
| `siswa/detail-pengaduan.blade.php` | Detail & timeline |
| `components/sidebar-siswa.blade.php` | Navigation menu |

## 🗄️ Database

### Table: `pengaduans`

**New/Updated Fields**:
```sql
- siswa_id (unsigned bigint, FK) → siswas.id
- isi_pengaduan (longtext)
- tanggal_selesai (timestamp, nullable)
```

**Migration**: `2026_01_15_add_siswa_fields_to_pengaduans.php`

## 🎨 UI Components

### Dashboard Cards
```php
- Total Pengaduan (border-left-primary)
- Pengaduan Proses (border-left-warning)
- Pengaduan Selesai (border-left-success)
- Quick Actions (border-left-info)
```

### Status Badges
```php
- Masuk: badge-warning (🟡 Kuning)
- Proses: badge-info (🔵 Biru)
- Selesai: badge-success (✅ Hijau)
```

### Pagination
```php
$pengaduan = Pengaduan::...->paginate(10);
// Displays 10 items per page
```

## 📊 Data Flow

### Create Pengaduan
```
Form Input → POST /siswa/input-aspirasi
                ↓
          storeAspirasi()
                ↓
          Validate Input
                ↓
          Create Pengaduan
          (siswa_id dari session)
                ↓
          Redirect ke Riwayat
          with success message
```

### View Riwayat
```
GET /siswa/riwayat
        ↓
riwayatPengaduan()
        ↓
Query: Pengaduan::where('siswa_id', session('siswa_id'))
                 ->with('kategori')
                 ->paginate(10)
        ↓
Display Tabel + Pagination
```

### View Detail
```
GET /siswa/detail/{id}
        ↓
detailPengaduan($id)
        ↓
Check: Pengaduan->siswa_id === session('siswa_id')
        ↓
Display Lengkap + Timeline
```

## 📝 Form Validation

### Input Aspirasi
```php
$validated = $request->validate([
    'kategori_id' => 'required|exists:kategoris,id',
    'isi_pengaduan' => 'required|string|min:10',
]);
```

**Rules**:
- Kategori: Required, must exist in kategoris table
- Isi: Required, minimum 10 characters

## 🔑 Session Data

Saat login berhasil:
```php
session([
    'siswa_id' => $siswa->id,           // INT
    'siswa_nama' => $siswa->nama,       // STRING
    'siswa_nis' => $siswa->nis,         // STRING
    'siswa_kelas' => $siswa->kelas,     // STRING
    'user_type' => 'siswa'              // STRING
]);
```

## 🚀 Bootstrap Commands

```bash
# Cache config
php artisan config:cache

# Clear config cache
php artisan config:clear

# View routes
php artisan route:list

# Migration
php artisan migrate

# Seed demo
php artisan db:seed --class=DemoSiswaSeeder
```

## 📦 File Structure

```
✅ app/Http/Controllers/SiswaDashboardController.php
✅ app/Http/Middleware/AuthSiswa.php
✅ resources/views/siswa/
   ├── dashboard.blade.php
   ├── input-aspirasi.blade.php
   ├── riwayat-pengaduan.blade.php
   └── detail-pengaduan.blade.php
✅ resources/views/components/sidebar-siswa.blade.php
✅ database/migrations/2026_01_15_...php
✅ database/seeders/DemoSiswaSeeder.php
```

## 🧪 Test Data

**Demo Seeder**: `DemoSiswaSeeder.php`

```php
// Siswa 1
NIS: 12001
Kelas: XII IPA 1
Nama: John Doe

// Siswa 2
NIS: 12002
Kelas: XII IPS 1
Nama: Jane Smith

// Categories
- Ruang Kelas
- Laboratorium
- Perpustakaan
- Toilet
- Kantin

// Sample Pengaduans
- 3 untuk John (status: selesai, proses, masuk)
- 2 untuk Jane (status: selesai, proses)
```

Run seeder:
```bash
php artisan db:seed --class=DemoSiswaSeeder
```

## 🔍 Key Methods

### SiswaDashboardController

```php
// Get dashboard stats
public function dashboard()
    → $totalPengaduan, $pengaduanProses, $pengaduanSelesai

// Show input form
public function inputAspirasi()
    → $kategori = Kategori::all()

// Save pengaduan
public function storeAspirasi(Request $request)
    → Validate & Create Pengaduan
    → Redirect to siswa.riwayat

// Get history with pagination
public function riwayatPengaduan()
    → Pengaduan::where('siswa_id', ...)->paginate(10)

// Get detail with check
public function detailPengaduan($id)
    → Check siswa_id
    → Return with kategori
```

## 🎯 Status Values

```php
'masuk'   // Baru diterima
'proses'  // Sedang ditangani
'selesai' // Sudah ditangani
```

## 📲 Frontend Routes

```
/login → Login page
/siswa/dashboard → Dashboard
/siswa/input-aspirasi → Form input (GET)
/siswa/input-aspirasi → Submit (POST)
/siswa/riwayat → History list
/siswa/detail/{id} → Detail view
/logout → Logout (POST)
```

## 💻 Browser Testing

1. Open Dev Tools (F12)
2. Check Network tab for requests
3. Check Console for errors
4. Check Storage → Cookies for session

## 🐛 Common Issues

| Problem | Solution |
|---------|----------|
| Routes not found | `php artisan route:clear` |
| Cache issues | `php artisan config:cache` |
| DB errors | Check migration, run `php artisan migrate` |
| 403 Forbidden | Check middleware, verify session |
| Session lost | Clear cookies, login again |

---

**Version**: 1.0  
**Last Updated**: 15 Januari 2026
