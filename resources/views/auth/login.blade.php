@extends('layouts.home')
@section('contenu_home')
<nav class="navbar navbar-expand-md navbar-light sticky-top">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/fatoura.JPG')}}" alt="fatoure"  height="60" width="200">
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
<div class="connect_section" >
    @if (session('email_missing'))
            <div class="alert alert-danger" role="alert">
                {{ session('email_missing') }}
            </div>
    @endif
    <h2 class="my-5 text-center">Connexion</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="row my-3 px-5">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror col-12 mb-4" name="email" value="{{ old('email') }}" placeholder="Email d'utilisateur" required autocomplete="email" autofocus>
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input id="password" type="password" class="@error('password') is-invalid @enderror col-12 mb-4" name="password" placeholder="Mot de pass" required autocomplete="current-password">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input type="submit" value="Connecter" class="col-12 mb-1">
                </div>
                <div class="row souvenir px-5">
                    <div class="col-12">
                        <div class="row ">
                            <div class="col-6 checkbox mt-1">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="pl-2">Se Souvenir</span>
                            </div>
                            <div class="col-6 oublie text-right ">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Oublié?</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row ou_section">
                            <span class="col-5"><hr></span> <p class="col-2">ou</p> <span class="col-5"><hr></span>
                        </div>
                    </div>
                    <div class="col-12 para text-center">
                        <p>Connectez-vous avec votre compte de médias sociaux</p>
                    </div>
                    <div class="col-12 social mt-3">
                        <div class="col-md-12 icons ">
                            <div class="mb-5 d-flex justify-content-around">
                            <!-- Facebook -->
                            <a href="{{route('login_facebook')}}" class="fb-ic mx-3 fb">
                                <i class="fab fa-facebook-f fa-lg"> </i>
                            </a>
                            <!-- Google +-->
                            <a href="{{route('login_google')}}" class="gplus-ic mx-3 go">
                                <i class="fab fa-google-plus-g fa-lg"> </i>
                            </a>
                            </div>
                        </div>
                        </ul>
                    </div>
                </div>
            </form>
</div>
@endsection
