<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatoura</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-8 mx-auto">
                <div class="panel panel-primary">

                    <div class="panel-heading" >
                        <h3 class="panel-title uppercase">{{$user->name}}&nbsp;{{$user->lastname}}</h3>
                    </div>

                    <div class="panel-body" >
                            <div class="d-inline " align="center"><img src="{{asset('uploads/avatars/'.$user->avatar)}}"
                                    alt="avatar_image" class="img-circle img-responsive"> </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="row ">
            <div class="col-8 mx-auto">
                <div class="panel panel-primary">
                    <div class="panel-body" >
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Nom</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Prenom</td>
                                    <td>{{$user->lastname}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Type</td>
                                    <td>@if(Auth::user()->role === 0)
                                      Utilisateur
                                    @else
                                      Administrateur
                                    @endif</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Adresse email</td>
                                    <td><a href="mailto:{{$user->email}}" class="link-hover-focus">{{$user->email}}</a></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Adresse</td>
                                    <td>{{$user->adresse}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ville</td>
                                    <td>{{$user->ville}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Pays</td>
                                    <td>{{$user->pays}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Société</td>
                                    <td>{{$user->name_company}}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Numéro de téléphone</td>
                                    <td><a class="link-hover-focus" href="tel:{{$user->tel}}">{{$user->tel}}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
