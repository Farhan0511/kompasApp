<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = auth()->user()->role;
        
        if ($role === 'penanggung_jawab') {
            // PJ bisa lihat semua booking dengan data user
            $bookings = Booking::with('user')->latest()->paginate(15);
        } elseif ($role === 'ketua') {
            // Ketua bisa lihat semua booking untuk laporan
            $bookings = Booking::with('user')->latest()->paginate(15);
        } else {
            // Mahasiswa hanya lihat booking sendiri
            $bookings = Booking::where('user_id', auth()->id())
                ->with('user')
                ->latest()
                ->paginate(15);
        }
        
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $this->authorizeRole(['mahasiswa']);
        return view('booking.create');
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['mahasiswa']);
        
        $validated = $request->validate([
            'jenis_layanan' => 'required|string|max:100',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'keperluan' => 'required|string|min:10|max:500',
        ], [
            'jenis_layanan.required' => 'Jenis layanan wajib diisi',
            'jenis_layanan.max' => 'Jenis layanan maksimal 100 karakter',
            'tanggal_booking.required' => 'Tanggal booking wajib diisi',
            'tanggal_booking.date' => 'Format tanggal tidak valid',
            'tanggal_booking.after_or_equal' => 'Tanggal booking tidak boleh di masa lalu',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai',
            'keperluan.required' => 'Keperluan wajib diisi',
            'keperluan.min' => 'Keperluan minimal 10 karakter',
            'keperluan.max' => 'Keperluan maksimal 500 karakter',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Booking::create($validated);
        
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat! Menunggu persetujuan penanggung jawab.');
    }

    public function approve(Booking $booking)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        if ($booking->status !== 'pending') {
            return redirect()->route('booking.index')
                ->with('error', 'Booking ini sudah diproses sebelumnya');
        }
        
        $booking->update(['status' => 'approved']);
        
        return redirect()->route('booking.index')->with('success', 'Booking disetujui!');
    }

    public function reject(Request $request, Booking $booking)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        if ($booking->status !== 'pending') {
            return redirect()->route('booking.index')
                ->with('error', 'Booking ini sudah diproses sebelumnya');
        }
        
        $validated = $request->validate([
            'catatan_penanggung_jawab' => 'required|string|min:5|max:500',
        ], [
            'catatan_penanggung_jawab.required' => 'Alasan penolakan wajib diisi',
            'catatan_penanggung_jawab.min' => 'Alasan penolakan minimal 5 karakter',
            'catatan_penanggung_jawab.max' => 'Alasan penolakan maksimal 500 karakter',
        ]);

        $booking->update([
            'status' => 'rejected',
            'catatan_penanggung_jawab' => $validated['catatan_penanggung_jawab'],
        ]);
        
        return redirect()->route('booking.index')->with('success', 'Booking ditolak!');
    }

    private function authorizeRole($roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized action - Anda tidak memiliki akses untuk melakukan aksi ini.');
        }
    }
}
