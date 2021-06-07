@extends('home')
@section('header_content')
    <h2 id="grand_title_addclient" class="text-uppercase">Nouveau client</h2>
@endsection
@section('contenu_inside')
    <h3 id="title_addclient">Ajouter un client</h3>
<form action="{{route('clients.store')}}" method="post" id="addclient_form">
    @csrf
    <div class="row">
        <div class="col-md-6 part1_addclient">
            <h5>Informations:</h5>
            <div class="group_form">
                <input type="text" name="adresse_email_client" id="adresse_email_client" class="inputs">
                <label for="adresse_email_client" class="lb">Adresse Email</label>
                @error('adresse_email_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- @if($errors->has('adresse_email_client'))
                    <p class="text-danger eror" >n'est pas une adresse email valide</p>
                @endif --}}
            </div>
            <div class="group_form">
                <input type="text" name="nom_client" id="nom_client" class="inputs">
                <label for="nom_client" class="lb">Nom</label>
                @error('nom_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_form">
                <input type="text" name="prenom_client" id="prenom_client"  class="inputs">
                <label for="prenom_client" class="lb">Prénom</label>
                @error('prenom_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_form">
                <input type="text" name="fonction_client" id="fonction"  class="inputs">
                <label for="fonction" class="lb">Fonction</label>
                @error('fonction_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="group_form">
                <input type="text" name="adresse_client" id="adresse"  class="inputs">
                <label for="adresse" class="lb">Adresse client</label>
                @error('adresse_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_langue mt-4">
                <select name="langue" id="langue" class="mt-3">
                    <option value="Francais" selected>Francais</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Angalis">Angalis</option>
                </select>
                <label for="langue">Langue</label>
            </div>
        </div>
        <div class="col-md-6 part2_addclient">
            <h5>Note:</h5>
            <div class="group_form">
                <textarea name="note_client" id="note_client" cols="30" rows="6" placeholder="Note sur client"
                            class="form-control"></textarea>
                @error('note_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
        </div>
        <div class="col-md-6 part3_addclient">
            <h5>Coordonées de client:</h5>
            <div class="group_form">
                <input type="text" name="codepostal_client" id="codepostal"  class="inputs">
                <label for="codepostal" class="lb">Code postal</label>
                @error('codepostal_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_form">
                <input type="text" name="ville_client" id="ville_client"  class="inputs">
                <label for="ville_client" class="lb">Ville</label>
                @error('ville_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_form">
                <input type="text" name="site_client" id="site_client"  class="inputs">
                <label for="site_client" class="lb">Site</label>
                @error('site_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="group_form">
                <input type="text" name="tel_client" id="tel_client"  class="inputs">
                <label for="tel_client" class="lb">Teléphone</label>
                @error('tel_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 part4_addclient">
            <h5>Mots clés:</h5>
            <div class="group_cle">
                <select name="motcle_client[]" id="motcle_client" multiple="multiple" class="clé" data-placeholder="Ajouter/Sélectionner un mot clé" >
                     @foreach ($cles as $cle)
                     <option>{{$cle->mot_cle}}</option>
                     @endforeach
                </select>
                @error('motcle_client')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end contain_button_submit">
        <a href="{{ url()->previous() }}" class="btn addclient_retour btn-danger rounded font-weight-bold "><span><i class="fas fa-backspace font-weight-bold" style="margin-right:-4px"></i></span> Annuler</a>
        <button type="submit" id="addclient_sumbit_button" class=" btn btn-success rounded font-weight-bold "><span><i  class="fas fa-user-plus font-weight-bold"></i></span>Créer le client</button>
    </div>


</form>
@endsection
@section('select2')
<script>
    $(document).ready(function () {

        $('.clé').select2({
            tags: true
        });

            $('.inputs').focus(function(){
                $(this).next("label").addClass("floot");
                $(this).css("borderBottom","solid 1px #1B7FF0");
                $(this).next("label").css("color","blue");
            });
            $('.inputs').focusout(function(){
                var inp = $(this).val();
                if(inp == "")
                {
                    $(this).next("label").removeClass("floot");
                    $(this).css("borderBottom","solid 1px #000");
                    $(this).next("label").css("color","black");
                }
            });
            $('.inputs').keyup(function(){
                $(this).next("label").addClass("floot");
                $(this).css("borderBottom","solid 1px #1B7FF0");
                $(this).next("label").css("color","black");
                var inp = $(this).val();
                if(inp == "")
                {
                    $(this).next("label").removeClass("floot");
                    $(this).css("borderBottom","solid 1px #000");
                    $(this).next("label").css("color","black");
                }
            });



    });
</script>
@endsection
