# 🧪 TESTING GUIDE - UKK SARANA

Panduan lengkap untuk testing aplikasi UKK Sarana setelah setup.

---

## ✅ PRE-TESTING CHECKLIST

Sebelum mulai testing, pastikan:

- [ ] Database sudah di-migrate: `php artisan migrate:refresh --seed`
- [ ] Server sedang berjalan: `php artisan serve`
- [ ] Aplikasi accessible: `http://localhost:8000`
- [ ] Browser terbuka dan bersih (clear cache)
- [ ] No error messages di terminal

---

## 🔐 TEST 1: ADMIN LOGIN

### Setup
- Browser: `http://localhost:8000/login`
- Tab: Admin Login
- Email: `admin@example.com`
- Password: `password`

### Test Steps
1. [ ] Go to login page
2. [ ] Click Admin tab
3. [ ] Enter admin@example.com
4. [ ] Enter password
5. [ ] Click Login
6. [ ] Should redirect to `/admin/dashboard`

### Expected Result
```
✅ Successfully logged in as admin
✅ Dashboard displayed with statistics
✅ Can see total siswa, kategori, pengaduan
```

### Possible Issues
| Issue | Solution |
|-------|----------|
| Login fails | Check database seeder ran |
| Page not found | Check migrations complete |
| Blank page | Clear browser cache |

---

## 📊 TEST 2: ADMIN DASHBOARD

### Test Steps
1. [ ] Navigate to `/admin/dashboard`
2. [ ] Verify page loads
3. [ ] Check statistics widgets:
   - [ ] Total Siswa count
   - [ ] Total Kategori count
   - [ ] Total Pengaduan count
   - [ ] Pengaduan Menunggu count
   - [ ] Pengaduan Proses count
   - [ ] Pengaduan Selesai count
4. [ ] Check sidebar navigation:
   - [ ] Dashboard link
   - [ ] Data Siswa link
   - [ ] Data Kategori link
   - [ ] Manajemen Pengaduan link
5. [ ] Check topbar:
   - [ ] User name displayed
   - [ ] Logout button

### Expected Result
```
✅ Dashboard loads without errors
✅ All statistics display correctly
✅ Navigation menu visible and clickable
✅ Can navigate to other admin pages
```

### Database Check
```php
php artisan tinker
DB::table('siswas')->count()        // Should show count
DB::table('kategoris')->count()     // Should show count
DB::table('pengaduans')->count()    // Should show count
```

---

## 👨‍🎓 TEST 3: MANAGE SISWA (CRUD)

### 3.1 CREATE (Create New)
**Route:** `/admin/siswa/create`

#### Test Steps
1. [ ] Navigate to Data Siswa menu
2. [ ] Click "Tambah Siswa" button
3. [ ] Fill form:
   - [ ] NIS: 999 (unique)
   - [ ] Nama: John Doe
   - [ ] Kelas: XII A
   - [ ] Jurusan: RPL
4. [ ] Click Submit
5. [ ] Should redirect to siswa list with success message

#### Expected Result
```
✅ Form validates correctly
✅ New siswa created in database
✅ Success message displayed
✅ New siswa visible in list
```

#### Validation Test
- [ ] Try duplicate NIS → should error
- [ ] Try empty field → should error
- [ ] Try invalid input → should error

### 3.2 READ (View List)
**Route:** `/admin/siswa`

#### Test Steps
1. [ ] Navigate to Data Siswa
2. [ ] Verify all siswa listed
3. [ ] Check pagination:
   - [ ] Shows 10 items per page
   - [ ] Can navigate pages
   - [ ] Count correct
4. [ ] Check all columns visible:
   - [ ] No (nomor urut)
   - [ ] NIS
   - [ ] Nama
   - [ ] Kelas
   - [ ] Jurusan
   - [ ] Actions (Edit/Delete)

#### Expected Result
```
✅ List loads correctly
✅ All siswa displayed
✅ Pagination works
✅ Can sort/filter (if implemented)
```

### 3.3 UPDATE (Edit)
**Route:** `/admin/siswa/{id}/edit`

#### Test Steps
1. [ ] Click Edit button on any siswa
2. [ ] Modify a field (e.g., Kelas)
3. [ ] Click Save
4. [ ] Should redirect to list with success message
5. [ ] Verify changes saved in database

#### Expected Result
```
✅ Form pre-populated correctly
✅ Update works
✅ Changes visible in list
✅ Database updated
```

### 3.4 DELETE (Delete)
**Route:** DELETE `/admin/siswa/{id}`

#### Test Steps
1. [ ] Click Delete button on any siswa
2. [ ] Confirm deletion in dialog
3. [ ] Should redirect to list with success message
4. [ ] Verify siswa removed from list

#### Expected Result
```
✅ Confirmation dialog shown
✅ Siswa deleted from database
✅ Pengaduan associated (cascade delete)
✅ List updated
```

---

## 📂 TEST 4: MANAGE KATEGORI (CRUD)

