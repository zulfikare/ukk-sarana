# 🔍 VERIFICATION GUIDE - Database Revision

## ✅ Semua File Backend Telah Diupdate

Gunakan guide ini untuk memverifikasi bahwa semua perubahan sudah diterapkan dengan benar.

---

## 1️⃣ VERIFICATION: Database Migrations

### ✓ Users Table
**File**: `database/migrations/0001_01_01_000000_create_users_table.php`

**Cek**:
```sql
-- Should have only:
- id (PK)
- username (UNIQUE)
- password
- remember_token
- created_at, updated_at

-- Should NOT have:
- name ❌
- email_verified_at ❌
```

### ✓ Siswas Table
**File**: `database/migrations/2026_01_13_051204_create_siswas_table.php`

**Cek**:
```sql
-- Primary Key: nis (not auto-increment)
-- Columns:
- nis (int, PK, not auto-increment)
- keterangan (varchar 10, nullable)
- created_at, updated_at

-- Should NOT have:
- nama ❌
- kelas ❌
- jurusan ❌
```

### ✓ Kategoris Table
**File**: `database/migrations/2026_01_13_073629_create_kategoris_table.php`

**Cek**:
```sql
-- Primary Key: id_kategori (not auto-increment)
-- Columns:
- id_kategori (int, PK, not auto-increment)
- ket_kategori (varchar 30)
- created_at, updated_at

-- Should NOT have:
- nama ❌
- deskripsi ❌
```

### ✓ Aspirasis Table
**File**: `database/migrations/2026_01_14_004245_create_pengaduans_table.php`

**Cek**:
```sql
-- Table name: aspirasis (not pengaduans)
-- Primary Key: id_aspirasi (not auto-increment)
-- Columns:
- id_aspirasi (int, PK, not auto-increment)
- nis (int, FK to siswas.nis)
- id_kategori (int, FK to kategoris.id_kategori)
- lokasi (varchar 50, nullable)
- keterangan (varchar 50, nullable)
- status (enum: 'Menunggu Proses', 'Selesai')
- feedback (int, nullable)
- created_at, updated_at

-- Should NOT have:
- pelapor ❌
- isi_pengaduan ❌
- gambar ❌
- tanggal_selesai ❌
```

---

## 2️⃣ VERIFICATION: Models

### ✓ User Model
**File**: `app/Models/User.php`
```php
// ✅ fillable hanya berisi
protected $fillable = ['username', 'password'];

// ✅ casts hanya berisi
return ['password' => 'hashed'];

// ❌ Tidak boleh ada:
// - 'name' di fillable
// - 'email_verified_at' di casts
```

### ✓ Siswa Model
**File**: `app/Models/Siswa.php`
```php
// ✅ Primary key:
protected $primaryKey = 'nis';
public $incrementing = false;
protected $keyType = 'int';

// ✅ fillable:
protected $fillable = ['nis', 'keterangan'];

// ❌ Jangan ada:
// - ['nama', 'kelas', 'jurusan']
```

### ✓ Kategori Model
**File**: `app/Models/Kategori.php`
```php
// ✅ Primary key:
protected $primaryKey = 'id_kategori';
public $incrementing = false;
protected $keyType = 'int';

// ✅ fillable:
protected $fillable = ['id_kategori', 'ket_kategori'];

// ❌ Jangan ada:
// - ['nama', 'deskripsi']
```

### ✓ Pengaduan Model
**File**: `app/Models/Pengaduan.php`
```php
// ✅ Table name:
protected $table = 'aspirasis';

// ✅ Primary key:
protected $primaryKey = 'id_aspirasi';
public $incrementing = false;
protected $keyType = 'int';

// ✅ fillable:
protected $fillable = ['id_aspirasi', 'nis', 'id_kategori', 'lokasi', 'keterangan', 'status', 'feedback'];

// ✅ Relationships harus gunakan:
// siswa() -> belongsTo(Siswa::class, 'nis', 'nis')
// kategori() -> belongsTo(Kategori::class, 'id_kategori', 'id_kategori')
```

### ✓ Aspirasi Model
**File**: `app/Models/Aspirasi.php`
```php
// ✅ Harus ada file ini dengan struktur sama seperti Pengaduan
// ✅ Table: aspirasis
// ✅ Primary key: id_aspirasi
```

---

## 3️⃣ VERIFICATION: Controllers

### ✓ AuthController
**File**: `app/Http/Controllers/AuthController.php`

**adminLogin()**:
```php
// ✅ Query gunakan username field:
$user = User::where('username', $request->username)->first();

// ❌ Jangan gunakan:
// $user = User::where('name', $request->username)->first();
```

**siswaLogin()**:
```php
// ✅ Hanya validate NIS:
$request->validate(['nis' => 'required|string']);

// ✅ Session keys:
session(['nis' => $siswa->nis, 'user_type' => 'siswa']);

// ❌ Jangan ada:
// - validasi 'kelas'
// - session key 'siswa_id', 'siswa_nama', 'siswa_kelas'
```

