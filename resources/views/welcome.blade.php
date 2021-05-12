@extends('layouts.home')
@section('contenu_home')
<nav class="navbar navbar-expand-md navbar-light">
    <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/fatoura.JPG')}}" alt="fatoura"  height="60" width="200">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="basicExampleNav">
        @if (Route::has('login'))
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{route('dash.charteuro')}}">Home</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link text-center" href="{{ route('register') }}">Inscription</a>
                        @endif
                    </li>
                @endauth
            </ul>
        @endif
    </div>
</nav>
<div id="big">
<h1>Votre emplacement idéal pour gérer vos factures</h1>
<h5>Gérez votre fichier client, établissez des devis et générez des factures gratuitement</h5>
@if (Route::has('login'))
                @auth
                <div class="d-flex justify-content-center mt-5 ">
                    <br>
                    <br>
                    <br>
                </div>

                @else
                <div class="d-flex justify-content-center mt-5">
                    <a href="{{ route('register') }}">Créer votre compte maintenant</a>
                </div>
                @endauth

        @endif
<p class="text-center">Compatible Mobile, Tablettes & P.C</p>
<p class="text-center">Vous pouvez gérer vos factures gratuitement sur tous vos appareils</p>
</div>
<div class="images row container-fluid">
<div class="col-12 col-lg-4"><img src="{{asset('img/pc.png')}}" alt="pc" class="img-responsive image"></div>
<div class=" col-12 col-lg-4"><img src="{{asset('img/tablet.png')}}" alt="tablet" class="img-responsive image"></div>
<div class=" col-12 col-lg-4"><img src="{{asset('img/phone.png')}}" alt="phone" class="img-responsive image"></div>
</div>
<div id="stat" class=" my-5">
<h2 class="text-center mt-5 mx-2">Des millions des personnes utilisent quotidiennement notre outil</h2>
<div class="container row  mx-auto mt-5">
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/facture.png')}}" alt="facturation" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/visteurs.png')}}" alt="visiteurs" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/Devis.png')}}" alt="devis" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/opportunité.png')}}" alt="oportunité" class="img-responsive image"></div>
</div>
</div>
<div id="articles">
<div class="container row d-flex justify-content-between mx-auto my-5">
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-file-alt"></i></a></li>
            </ul>
            <p class="col-12">CREATION DE DEVIS ET DE FACTURES</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Générez devis et factures gratuitement. Dupliquez les documents ou transformez-les.
             Exportez-les sous différents formats. Chaque document est rattaché à un client.
              Obtenez facilement une vision d'ensemble !</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="far fa-gem"></i></a></li>
            </ul>
            <p class="col-12">Opportunités d'affaires</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Les opportunités d'affaire permettent une visibilité claire de votre prévisionnel de chiffre d'affaires. C'est une fonction CRM puissante.
                 Rentrez juste pour chaque client les projets que vous pensez pouvoir signer puis précisez simplement le montant du projet.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-tasks"></i></a></li>
            </ul>
            <p class="col-12">GESTION DES CLIENTS</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Un véritable CRM au sein de votre outil de facturation gratuit. Ajoutez, supprimez et modifiez vos clients. Ajoutez des informations,
                 rentrez votre activité au fur et à mesure (appels, rendez-vous, emails) et ajoutez des devis, des factures, des avoirs et même des opportunités d'affaire.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>

</div>
<div class="container row d-flex justify-content-between mx-auto my-5">
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-search"></i></a></li>
            </ul>
            <p class="col-12">Moteur de recherche puissant</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Trouvez facilement vos documents. Notre moteur de recherche vous permet de filtrer,
                 de trouver et de sélectionner clients, devis et factures en quelques instants.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-download"></i></a></li>
            </ul>
            <p class="col-12">Exporter tout en un clic</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Vous pouvez exporter vos factures et vos devis en un seul clic.
                 Fonctionnement idéal pour transmettre ses documents à un comptable ou à un client.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-sort-amount-up-alt"></i></a></li>
            </ul>
            <p class="col-12">Classement par catégories</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Que ce soit pour améliorer le fonctionnement de votre CRM gratuit ou pour mieux classer votre comptabilité,
                 le classement par catégorie permet de rassembler les devis, factures et clients selon une thématique ou une classe particulière.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="page-footer font-small indigo">
    <!-- Footer Links -->
    <div class="container">
      <div class="row text-center d-flex justify-content-center pt-5 mb-3">
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Qui Nous</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Notre Siteweb</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Blog</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Aide</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Contact</a>
          </h6>
        </div>
      </div>
      <!-- Grid row-->
      <hr class="rgba-white-light" style="margin: 0 15%;">

      <!-- Grid row-->
      <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">
        <!-- Grid column -->
        <div class="col-md-8 col-12 mt-5 desc">
          <p style="line-height: 1.7rem">Il est toujours plus facile de faire du bon travail lorsque l'on croit en ce que l'on fait.
             C'est la raison pour laquelle nous m'engageons à d'aider davantage des personnes, jour après jour.</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row-->
      <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">
      <div class="row pb-3 mt-2">
        <div class="col-md-12 icons">
          <div class="mb-5 text-center">
            <!-- Facebook -->
            <a class="fb-ic">
              <i class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic">
              <i class="fab fa-twitter fa-lg white-text mr-4"> </i>
            </a>
            <!-- Google +-->
            <a class="gplus-ic">
              <i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic">
              <i class="fab fa-instagram fa-lg white-text mr-4"> </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="color: white">© 2021 Copyright:
      <a href="https://devosoft.ma">Devosoft.ma</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
@endsection


