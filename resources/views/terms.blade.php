@extends('layouts.home')
@section('contenu_home')
<nav class="navbar navbar-expand-md navbar-light">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/fatoura.JPG')}}" alt="fatoure"  height="60" width="200">
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
                        <a class="nav-link text-center" href="{{ route('clients.index') }}">Home</a>
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

<div class="container">
    <div class="row d-flex mb-md-0 ">
        <!-- Grid column -->
        <div class="col-12 mt-2 desc">
            <h1 class="navbar-title">Conditions Générales d'Utilisation</h1>
        </div>
        <!-- Grid column -->
    </div>

    <div class="row d-flex  mb-md-0 ">
        <!-- Grid column -->
        <div class="col-12  desc">
          <p style="line-height: 1.7rem">
            Les Termes et Conditions suivants s'appliquent à l'utilisation de ce site Web.
                Cet Accord (désigné sous le nom de « Accord ») désigne l'Accord
                contractuel entre le site Facture.net propriété de la société Codeur SARL («
                Facture.net », « nous », « on ») et vous (« Utilisateur », « vous », «
                votre », « vos ») qui acceptez les termes de cet Accord en cliquant sur la
                case « J'accepte » dans le formulaire de création de compte Utilisateur
                dans la section « Termes et conditions ». Cet Accord devient effectif au
                moment où vous soumettez le formulaire de création de compte Utilisateur
                après avoir cliqué sur la case « J'accepte ». Cet Accord régit les règles
                d'utilisation du site web Facture.net. Maintenant en considération des
                termes et conditions de cet Accord contenus dans la suite de ce document,
                vous acceptez tout ce qui suit :
            </p>
        </div>
        <!-- Grid column -->
    </div>
        <div class="row d-flex  mb-md-0 ">
            <!-- Grid column -->
            <div class="col-12  desc">
              <h2>1. Clic sur le bouton « Créez un compte »</h2>
              <p style="line-height: 1.7rem">
                En utilisant le site web Facture.net, en cliquant sur le bouton « Créez un
                compte », vous reconnaissez avoir accepté les termes et conditions de cet
                accord. En acceptant les termes et conditions de cet Accord, et après
                avoir validé les informations que vous avez saisies dans le formulaire
                d'inscription, vous devenez enregistré en tant que « Utilisateur
                Enregistré » et acceptez d'être désigné en tant que « Utilisateur » (comme
                définie dans la section 3) ce qui garantit le fait que vous êtes
                représenté dans cet Accord. Si vous n'acceptez pas les termes et
                conditions de cet Accord, vous n'êtes pas autorisé à utiliser ce site Web.
                Le terme « Utilisateur Enregistré » représente toute personne physique ou
                morale qui s'est inscrite sur le site web Facture.net.
                </p>
            </div>
            <!-- Grid column -->
      </div>
      <div class="row d-flex  mb-md-0 ">
        <!-- Grid column -->
        <div class="col-12  desc">
          <h2>2. Site web</h2>
          <p style="line-height: 1.7rem">
            Le site web Facture.net fournit un moyen pour les Utilisateurs de créer des
            factures et de faire leur gestion commerciale. A partir du site web
            Facture.net, nous fournissons des informations à propos de nos services,
            de nos utilisateurs ainsi que d'autres informations tiers. Nous pouvons
            modifier, supprimer ou ajouter une partie ou la totalité de ces
            informations à n'importe quel moment.
            </p>
        </div>
        <!-- Grid column -->
  </div>

  <div class="row d-flex  mb-md-0 ">
    <!-- Grid column -->
    <div class="col-12  desc">
      <h2>3. Utilisateurs</h2>
      <p style="line-height: 1.7rem">
        En cochant la case « Oui j'ai lu et j'accepte les termes et conditions
        d'utilisation » dans le formulaire d'inscription ou le formulaire de
        création d'un projet, vous vous désignez en tant qu' « Utilisateur ».
      </p>
    </div>
    <!-- Grid column -->
