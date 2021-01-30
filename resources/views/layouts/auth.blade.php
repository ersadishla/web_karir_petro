<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Other meta tags -->
    <meta name="description" content="Karir Pengembangan SDM PT. Petrokimia Gresik">
    <meta name="author" content="Petrokimia Gresik">

    <title>@yield('title') &bullet; Karir Bang SDM</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- vendor CSS -->
    <link href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/animate.css/animate.min.css') }}" rel="stylesheet">


    @yield('prestyles')

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.customs.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    @yield('styles')
</head>

<body>
    @yield('content')

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    @yield('prescripts')

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>\

    <!-- append theme customizer -->

    @yield('scripts')

</body>

</html>