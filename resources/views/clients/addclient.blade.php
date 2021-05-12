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
                @if($errors->has('adresse_email_client'))
                    <p class="text-danger eror" >n'est pas une adresse email valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="nom_client" id="nom_client" class="inputs">
                <label for="nom_client" class="lb">Nom</label>
                @if($errors->has('nom_client'))
                    <p class="text-danger eror" >doit être rempli(e)</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="prenom_client" id="prenom_client"  class="inputs">
                <label for="prenom_client" class="lb">Prénom</label>
                @if($errors->has('prenom_client'))
                    <p class="text-danger eror" >doit être rempli(e)</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="fonction_client" id="fonction"  class="inputs">
                <label for="fonction" class="lb">Fonction</label>
            </div>
            <div class="group_form">
                <input type="text" name="adresse_client" id="adresse"  class="inputs">
                <label for="adresse" class="lb">Adresse client</label>
            </div>
            <div class="group_langue mt-4">
                <select name="langue" id="langue" class="mt-3">
                    <option value="Francais">Francais</option>
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
            </div>
        </div>
        <div class="col-md-6 part3_addclient">
            <h5>Coordonées de client:</h5>
            <div class="group_form">
                <input type="text" name="codepostal_client" id="codepostal"  class="inputs">
                <label for="codepostal" class="lb">Code postal</label>
                @if($errors->has('codepostal_client'))
                    <p class="text-danger eror" >n'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="ville_client" id="ville_client"  class="inputs">
                <label for="ville_client" class="lb">Ville</label>
            </div>
            <div class="group_form">
                <input type="text" name="site_client" id="site_client"  class="inputs">
                <label for="site_client" class="lb">Site</label>
                @if($errors->has('site_client'))
                    <p class="text-danger eror" >n'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="tel_client" id="tel_client"  class="inputs">
                <label for="tel_client" class="lb">Teléphone</label>
                @if($errors->has('tel_client'))
                    <p class="text-danger eror" >n'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="societe_client" id="societe_client"  class="inputs">
                <label for="societe_client" class="lb">Nom de sociéte</label>
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
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end contain_button_submit">
        <a href="{{ route('clients.index') }}" class="btn addclient_retour "><span><i class="fas fa-undo" style="background-color: #3E81C8"></i></span> Annuler</a>
        <button type="submit" id="addclient_sumbit_button"><span><i  class="fas fa-user-plus"  style="background-color: #13438A"></i></span>Ajouter un client</button>
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
