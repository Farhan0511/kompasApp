@extends(auth()->user()->role === 'penanggung_jawab' || auth()->user()->role === 'ketua' ? 'admin.main' : 'user.main')

@section('title', 'Peminjaman Alat')

@section('content')
@if(auth()->user()->role === 'penanggung_jawab')
<!-- Admin View -->
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0">Peminjaman Alat</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $index => $item)
                            <tr>
                                <td>{{ $peminjaman->firstItem() + $index }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->masterAlat->nama_alat }}</td>
                                <td>{{ $item->tanggal_pinjam->format('d M Y') }}</td>
                                <td>{{ $item->tanggal_kembali->format('d M Y') }}</td>
                                <td>
                                    @if($item->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($item->status === 'dikembalikan')
                                        <span class="badge bg-info text-dark">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status === 'pending')
                                        <form action="{{ route('peminjaman.approve', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-icon btn-success btn-sm me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#reject{{ $item->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        
                                        <div class="modal fade" id="reject{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="{{ route('peminjaman.reject', $item) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tolak Peminjaman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Alasan Penolakan</label>
                                                                <textarea name="catatan_penanggung_jawab" class="form-control" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @elseif($item->status === 'approved')
                                        <form action="{{ route('peminjaman.return', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Alat sudah dikembalikan?')">
                                            @csrf
                                            <button type="submit" class="btn btn-icon btn-info btn-sm">
                                                <i class="fas fa-undo"></i> Kembalikan
                                            </button>
                                        </form>
                                    @elseif($item->status === 'rejected')
                                        <small class="text-muted">{{ $item->catatan_penanggung_jawab }}</small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center">
                        {{ $peminjaman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- Mahasiswa View -->
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Riwayat Peminjaman</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-box-seam me-1"></i>Daftar peminjaman alat yang telah dibuat
        </p>
    </div>
</div>

<section class="container section py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i>Riwayat Peminjaman</h4>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Ajukan Peminjaman Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($peminjaman->count() > 0)
                <div class="row gy-4">
                    @foreach($peminjaman as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <!-- Image with placeholder -->
                            <div class="position-relative" style="height: 200px; overflow: hidden; background: #f8f9fa;">
                                @if($item->masterAlat->foto && file_exists(public_path($item->masterAlat->foto)))
                                    <img src="{{ asset($item->masterAlat->foto) }}?v={{ time() }}" 
                                         class="card-img-top h-100 w-100" 
                                         style="object-fit: cover;" 
                                         alt="{{ $item->masterAlat->nama_alat }}"
                                         onerror="this.onerror=null; this.src='https://placehold.co/400x300/0d6efd/ffffff?text={{ urlencode($item->masterAlat->nama_alat) }}'">
                                @else
                                    <img src="https://placehold.co/400x300/0d6efd/ffffff?text={{ urlencode($item->masterAlat->nama_alat) }}" 
                                         class="card-img-top h-100 w-100" 
                                         style="object-fit: cover;" 
                                         alt="{{ $item->masterAlat->nama_alat }}">
                                @endif
                                <div class="position-absolute top-0 end-0 m-2">
                                    @if($item->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($item->status === 'dikembalikan')
                                        <span class="badge bg-info text-dark">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title mb-2">{{ $item->masterAlat->nama_alat }}</h5>
                                @if($item->masterAlat->kategori)
                                    <span class="badge bg-secondary mb-2">{{ $item->masterAlat->kategori }}</span>
                                @endif
                                
                                <hr class="my-3">
                                
                                <div class="mb-2">
                                    <small class="text-muted"><i class="bi bi-calendar-check me-1"></i>Pinjam:</small>
                                    <div class="fw-semibold">{{ $item->tanggal_pinjam->format('d M Y') }}</div>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted"><i class="bi bi-calendar-return me-1"></i>Kembali:</small>
                                    <div class="fw-semibold">{{ $item->tanggal_kembali->format('d M Y') }}</div>
                                </div>
                                
                                @if($item->tanggal_kembali_realisasi)
                                    <div class="mb-2">
                                        <small class="text-muted"><i class="bi bi-check-circle me-1"></i>Dikembalikan:</small>
                                        <div class="fw-semibold text-success">{{ $item->tanggal_kembali_realisasi->format('d M Y') }}</div>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <small class="text-muted"><i class="bi bi-file-text me-1"></i>Keperluan:</small>
                                    <p class="small mb-0">{{ Str::limit($item->keperluan, 80) }}</p>
                                </div>
                                
                                @if($item->status === 'rejected' && $item->catatan_penanggung_jawab)
                                    <div class="alert alert-danger small mb-0">
                                        <strong>Catatan:</strong> {{ $item->catatan_penanggung_jawab }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4 d-flex justify-content-center">
                    {{ $peminjaman->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-box-seam text-muted" style="font-size: 64px;"></i>
                        <h5 class="mt-3 mb-2">Belum Ada Peminjaman</h5>
                        <p class="text-muted mb-4">Anda belum meminjam alat apapun</p>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Ajukan Peminjaman Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
@endsection