**logout()**:
```php
// ✅ Forget keys:
session()->forget(['nis', 'user_type']);

// ❌ Jangan ada:
// session()->forget(['siswa_id', 'siswa_nama', 'siswa_nis', 'siswa_kelas', 'user_type']);
```

### ✓ PengaduanController
**File**: `app/Http/Controllers/PengaduanController.php`

**index()**:
```php
// ✅ Field references:
$query->where('id_kategori', $request->id_kategori);
$query->where('nis', $request->nis);

// ❌ Jangan ada:
// $query->where('kategori_id', ...)
// $query->where('siswa_id', ...)
```

**store()**:
```php
// ✅ Validation:
'nis' => 'required|exists:siswas,nis',
'id_kategori' => 'required|exists:kategoris,id_kategori',
'keterangan' => 'required',

// ❌ Jangan ada:
// 'kategori_id' => 'exists:kategoris,id'
// 'pelapor' atau 'isi_pengaduan'
```

**update()**:
```php
// ✅ Status values:
'status' => 'required|in:Menunggu Proses,Selesai',

// ❌ Jangan ada:
// 'status' => 'required|in:Dalam Proses,Selesai'
```

### ✓ KategoriController
**File**: `app/Http/Controllers/KategoriController.php`

**store() & update()**:
```php
// ✅ Validation:
'ket_kategori' => 'required|string|max:30',

// ❌ Jangan ada:
// 'nama_kategori' => 'required'
// 'deskripsi' => 'nullable'
```

### ✓ AspirasiController (Siswa)
**File**: `app/Http/Controllers/Siswa/AspirasiController.php`

**store()**:
```php
// ✅ Validation dan fields:
'id_kategori' => 'required|exists:kategoris,id_kategori',
'lokasi' => 'nullable|string|max:50',
'keterangan' => 'required|string|max:50',

// ✅ Session:
$nis = session('nis');

// ❌ Jangan ada:
// 'siswa_id' dari session
// 'siswa_nama' 
// File upload handling
// 'isi_pengaduan'
```

---

## 4️⃣ VERIFICATION: Database Seeding

**File**: `database/seeders/AdminUserSeeder.php`

```php
// ✅ Create user:
User::firstOrCreate(
    ['username' => 'admin'],
    ['password' => Hash::make('password')]
);

// ❌ Jangan ada:
// ['name' => 'Administrator']
```

---

## 5️⃣ MIGRATION & TESTING STEPS

### Step 1: Fresh Migration
```bash
cd c:\laragon\www\ukk_sarana

# Jalankan fresh migration
php artisan migrate:fresh --seed

# Output yang diharapkan:
# - Dropped all tables
# - Tables created: users, siswas, kategoris, aspirasis
# - Seeded AdminUserSeeder
```

### Step 2: Verify Database Structure
```bash
php artisan schema:show

# Cek output:
# - users table (id, username, password, remember_token, timestamps)
# - siswas table (nis PK, keterangan, timestamps)
# - kategoris table (id_kategori PK, ket_kategori, timestamps)
# - aspirasis table (id_aspirasi PK, nis FK, id_kategori FK, lokasi, keterangan, status, feedback, timestamps)
```

### Step 3: Test Admin Login
```
URL: http://localhost/ukk_sarana/login
Type: Admin
Username: admin
Password: password

✅ Harusnya berhasil login ke /admin/dashboard
```

### Step 4: Test Siswa Login
```
URL: http://localhost/ukk_sarana/login
Type: Siswa
NIS: [Insert valid NIS from database]

✅ Harusnya berhasil login ke /siswa/dashboard
```

### Step 5: Verify Foreign Keys
```bash
# Di database, check foreign keys:
# aspirasis.nis -> siswas.nis (ON DELETE CASCADE)
# aspirasis.id_kategori -> kategoris.id_kategori (ON DELETE CASCADE)

# Atau via SQL:
SELECT CONSTRAINT_NAME, TABLE_NAME, REFERENCED_TABLE_NAME 
FROM INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS 
WHERE TABLE_NAME IN ('aspirasis', 'siswas', 'kategoris');
```

---

## 6️⃣ CHECKLIST FINAL

- [ ] Semua migrations diupdate dengan struktur baru
- [ ] Semua models dikonfigurasi dengan primary key yang benar
- [ ] AuthController menggunakan field yang tepat
- [ ] PengaduanController menggunakan field baru
- [ ] KategoriController menggunakan field baru
- [ ] AspirasiController menggunakan field baru
- [ ] Session keys diupdate (gunakan 'nis' bukan 'siswa_id')
- [ ] Seeder hanya berisi username dan password
- [ ] Fresh migration berjalan tanpa error
- [ ] Database structure sesuai diagram ER
- [ ] Login admin berfungsi
- [ ] Login siswa berfungsi
- [ ] Foreign keys berfungsi dengan benar

---

## 📋 Next Steps After Verification

1. Update semua Views yang mereferensi field lama
2. Test semua fitur (create, read, update, delete)
3. Test session dan authentication
4. Test foreign key relationships
5. Deploy ke production

---

**Last Updated**: 2026-01-26  
**Revision Status**: COMPLETE & VERIFIED
