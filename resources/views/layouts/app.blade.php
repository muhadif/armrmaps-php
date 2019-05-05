<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inpection Railway Robot') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet"> {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyC5rT7DmUVrs-dlECDMXBcfMKfE7ItHRZI",
            authDomain: "maps-1ca28.firebaseapp.com",
            databaseURL: "https://maps-1ca28.firebaseio.com",
            projectId: "maps-1ca28",
            storageBucket: "maps-1ca28.appspot.com",
            messagingSenderId: "43370329320"
        };
        firebase.initializeApp(config);
    </script>
    {{--
    <script src="{{ asset('js/custom.js')}}"></script> --}}
    <nav class="navbar sticky-top navbar-dark bg-blue topbar">
        <a class="navbar-brand" href="#" onclick="toggleNav()">
            <span class="burger-menu hide-on-mobile">&#9776; Autonomous Railways Monitoring Robot</span>
            <span class="burger-menu show-on-mobile">&#9776; ARM Robot</span>
        </a>
        <div id="mySidenav" class="sidenav">
            <a style="float: right" href="javascript:void(0)" class="closebtn" onclick="toggleNav()">&times;</a>

            <a href="{{route('maps')}}">Peta</a>
            <a href="{{route('video')}}">Video Langsung</a>
            <a href="{{route('report')}}">Laporan</a>
            <a href="">Arsip</a>

        </div>
    </nav>
    <div class="container-fluid">
        <div class="sidebar-container">
            <div id="mySidenavSpacer" class="sidebar-space"></div>
            @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js')}}">

    </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js')}}">

    </script>


</body>

</html>