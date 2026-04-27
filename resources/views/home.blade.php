@extends('user.main')

@section('title', 'KompasApp - Home')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-8 order-2 order-lg-1 text-center">
                <h1 class="mb-4">Selamat Datang di KompasApp</h1>
                <p class="mb-4 lead">Sistem Manajemen Peminjaman Alat dan Booking Jasa</p>
                
                @auth
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        @if(auth()->user()->role === 'mahasiswa')
                            <a href="{{ route('booking.hub') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-calendar-plus"></i> Booking & Peminjaman
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'penanggung_jawab')
                            <a href="{{ route('master-alat.index') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-seam"></i> Master Alat
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'ketua')
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Lihat Laporan
                            </a>
                        @endif
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <strong>Halo, {{ auth()->user()->name }}!</strong><br>
                        Role Anda: <strong>{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</strong>
                    </div>
                @else
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</section>

@auth
@if(auth()->user()->role === 'mahasiswa')
<!-- Quick Access Section -->
<section id="services" class="services section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="service-item d-flex">
                    <div class="icon flex-shrink-0">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div>
                        <h4 class="title">Booking Jasa</h4>
                        <p class="description">Booking alat untuk keperluan jasa/layanan dengan menentukan tanggal dan waktu penggunaan.</p>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary mt-2">Buat Booking</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-item d-flex">
                    <div class="icon flex-shrink-0">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h4 class="title">Peminjaman Alat</h4>
                        <p class="description">Pinjam alat untuk keperluan pribadi dengan menentukan periode peminjaman.</p>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-success mt-2">Ajukan Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endauth
@endsection
