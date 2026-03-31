<!-- About Section -->
@extends('user.main')

@section('title', 'About Kompas')
@section('content')
    <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up"> <span>Tentang Kami<br></span>
            <h2>About</h2>
            <p>Media informasi UKM Kompas Universitas Banten Jaya</p>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100"> <img
                        src="{{ asset('views/assets/user/img/about.png') }}" class="img-fluid" alt=""> </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Kompas UNBAJA</h3>
                    <p> Kompas UNBAJA adalah portal berita UKM Universitas Banten Jaya yang menyajikan informasi seputar
                        kegiatan kampus dan mahasiswa secara cepat dan terpercaya. </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Informasi kegiatan kampus</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Berita dan update mahasiswa</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Media publikasi UKM Kompas</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Penyewaan alat musik dan perlengkapan kegiatan</span>
                        </li>
                    </ul>
                    <p> Selain sebagai media informasi, Kompas juga menyediakan layanan penyewaan alat musik dan
                        perlengkapan untuk mendukung kegiatan mahasiswa di Universitas Banten Jaya. </p>
                </div>
            </div>
        </div>
    </section>
@endsection
