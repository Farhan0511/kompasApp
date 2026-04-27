@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px;">
    <div class="card border-0 shadow-lg" style="max-width: 450px; width: 100%; border-radius: 16px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="mb-3">
                    <img src="https://placehold.co/80x80/667eea/ffffff?text=K" alt="Logo" class="rounded-circle shadow" style="width: 80px; height: 80px;">
                </div>
                <h3 class="fw-bold mb-1" style="color: #667eea;">Login</h3>
                <p class="text-muted mb-0">Manajemen Alat & Booking</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        Login
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                @endif
            </form>

            <div class="mt-4 p-3" style="background: #f8f9fa; border-radius: 8px;">
                <small class="text-muted d-block text-center mb-2">Default Users:</small>
                <small class="d-block text-center"><strong>pj@kompasapp.test</strong> / password (PJ)</small>
                <small class="d-block text-center"><strong>ketua@kompasapp.test</strong> / password (Ketua)</small>
                <small class="d-block text-center"><strong>mhs@kompasapp.test</strong> / password (Mhs)</small>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
@endsection
