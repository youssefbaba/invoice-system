@extends('home')
@section('header_content')
<h2 id="grand_title_addclient " style="color: white" class="text-uppercase">Modifier {{$clients->nom_client}}&nbsp;{{$clients->prenom_client}}</h2>
@endsection
@section('contenu_inside')
    <h3 id="title_addclient">Modifier un client</h3>
<form action="{{route('clients.update',$clients->id)}}" method="post" id="addclient_form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 part1_addclient">
            <h5>Informations:</h5>
            <div class="group_form">
            <input type="text" name="adresse_email_client" id="adresse_email_client" class="inputs" value="{{$clients->adresse_email_client}}" >
                <label for="adresse_email_client" class="lb">Adresse Email</label>
                @if($errors->has('adresse_email_client'))
                    <p class="text-danger eror" >n'est pas une adresse email valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="nom_client" id="nom_client" class="inputs" value="{{$clients->nom_client}}">
                <label for="nom_client" class="lb">Nom</label>
                @if($errors->has('nom_client'))
                <p class="text-danger eror" >doit être rempli(e)</p>
            @endif
            </div>
            <div class="group_form">
                <input type="text" name="prenom_client" id="prenom_client"  class="inputs" value="{{$clients->prenom_client}}">
                <label for="prenom_client" class="lb">Prénom</label>
                @if($errors->has('prenom_client'))
                    <p class="text-danger eror" >doit être rempli(e)</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="fonction_client" id="fonction"  class="inputs" value="{{$clients->fonction_client}}">
                <label for="fonction" class="lb">Fonction</label>
            </div>
            <div class="group_form">
                <input type="text" name="adresse_client" id="adresse"  class="inputs" value="{{$clients->adresse_client}}">
                <label for="adresse" class="lb">Adresse client</label>
            </div>
            <div class="group_langue mt-4">
                <select name="langue" id="langue" class="mt-3">
                    @foreach ($arrs as $arr)
                        <option value="{{$arr}}"
                            @if ($clients->langue_client === $arr)
                                selected
                            @endif
                            >{{ strtoupper($arr)}}
                        </option>
                    @endforeach
                </select>
                <label for="langue">Langue</label>
            </div>
        </div>
        <div class="col-md-6 part2_addclient">
            <h5>Note:</h5>
            <div class="group_form">
                <textarea name="note_client" id="note_client" cols="30" rows="6" placeholder="Note sur client"
                            class="form-control">{{$clients->note_client}}</textarea>
            </div>
        </div>
        <div class="col-md-6 part3_addclient">
            <h5>Coordonées de client:</h5>
            <div class="group_form">
                <input type="text" name="codepostal_client" id="codepostal"  class="inputs" value="{{$clients->codep_client}}">
                <label for="codepostal" class="lb">Code postal</label>
                @if($errors->has('codepostal_client'))
                    <p class="text-danger eror" >N'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="ville_client" id="ville_client"  class="inputs" value="{{$clients->ville_client}}">
                <label for="ville_client" class="lb">Ville</label>
            </div>
            <div class="group_form">
                <input type="text" name="site_client" id="site_client"  class="inputs" value="{{$clients->site_client}}">
                <label for="site_client" class="lb">Site</label>
                @if($errors->has('site_client'))
                    <p class="text-danger eror" >N'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="tel_client" id="tel_client"  class="inputs" value="{{$clients->tel_client}}">
                <label for="tel_client" class="lb">Teléphone</label>
                @if($errors->has('tel_client'))
                    <p class="text-danger eror" >N'est pas valide</p>
                @endif
            </div>
            <div class="group_form">
                <input type="text" name="societe_client" id="societe_client"  class="inputs" value="{{$clients->societe_client}}">
                <label for="societe_client" class="lb">Nom de sociéte</label>
            </div>
        </div>
        <div class="col-md-6 part4_addclient">
            <h5>Mots clés:</h5>
            <div class="group_cle">
                <select name="motcle_client[]" id="motcle" class="form-control sel1" multiple="multiple">
                    @foreach ($cles as $cle)
                        <option value="{{$cle->mot_cle}}"  selected >{{$cle->mot_cle}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end contain_button_submit">
        <a href="{{ route('clients.index') }}" class="btn editclient_retour " style="background-color: #3E81C8"><span><i class="fas fa-undo" style="background-color: #3E81C8"></i></span> Annuler</a>
        <button type="submit" id="addclient_sumbit_button"><span><i class="fas fa-user-plus" style="background-color: #13438A"></i></span>Modifier le client</button>
    </div>
</form>
@endsection
@section('select2')
    <script>
        $(document).ready(function() {
            $('.sel1').select2({
                tags:true
            });
            $('.inputs').next("label").addClass("floot");
            $('.inputs').css("borderBottom","solid 1px #1B7FF0");
            $('.inputs').next("label").css("color","white");
            var inp = $(this).val();
                if(inp == " ")
                {
                    $('.inputs').next("label").removeClass("floot");
                    $('.inputs').css("borderBottom","solid 1px #000");
                    $('.inputs').next("label").css("color","black");
                }
            $('.inputs').focus(function(){
                $(this).next("label").addClass("floot");
                $(this).css("borderBottom","solid 1px #1B7FF0");
                $(this).next("label").css("color","white");
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
                $(this).next("label").css("color","white");
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
