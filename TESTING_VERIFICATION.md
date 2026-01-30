# Testing & Verification Guide

## ✅ Pre-Deployment Testing

### 1. Route Verification
```bash
# Check all routes are registered
php artisan route:list

# Expected output should show:
# - /admin/dashboard
# - /admin/siswa/* (index, create, store, edit, update, destroy, show)
# - /admin/kategori/* (index, create, store, edit, update, destroy, show)
# - /admin/pengaduan/* (index, show, updateStatus)
# - /siswa/dashboard
# - /siswa/aspirasi/create
# - /siswa/aspirasi (POST)
# - /siswa/riwayat (index)
# - /siswa/riwayat/{id} (show)
```

### 2. Database & Migration
```bash
# Ensure migrations are run
php artisan migrate

# Check tables exist:
# - users
# - siswas
# - kategoris
# - pengaduans (with siswa_id, isi_pengaduan, tanggal_selesai fields)
```

### 3. View Files Verification
```bash
# Check all views are created and accessible
# Admin views (11 files)
resources/views/admin/dashboard/index.blade.php
resources/views/admin/siswa/index.blade.php
resources/views/admin/siswa/create.blade.php
resources/views/admin/siswa/edit.blade.php
resources/views/admin/kategori/index.blade.php
resources/views/admin/kategori/create.blade.php
resources/views/admin/kategori/edit.blade.php
resources/views/admin/pengaduan/index.blade.php
resources/views/admin/pengaduan/show.blade.php
resources/views/admin/components/sidebar.blade.php

# Siswa views (5 files)
resources/views/siswa/dashboard.blade.php
resources/views/siswa/aspirasi/create.blade.php
resources/views/siswa/riwayat/index.blade.php
resources/views/siswa/riwayat/show.blade.php
resources/views/siswa/components/sidebar.blade.php
```

### 4. Middleware Testing
```bash
# Test auth.admin middleware
# Go to: http://localhost/admin/dashboard (without login)
# Expected: Redirect to login page

# Test auth.siswa middleware
# Go to: http://localhost/siswa/dashboard (without login)
# Expected: Redirect or unauthorized message
```

---

## 🧪 Manual Testing Checklist

### Admin Login
- [ ] Login as admin user
- [ ] Should redirect to /admin/dashboard
- [ ] Dashboard shows 4 statistics cards (Siswa, Kategori, Pengaduan, Proses)

### Admin - Data Siswa
- [ ] Go to /admin/siswa - View daftar siswa
- [ ] Click "Tambah Siswa" - Form appears
- [ ] Fill form: NIS, Nama, Kelas, Jurusan
- [ ] Submit - Siswa added to database
- [ ] Click Edit - Form pre-filled with current data
- [ ] Update data - Changes saved
- [ ] Click Delete - Confirmation appears and data deleted

### Admin - Data Kategori
- [ ] Go to /admin/kategori - View daftar kategori
- [ ] Click "Tambah Kategori" - Form appears
- [ ] Fill form: Nama Kategori
- [ ] Submit - Kategori added
- [ ] Edit - Works as expected
- [ ] Delete - Works as expected

### Admin - Pengaduan Management
- [ ] Go to /admin/pengaduan - View daftar pengaduan
- [ ] Test filters: Kategori, Status, Nama Pelapor
- [ ] Click "Lihat" on a pengaduan - Detail page appears
- [ ] Update status: Menunggu → Proses → Selesai
- [ ] Check tanggal_selesai is set when status becomes "Selesai"

### Admin Logout
- [ ] Click Logout
- [ ] Redirect to login page
- [ ] Cannot access /admin/dashboard anymore

---

### Siswa Login
- [ ] Login as siswa user (via custom login)
- [ ] Should redirect to /siswa/dashboard
- [ ] Dashboard shows 4 cards with personal statistics

### Siswa - Input Aspirasi
- [ ] Go to /siswa/aspirasi/create - Form appears
- [ ] Fill form: Kategori, Isi Pengaduan
- [ ] Submit - Pengaduan created
- [ ] Check siswa_id and pelapor are auto-filled from session

