@extends('layouts.home')

@section('contenu_home')
<nav class="navbar navbar-expand-md navbar-light sticky-top">
    <a class="navbar-brand" href="{{ url('/') }}">
        <div class="loader">
            Facturation
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @guest
        @else
            <ul class="navbar-nav mr-auto">
                <form action="" method="post" id="form_search">
                    <span><i class="far fa-edit"></i></span>
                    <input type="search" name="chercher" >
                </form>
            </ul>
        @endguest
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                    </li>
                @endif
            @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            @endguest
        </ul>
    </div>
</nav>
<div class="reset_section" >
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
    @endif
    <h2 class="my-5 text-center">Mot de pass oublié</h2>
        <form action="{{ route('password.email') }}" method="post">
            @csrf
                <div class="row my-3 px-5 pt-5">
                    <input id="email" type="email" class=" @error('email') is-invalid @enderror col-12 mb-4" placeholder="Email d'utilisateur" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input type="submit" value="Envoyer" class="col-12 mb-1">
                </div>
        </form>
</div>
@endsection
