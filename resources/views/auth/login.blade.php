@extends('layouts.auth')

@section('title')
    Masuk
@endsection

@section('styles')
    <style>
        body {
            /* Location of the image */
            background-image: url("{{ asset('assets/img/bg-login.jpg') }}");

            /* Background image is centered vertically and horizontally at all times */
            background-position: center center;

            /* Background image doesn't tile */
            background-repeat: no-repeat;

            /* Background image is fixed in the viewport so that it doesn't move when
                the content's height is greater than the image's height */
            background-attachment: fixed;

            /* This is what makes the background image rescale based
                on the container's size */
            background-size: cover;

            /* Set a background color that will be displayed
                while the background image is loading */
            background-color: #464646;

        }

        .bg-white-custom {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
@endsection

@section('content')<header class="navbar navbar-header navbar-header-fixed">
    <div class="navbar-brand">
        <img src="{{ asset('assets/img/logo-petro-cv.png') }}" height="40" alt="">
    </div><!-- navbar-brand -->
</header><!-- navbar -->
<div class="content content-fixed content-auth-alt">
    <div class="container d-flex justify-content-center align-items-center ht-100p">
        <div class="col-sm-12 col-md-8 col-lg-6 mg-b-10 my-auto">
            @include('partials.messages')
            <div class="card bg-white-custom">
                <div class="card-body">
                    <div class="wd-sm-200 wd-md-300 wd-lg-400 pd-20 mg-b-15 mx-auto">
                        <img src="{{ asset('assets/img/logo-petro-cv.png') }}" class="img-fluid" alt="">
                    </div><!-- media-body -->
                    <form class="px-30" action="{{ route('login.submit') }}" method="post">
                        @csrf
                        <div class="wd-100p">
                            <h3 class="tx-color-01 mg-b-5 tx-center">Masuk</h3>
                            <p class="tx-color-01 tx-16 mg-b-40 tx-center">Sistem Informasi Karir Bang SDM.</p>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-success btn-lg rounded-pill tx-montserrat tx-semibold"><span class="mg-x-10">Masuk</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection