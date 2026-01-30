# 🚀 INSTALLATION GUIDE - Role Siswa

Panduan instalasi lengkap untuk menjalankan sistem role siswa.

---

## ✅ Prerequisites

Pastikan sudah ter-install:
- PHP 8.0 atau lebih tinggi
- Laravel 11.x
- MySQL/MariaDB
- Composer
- Node.js (opsional, untuk asset compilation)

---

## 📥 Installation Steps

### Step 1: Extract/Clone Files
```bash
# Pastikan semua file sudah ter-extract ke folder project
cd c:\laragon\www\ukk_sarana
```

### Step 2: Install Dependencies (jika diperlukan)
```bash
composer install
```

### Step 3: Database Configuration
Pastikan file `.env` sudah dikonfigurasi dengan database credentials Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ukk_sarana
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations
**PENTING**: Langkah ini wajib untuk membuat table schema yang benar.

```bash
php artisan migrate
```

**Expected Output**:
```
INFO  Running migrations.
2026_01_15_add_siswa_fields_to_pengaduans ............................... 1s DONE
```

### Step 5: (Opsional) Seed Demo Data
Jika ingin menambahkan data dummy untuk testing:

```bash
php artisan db:seed --class=DemoSiswaSeeder
```

**Demo Login Credentials**:
```
Siswa 1:
- NIS: 12001
- Kelas: XII IPA 1

Siswa 2:
- NIS: 12002
- Kelas: XII IPS 1
```

### Step 6: Clear Cache
```bash
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

### Step 7: Start Development Server
```bash
php artisan serve
```

Atau jika menggunakan Laragon:
- Buka Laragon
- Double-click project atau akses dari browser
- URL: `http://localhost` atau `http://ukk_sarana.local`

---

## 🧪 Verification

### 1. Check Routes
```bash
php artisan route:list | grep siswa
```

Expected: 5 siswa routes

### 2. Check Application
```bash
php artisan tinker
# Should show PHP prompt without errors
exit
```

### 3. Test in Browser
```
1. Open: http://localhost/login
2. Select "Siswa" tab
3. Use demo credentials (if seeded)
   - NIS: 12001
   - Kelas: XII IPA 1
4. Click Login
5. Should redirect to /siswa/dashboard
```

---

## 📂 File Locations

Setelah instalasi, file-file berikut harus ada:

### Controllers
```
✓ app/Http/Controllers/SiswaDashboardController.php
```

### Middleware
```
✓ app/Http/Middleware/AuthSiswa.php
```

### Views
```
✓ resources/views/siswa/dashboard.blade.php
✓ resources/views/siswa/input-aspirasi.blade.php
✓ resources/views/siswa/riwayat-pengaduan.blade.php
✓ resources/views/siswa/detail-pengaduan.blade.php
✓ resources/views/components/sidebar-siswa.blade.php
```

### Database
```
✓ database/migrations/2026_01_15_add_siswa_fields_to_pengaduans.php
✓ database/seeders/DemoSiswaSeeder.php
```

### Documentation
```
✓ START_HERE.md
✓ README_SISWA.md
✓ PANDUAN_SISWA.md
✓ DOKUMENTASI_SISWA.md
✓ QUICK_REFERENCE.md
✓ CHECKLIST_SISWA.md
✓ RINGKASAN_IMPLEMENTASI.md
✓ DEPLOYMENT_CHECKLIST.md
✓ DOKUMENTASI_INDEX.md
✓ FINAL_REPORT.md
✓ INSTALLATION.md (file ini)
```

---

## 🔧 Troubleshooting

### Error: Class 'SiswoDashboardController' not found
**Solusi**:
```bash
composer dump-autoload
php artisan config:cache
```

### Error: Migration not found
**Solusi**:
- Pastikan file migration ada di `database/migrations/`
- Run: `php artisan migrate:refresh`

### Error: Middleware not registered
**Solusi**:
- Check `bootstrap/app.php` contains:
```php
'auth.siswa' => \App\Http\Middleware\AuthSiswa::class,
```

### Routes not found (404)
**Solusi**:
```bash
php artisan route:clear
php artisan config:cache
```

### Session issues
**Solusi**:
```bash
# Clear Laravel cache
php artisan cache:clear
php artisan config:clear

# Clear browser cookies
# Delete all cookies for localhost
```

---

## 🌐 Accessing the Application

### Local Development
```
URL: http://localhost:8000
atau
http://localhost (jika menggunakan Laragon)
```

### Login
```
1. Go to /login
2. Select "Siswa" tab
3. Enter credentials:
   - NIS: 12001 (demo)
   - Kelas: XII IPA 1 (demo)
4. Click Login
```

### Dashboard
After successful login, you'll be at:
```
URL: /siswa/dashboard
```

---

## 📋 Post-Installation Checklist

- [ ] PHP version >= 8.0
- [ ] Laravel 11.x installed
- [ ] MySQL database created
- [ ] .env configured
- [ ] Dependencies installed (composer install)
- [ ] Migrations executed (php artisan migrate)
- [ ] Cache cleared
- [ ] Routes verified
- [ ] Demo data seeded (optional)
- [ ] Login tested
- [ ] Dashboard displayed
- [ ] All 4 menus working
- [ ] Logout tested

---

## 🚀 Quick Start (TL;DR)

```bash
# 1. Navigate to project
cd c:\laragon\www\ukk_sarana

# 2. Configure .env (if needed)
# Edit .env with database details

# 3. Install composer (if needed)
composer install

# 4. Run migration
php artisan migrate

# 5. Seed demo data (optional)
php artisan db:seed --class=DemoSiswaSeeder

# 6. Clear cache
php artisan config:cache

# 7. Start server
php artisan serve

# 8. Open browser
# http://localhost:8000/login
```

---

## 📞 Support

### If you encounter issues:
1. Check `DOKUMENTASI_SISWA.md` - Troubleshooting section
2. Check `PANDUAN_SISWA.md` - User guide
3. Check `QUICK_REFERENCE.md` - Technical reference
4. Check application logs: `storage/logs/laravel.log`
5. Run `php artisan tinker` to test basic app functionality

---

## 🔄 Updating/Reinstalling

### To reset the database
```bash
php artisan migrate:refresh
```

### To drop and recreate everything
```bash
php artisan migrate:fresh
```

### To seed data again
```bash
php artisan db:seed --class=DemoSiswaSeeder
```

---

## 📊 System Requirements

| Component | Requirement | Status |
|-----------|-------------|--------|
| PHP | 8.0+ | ✅ |
| Laravel | 11.x | ✅ |
| MySQL | 5.7+ | ✅ |
| Composer | Latest | ✅ |
| Browser | Modern | ✅ |
| Disk Space | 50MB | ✅ |
| Memory | 256MB+ | ✅ |

---

## 🎓 Next Steps After Installation

1. **Read Documentation**
   - Start with: `START_HERE.md`
   - Then: `PANDUAN_SISWA.md` (if you're a user)
   - Then: `DOKUMENTASI_SISWA.md` (if you're a developer)

2. **Test Features**
   - Login as student
   - Create a complaint
   - View history
   - Check detail & timeline

3. **Deploy** (when ready)
   - Follow: `DEPLOYMENT_CHECKLIST.md`

---

## ✨ Installation Complete!

Sistem role siswa sudah siap digunakan. 

**Next**: Buka browser dan kunjungi `/login`

---

**Version**: 1.0  
**Date**: 15 Januari 2026  
**Status**: ✅ Ready
