<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fatoura</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('font/css/all.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_skellet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showclient1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addclient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/voir_client1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showfacture1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facture_voirplus.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/avoir.css') }}">
</head>
<body >
        <div class="sidebar">
            @yield('content')
        </div>
        <div class="content">
            <div class="content_header">
                <button id="clicka">☰</button>
                @yield('header_content')
            </div>
            <div class="content_inside">
                @yield('contenu_inside')
            </div>
        </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#clicka').on('click',function(){
                $('.sidebar').toggleClass("show");
                $(this).toggleClass("move");
            });
        });
    </script>
    @yield('script')
    @yield('select2')
    <script src="{{ asset('js/showclient.js') }}">
    <script src="{{ asset('js/showdevi.js') }}">
    <script src="{{ asset('js/showfacture.js') }}">
    <script src="{{ asset('js/showfacturepaye.js') }}">
    <script src="{{ asset('js/jquery.js') }}">
    <script src="{{ asset('js/bootstrap.bundle.js') }}">

    </script>
</body>
</html>
