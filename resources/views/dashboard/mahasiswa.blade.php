@extends('user.main')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <div class="avatar-circle bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mb-3 shadow" style="width: 80px; height: 80px; font-size: 32px; font-weight: bold;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Dashboard Mahasiswa</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }} 
            <span class="mx-2">•</span> 
            <i class="bi bi-card-text me-1"></i>{{ auth()->user()->nim ?? '-' }}
        </p>
    </div>
</div>

<!-- Welcome Section -->
<section class="container section py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="mb-0">Halo, {{ auth()->user()->name }}! 👋</h4>
                            <p class="text-muted mb-0">NIM: {{ auth()->user()->nim ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row gy-4 mb-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-shadow" style="transition: all 0.3s ease;">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-calendar-check" style="font-size: 48px; color: #0d6efd;"></i>
                            </div>
                            <h5 class="card-title mb-2">Booking Jasa</h5>
                            <p class="card-text text-muted small mb-3">
                                Booking alat untuk keperluan jasa dengan menentukan tanggal dan waktu
                            </p>
                            <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-plus-circle"></i> Buat Booking
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-shadow" style="transition: all 0.3s ease;">
                        <div class="card-body text-center p-4">
                            <div class="icon-box mb-3">
                                <i class="bi bi-box-seam" style="font-size: 48px; color: #198754;"></i>
                            </div>
                            <h5 class="card-title mb-2">Peminjaman Alat</h5>
                            <p class="card-text text-muted small mb-3">
                                Pinjam alat untuk dibawa keluar dengan periode tertentu
                            </p>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-sm px-4">
                                <i class="bi bi-plus-circle"></i> Ajukan Peminjaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-calendar3 text-primary me-2"></i>Riwayat Booking</h5>
                                <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if($myBookings->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">Alat</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myBookings as $booking)
                                            <tr>
                                                <td class="ps-3">
                                                    <div>
                                                        <strong>{{ $booking->masterAlat->nama_alat }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $booking->tanggal_booking->format('d M Y') }}</small>
                                                </td>
                                                <td>
                                                    @if($booking->status === 'approved')
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif($booking->status === 'rejected')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-x text-muted" style="font-size: 48px;"></i>
                                    <p class="text-muted mt-2 mb-0">Belum ada booking</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-box-seam text-success me-2"></i>Riwayat Peminjaman</h5>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if($myPeminjaman->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">Alat</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myPeminjaman as $peminjaman)
                                            <tr>
                                                <td class="ps-3">
                                                    <div>
                                                        <strong>{{ $peminjaman->masterAlat->nama_alat }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</small>
                                                </td>
                                                <td>
                                                    @if($peminjaman->status === 'approved')
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @elseif($peminjaman->status === 'rejected')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @elseif($peminjaman->status === 'dikembalikan')
                                                        <span class="badge bg-info text-dark">Dikembalikan</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-box-seam text-muted" style="font-size: 48px;"></i>
                                    <p class="text-muted mt-2 mb-0">Belum ada peminjaman</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
