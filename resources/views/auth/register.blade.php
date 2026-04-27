@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px;">
    <div class="card border-0 shadow-lg" style="max-width: 450px; width: 100%; border-radius: 16px;">
        <div class="card-body p-5">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <img src="https://placehold.co/80x80/667eea/ffffff?text=K" alt="Logo" class="rounded-circle shadow" style="width: 80px; height: 80px;">
                </div>
                <h3 class="fw-bold mb-1" style="color: #667eea;">Register</h3>
                <p class="text-muted mb-0">Buat akun baru untuk mengakses sistem</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        <i class="bi bi-person me-1"></i>Nama Lengkap
                    </label>
                    <input id="name" 
                           type="text" 
                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Masukkan nama lengkap"
                           required 
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope me-1"></i>Email
                    </label>
                    <input id="email" 
                           type="email" 
                           class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="contoh@email.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label fw-semibold">
                        <i class="bi bi-card-text me-1"></i>NIM
                    </label>
                    <input id="nim" 
                           type="text" 
                           class="form-control form-control-lg @error('nim') is-invalid @enderror" 
                           name="nim" 
                           value="{{ old('nim') }}" 
                           placeholder="Masukkan NIM">
                    @error('nim')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-text">Kosongkan jika bukan mahasiswa</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock me-1"></i>Password
                    </label>
                    <input id="password" 
                           type="password" 
                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                           name="password" 
                           placeholder="Minimal 8 karakter"
                           required>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="form-label fw-semibold">
                        <i class="bi bi-lock-fill me-1"></i>Konfirmasi Password
                    </label>
                    <input id="password-confirm" 
                           type="password" 
                           class="form-control form-control-lg" 
                           name="password_confirmation" 
                           placeholder="Ulangi password"
                           required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <i class="bi bi-person-plus me-2"></i>Register
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <p class="mb-0 text-muted">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #667eea;">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
@endsection
