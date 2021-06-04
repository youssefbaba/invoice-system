@component('mail::message')
<p>Voilà vos email et mot de passe pour l'authentification sur l'application fatoura </p>
<p>Email:<span>{{$user->email}}</span></p>
<p>Mot de passe:<span>{{$password}}</span></p>
@component('mail::button', ['url' => 'http://localhost:8000/login'])
Authentification
@endcomponent
<p style="color: red">Après l'authentification c'est obligatoire de modifier votre mot de passe et finir le remplissage de votre information</p>
@component('mail::button', ['url' => 'http://localhost:8000/parametreCompte'])
Réinitialiser le mot de passe
@endcomponent
@component('mail::button', ['url' => 'http://localhost:8000/user/finishinformation'])
Compléter vos informations
@endcomponent
Thanks,<br>

