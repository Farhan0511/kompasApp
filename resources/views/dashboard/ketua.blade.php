@extends('admin.main')

@section('title', 'Dashboard Ketua')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0">Dashboard Ketua</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-primary">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Total Alat</p>
                        <h4 class="card-title">{{ $totalAlat }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Total Booking</p>
                        <h4 class="card-title">{{ $totalBooking }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-info">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-hand-holding"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Total Peminjaman</p>
                        <h4 class="card-title">{{ $totalPeminjaman }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Pending Approval</p>
                        <h4 class="card-title">{{ $pendingApproval }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">📊 Statistik Sistem</h4>
            </div>
            <div class="card-body">
                <p>Sistem manajemen peminjaman alat dan booking jasa aktif.</p>
                <p class="text-muted mb-0">Data real-time per {{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
