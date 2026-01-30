# 🏗️ DATABASE ARCHITECTURE - FINAL STRUCTURE

## Entity Relationship Diagram (Updated)

```
┌─────────────────────────────────────────────────────────────────┐
│                        USERS (Admin)                             │
├─────────────────────────────────────────────────────────────────┤
│ PK │ id              INT AUTO_INCREMENT                          │
│    │ username        VARCHAR(255) UNIQUE NOT NULL                │
│    │ password        VARCHAR(255) NOT NULL                       │
│    │ remember_token  VARCHAR(100) NULLABLE                       │
│    │ created_at      TIMESTAMP                                   │
│    │ updated_at      TIMESTAMP                                   │
└─────────────────────────────────────────────────────────────────┘
                            ▲
                            │
              ┌─────────────┴──────────────┐
              │ Admin manages categories  │ Admin reviews aspirations
              │ and reviews aspirations   │
              │                           │
              │                           ▼
              │        ┌──────────────────────────────────────┐
              │        │      ASPIRASIS (Reports)             │
              │        ├──────────────────────────────────────┤
              │        │ PK │ id_aspirasi    INT              │
              │        │ FK │ nis            INT               │
              │        │ FK │ id_kategori    INT               │
              │        │    │ lokasi         VARCHAR(50)       │
              │        │    │ keterangan     VARCHAR(50)       │
              │        │    │ status         ENUM(2)           │
              │        │    │ feedback       INT               │
              │        │    │ created_at     TIMESTAMP         │
              │        │    │ updated_at     TIMESTAMP         │
              │        └──────────────────────────────────────┘
              │                ▲                    ▲
              │                │                    │
              │        ┌───────┴──────┐        ┌───┴──────┐
              │        │ Belongs to   │        │ Belongs  │
              │        │              │        │ to       │
              │        │              │        │          │
              ▼        │              │        │          │
┌────────────────────┐ │         ┌────▼─────┐ │  ┌──────▼─────┐
│   SISWAS           │ │         │ KATEGORI │ │  │ ASPIRASI   │
├────────────────────┤ │         ├──────────┤ │  │ (Model)    │
│ PK │ nis      INT  │◄┘         │ PK │ id │◄┘  │            │
│    │            │  │         │ kategori  │    │ (Alias of  │
│ UQ │ (composite)  │         │    INT    │    │  pengaduans │
│    │ keterangan   │         │ ket_      │    │  table)    │
│    │ VARCHAR(10)  │         │ kategori  │    └────────────┘
│    │              │         │ VARCHAR   │
│    │ created_at   │         │ (30)      │
│    │ updated_at   │         │ created   │
│    │              │         │ _at       │
│    │              │         │ updated   │
│    │              │         │ _at       │
└────────────────────┘         └───────────┘
```

---

## Data Flow Diagram

```
┌──────────────┐
│ Admin Login  │
│ (username)   │
└──────┬───────┘
       │
       ▼
┌─────────────────────────────────────┐
│ Authenticate Against USERS Table    │
│ WHERE username = 'admin'            │
└──────┬────────────────────────────┘
       │ ✅ Valid
       ▼
┌─────────────────────────────────────┐
│ Create Session                      │
│ - 'user_type' => 'admin'            │
└──────┬────────────────────────────┘
       │
       ▼
┌──────────────────────────────────────┐
│ Access Admin Dashboard              │
│ - Manage Kategori                   │
│ - Review Aspirasi (from aspirasis)  │
│ - Update Status                     │
└──────────────────────────────────────┘

─────────────────────────────────────────

┌──────────────┐
│ Siswa Login  │
│ (nis)        │
└──────┬───────┘
       │
       ▼
┌─────────────────────────────────────┐
│ Query SISWAS Table                  │
│ WHERE nis = '<input>'               │
└──────┬────────────────────────────┘
       │ ✅ Found
       ▼
┌─────────────────────────────────────┐
│ Create Session                      │
│ - 'nis' => <nis_value>              │
│ - 'user_type' => 'siswa'            │
└──────┬────────────────────────────┘
       │
       ▼
┌──────────────────────────────────────┐
│ Access Siswa Dashboard              │
│ - Submit Aspirasi                   │
│  (INSERT to aspirasis table)        │
│ - View Aspirasi History             │
└──────────────────────────────────────┘
```

---

## Table Relationships

```
SISWAS (Master Data)
├─ PK: nis (int, unsigned)
├─ Data minimal: hanya NIS dan keterangan
└─ Used by:
   └─ ASPIRASIS (1:N relationship)
      └─ Siswa punya banyak aspirasi/laporan

KATEGORIS (Master Data)
├─ PK: id_kategori (int, unsigned)
├─ Data minimal: kategori deskripsi (30 char)
└─ Used by:
   └─ ASPIRASIS (1:N relationship)
      └─ Kategori punya banyak aspirasi

ASPIRASIS (Transaksi)
├─ PK: id_aspirasi (int, unsigned)
├─ FK: nis (→ siswas.nis)
├─ FK: id_kategori (→ kategoris.id_kategori)
├─ Data: lokasi, keterangan, status, feedback
└─ Relations:
   ├─ Belongs to SISWAS (N:1)
   └─ Belongs to KATEGORIS (N:1)

USERS (Authentication)
├─ PK: id (int, auto-increment)
├─ Fields: username (unique), password
└─ Used by:
   └─ Admin authentication only
```

