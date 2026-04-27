<?php

namespace App\Http\Controllers;

use App\Models\MasterAlat;
use Illuminate\Http\Request;

class MasterAlatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorizeRole(['penanggung_jawab', 'ketua']);
        $alats = MasterAlat::latest()->paginate(10);
        return view('master-alat.index', compact('alats'));
    }

    public function create()
    {
        $this->authorizeRole(['penanggung_jawab']);
        return view('master-alat.create');
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak,perbaikan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_alat.required' => 'Nama alat wajib diisi',
            'nama_alat.max' => 'Nama alat maksimal 255 karakter',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'kondisi.required' => 'Kondisi wajib diisi',
            'kondisi.in' => 'Kondisi harus baik, rusak, atau perbaikan',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/alat'), $filename);
            $validated['foto'] = 'uploads/alat/' . $filename;
        }

        MasterAlat::create($validated);
        
        return redirect()->route('master-alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function edit(MasterAlat $masterAlat)
    {
        $this->authorizeRole(['penanggung_jawab']);
        return view('master-alat.edit', compact('masterAlat'));
    }

    public function update(Request $request, MasterAlat $masterAlat)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak,perbaikan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_alat.required' => 'Nama alat wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'kondisi.required' => 'Kondisi wajib diisi',
            'kondisi.in' => 'Kondisi harus baik, rusak, atau perbaikan',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($masterAlat->foto && file_exists(public_path($masterAlat->foto))) {
                unlink(public_path($masterAlat->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/alat'), $filename);
            $validated['foto'] = 'uploads/alat/' . $filename;
        }

        $masterAlat->update($validated);
        
        return redirect()->route('master-alat.index')->with('success', 'Alat berhasil diupdate!');
    }

    public function destroy(MasterAlat $masterAlat)
    {
        $this->authorizeRole(['penanggung_jawab']);
        
        // Check if alat is being used in active bookings or peminjaman
        $hasActiveBookings = $masterAlat->bookings()->whereIn('status', ['pending', 'approved'])->exists();
        $hasActivePeminjaman = $masterAlat->peminjaman()->whereIn('status', ['pending', 'approved'])->exists();
        
        if ($hasActiveBookings || $hasActivePeminjaman) {
            return redirect()->route('master-alat.index')
                ->with('error', 'Tidak dapat menghapus alat yang masih memiliki booking/peminjaman aktif!');
        }
        
        $masterAlat->delete();
        
        return redirect()->route('master-alat.index')->with('success', 'Alat berhasil dihapus!');
    }

    private function authorizeRole($roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized action - Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
