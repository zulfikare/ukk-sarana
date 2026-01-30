# 🚀 QUICK REFERENCE - UKK Sarana

## 🔗 Akses Utama

**Admin Dashboard:** `http://localhost/admin/dashboard`
**Siswa Dashboard:** `http://localhost/siswa/dashboard`

---

## 📍 Routes Penting

| Rute | Tujuan |
|------|--------|
| `/admin/dashboard` | Dashboard admin + statistik |
| `/admin/siswa` | Kelola data siswa (CRUD) |
| `/admin/kategori` | Kelola kategori (CRUD) |
| `/admin/pengaduan` | Kelola pengaduan + filter |
| `/siswa/dashboard` | Dashboard siswa + statistik personal |
| `/siswa/aspirasi/create` | Form input aspirasi baru |
| `/siswa/riwayat` | Lihat riwayat pengaduan |

---

## 🎯 Tugas Umum

### Tambah Siswa Baru
1. Login as admin → `/admin/siswa` → Klik "Tambah Siswa"
2. Isi form: NIS, Nama, Kelas, Jurusan
3. Submit

### Input Aspirasi (Siswa)
1. Login as siswa → `/siswa/aspirasi/create`
2. Pilih kategori → Tulis detail → Submit

### Update Status Pengaduan (Admin)
1. `/admin/pengaduan` → Klik "Lihat"
2. Pilih status baru → Klik "Perbarui Status"

---

## 🗂️ File Locations

```
Controllers:  app/Http/Controllers/{Admin,Siswa}/*
Views:        resources/views/{admin,siswa}/*
Routes:       routes/{web,admin,siswa}.php
Models:       app/Models/{User,Siswa,Kategori,Pengaduan}.php
```

---

## 📚 Dokumentasi

1. **STRUKTUR_FOLDER_ROUTES.md** - Referensi lengkap
2. **TESTING_VERIFICATION.md** - Panduan testing
3. **IMPLEMENTASI_SUMMARY_v2.md** - Ringkasan implementasi

---

**Status:** ✅ Ready for Deployment
