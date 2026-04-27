@extends('admin.main')

@section('title', 'Dashboard Penanggung Jawab')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0">Dashboard Penanggung Jawab</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-warning">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Booking Pending</p>
                        <h4 class="card-title">{{ $pendingBookings->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-info">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">Peminjaman Pending</p>
                        <h4 class="card-title">{{ $pendingPeminjaman->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Booking Pending</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if($pendingBookings->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingBookings as $booking)
                            <tr>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->masterAlat->nama_alat }}</td>
                                <td>{{ $booking->tanggal_booking->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('booking.approve', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectBooking{{ $booking->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="rejectBooking{{ $booking->id }}" tabindex="-1">
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
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">Tidak ada booking pending</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Peminjaman Pending</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if($pendingPeminjaman->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingPeminjaman as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->masterAlat->nama_alat }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('peminjaman.approve', $peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectPem{{ $peminjaman->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="rejectPem{{ $peminjaman->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('peminjaman.reject', $peminjaman) }}" method="POST">
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
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">Tidak ada peminjaman pending</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