</div>
<div class="row d-flex  mb-md-0 ">
    <!-- Grid column -->
    <div class="col-12  desc">
      <h2>4. Integrite du systeme</h2>
        <p style="line-height: 1.7rem">Vous n'êtes pas autorisé à utiliser des dispositifs, logiciels, ou algorithme,
            incluant mais ne se limitant pas aux virus, trojan, vers, attaque DDOS,
            avec l'intention de causer des dommages ou s'opposer au bon fonctionnement
            du Site Web, ou à n'importe quelle transaction se déroulant sur le Site
            Web, d'intercepter et utiliser le système, données, ou informations
            personnelles du Site Web. Il vous est interdit d'entreprendre des actions
            qui viseraient à surcharger notre système, incluant mais ne se limitant
            pas au « Spam » ou autre technique d'envois d'email massifs.</p>
            <p style="line-height: 1.7rem">Le site web Facture.net conserve vos données gratuitement et vous avertira à
            l'avance si pour une raison ou pour une autre les services devaient être
            interrompus et les données effacées. Si tel était le cas, le site
            Facture.net proposerait des solutions pour extraire les données des
            Utilisateurs avant leur effacement.</p>
            <p style="line-height: 1.7rem">Les données du site web Facture.net sont convenablement protégées et
            sauvegardées. Néanmoins la société Codeur SARL ne garanti pas les
            Utilisateurs du site Facture.net contre toute perte de données, notamment
            en cas d'évènement qui ne sont pas de la responsabilité de la société
            Codeur SARL comme, par exemple, incendie, incident serveur, guerre et
            actes de terrorisme.</p>

    </div>
    <!-- Grid column -->
</div>


<div class="row d-flex  mb-md-0 ">
    <!-- Grid column -->
    <div class="col-12  desc">
      <h2>5. Informations publiées</h2>
      <p style="line-height: 1.7rem"><strong>A.</strong> Vous êtes seul et unique responsable des informations que vous publiez sur notre
        Site Web, incluant mais ne se limitant pas à toute forme de publication,
        de création de message dans un espace de discussion, ou par un système
        d'émail. Vous nous Accordez le droit irrévocable d'appliquer les
        copyrights ainsi que les droits de la publicité en respect de ces
        informations. Les informations que vous publiez ne doivent pas : porter
        atteinte au droits d'autrui, incluant mais ne se limitant pas aux droits
        de la propriété intellectuel, publicité, ou vie privé ; être diffamatoire,
        menacer, harceler ; être obscène , indécent, ou contenir de la
        pornographie. Nous ne sommes pas responsable des informations publiées par
        les Utilisateurs Enregistrés ni exposé pour ce type d'information publiées
        sur notre Site Web incluant mais ne se limitant pas aux informations
        traitant de vous. Nous nous réservons le droit de prendre des actions
        légales envers les informations portées sur notre Site Web qui seront
        jugées, à notre entière discrétion, en respect de ce type d'informations,
        incluant mais ne se limitant pas à la clôture de cet Accord. Par ailleurs
        nous ne pouvons contrôler les informations qui vous seraient fournies par
        les Utilisateurs Enregistrés par le biais du Site Web. Il est très rare
        que les informations publiées par les gens soient offensives, menaçantes
        ou imprécises. Les informations fournies sur le Site Web Facture.net sont
        livrées en tant que tel et peuvent contenir des incohérences techniques ou
        des fautes de typographie.</p>
        <p style="line-height: 1.7rem"><strong>B.</strong> Le Site Web peut contenir des liens vers des site web extérieurs qui ne sont pas
        sous le contrôle de Facture.net. Nous ne sommes pas responsable du contenu
        de ces sites web ni des liens pouvant être contenu dans ces sites
        extérieurs.</p>
    </div>
    <!-- Grid column -->
</div>


<div class="row d-flex  mb-md-0 ">
    <!-- Grid column -->
    <div class="col-12  desc">
      <h2>6. Confidentialité</h2>
      <p style="line-height: 1.7rem">Facture.net s’interdit expressément d'utiliser les données concernant les
        clients des utilisateurs. Et ce notamment à toutes fins marketing ou
        commerciale. Ces données sont confidentielles et restent a usage exclusif
        des utilisateurs qui les ont créées. Facture.net ne peut accéder à ces
        données que pour des raisons de maintenance ou de support technique.</p>
    </div>
    <!-- Grid column -->
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
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://devosoft.ma">Devosoft.ma</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
@endsection



