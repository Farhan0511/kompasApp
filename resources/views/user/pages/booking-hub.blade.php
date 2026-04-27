@extends('user.main')

@section('title', 'Booking & Peminjaman')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Booking & Peminjaman</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-info-circle me-1"></i>Pilih layanan yang Anda butuhkan
        </p>
    </div>
</div>

<section class="container section">
    <div class="row gy-4">
        <!-- Booking Card -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-lg">
                <div class="card-body text-center p-5">
                    <div class="icon-box mb-4">
                        <i class="bi bi-calendar-check" style="font-size: 64px; color: #0d6efd;"></i>
                    </div>
                    <h3 class="card-title mb-3">Booking Jasa</h3>
                    <p class="card-text text-muted mb-4">
                        Booking alat untuk keperluan jasa atau layanan dengan menentukan tanggal dan waktu penggunaan.
                        Cocok untuk event, shooting, recording, dan kegiatan lainnya.
                    </p>
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Tentukan alat yang ingin digunakan</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Pilih tanggal dan waktu</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Isi keperluan booking</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Tunggu persetujuan penanggung jawab</li>
                    </ul>
                    <a href="{{ route('booking.create') }}" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-plus-circle"></i> Buat Booking Baru
                    </a>
                    <a href="{{ route('booking.index') }}" class="btn btn-outline-primary btn-lg px-5 ms-2">
                        <i class="bi bi-list"></i> Lihat Riwayat
                    </a>
                </div>
            </div>
        </div>

        <!-- Peminjaman Card -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-lg">
                <div class="card-body text-center p-5">
                    <div class="icon-box mb-4">
                        <i class="bi bi-box-seam" style="font-size: 64px; color: #198754;"></i>
                    </div>
                    <h3 class="card-title mb-3">Peminjaman Alat</h3>
                    <p class="card-text text-muted mb-4">
                        Pinjam alat untuk keperluan pribadi atau kelompok dengan periode peminjaman yang jelas.
                        Alat harus dikembalikan sesuai tanggal yang ditentukan.
                    </p>
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Pilih alat yang tersedia</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Tentukan periode pinjam</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Isi keperluan peminjaman</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Kembalikan tepat waktu</li>
                    </ul>
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-lg px-5">
                        <i class="bi bi-plus-circle"></i> Ajukan Peminjaman
                    </a>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-success btn-lg px-5 ms-2">
                        <i class="bi bi-list"></i> Lihat Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container section">
    <div class="card bg-light border-0">
        <div class="card-body p-4">
            <h4 class="mb-3"><i class="bi bi-info-circle"></i> Perbedaan Booking dan Peminjaman</h4>
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary">Booking Jasa:</h6>
                    <ul class="small">
                        <li>Untuk penggunaan alat di tempat (on-site)</li>
                        <li>Dengan layanan/jasa dari operator</li>
                        <li>Berdasarkan waktu (jam mulai - selesai)</li>
                        <li>Contoh: Booking studio recording, booking kamera untuk event</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="text-success">Peminjaman Alat:</h6>
                    <ul class="small">
                        <li>Untuk membawa alat keluar (take-away)</li>
                        <li>Menggunakan alat sendiri</li>
                        <li>Berdasarkan periode (tanggal pinjam - kembali)</li>
                        <li>Contoh: Pinjam tripod 3 hari, pinjam projector untuk presentasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
