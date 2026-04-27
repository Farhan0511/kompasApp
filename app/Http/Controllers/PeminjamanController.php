<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\MasterAlat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = auth()->user()->role;
        
        if ($role === 'penanggung_jawab' || $role === 'ketua') {
            // PJ dan Ketua bisa lihat semua peminjaman
            $peminjaman = Peminjaman::with(['user', 'masterAlat'])
                ->latest()
                ->paginate(15);
        } else {
            // Mahasiswa hanya lihat peminjaman sendiri
            $peminjaman = Peminjaman::where('user_id', auth()->id())
                ->with('masterAlat')
                ->latest()
                ->paginate(15);
        }
        
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $this->authorizeRole(['mahasiswa']);
        $alats = MasterAlat::where('kondisi', 'baik')
            ->where('jumlah', '>', 0)
            ->orderBy('nama_alat')
            ->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['mahasiswa']);
        
        $validated = $request->validate([
            'master_alat_id' => 'required|exists:master_alat,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan' => 'required|string|min:10|max:500',
        ], [
            'master_alat_id.required' => 'Pilih alat terlebih dahulu',
            'master_alat_id.exists' => 'Alat tidak valid',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi',
            'tanggal_pinjam.date' => 'Format tanggal tidak valid',
            'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam tidak boleh di masa lalu',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi',
            'tanggal_kembali.date' => 'Format tanggal tidak valid',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus sama atau setelah tanggal pinjam',
            'keperluan.required' => 'Keperluan wajib diisi',
            'keperluan.min' => 'Keperluan minimal 10 karakter',
            'keperluan.max' => 'Keperluan maksimal 500 karakter',
        ]);

        // Check if alat has available quantity
        $alat = MasterAlat::find($validated['master_alat_id']);
        if (!$alat || $alat->jumlah <= 0) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['master_alat_id' => 'Stok alat tidak tersedia']);
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Peminjaman::create($validated);
        
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat! Menunggu persetujuan penanggung jawab.');
    }

    public function approve(Peminjaman $peminjaman)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        if ($peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman ini sudah diproses sebelumnya');
        }
        
        $peminjaman->update(['status' => 'approved']);
        
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui!');
    }

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        if ($peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman ini sudah diproses sebelumnya');
        }
        
        $validated = $request->validate([
            'catatan_penanggung_jawab' => 'required|string|min:5|max:500',
        ], [
            'catatan_penanggung_jawab.required' => 'Alasan penolakan wajib diisi',
            'catatan_penanggung_jawab.min' => 'Alasan penolakan minimal 5 karakter',
            'catatan_penanggung_jawab.max' => 'Alasan penolakan maksimal 500 karakter',
        ]);

        $peminjaman->update([
            'status' => 'rejected',
            'catatan_penanggung_jawab' => $validated['catatan_penanggung_jawab'],
        ]);
        
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak!');
    }

    public function return(Peminjaman $peminjaman)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        if ($peminjaman->status !== 'approved') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Hanya peminjaman yang disetujui yang bisa dikembalikan');
        }
        
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali_realisasi' => now(),
        ]);
        
        return redirect()->route('peminjaman.index')->with('success', 'Alat telah dikembalikan!');
    }

    private function authorizeRole($roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized action - Anda tidak memiliki akses untuk melakukan aksi ini.');
        }
    }
}
