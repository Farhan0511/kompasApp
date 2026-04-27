@extends('user.main')

@section('title', 'Buat Booking')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Form Booking Jasa</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-calendar-check me-1"></i>Booking untuk keperluan jasa/layanan
        </p>
    </div>
</div>

<section class="container section py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Form Booking Jasa</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="jenis_layanan" class="form-label fw-bold">Jenis Layanan *</label>
                            <input type="text" class="form-control @error('jenis_layanan') is-invalid @enderror" id="jenis_layanan" name="jenis_layanan" value="{{ old('jenis_layanan') }}" placeholder="Contoh: Fotografi Wedding, Recording Podcast, Live Streaming" required>
                            @error('jenis_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Jenis jasa/layanan yang akan dilakukan</div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_booking" class="form-label fw-bold">Tanggal Booking *</label>
                            <input type="date" class="form-control @error('tanggal_booking') is-invalid @enderror" id="tanggal_booking" name="tanggal_booking" value="{{ old('tanggal_booking') }}" min="{{ date('Y-m-d') }}" required>
                            @error('tanggal_booking')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tanggal pelaksanaan jasa/layanan</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="waktu_mulai" class="form-label fw-bold">Waktu Mulai *</label>
                                <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
                                @error('waktu_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="waktu_selesai" class="form-label fw-bold">Waktu Selesai *</label>
                                <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required>
                                @error('waktu_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keperluan" class="form-label fw-bold">Keperluan *</label>
                            <textarea class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" rows="4" placeholder="Jelaskan detail keperluan booking jasa/layanan Anda..." required>{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Minimal 10 karakter, maksimal 500 karakter</div>
                        </div>

                        <!-- Info Card -->
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Info Booking:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Booking digunakan untuk jasa/layanan (bukan peminjaman alat)</li>
                                <li>Pastikan waktu booking tidak bentrok dengan kegiatan lain</li>
                                <li>Booking harus disetujui oleh penanggung jawab</li>
                            </ul>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send me-2"></i>Submit Booking
                            </button>
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
