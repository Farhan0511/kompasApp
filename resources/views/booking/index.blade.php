@extends(auth()->user()->role === 'penanggung_jawab' || auth()->user()->role === 'ketua' ? 'admin.main' : 'user.main')

@section('title', 'Booking Jasa')

@section('content')
@if(auth()->user()->role === 'penanggung_jawab')
<!-- Admin View -->
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0">Booking Jasa</h3>
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
                                <th>Jenis Layanan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $index }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td><strong>{{ $booking->jenis_layanan }}</strong></td>
                                <td>{{ $booking->tanggal_booking->format('d M Y') }}</td>
                                <td>{{ substr($booking->waktu_mulai, 0, 5) }} - {{ substr($booking->waktu_selesai, 0, 5) }}</td>
                                <td>{{ Str::limit($booking->keperluan, 50) }}</td>
                                <td>
                                    @if($booking->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($booking->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('booking.approve', $booking) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-icon btn-success btn-sm me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#reject{{ $booking->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        
                                        <div class="modal fade" id="reject{{ $booking->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="{{ route('booking.reject', $booking) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tolak Booking</h5>
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
                                    @elseif($booking->status === 'rejected')
                                        <small class="text-muted">{{ $booking->catatan_penanggung_jawab }}</small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- Mahasiswa View -->
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Riwayat Booking</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-calendar3 me-1"></i>Daftar booking jasa yang telah dibuat
        </p>
    </div>
</div>

<section class="container section py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Riwayat Booking</h4>
                <a href="{{ route('booking.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Buat Booking Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($bookings->count() > 0)
                <div class="row gy-4">
                    @foreach($bookings as $booking)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-3">
                                        <i class="bi bi-calendar-check text-primary" style="font-size: 24px;"></i>
                                    </div>
                                    @if($booking->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($booking->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </div>
                                
                                <h5 class="card-title mb-2">{{ $booking->jenis_layanan }}</h5>
                                
                                <hr class="my-3">
                                
                                <div class="mb-2">
                                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>Tanggal:</small>
                                    <div class="fw-semibold">{{ $booking->tanggal_booking->format('d M Y') }}</div>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i>Waktu:</small>
                                    <div class="fw-semibold">{{ substr($booking->waktu_mulai, 0, 5) }} - {{ substr($booking->waktu_selesai, 0, 5) }}</div>
                                </div>
                                
                                <div class="mb-3">
                                    <small class="text-muted"><i class="bi bi-file-text me-1"></i>Keperluan:</small>
                                    <p class="small mb-0">{{ Str::limit($booking->keperluan, 80) }}</p>
                                </div>
                                
                                @if($booking->status === 'rejected' && $booking->catatan_penanggung_jawab)
                                    <div class="alert alert-danger small mb-0">
                                        <strong>Catatan:</strong> {{ $booking->catatan_penanggung_jawab }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4 d-flex justify-content-center">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-calendar-x text-muted" style="font-size: 64px;"></i>
                        <h5 class="mt-3 mb-2">Belum Ada Booking</h5>
                        <p class="text-muted mb-4">Anda belum membuat booking apapun</p>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Buat Booking Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
@endsection