### Similar to Siswa Tests
Follow same pattern as TEST 3 but for Kategori:

- [ ] Create new kategori
- [ ] View kategori list
- [ ] Edit kategori
- [ ] Delete kategori

#### Test Data
```
Kategori Examples:
- Ruang Kelas
- Toilet
- Perpustakaan
- Kantin
- Lapangan Olahraga
```

#### Expected Result
```
✅ All CRUD operations work
✅ Unique validation works
✅ Cascade delete works
```

---

## 📋 TEST 5: MANAGE PENGADUAN

### 5.1 VIEW PENGADUAN LIST
**Route:** `/admin/pengaduan`

#### Test Steps
1. [ ] Navigate to Manajemen Pengaduan
2. [ ] Verify all pengaduan listed
3. [ ] Check filter options:
   - [ ] By Kategori dropdown visible
   - [ ] Can select kategori
   - [ ] List filters correctly
4. [ ] Check pengaduan details:
   - [ ] Siswa nama
   - [ ] Kategori nama
   - [ ] Status badge
   - [ ] Tanggal pengaduan
5. [ ] Check actions available:
   - [ ] View detail button
   - [ ] Status button

#### Expected Result
```
✅ List loads with pengaduans
✅ Filter works correctly
✅ All columns display
✅ Pagination works
```

### 5.2 VIEW DETAIL
**Route:** `/admin/pengaduan/{id}`

#### Test Steps
1. [ ] Click View Detail on any pengaduan
2. [ ] Verify detail page shows:
   - [ ] Siswa nama
   - [ ] Kategori
   - [ ] Isi pengaduan
   - [ ] Status
   - [ ] Tanggal input
3. [ ] Check action buttons

#### Expected Result
```
✅ Detail page loads correctly
✅ All information displayed
✅ Can update status from here
```

### 5.3 UPDATE STATUS
**Route:** PATCH `/admin/pengaduan/{id}/status`

#### Test Steps
1. [ ] Open pengaduan detail
2. [ ] Click change status button
3. [ ] Change status:
   - [ ] pending → proses
   - [ ] proses → selesai
   - [ ] Test reverse changes
4. [ ] Verify status updated in list

#### Status Flow Test
```
pending  →  proses  →  selesai
  ↓          ↓          ↓
Can change  Can change  Final
```

#### Expected Result
```
✅ Status updates correctly
✅ Valid status values only
✅ Status reflected in list
✅ Dashboard counts update
```

---

## 👤 TEST 6: SISWA LOGIN

### Setup
- Browser: `http://localhost:8000/login`
- Tab: Siswa Login
- NIS: `001`
- Kelas: `X A`

### Test Steps
1. [ ] Go to login page
2. [ ] Click Siswa tab
3. [ ] Enter NIS: 001
4. [ ] Enter Kelas: X A
5. [ ] Click Login
6. [ ] Should redirect to `/siswa/dashboard`

### Expected Result
```
✅ Siswa login works
✅ Session created
✅ Redirected to siswa dashboard
✅ Can access siswa menu
```

---

## 🎓 TEST 7: SISWA DASHBOARD

### Test Steps
1. [ ] Login as siswa
2. [ ] Verify dashboard loads
3. [ ] Check menu options:
   - [ ] Input Aspirasi
   - [ ] Riwayat Pengaduan
   - [ ] Logout

### Expected Result
```
✅ Dashboard loads
✅ Menu visible
✅ Can navigate to features
```

---

## 📝 TEST 8: INPUT ASPIRASI

### Route: `/siswa/aspirasi/create`

#### Test Steps
1. [ ] Navigate to "Input Aspirasi"
2. [ ] Fill form:
   - [ ] Select kategori from dropdown
   - [ ] Enter isi pengaduan (min 10 chars)
3. [ ] Click Submit
4. [ ] Should redirect to riwayat with success

#### Validation Tests
- [ ] Empty kategori → error
- [ ] Empty isi → error
- [ ] Less than 10 chars → error
- [ ] Valid input → success

#### Expected Result
```
✅ Form validates correctly
✅ Pengaduan created with status 'pending'
✅ Linked to logged-in siswa
✅ Visible in riwayat
✅ Success message shown
```

#### Database Check
```php
php artisan tinker
$p = Pengaduan::latest()->first()
$p->status  // Should be 'pending'
$p->siswa_id  // Should match login siswa
```

---

## 📖 TEST 9: RIWAYAT PENGADUAN

### Route: `/siswa/riwayat`

#### Test Steps
1. [ ] Navigate to "Riwayat Pengaduan"
2. [ ] Verify only siswa's pengaduans shown
3. [ ] Check status display:
   - [ ] pending badge color
   - [ ] proses badge color
   - [ ] selesai badge color
4. [ ] Click view detail on any pengaduan
5. [ ] Verify detail page shows all info

#### Expected Result
```
✅ Only siswa's pengaduans shown
✅ Status correctly displayed
✅ Can view detail
✅ Latest pengaduans first
```

---

