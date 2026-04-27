<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header text-center py-3">
            <a href="{{ route('dashboard') }}" class="logo text-white text-decoration-none">
                <h4 class="mb-0 fw-bold">Kompas App</h4>
            </a>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Dashboard -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                        <i class="fas fa-home"></i>
                        <p class="mb-0 ms-2">Dashboard</p>
                    </a>
                </li>

                @if(auth()->user()->role === 'penanggung_jawab')
                <!-- Master Alat -->
                <li class="nav-item {{ request()->routeIs('master-alat.*') ? 'active' : '' }}">
                    <a href="{{ route('master-alat.index') }}" class="d-flex align-items-center">
                        <i class="fas fa-folder"></i>
                        <p class="mb-0 ms-2">Master Alat</p>
                    </a>
                </li>

                <!-- Booking -->
                <li class="nav-item {{ request()->routeIs('booking.*') ? 'active' : '' }}">
                    <a href="{{ route('booking.index') }}" class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt"></i>
                        <p class="mb-0 ms-2">Booking</p>
                    </a>
                </li>

                <!-- Peminjaman -->
                <li class="nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <a href="{{ route('peminjaman.index') }}" class="d-flex align-items-center">
                        <i class="fas fa-hand-holding"></i>
                        <p class="mb-0 ms-2">Peminjaman</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role === 'ketua')
                <!-- Laporan Booking -->
                <li class="nav-item {{ request()->routeIs('laporan.booking') ? 'active' : '' }}">
                    <a href="{{ route('laporan.booking') }}" class="d-flex align-items-center">
                        <i class="fas fa-file-alt"></i>
                        <p class="mb-0 ms-2">Laporan Booking</p>
                    </a>
                </li>

                <!-- Laporan Peminjaman -->
                <li class="nav-item {{ request()->routeIs('laporan.peminjaman') ? 'active' : '' }}">
                    <a href="{{ route('laporan.peminjaman') }}" class="d-flex align-items-center">
                        <i class="fas fa-clipboard-list"></i>
                        <p class="mb-0 ms-2">Laporan Peminjaman</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
