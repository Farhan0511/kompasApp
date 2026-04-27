<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Kompas App')</title>

    <link rel="icon" href="{{ asset('views/assets/user/img/kompasapp.jpeg') }}">

    <!-- CSS -->
    <link href="{{ asset('views/assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('views/assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('views/assets/user/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('views/assets/user/css/main.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('user.components.navbar')

    {{-- Content --}}
    <main class="main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #198754;">
                <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #dc3545;">
                <i class="bi bi-exclamation-triangle me-2"></i><strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #0dcaf0;">
                <i class="bi bi-info-circle me-2"></i><strong>Info:</strong> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    @include('user.components.footer')

    <!-- JS -->
    <script src="{{ asset('views/assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('views/assets/user/js/main.js') }}"></script>
    
    @stack('scripts')

</body>

</html>
