<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Kompas App')</title>

    <link rel="icon" href="https://placehold.co/32x32/0d6efd/ffffff?text=K" type="image/x-icon">

    <!-- CSS -->
    <link href="{{ asset('views/assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('views/assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('views/assets/user/css/main.css') }}" rel="stylesheet">
</head>

<body class="auth-page">

    <main class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- JS -->
    <script src="{{ asset('views/assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
