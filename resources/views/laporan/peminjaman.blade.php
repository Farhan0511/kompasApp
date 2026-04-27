@extends('admin.main')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h3 class="fw-bold mb-0"><i class="fas fa-file-alt me-2"></i>Laporan Peminjaman</h3>
                <p class="text-muted mb-0">Data seluruh peminjaman alat</p>
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
                                <option value="dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="peminjamanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Alat</th>
                                <th>Periode</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $index => $item)
                            <tr data-status="{{ $item->status }}">
                                <td>{{ $peminjaman->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->tanggal_pinjam->format('d M Y') }}</strong>
                                </td>
                                <td>
                                    <div>{{ $item->user->name }}</div>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </td>
                                <td>
                                    <strong>{{ $item->masterAlat->nama_alat }}</strong>
                                    @if($item->masterAlat->kategori)
                                        <br>
                                        <small class="text-muted">{{ $item->masterAlat->kategori }}</small>
                                    @endif
                                </td>
                                <td>
                                    <div><small class="text-muted">Pinjam:</small> {{ $item->tanggal_pinjam->format('d M Y') }}</div>
                                    <div><small class="text-muted">Kembali:</small> {{ $item->tanggal_kembali->format('d M Y') }}</div>
                                    @if($item->tanggal_kembali_realisasi)
                                        <div><small class="text-success">Realisasi:</small> {{ $item->tanggal_kembali_realisasi->format('d M Y') }}</div>
                                    @endif
                                </td>
                                <td>{{ Str::limit($item->keperluan, 50) }}</td>
                                <td>
                                    @if($item->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($item->status === 'dikembalikan')
                                        <span class="badge bg-info text-dark">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-muted">
                                    <small>Total: {{ $peminjaman->total() }} peminjaman</small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $peminjaman->links() }}
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
    const rows = document.querySelectorAll('#peminjamanTable tbody tr');
    
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
