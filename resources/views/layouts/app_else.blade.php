<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE7aRb0VJdRBlUnvjcQ_lnKWoAWuXUx8&libraries=places,geometry" async defer></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" crossorigin="anonymous"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background: white;">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-logo" src="{{asset("images/logo.png")}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0" style="position: absolute; right: 5%;">
                            <li class="nav-item active">
                                <a class="nav-link username-link text-muted mt-1" href="#" >Welcome {{auth()->user()->name}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="font-size: 22px;"><i class="fa fa-bell" style="color: #999999;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" @click.prevent="openOrCloseMenu()" href="#" style="font-size: 22px;"><i class="fa fa-bars" style="color: #999999;"></i></a>
                                @include("layouts.menu")
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        {{--SET MODULE URLS --}}
        <input hidden value="{{ env("APP_URL") }}" id="app_url">

        <input hidden id="platform-url" value="{{env("PLATFORM_URL")}}">
        <input hidden id="faceform-url" value="{{env("FACEFORM_URL")}}">

    </div>

    @stack('custom-script')
</body>
</html>
