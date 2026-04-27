<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterAlatController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking-hub', [App\Http\Controllers\HomeController::class, 'bookingHub'])->name('booking.hub');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Laporan (Ketua only)
    Route::middleware('role:ketua')->group(function () {
        Route::get('/laporan/booking', [DashboardController::class, 'laporanBooking'])->name('laporan.booking');
        Route::get('/laporan/peminjaman', [DashboardController::class, 'laporanPeminjaman'])->name('laporan.peminjaman');
    });
    
    // Master Alat (Penanggung Jawab only)
    Route::middleware('role:penanggung_jawab')->group(function () {
        Route::resource('master-alat', MasterAlatController::class);
    });
    
    // Booking Routes
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::post('/{booking}/approve', [BookingController::class, 'approve'])->name('approve')->middleware('role:penanggung_jawab');
        Route::post('/{booking}/reject', [BookingController::class, 'reject'])->name('reject')->middleware('role:penanggung_jawab');
    });
    
    // Peminjaman Routes
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('/create', [PeminjamanController::class, 'create'])->name('create');
        Route::post('/', [PeminjamanController::class, 'store'])->name('store');
        Route::post('/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('approve')->middleware('role:penanggung_jawab');
        Route::post('/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('reject')->middleware('role:penanggung_jawab');
        Route::post('/{peminjaman}/return', [PeminjamanController::class, 'return'])->name('return')->middleware('role:penanggung_jawab');
    });
});
