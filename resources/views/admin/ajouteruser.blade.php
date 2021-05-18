@extends('home')
@section('header_content')
<h2 id="grand_title_addclient " style="color: white" class="text-uppercase ml-2">
    Ajouter&nbsp;Un&nbsp;Utlisateur</h2>
@endsection
@section('contenu_inside')
<div class="container my-4" >
    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="nom_user" class="font-weight-bold">Nom</label>
            <input id="name" type="text" class=" form-control @error('name') @enderror col-12 mb-4 " name="name" placeholder="Nom"  autocomplete="name" autofocus required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
          </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="prenom_user" class="font-weight-bold">Prenom</label>
              <input id="lastname" type="text" class=" form-control @error('lastname') @enderror col-12 mb-4 " name="lastname" placeholder="prenom" autocomplete="lastname" required>
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="email_user" class="font-weight-bold">Email Professionnel</label>
              <input id="email" type="email" class="form-control  @error('email') @enderror col-12 mb-4 " name="email" placeholder="email "  required autocomplete="email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="role_user" class="font-weight-bold">Mot de passt</label>
              <input id="password" type="password" class="form-control @error('password')@enderror col-12 mb-4 " name="password" placeholder="Mot de pass" value="{{Str::random(3).''.rand( 10000, 99999 )}}"  autocomplete="new-password" required>
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{ route('admin') }}" >Annuler</a>
        <button class="btn btn-primary" type="submit">Ajouter un utilisateur</button>
    </form>
</div>

@endsection
@section('select2')
<script>

</script>
@endsection
