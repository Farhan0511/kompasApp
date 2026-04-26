<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking', [HomeController::class, 'booking'])->name('booking');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/jadwal', [HomeController::class, 'jadwal'])->name('jadwal');

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');