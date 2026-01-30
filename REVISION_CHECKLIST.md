# Checklist Revisi Database Struktur

## ✅ Migrations Diupdate

- [x] `0001_01_01_000000_create_users_table.php` - Hapus `name` dan `email_verified_at`
- [x] `2026_01_13_051204_create_siswas_table.php` - Primary key: `nis`, tambah `keterangan`
- [x] `2026_01_13_073629_create_kategoris_table.php` - Primary key: `id_kategori`, rename ke `ket_kategori`
- [x] `2026_01_14_004245_create_pengaduans_table.php` - Ubah ke `aspirasis` table dengan struktur baru

## ✅ Models Diupdate

- [x] `app/Models/User.php` - Update `fillable` hapus `name`
- [x] `app/Models/Siswa.php` - Set primary key `nis`, update `fillable`
- [x] `app/Models/Kategori.php` - Set primary key `id_kategori`, update `fillable`
- [x] `app/Models/Pengaduan.php` - Set table `aspirasis`, primary key `id_aspirasi`, update relationships
- [x] `app/Models/Aspirasi.php` - Model baru untuk aspirasis

## ✅ Controllers Diupdate

### AuthController
- [x] `adminLogin()` - Ubah dari `where('name', ...)` ke `where('username', ...)`
- [x] `siswaLogin()` - Hapus validasi `kelas`, update session keys
- [x] `logout()` - Update session forget keys

### PengaduanController
- [x] `index()` - Update field references dan joins
- [x] `store()` - Update validation untuk field baru
- [x] `update()` - Update status values, validation
- [x] `export()` - Update filter references

### KategoriController
- [x] `store()` - Update validation: `nama_kategori` → `ket_kategori`
- [x] `update()` - Update validation: `nama_kategori` → `ket_kategori`

### AspirasiController (Siswa)
- [x] `store()` - Update field references, hapus gambar handling
- [x] Session keys - Gunakan `nis` bukan `siswa_id`

## ✅ Seeders Diupdate

- [x] `AdminUserSeeder.php` - Hapus field `name` dari create/firstOrCreate

## ✅ Documentation

- [x] `DATABASE_REVISION.md` - Dokumentasi lengkap perubahan
- [x] Cleanup migration file dibuat

## 📋 Langkah Implementasi

### Option 1: Fresh Migration (Recommended untuk Development)
```bash
cd c:\laragon\www\ukk_sarana
php artisan migrate:fresh --seed
```

### Option 2: Testing Database Changes
```bash
# Backup database dulu
# Buat migration baru jika ingin data migration
php artisan migrate
```

## 🔍 Verifikasi

Setelah migration, jalankan:

```bash
# Cek struktur database
php artisan schema:show

# Test login admin
# Username: admin
# Password: password

# Test login siswa
# NIS: [sesuai data di database]
```

## 📝 Views yang Perlu Di-Cek

- [ ] `resources/views/login.blade.php` - Update form siswa (hapus field kelas)
- [ ] `resources/views/daftar-pengaduan.blade.php` - Update field display
- [ ] `resources/views/data-kategori.blade.php` - Update field display
- [ ] `resources/views/siswa/aspirasi/create.blade.php` - Update form fields
- [ ] Semua modal dan form yang reference field lama

## ⚠️ Perhatian

1. Data lama dari `pengaduans` table akan hilang saat fresh migration
2. Backup database sebelum migrate jika ada data penting
3. Pastikan semua views sudah diupdate untuk field baru
4. Test login untuk admin dan siswa
5. Verifikasi foreign key relationships berfungsi dengan baik

---

**Last Updated**: 2026-01-26
**Status**: Database structure revision complete
