@component('mail::message')
<p>Voilà vos email et mot de passe pour l'authentification sur l'application fatoura </p>
<p>Email:<span>{{$user->email}}</span></p>
<p>Mot de passe:<span>{{$password}}</span></p>
@component('mail::button', ['url' => 'http://localhost:8000/login'])
Authentification
@endcomponent
Thanks,<br>

