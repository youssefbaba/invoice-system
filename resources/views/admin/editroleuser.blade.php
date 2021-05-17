@extends('home')
@section('header_content')
<h2 id="grand_title_addclient " style="color: white" class="text-uppercase ml-2">
    Modifier&nbsp;le&nbsp;Role&nbsp;du&nbsp;{{$user->name}}&nbsp;{{$user->lastname}}</h2>
@endsection
@section('contenu_inside')
<div class="container mt-2">
    <form method="POST" action="{{ route('admin.update', ['user_id'=>$user->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="nom_user" class="font-weight-bold">Nom</label>
            <input type="text" class="form-control bg-white" id="nom_user" name="nom_user" value="{{$user->name}}"  readonly required>
          </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="prenom_user" class="font-weight-bold">Prenom</label>
              <input type="text" class="form-control bg-white" id="prenom_user" value="{{$user->lastname}}" readonly required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="email_user" class="font-weight-bold">Email Professionnel</label>
              <input type="email" class="form-control bg-white" id="email_user" value="{{$user->email_profes}}" readonly name="email_user"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="role_user" class="font-weight-bold">Role</label>
                <select class="form-control" name="role_user" id="role_user">
                  <option value="0">Adminisrateur </option>
                  <option value="1"  selected>Utilisateur</option>
                </select>
            </div>
        </div>
        <a type="button" class="btn btn-danger" href="{{ route('admin') }}" >Annuler</a>
        <button class="btn btn-primary" type="submit">Update Role</button>
      </form>

</div>

@endsection
@section('select2')
<script>

</script>
@endsection
