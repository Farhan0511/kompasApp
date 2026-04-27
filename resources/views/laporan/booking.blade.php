@extends('admin.main')

@section('title', 'Laporan Booking')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h3 class="fw-bold mb-0"><i class="fas fa-file-alt me-2"></i>Laporan Booking</h3>
                <p class="text-muted mb-0">Data seluruh booking jasa</p>
            </div>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Cetak Laporan
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h5 class="mb-0">Filter Laporan</h5>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex gap-2 justify-content-end">
                            <select class="form-select form-select-sm" id="filterStatus" onchange="filterTable()">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Disetujui</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="bookingTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Jenis Layanan</th>
                                <th>Waktu</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $booking)
                            <tr data-status="{{ $booking->status }}">
                                <td>{{ $bookings->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $booking->tanggal_booking->format('d M Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ substr($booking->waktu_mulai, 0, 5) }} - {{ substr($booking->waktu_selesai, 0, 5) }}</small>
                                </td>
                                <td>
                                    <div>{{ $booking->user->name }}</div>
                                    <small class="text-muted">{{ $booking->user->email }}</small>
                                </td>
                                <td>{{ $booking->jenis_layanan }}</td>
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-muted">
                                    <small>Total: {{ $bookings->total() }} booking</small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .sidebar, .main-header, .btn, .card-header, .pagination {
        display: none !important;
    }
    .main-panel {
        margin-left: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

<script>
function filterTable() {
    const status = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#bookingTable tbody tr');
    
    rows.forEach(row => {
        if (!status || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endsection