### Siswa - Riwayat Pengaduan
- [ ] Go to /siswa/riwayat - View list of own pengaduans
- [ ] Click "Detail" on pengaduan - Detail page appears
- [ ] Check: Hanya bisa lihat pengaduan milik sendiri (not others)
- [ ] Test: Try to access another siswa's pengaduan by URL
  - [ ] Should get 403 Forbidden error

### Siswa Logout
- [ ] Click Logout
- [ ] Redirect to login page
- [ ] Cannot access /siswa/dashboard anymore

---

## 🔍 Validation Testing

### Input Validation
```
Siswa Form:
- [ ] NIS must be unique
- [ ] Nama, Kelas, Jurusan required

Kategori Form:
- [ ] Nama must be unique
- [ ] Nama required

Aspirasi Form:
- [ ] Kategori required (dropdown)
- [ ] Isi Pengaduan minimum 10 characters
- [ ] Error messages display properly
```

### Authorization Testing
```
- [ ] Non-authenticated users cannot access /admin/*
- [ ] Non-authenticated users cannot access /siswa/*
- [ ] Admin cannot access /siswa/* routes
- [ ] Siswa cannot access /admin/* routes
- [ ] Siswa can only see their own pengaduan details
```

---

## 📱 Browser Compatibility

Test on:
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Mobile browsers

Expected:
- [ ] Responsive design works
- [ ] Forms submit properly
- [ ] Navigation works
- [ ] No console errors

---

## 🚀 Performance Checks

```bash
# Check if Laravel is running smoothly
php artisan serve

# Monitor logs for errors
tail -f storage/logs/laravel.log

# Check database connections
# Verify slow queries don't occur
# Ensure pagination works (15 items per page)
```

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: "View not found" error
```
Solution: Check if view file exists in correct path
- Check path uses snake_case and matches namespace
- Check blade.php extension is present
```

**Issue**: "Middleware not found"
```
Solution: Verify middleware is registered in bootstrap/app.php
- Check middleware class exists in App/Http/Middleware/
- Check middleware is added to middleware aliases
```

**Issue**: "Route not found"
```
Solution: Run php artisan route:cache and clear cache
php artisan route:clear
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

**Issue**: Database errors
```
Solution: Ensure migrations are run
php artisan migrate:fresh --seed
```

**Issue**: Session data not found
```
Solution: Check session configuration in .env
- SESSION_DRIVER=file (or cookie)
- Clear sessions: php artisan cache:clear
```

---

## 📊 Test Data Setup

### Seed Test Data
```bash
# Run seeders to populate test data
php artisan db:seed

# Or specific seeder
php artisan db:seed --class=KategoriSeeder
php artisan db:seed --class=SiswaSeeder
php artisan db:seed --class=PengaduanSeeder
```

### Sample Test Users
```
Admin User:
- Email: admin@example.com
- Password: password

Siswa Users:
- Session-based (no email login)
- Set via custom login controller
```

---

## ✅ Final Checklist Before Deployment

- [ ] All routes registered and accessible
- [ ] All views created and rendering properly
- [ ] Database migrations completed
- [ ] Middleware protection working
- [ ] Authorization checks functioning
- [ ] Form validation working
- [ ] Error messages displaying
- [ ] Pagination working
- [ ] Filtering working
- [ ] Status updates working
- [ ] File uploads (if any) working
- [ ] No console errors
- [ ] No database errors
- [ ] Response times acceptable
- [ ] Mobile responsive
- [ ] All links working (no 404)
- [ ] Logout working properly
- [ ] Session data persisting
- [ ] CSRF protection active
- [ ] Admin and Siswa roles separated

---

## 🎯 Deployment Steps

```bash
# 1. Fresh deployment
git clone <repo>
cd ukk_sarana

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate
php artisan db:seed

# 5. Compile assets
npm run build

# 6. Clear all caches
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:clear

# 7. Start application
php artisan serve
# or use: php artisan serve --host=0.0.0.0 --port=8000
```

---

## 📞 Support & Documentation

For questions or issues:
1. Check this documentation first
2. Review Laravel official docs: https://laravel.com/docs
3. Check generated STRUKTUR_FOLDER_ROUTES.md for reference

---

**Last Updated:** {{ date('d/m/Y H:i:s') }}
**Status:** Ready for Testing ✅
