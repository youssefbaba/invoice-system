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
    <link href="{{ asset('css/style_para.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cordonne.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body >
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class=" border-right" id="sidebar-wrapper" style="background-color:#093073">
              <div class="sidebar-heading font-weight-bold" style="color: white"><a href="{{ route('parametre') }}" style="color: white"><i class="fas fa-cog">&nbsp;Paramètres</i></a> </div>
              <div class="list-group list-group-flush">
                <a href="{{route('parametre')}}" class="list-group-item list-group-item-action" style="background-color:#093073;color:white"><i class="fa fa-address-card">&nbsp;Coordonnées</i> </a>
                <a href="{{route('parametre.compte')}}" class="list-group-item list-group-item-action" style="background-color:#093073;color:white"><i class="fas fa-user">&nbsp;Compte</i></a>
                <a href="{{route('parametre.delete')}}" class="list-group-item list-group-item-action" style="background-color:#093073;color:white"><i class="fas fa-user-times">&nbsp;Supprimer mon compte</i></a>
                <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action" style="background-color:#093073;color:white"><span style="float: right"><i class="fas fa-arrow-left"></i></span><span>Retour</span></a>
              </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

              <nav class="navbar navbar-expand-lg navbar-light  border-bottom" style="background-color: #093073;">
                <button class="btn btn-primary" id="menu-toggle" >≡</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('dashboard')}}" style="color: white">Dashboard</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('deconnexion')}}" style="color: white">Déconnexion</a>
                    </li>
                  </ul>
                </div>
              </nav>
                <div class="container-fluid">
                    @yield('contenu_inside')
                </div>
            </div>
            <!-- /#page-content-wrapper -->

          </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!--  jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @yield('script_para')
</body>
</html>
