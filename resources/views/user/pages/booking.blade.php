<!-- About Section -->
@extends('user.main')

@section('title', 'Booking | Kompas')
@section('content')
    <div class="container mt-5">

        <div class="text-center mb-4">
            <h2>Form Booking Penampilan Kompas</h2>
            <p>Silakan isi data berikut untuk melakukan pemesanan</p>
        </div>

        <form action="" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Pemesan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Instansi / Nama Acara</label>
                <input type="text" name="instansi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Acara</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Lokasi Acara</label>
                <input type="text" name="lokasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Penampilan</label>
                <select name="jenis" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Musik">Musik</option>
                    <option value="Akustik">Akustik</option>
                    <option value="Full Band">Full Band</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Kontak (WhatsApp)</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catatan Tambahan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Kirim Booking
            </button>

        </form>
    </div>
@endsection
