@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase">Modifier&nbsp;le&nbsp;Role&nbsp;du&nbsp;{{$user->name}}&nbsp;{{$user->lastname}}</h2>
@endsection
@section('contenu_inside')
<div class="container-fluid mt-2">
    <form method="POST" action="{{ route('admin.update', ['user_id'=>$user->id]) }}" enctype="multipart/form-data" id="bigform2">
        @csrf
        @method('PUT')
        <div class="client col-md-8">
            <div class="form-group">
                <label for="nom_user" >Nom</label>
                <input type="text" class="form-control bg-white" id="nom_user" name="nom_user" value="{{$user->name}}"  readonly required>
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="prenom_user">Prenom</label>
                <input type="text" class="form-control bg-white" id="prenom_user" value="{{$user->lastname}}" readonly required>
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="email_user">Email Professionnel</label>
                <input type="email" class="form-control bg-white" id="email_user" value="{{$user->email}}" readonly name="email_user"  required>
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="role_user">Role</label>
                <select class="form-control" name="role_user" id="role_user">
                  <option value="0">Adminisrateur </option>
                  <option value="1"  selected>Utilisateur</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-end contain_button_submit mt-2" style="padding-left:30px;padding-top:10px;">
                <a href="{{ url()->previous() }}" class="btn addclient_retour  btn-danger rounded font-weight-bold"><span><i class="fas fa-backspace font-weight-bold" style="margin-right:-6px"></i></span> Annuler</a>
                <button type="submit" id="addclient_sumbit_button" class=" btn btn-warning rounded font-weight-bold"><span><i class="far fa-edit font-weight-bold" style="color:#212529"></i></span>Modifier le rôle</button>
            </div>
            <div class="col-md-6">
            </div>
        </div>
      </form>

</div>

@endsection
@section('select2')
<script>

</script>
@endsection
