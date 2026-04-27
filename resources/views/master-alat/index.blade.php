@extends('admin.main')

@section('title', 'Master Alat')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="fw-bold mb-0">Master Alat</h3>
            <a href="{{ route('master-alat.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Alat
            </a>
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
                                <th width="5%">No</th>
                                <th width="15%">Foto</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th width="10%">Jumlah</th>
                                <th width="12%">Kondisi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $index => $alat)
                            <tr>
                                <td>{{ $alats->firstItem() + $index }}</td>
                                <td>
                                    @if($alat->foto && file_exists(public_path($alat->foto)))
                                        <img src="{{ asset($alat->foto) }}?v={{ time() }}" 
                                             alt="{{ $alat->nama_alat }}" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $alat->nama_alat }}</strong></td>
                                <td>{{ $alat->kategori ?? '-' }}</td>
                                <td>{{ $alat->jumlah }}</td>
                                <td>
                                    @if($alat->kondisi === 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($alat->kondisi === 'rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                    @else
                                        <span class="badge bg-warning">Perbaikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('master-alat.edit', $alat) }}" class="btn btn-icon btn-warning btn-sm me-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('master-alat.destroy', $alat) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus alat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data alat</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center">
                        {{ $alats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
