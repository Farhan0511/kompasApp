@extends('user.main')

@section('title', 'Ajukan Peminjaman')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs d-flex align-items-center" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 60px 0; margin-bottom: 30px;">
    <div class="container position-relative d-flex flex-column align-items-center">
        <h2 class="text-white mb-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Form Peminjaman Alat</h2>
        <p class="text-white-50 mb-0" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
            <i class="bi bi-box-seam me-1"></i>Pinjam alat untuk keperluan pribadi/kelompok
        </p>
    </div>
</div>

<section class="container section py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i>Form Peminjaman Alat</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        
                        <!-- Alat Selection with Image Preview -->
                        <div class="mb-4">
                            <label for="master_alat_id" class="form-label fw-bold">Pilih Alat *</label>
                            <select class="form-select form-select-lg @error('master_alat_id') is-invalid @enderror" id="master_alat_id" name="master_alat_id" required onchange="previewAlatImage()">
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alats as $alat)
                                    <option value="{{ $alat->id }}" 
                                            data-foto="{{ $alat->foto }}" 
                                            data-nama="{{ $alat->nama_alat }}"
                                            data-stok="{{ $alat->jumlah }}">
                                        {{ $alat->nama_alat }} (Stok: {{ $alat->jumlah }})
                                    </option>
                                @endforeach
                            </select>
                            @error('master_alat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Pilih alat yang ingin dipinjam</div>
                            
                            <!-- Image Preview -->
                            <div id="alatImagePreview" class="mt-3 text-center" style="display: none;">
                                <img id="previewImg" src="" alt="Preview Alat" class="img-fluid rounded shadow-sm" style="max-height: 250px; max-width: 100%;">
                                <h6 id="alatNama" class="mt-2 mb-0 fw-semibold"></h6>
                                <span id="alatStok" class="badge bg-success mt-1"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_pinjam" class="form-label fw-bold">Tanggal Pinjam *</label>
                                <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" min="{{ date('Y-m-d') }}" required>
                                @error('tanggal_pinjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Tanggal mulai meminjam</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_kembali" class="form-label fw-bold">Tanggal Kembali *</label>
                                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" min="{{ date('Y-m-d') }}" required>
                                @error('tanggal_kembali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Tanggal rencana pengembalian</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keperluan" class="form-label fw-bold">Keperluan *</label>
                            <textarea class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" rows="4" placeholder="Jelaskan keperluan peminjaman alat..." required>{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Minimal 10 karakter, maksimal 500 karakter</div>
                        </div>

                        <!-- Info Card -->
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Perhatian:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Alat harus dikembalikan sesuai tanggal yang ditentukan</li>
                                <li>Pastikan alat dalam kondisi baik saat diterima</li>
                                <li>Keterlambatan pengembalian akan dikenakan sanksi</li>
                            </ul>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-send me-2"></i>Submit Peminjaman
                            </button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function previewAlatImage() {
    const select = document.getElementById('master_alat_id');
    const selectedOption = select.options[select.selectedIndex];
    const previewDiv = document.getElementById('alatImagePreview');
    const previewImg = document.getElementById('previewImg');
    const alatNama = document.getElementById('alatNama');
    const alatStok = document.getElementById('alatStok');
    
    console.log('Selected value:', select.value);
    console.log('Selected option:', selectedOption);
    
    if (select.value && selectedOption) {
        const foto = selectedOption.getAttribute('data-foto');
        const nama = selectedOption.getAttribute('data-nama');
        const stok = selectedOption.getAttribute('data-stok');
        
        console.log('Foto:', foto);
        console.log('Nama:', nama);
        
        let imageUrl = '';
        if (foto && foto.length > 0) {
            imageUrl = '{{ asset('') }}' + foto + '?v=' + Date.now();
            console.log('Using uploaded image:', imageUrl);
        } else {
            imageUrl = 'https://placehold.co/400x300/198754/ffffff?text=' + encodeURIComponent(nama);
            console.log('Using placeholder:', imageUrl);
        }
        
        previewImg.src = imageUrl;
        previewImg.onerror = function() {
            console.error('Image failed to load:', this.src);
            this.src = 'https://placehold.co/400x300/198754/ffffff?text=' + encodeURIComponent(nama);
        };
        
        alatNama.textContent = nama;
        alatStok.textContent = 'Stok: ' + stok;
        previewDiv.style.display = 'block';
        console.log('Preview shown');
    } else {
        previewDiv.style.display = 'none';
        console.log('No selection');
    }
}

// Initialize on page load if old input exists
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    const select = document.getElementById('master_alat_id');
    if (select && select.value) {
        console.log('Initializing with old value');
        previewAlatImage();
    }
    
    // Add change listener
    select.addEventListener('change', previewAlatImage);
});
</script>
@endpush
@endsection
