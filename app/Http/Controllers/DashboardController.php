<?php

namespace App\Http\Controllers;

use App\Models\MasterAlat;
use App\Models\Booking;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;
        
        if ($role === 'ketua') {
            // Ketua hanya lihat laporan/statistik
            $totalAlat = MasterAlat::count();
            $totalBooking = Booking::count();
            $totalPeminjaman = Peminjaman::count();
            $pendingApproval = Booking::where('status', 'pending')->count() + Peminjaman::where('status', 'pending')->count();
            
            return view('dashboard.ketua', compact('totalAlat', 'totalBooking', 'totalPeminjaman', 'pendingApproval'));
        } elseif ($role === 'penanggung_jawab') {
            // Penanggung jawab kelola data
            $pendingBookings = Booking::where('status', 'pending')
                ->with(['user', 'masterAlat'])
                ->orderBy('created_at', 'desc')
                ->get();
            $pendingPeminjaman = Peminjaman::where('status', 'pending')
                ->with(['user', 'masterAlat'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('dashboard.penanggung_jawab', compact('pendingBookings', 'pendingPeminjaman'));
        } else {
            // Mahasiswa
            $myBookings = Booking::where('user_id', $user->id)
                ->with('masterAlat')
                ->latest()
                ->take(5)
                ->get();
            $myPeminjaman = Peminjaman::where('user_id', $user->id)
                ->with('masterAlat')
                ->latest()
                ->take(5)
                ->get();
            
            return view('dashboard.mahasiswa', compact('myBookings', 'myPeminjaman'));
        }
    }
    
    // Laporan Booking (Ketua only)
    public function laporanBooking()
    {
        if (auth()->user()->role !== 'ketua') {
            abort(403, 'Unauthorized - Hanya Ketua yang dapat mengakses laporan');
        }
        
        $bookings = Booking::with('user')->latest()->paginate(20);
        return view('laporan.booking', compact('bookings'));
    }
    
    // Laporan Peminjaman (Ketua only)
    public function laporanPeminjaman()
    {
        if (auth()->user()->role !== 'ketua') {
            abort(403, 'Unauthorized - Hanya Ketua yang dapat mengakses laporan');
        }
        
        $peminjaman = Peminjaman::with(['user', 'masterAlat'])->latest()->paginate(20);
        return view('laporan.peminjaman', compact('peminjaman'));
    }
}
