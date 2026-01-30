# Struktur Database Revisi - Sesuai Diagram ER

## Ringkasan Perubahan

Database structure telah direvisi sesuai dengan diagram ER yang diberikan. Berikut adalah perubahan utama:

### 1. **Users Table (Admin)**
- ✅ Hanya memiliki kolom: `id`, `username`, `password`, `remember_token`, `timestamps`
- ❌ Dihapus: kolom `name`, `email_verified_at`

### 2. **Siswas Table**
- ✅ Primary Key: `nis` (integer, bukan auto-increment)
- ✅ Kolom: `nis`, `keterangan` (varchar 10)
- ❌ Dihapus: `nama`, `kelas`, `jurusan`

### 3. **Kategoris Table**
- ✅ Primary Key: `id_kategori` (integer, bukan auto-increment)
- ✅ Kolom: `id_kategori`, `ket_kategori` (varchar 30)
- ❌ Dihapus: `nama`, `deskripsi`

### 4. **Aspirasis Table** (Pengganti Pengaduans)
- ✅ Nama table: `aspirasis` (bukan `pengaduans`)
- ✅ Primary Key: `id_aspirasi` (integer, bukan auto-increment)
- ✅ Kolom:
  - `id_aspirasi` (int, primary key)
  - `nis` (int, foreign key ke siswas)
  - `id_kategori` (int, foreign key ke kategoris)
  - `lokasi` (varchar 50, nullable)
  - `keterangan` (varchar 50, nullable)
  - `status` (enum: 'Menunggu Proses', 'Selesai')
  - `feedback` (int, nullable)
  - `created_at`, `updated_at`

## File yang Dimodifikasi

### Migrations
1. `0001_01_01_000000_create_users_table.php` - Hapus kolom `name` dan `email_verified_at`
2. `2026_01_13_051204_create_siswas_table.php` - Ubah struktur ke sesuai diagram
3. `2026_01_13_073629_create_kategoris_table.php` - Ubah struktur ke sesuai diagram
4. `2026_01_14_004245_create_pengaduans_table.php` - Ubah menjadi aspirasis table

### Models
1. `app/Models/User.php` - Update fillable: hapus `name`
2. `app/Models/Siswa.php` - Primary key: `nis`, update fillable
3. `app/Models/Kategori.php` - Primary key: `id_kategori`, update fillable
4. `app/Models/Pengaduan.php` - Update untuk use table `aspirasis`, update foreign keys
5. `app/Models/Aspirasi.php` - Model baru untuk aspirasis table

### Controllers
1. `app/Http/Controllers/AuthController.php`
   - `adminLogin()`: Ubah dari `where('name', ...)` ke `where('username', ...)`
   - `siswaLogin()`: Simplifikasi - hanya cek `nis`, hapus `kelas`
   - Update session keys

2. `app/Http/Controllers/PengaduanController.php`
   - Update field references: `siswa_id` → `nis`, `kategori_id` → `id_kategori`
   - Update validation rules untuk foreign keys
   - Update filter queries

3. `app/Http/Controllers/KategoriController.php`
   - Update validation: `nama_kategori` → `ket_kategori`
   - Hapus field `deskripsi`

4. `app/Http/Controllers/Siswa/AspirasiController.php`
   - Update field references
   - Simplifikasi session usage: `siswa_id` → `nis`
   - Hapus upload gambar dan isi_pengaduan fields

### Seeders
1. `database/seeders/AdminUserSeeder.php` - Hapus field `name`

## Langkah Migrasi

### Step 1: Fresh Migration (Recommended)
```bash
php artisan migrate:fresh --seed
```

### Step 2: Jika ingin keep data (Advanced)
- Backup data terlebih dahulu
- Tulis migration untuk migrate data dari pengaduans ke aspirasis
- Sesuaikan field mapping

## Catatan Penting

1. **Primary Keys Non-AutoIncrement**: Pastikan saat insert, app menyediakan nilai untuk `nis` dan `id_kategori`
2. **Foreign Keys**: Relasi sekarang menggunakan `nis` dan `id_kategori` bukan auto-increment `id`
3. **Session**: Sekarang menggunakan `nis` bukan `siswa_id`
4. **Status Values**: Gunakan 'Menunggu Proses' atau 'Selesai' (case-sensitive)
5. **Kolom Dihapus**: `nama`, `kelas`, `jurusan` dari siswa; `deskripsi` dari kategori; `isi_pengaduan`, `pelapor`, `gambar` dari aspirasi

## Validasi Schema

Verifikasi schema baru dengan command:
```bash
php artisan schema:show
```

Atau gunakan database client untuk lihat struktur tabel.