---

## Key Design Decisions

### 1. Non-Auto-Increment Primary Keys
```
Why?
- SISWAS.nis: Student ID is natural key
- KATEGORIS.id_kategori: Category ID is natural key
- ASPIRASIS.id_aspirasi: Aspirasi ID is business-level ID

Benefit:
- More semantic meaning
- Reduces surrogate keys
- Better for business logic
```

### 2. Enum Status Values
```
Instead of: pending, proses, selesai
Use: 'Menunggu Proses', 'Selesai'

Benefit:
- More descriptive
- Better for user-facing display
- Clearer state management
```

### 3. VARCHAR Size Constraints
```
SISWAS.keterangan: VARCHAR(10)
KATEGORIS.ket_kategori: VARCHAR(30)
ASPIRASIS.lokasi: VARCHAR(50)
ASPIRASIS.keterangan: VARCHAR(50)

Benefit:
- Forces data quality
- Prevents excessive text entry
- Optimizes storage
```

### 4. CASCADE Delete Foreign Keys
```
aspirasis.nis -> siswas.nis (ON DELETE CASCADE)
aspirasis.id_kategori -> kategoris.id_kategori (ON DELETE CASCADE)

Benefit:
- Automatic cleanup
- Maintains referential integrity
- Prevents orphan records
```

---

## Migration Path (Data Structure Only)

```
Old Structure          →    New Structure
─────────────────────────────────────────

pengaduans table       →    aspirasis table
├─ id (PK)            ├─ id_aspirasi (PK)
├─ siswa_id (FK)      ├─ nis (FK)
├─ kategori_id (FK)   ├─ id_kategori (FK)
├─ pelapor            ├─ lokasi
├─ isi_pengaduan      ├─ keterangan
├─ deskripsi          ├─ status
├─ gambar             ├─ feedback
├─ status             ├─ created_at
├─ tanggal_selesai    └─ updated_at
├─ created_at
└─ updated_at

siswas table          →    siswas table
├─ id (PK)            └─ nis (PK)
├─ nis (unique)       └─ keterangan
├─ nama
├─ kelas
└─ jurusan

kategoris table       →    kategoris table
├─ id (PK)            ├─ id_kategori (PK)
├─ nama               └─ ket_kategori
└─ deskripsi

users table           →    users table
├─ id (PK)            ├─ id (PK)
├─ name               ├─ username
├─ username           └─ password
├─ email_verified_at
└─ password
```

---

## Index Strategy

```sql
-- Primary Keys (auto-indexed)
ALTER TABLE siswas MODIFY nis INT PRIMARY KEY;
ALTER TABLE kategoris MODIFY id_kategori INT PRIMARY KEY;
ALTER TABLE aspirasis MODIFY id_aspirasi INT PRIMARY KEY;

-- Foreign Keys (auto-indexed on referencing side)
-- aspirasis.nis → siswas.nis ✓
-- aspirasis.id_kategori → kategoris.id_kategori ✓

-- Recommended Additional Indexes
CREATE INDEX idx_aspirasis_status ON aspirasis(status);
CREATE INDEX idx_aspirasis_created_at ON aspirasis(created_at);
CREATE INDEX idx_aspirasis_nis_status ON aspirasis(nis, status);
```

---

## Query Examples with New Structure

```sql
-- Get all aspirasi for a student
SELECT * FROM aspirasis WHERE nis = 12345;

-- Get aspirasi by category
SELECT * FROM aspirasis 
JOIN kategoris ON aspirasis.id_kategori = kategoris.id_kategori
WHERE kategoris.id_kategori = 1;

-- Get student info with aspirasi
SELECT s.nis, s.keterangan, a.id_aspirasi, a.status
FROM siswas s
LEFT JOIN aspirasis a ON s.nis = a.nis
WHERE s.nis = 12345;

-- Count aspirasi by status
SELECT status, COUNT(*) FROM aspirasis GROUP BY status;

-- Delete aspirasi cascade
DELETE FROM aspirasis WHERE id_aspirasi = 100;
-- Automatically maintains referential integrity
```

---

## Performance Notes

```
Small Dataset (< 100K records):
- All queries will be fast
- No special optimization needed
- Current indexes sufficient

Medium Dataset (100K - 1M records):
- Add recommended indexes (see above)
- Consider partitioning aspirasis table
- Monitor query performance

Large Dataset (> 1M records):
- Implement time-based partitioning
- Archive old aspirasi records
- Use database views for reporting
```

---

**Architecture Version**: 2.0 (Final)  
**Last Updated**: 2026-01-26  
**Status**: APPROVED FOR IMPLEMENTATION