## 🔐 TEST 10: AUTHORIZATION

### Admin Access Test
- [ ] Non-admin cannot access `/admin/dashboard`
- [ ] Non-admin redirected to login
- [ ] Admin can access all admin routes

### Siswa Access Test
- [ ] Non-siswa cannot access `/siswa/dashboard`
- [ ] Non-siswa redirected to login
- [ ] Siswa can only see own pengaduans

#### Test Steps
1. [ ] Try access admin route as siswa
   → Should redirect to login
2. [ ] Try access siswa route as admin
   → Should redirect to login
3. [ ] Try access without login
   → Should redirect to login

#### Expected Result
```
✅ Middleware blocks unauthorized access
✅ Redirects to login
✅ Each role can only access own pages
```

---

## 🔄 TEST 11: DATA CONSISTENCY

### Foreign Key Test
1. [ ] Create siswa
2. [ ] Create pengaduan for that siswa
3. [ ] Delete siswa
4. [ ] Verify pengaduan also deleted (cascade)

### Enum Test
```php
php artisan tinker
$p = Pengaduan::first()
$p->status  // Should be one of: pending, proses, selesai
```

### Database Integrity
```sql
-- Check foreign keys
SELECT * FROM pengaduans WHERE siswa_id NOT IN (SELECT id FROM siswas);
-- Should return 0 rows

SELECT * FROM pengaduans WHERE kategori_id NOT IN (SELECT id FROM kategoris);
-- Should return 0 rows
```

#### Expected Result
```
✅ No orphaned records
✅ Cascade delete works
✅ Enum values valid
✅ Foreign keys enforced
```

---

## 🐛 TEST 12: ERROR HANDLING

### Invalid Input Tests
- [ ] Invalid NIS format → validation error
- [ ] Duplicate NIS → validation error
- [ ] Invalid status → validation error
- [ ] Missing required fields → validation error

### 404 Tests
- [ ] Invalid siswa ID → 404 or error
- [ ] Invalid pengaduan ID → 404 or error
- [ ] Deleted record access → 404

### SQL Tests
- [ ] Corrupted data → handled gracefully
- [ ] Empty results → "Belum ada data" message
- [ ] Database error → appropriate error message

#### Expected Result
```
✅ All errors handled gracefully
✅ User-friendly error messages
✅ No SQL errors exposed
✅ App doesn't crash
```

---

## 📊 TEST 13: PAGINATION

### Test Steps
1. [ ] Add 20+ siswa
2. [ ] Go to siswa list
3. [ ] Verify:
   - [ ] Only 10 items per page
   - [ ] Pagination links shown
   - [ ] Can navigate to page 2
   - [ ] Correct count displayed

### Expected Result
```
✅ Pagination works
✅ Correct items per page
✅ All pages accessible
```

---

## 🎨 TEST 14: UI/UX

### Responsive Design
- [ ] Desktop view works
- [ ] Tablet view works
- [ ] Mobile view works (if responsive)

### Navigation
- [ ] All links work
- [ ] Breadcrumbs correct
- [ ] Back buttons work

### User Feedback
- [ ] Success messages display
- [ ] Error messages clear
- [ ] Loading states shown
- [ ] Confirmation dialogs work

#### Expected Result
```
✅ UI responsive
✅ Navigation intuitive
✅ User always knows what's happening
```

---

## 📈 FINAL CHECKLIST

After all tests, verify:

- [ ] All CRUD operations work
- [ ] Login works (admin & siswa)
- [ ] Validations work
- [ ] Status changes work
- [ ] Filters work
- [ ] Pagination works
- [ ] Authorization works
- [ ] Database integrity maintained
- [ ] No console errors
- [ ] No unhandled exceptions

---

## ✅ TEST RESULT TEMPLATE

When all tests pass, document as:

```
✅ TEST PASSED - DATE: 2026-01-14

Admin Testing:
- ✅ Dashboard
- ✅ Siswa CRUD
- ✅ Kategori CRUD
- ✅ Pengaduan Management
- ✅ Authorization

Siswa Testing:
- ✅ Login
- ✅ Dashboard
- ✅ Input Aspirasi
- ✅ View Riwayat

System Testing:
- ✅ Data Consistency
- ✅ Error Handling
- ✅ Pagination
- ✅ UI/UX

Status: PRODUCTION READY ✅
```

---

## 🐛 KNOWN ISSUES & SOLUTIONS

| Issue | Solution |
|-------|----------|
| Login fails | Clear cookies, try incognito mode |
| Pagination 404 | Check URL query params |
| Styling off | Clear browser cache |
| Database locked | Restart server |

---

## 📞 DEBUGGING TIPS

### Check Database
```bash
php artisan tinker
DB::table('siswas')->get()
DB::table('pengaduans')->get()
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

### Database Connection
```bash
php artisan tinker
DB::connection()->getPDO()
```

---

**Testing Guide Version:** 1.0
**Last Updated:** 2026-01-14
**Status:** ✅ COMPLETE

Selamat testing! 🧪
