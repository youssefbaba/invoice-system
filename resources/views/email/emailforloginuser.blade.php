 <p>Voilà votre email et mot de passe pour l'authentification sur l'application Fatoura </p>
 <p>Email:<span>{{$user->email}}</span></p>
 <p>Mot de passe:<span>{{$password}}</span></p>
 <p style="color: red">Après l'authentification c'est obligatoire de modifier votre mot de passe et finir le remplissage de votre information</p>
 <p>lien pour modifier le mot de passe :  <a href="{{ route('parametre.compte') }}">Réinitialiser le mot de passe</a></p>
 <p>lien pour finir le remplissage de vos inforamtions :  <a href="{{ route('user.create') }}">Compléter vos informations</a> </p>

