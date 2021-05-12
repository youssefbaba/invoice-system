<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fatoura</title>
        {{-- style home --}}
        <link rel="stylesheet" href="{{asset('css/style_home.css')}}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
           <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('font/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/registre1.css') }}">
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/reset_password.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    </head>
    <body>
        @yield('contenu_home')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/registre1.js') }}" defer></script>
        <script src="{{ asset('js/jquery.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.bundle.js') }}" ></script>
        @yield('select2')
    </body>
</html>
