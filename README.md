# Sistem Manajemen Peminjaman Alat & Booking Jasa

Aplikasi Laravel untuk manajemen peminjaman alat dan booking jasa dengan 3 role user.

## 🚀 Fitur

### Role User
- **Mahasiswa**: Bisa booking jasa dan ajukan peminjaman alat
- **Penanggung Jawab**: Kelola master alat, approve/reject booking & peminjaman
- **Ketua**: Lihat laporan dan statistik

### Modul
1. **Master Alat** - Inventaris alat dengan kategori, jumlah, dan kondisi
2. **Booking Jasa** - Booking alat untuk keperluan jasa/layanan
3. **Peminjaman** - Peminjaman alat dengan tanggal pinjam & kembali

## 📦 Instalasi

```bash
# Install dependencies (jika belum)
composer install

# Setup key
php artisan generate:key

# Setup database
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve
```

## 👤 User Default

| Role | Email | Password |
|------|-------|----------|
| Penanggung Jawab | pj@kompasapp.test | password |
| Ketua | ketua@kompasapp.test | password |
| Mahasiswa | mhs@kompasapp.test | password |

## 📁 Database Schema

### users
- id, name, email, password
- role (mahasiswa, penanggung_jawab, ketua)
- nim (nullable)

### master_alat
- id, nama_alat, kategori, deskripsi
- jumlah, kondisi (baik/rusak/perbaikan)
- foto (nullable)

### bookings
- id, user_id, master_alat_id
- jenis_layanan, tanggal_booking
- waktu_mulai, waktu_selesai
- keperluan, status (pending/approved/rejected)
- catatan_penanggung_jawab

### peminjaman
- id, user_id, master_alat_id
- tanggal_pinjam, tanggal_kembali
- tanggal_kembali_realisasi
- keperluan, status (pending/approved/rejected/dikembalikan)
- catatan_penanggung_jawab, kondisi_alat_kembali

## ✅ Validasi

### Master Alat
- nama_alat: required, max 255
- jumlah: required, integer, min 1
- kondisi: required, in:baik,rusak,perbaikan
- foto: nullable, image, max 2MB

### Booking
- master_alat_id: required, exists
- jenis_layanan: required, max 100
- tanggal_booking: required, date, after_or_equal:today
- waktu_mulai/waktu_selesai: required, date_format:H:i
- keperluan: required, min 10, max 500

### Peminjaman
- master_alat_id: required, exists
- tanggal_pinjam: required, date, after_or_equal:today
- tanggal_kembali: required, date, after_or_equal:tanggal_pinjam
- keperluan: required, min 10, max 500

## 🛠️ Tech Stack
- Laravel 11
- Bootstrap 5
- MySQL/MariaDB

## 📝 Notes
- Semua form sudah dilengkapi validasi
- Authorization berdasarkan role
- Session flash messages untuk notifikasi

## Developer
- [Farhan](https://github.com/Farhan0511)
- [Anwar](https://github.com/Anuraaaa)