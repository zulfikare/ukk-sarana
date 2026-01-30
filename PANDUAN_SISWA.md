# PANDUAN CEPAT ROLE SISWA

## 🎯 Menu Siswa yang Disediakan

```
┌─────────────────────────────────┐
│  Dashboard Siswa                │
│  ├─ Dashboard                   │
│  ├─ Input Aspirasi              │
│  ├─ Riwayat Pengaduan           │
│  └─ Logout                      │
└─────────────────────────────────┘
```

---

## ⚡ Fitur Utama

### 1️⃣ **Dashboard**
- Statistik pengaduan (Total, Proses, Selesai)
- Quick action untuk input aspirasi
- Informasi penting dan help

**Akses**: `/siswa/dashboard`

---

### 2️⃣ **Input Aspirasi**
- Form untuk membuat pengaduan baru
- Pilih kategori aspirtasi
- Tulis isi pengaduan (min 10 karakter)
- Submit dan otomatis tersimpan

**Akses**: `/siswa/input-aspirasi`

**Validasi**:
- ✓ Kategori harus dipilih
- ✓ Isi minimum 10 karakter
- ✓ Tidak boleh kosong

---

### 3️⃣ **Riwayat Pengaduan**
- Lihat semua pengaduan yang sudah dibuat
- Daftar dengan tabel terstruktur
- Status badge: Masuk 🟡 | Proses 🔵 | Selesai ✅
- Pagination otomatis (10 item/halaman)
- Klik "Lihat" untuk detail pengaduan

**Akses**: `/siswa/riwayat`

---

### 4️⃣ **Detail Pengaduan**
- Informasi lengkap pengaduan:
  - Tanggal & waktu
  - Kategori
  - Pelapor
  - Status saat ini
  - Tanggal selesai (jika ada)
  - Lama pemrosesan
  - Isi lengkap pengaduan

- Timeline status:
  - ✅ Pengaduan Masuk (saat dibuat)
  - ⏳ Dalam Proses (sedang ditangani)
  - ✅ Selesai (sudah ditangani)

**Akses**: `/siswa/riwayat` → Klik "Lihat"

---

### 5️⃣ **Logout**
- Keluar dari sistem
- Kembali ke halaman login

**Akses**: Klik "Logout" di sidebar

---

## 🚀 Cara Menggunakan

### Step 1: Login
```
1. Buka /login
2. Pilih tab "Siswa"
3. Input NIS (Nomor Induk Siswa)
4. Input Kelas
5. Klik "Login"
```

### Step 2: Lihat Dashboard
```
Otomatis diarahkan ke /siswa/dashboard
Lihat statistik pengaduan Anda
```

### Step 3: Input Aspirasi Baru
```
1. Klik "Input Aspirasi" di sidebar
2. Pilih kategori (Ruang Kelas, Lab, Perpustakaan, dll)
3. Tulis isi pengaduan dengan detail
4. Klik "Kirim Aspirasi"
5. Lihat notifikasi sukses
```

### Step 4: Cek Riwayat
```
1. Klik "Riwayat Pengaduan" di sidebar
2. Lihat daftar semua pengaduan
3. Klik "Lihat" untuk detail status
4. Lihat timeline pemrosesan
```

### Step 5: Logout
```
1. Klik "Logout" di sidebar
2. Konfirmasi logout
3. Kembali ke login
```

---

## 📊 Status Pengaduan

| Status | Warna | Arti |
|--------|-------|------|
| **Masuk** | 🟡 Kuning | Pengaduan baru diterima |
| **Proses** | 🔵 Biru | Sedang ditindaklanjuti |
| **Selesai** | ✅ Hijau | Sudah ditangani |

---

## ✅ Validasi Form Input Aspirasi

```
❌ SALAH                          ✅ BENAR
- Kategori tidak dipilih           - Kategori dipilih
- Isi kosong                       - Isi minimal 10 karakter
- Isi kurang dari 10 karakter      - Isi deskriptif dan jelas
- Teks tidak relevan               - Spesifik dan detail
```

---

## 💡 Tips Menulis Aspirasi yang Baik

1. **Spesifik**: Jelaskan masalah dengan detail
   ```
   ❌ Ruang kelas tidak nyaman
   ✅ Ruang kelas XII IPA 1 AC tidak dingin, 
      perlu perbaikan urgently
   ```

2. **Jelas**: Gunakan bahasa yang mudah dipahami
   ```
   ❌ Gini lah, AC nya rusak banget
   ✅ AC di ruang kelas XII IPA 1 tidak berfungsi 
      dan perlu segera diperbaiki
   ```

3. **Lokasi**: Sebutkan tempat jika ada
   ```
   ❌ Toiletnya ada masalah
   ✅ Toilet di lantai 2 dekat lab komputer 
      tidak ada air
   ```

4. **Waktu**: Sebutkan kapan terjadi
   ```
   ❌ Ada masalah kemarin
   ✅ Lampu di perpustakaan mati sejak 
      Senin pagi (12 Januari 2026)
   ```

---

## 🔒 Keamanan & Privasi

- ✓ Data hanya terlihat oleh siswa yang membuat
- ✓ Admin bisa lihat semua untuk penanganan
- ✓ Password tidak disimpan (hanya NIS + Kelas)
- ✓ Session aman dengan CSRF token

---

## 🆘 Troubleshooting

### ❌ Tidak bisa login
```
Solusi:
1. Cek NIS dan Kelas yang diinput
2. Pastikan siswa sudah terdaftar di database
3. Hubungi admin jika siswa belum dibuat
```

### ❌ Pengaduan tidak muncul di riwayat
```
Solusi:
1. Refresh halaman (F5)
2. Cek sudah login dengan siswa yang benar
3. Hubungi admin jika tetap tidak muncul
```

### ❌ Form input tidak bisa submit
```
Solusi:
1. Pastikan kategori sudah dipilih
2. Pastikan isi pengaduan minimal 10 karakter
3. Cek koneksi internet
4. Coba refresh dan submit lagi
```

### ❌ Logout tidak berhasil
```
Solusi:
1. Cek koneksi internet
2. Clear browser cache/cookies
3. Login ulang
```

---

## 📞 Kontak Support

Jika ada masalah atau pertanyaan:
- **Email**: admin@smk8.sch.id
- **Admin**: Hubungi ruang tata usaha
- **Jam kerja**: Senin - Jumat, 07:00 - 14:00

---

## 🎓 Panduan untuk Guru/Admin

### Lihat semua pengaduan siswa
```
URL: /daftar-pengaduan
Klik "Data Pengaduan" di admin panel
```

### Ubah status pengaduan
```
1. Klik pengaduan di daftar
2. Ubah status (Masuk → Proses → Selesai)
3. Siswa akan otomatis melihat update
```

### Export laporan
```
URL: /pengaduan-export
Download Excel semua pengaduan
```

---

**Versi**: 1.0
**Tanggal**: 15 Januari 2026
