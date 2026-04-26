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
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('user.components.footer')

    <!-- JS -->
    <script src="{{ asset('views/assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('views/assets/user/js/main.js') }}"></script>

</body>

</html>
