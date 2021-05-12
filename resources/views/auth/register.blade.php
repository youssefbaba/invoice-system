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
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="contain_first">
                            <div class="first">
                                <div class="inscrire_section">
                                    <h2 class="my-5 text-center">Inscription</h2>
                                        <div class="row my-3 px-5">
                                            <input id="name" type="text" class=" form-control @error('name') @enderror col-12 mb-4" name="name" placeholder="Nom"  autocomplete="name" autofocus required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="lastname" type="text" class=" form-control @error('lastname') @enderror col-12 mb-4" name="lastname" placeholder="prenom" autocomplete="lastname" required>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="email" type="email" class="form-control  @error('email') @enderror col-12 mb-4" name="email" placeholder="email "  required autocomplete="email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="password" type="password" class="form-control @error('password')@enderror col-12 mb-4" name="password" placeholder="Mot de pass"  autocomplete="new-password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="password-confirm" type="password" class="form-control col-12 mb-4" name="password_confirmation" placeholder="Confirmer Password"  autocomplete="new-password" required>
                                            <p class="col-12">La création d'un compte implique que vous avez lu et
                                                accepté les<a href="{{ route('terms') }}">Termes et conditions d'utilisation.</a></p>
                                            <span id="suivant" class="col-12 mb-5">Suivant</span>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="contain_information second">
                            <span class="right"><i class="fas fa-angle-double-right"></i></span>
                            <div class="information_section">
                                <h2 class="mt-5 text-center">Informations</h2>
                                <h5 class="my-2 text-center">Veuillez compléter les informations suivantes</h5>
                                    <div class="row my-3 px-5">
                                        <input type="text" name="adresse" placeholder="Adresse"  class="form-control col-6 mb-4">
                                        <input type="text" name="societe" placeholder="Nom de société"  class="form-control col-6 mb-4">
                                        <input type="text" name="postal" placeholder="Code_postal"  class="form-control col-6 mb-4">
                                        <input type="text" name="ville" placeholder="Ville" class=" form-control col-6 mb-4">
                                        <select name="pays" class="form-control col-12 mb-4">
                                            <option>Selectionner Votre Pays</option>
                                            <option value="maroc">Morocco</option>
                                            <option value="france">France</option>
                                        </select>
                                        <input type="email" name="emailprofessionnelle" placeholder="Email professionnelle"  class="form-control col-6 mb-4">
                                        <input type="text" name="phone" placeholder="Numéro de telephone" class="form-control col-6 mb-4">
                                        <input type="submit" value="S'incrire Maintenant" class="col-12 my-5">
                                    </div>
                            </div>
                        </div>
                    </form>
@endsection
