<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            <img src="https://placehold.co/40x40/0d6efd/ffffff?text=K" alt="Logo" class="me-2" style="border-radius: 8px;">
            <h1 class="sitename">KompasApp</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="active">Home</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('booking.index') }}">Booking</a></li>
                    <li><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                @else
                    <li><a href="{{ route('booking.hub') }}">Booking & Peminjaman</a></li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @auth
            <div class="dropdown">
                <a class="btn-getstarted dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
        @endauth

    </div>
</header>
