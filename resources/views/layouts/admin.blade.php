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
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.customs.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    @yield('styles')
</head>

<body>

    <aside class="aside aside-fixed">
        <div class="aside-header">
            @include('partials.menu-header')
        </div>
        <div class="aside-body">
            @include('partials.menu-body')
        </div>
    </aside>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            @include('partials.navbar-left')
            <nav class="nav r-25 pos-fixed z-index-10">
                @include('partials.navbar-right')
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div class="container pd-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                        <h4 class="mg-b-0 tx-spacing--1">
                            @yield('header_title')
                        </h4>
                    </div>
                    <div>
                        @yield('header_right')
                    </div>
                </div>

                <div class="row row-xs">
                    @yield('content')
                </div><!-- row -->
            </div><!-- container -->
        </div>
    </div>

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    @yield('prescripts')

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.aside.js') }}"></script>

    <!-- append theme customizer -->

    @include('partials.fixed-scripts')

    @yield('scripts')

</body>

</html>