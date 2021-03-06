@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase">Nouveau&nbsp;&nbsp;employé</h2>
@endsection
@section('contenu_inside')
<div class="container-fluid mt-2" >
    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" id="bigform2">
            @csrf
        <div class="client col-md-8">
            <div class="form-group">
                <label for="clients">Nom</label>
                <input id="name" type="text" class=" form-control @error('name') @enderror col-12 mb-4 " name="name" placeholder="Nom"  autocomplete="name" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="prenom_user" >Prenom</label>
                <input id="lastname" type="text" class=" form-control @error('lastname') @enderror col-12 mb-4 " name="lastname" placeholder="prenom" autocomplete="lastname" required>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="email_user" >Email Professionnel</label>
                <input id="email" type="email" class="form-control  @error('email') @enderror col-12 mb-4 " name="email" placeholder="email "  required autocomplete="email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="role_user" >Mot de passt</label>
              <input id="password" type="password" class="form-control @error('password')@enderror col-12 mb-4 " name="password" placeholder="Mot de pass" value="{{Str::random(3).''.rand( 10000, 99999 )}}"  autocomplete="new-password" required>
            </div>
        </div>
        <div class="d-flex justify-content-start contain_button_submit" style="margin-left: 14px">
            <a href="{{ url()->previous() }}" class="btn addclient_retour btn-danger rounded font-weight-bold "><span><i class="fas fa-backspace font-weight-bold" style="margin-right:-4px"></i></span> Annuler</a>
            <button type="submit" id="addclient_sumbit_button" class=" btn btn-success rounded font-weight-bold "><span><i  class="fas fa-user-plus font-weight-bold"></i></span>Créer un employé</button>
        </div>


    </form>
</div>

@endsection
@section('select2')
<script>

</script>
@endsection


