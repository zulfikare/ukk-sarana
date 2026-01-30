# ⚡ QUICK COMMAND REFERENCE

## 🚀 Ready to Deploy?

Copy dan paste commands berikut untuk implementasi database revision.

---

## 1. Navigasi ke Project
```bash
cd c:\laragon\www\ukk_sarana
```

---

## 2. Fresh Migration (Nuclear Option - Recommended for Dev)
```bash
php artisan migrate:fresh --seed
```

**Output yang diharapkan**:
```
Dropped all tables successfully
Migration table created successfully
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table (...)
Migrating: 0001_01_01_000001_create_cache_table
Migrated:  0001_01_01_000001_create_cache_table (...)
[... more migrations ...]
Migrating: 2026_01_14_004245_create_pengaduans_table
Migrated:  2026_01_14_004245_create_pengaduans_table (...)
[... continue ...]

Seeding: AdminUserSeeder
Seeded:  AdminUserSeeder (...)
Database seeding completed successfully.
```

---

## 3. Verifikasi Database
```bash
php artisan schema:show
```

**Cek Output** untuk:
- ✅ `users` table: id, username, password, remember_token
- ✅ `siswas` table: nis (PK), keterangan
- ✅ `kategoris` table: id_kategori (PK), ket_kategori
- ✅ `aspirasis` table: id_aspirasi, nis (FK), id_kategori (FK), lokasi, keterangan, status, feedback

---

## 4. Clear Cache (Optional)
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 5. Start Server
```bash
php artisan serve
```

Atau akses via browser:
```
http://localhost/ukk_sarana
atau
http://127.0.0.1:8000
```

---

## 6. Test Login Admin
```
Login Tab: Admin
Username: admin
Password: password

➜ Expected: Redirect to /admin/dashboard
```

---

## 7. Test Login Siswa
Pertama, lihat NIS yang tersedia:

```bash
php artisan tinker
>>> \App\Models\Siswa::all();
```

Kemudian login dengan salah satu NIS:
```
Login Tab: Siswa
NIS: [dari database]

➜ Expected: Redirect to /siswa/dashboard
```

---

## 📋 Jika Ada Error

### Error: "SQLSTATE[HY000]: General error: 1 no such table: siswas"

**Solusi**:
```bash
# Pastikan migration sudah fresh
php artisan migrate:fresh --seed

# Atau cek status migration
php artisan migrate:status

# Jika ada di "Pending", jalankan
php artisan migrate
```

---

### Error: "SQLSTATE[HY000]: General error: 1 near 'PRIMARY': syntax error"

**Solusi**:
- Cek migration file `2026_01_13_051204_create_siswas_table.php`
- Pastikan primary key adalah `nis` (integer, unsigned, not auto-increment)

```php
// ✅ Benar
$table->integer('nis', false, true)->primary();

// ❌ Salah
$table->id('nis');
```

---

### Error: Session key tidak ditemukan

**Solusi**:
- Pastikan AuthController sudah update session keys ke `nis` bukan `siswa_id`
- Clear cache: `php artisan cache:clear`

---

## 🎯 Success Indicators

Jika melihat output berikut, revision BERHASIL:

```
✅ Database tables created with correct structure
✅ Foreign keys configured properly
✅ Admin login works with username/password
✅ Student login works with NIS only
✅ Session variables set correctly (nis)
✅ All models use correct primary keys
✅ Controllers use correct field names
```

---

## 📊 Database Structure Verification

Buka database client (MySQL Workbench, phpMyAdmin, DBeaver) dan jalankan:

```sql
-- Check users table
DESC users;
-- Should show: id, username, password, remember_token, created_at, updated_at

-- Check siswas table
DESC siswas;
-- Should show: nis (PK), keterangan, created_at, updated_at

-- Check kategoris table
DESC kategoris;
-- Should show: id_kategori (PK), ket_kategori, created_at, updated_at

-- Check aspirasis table
DESC aspirasis;
-- Should show: id_aspirasi (PK), nis (FK), id_kategori (FK), lokasi, keterangan, status, feedback, created_at, updated_at

-- Check foreign keys
SHOW CREATE TABLE aspirasis\G
-- Should show:
-- FOREIGN KEY (nis) REFERENCES siswas(nis) ON DELETE CASCADE
-- FOREIGN KEY (id_kategori) REFERENCES kategoris(id_kategori) ON DELETE CASCADE
```

---

## 🔐 Important Notes

1. **Data Loss**: `migrate:fresh` akan hapus semua data. Backup dulu jika ada data penting.

2. **Primary Keys**: Jangan auto-increment untuk `nis`, `id_kategori`, `id_aspirasi`.

3. **Foreign Keys**: Pastikan foreign key constraints berfungsi (ON DELETE CASCADE).

4. **Session**: Gunakan `session('nis')` bukan `session('siswa_id')`.

5. **Status Values**: Gunakan exactly `'Menunggu Proses'` atau `'Selesai'` (case-sensitive).

---

## 🚨 Rollback (Jika Diperlukan)

Jika ada masalah serius:

```bash
# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Rollback and re-migrate
php artisan migrate:refresh

# Rollback dan fresh seed
php artisan migrate:fresh --seed
```

---

## ✨ Final Checklist

- [ ] `cd c:\laragon\www\ukk_sarana`
- [ ] `php artisan migrate:fresh --seed`
- [ ] Verify database dengan `php artisan schema:show`
- [ ] Clear cache jika perlu
- [ ] Test login admin (username: admin, password: password)
- [ ] Test login siswa (dengan NIS dari database)
- [ ] Verify semua CRUD operations berfungsi
- [ ] Update Views jika ada yang belum disesuaikan

---

**Status**: Ready for Implementation ✅  
**Estimated Time**: 5-10 minutes  
**Risk Level**: Low (Development), Medium (Production - backup data dulu)

---

Pertanyaan? Refer ke:
- `DATABASE_REVISION.md` - Detail perubahan
- `VERIFICATION_GUIDE.md` - Cara verifikasi
- `REVISION_CHECKLIST.md` - Checklist implementasi
