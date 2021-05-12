@extends('layouts.apppara')
@section('contenu_inside')
    <div class="container-fluid">
            <h3 class="text-dark font-weight-bold mt-2">Coordonnées</h3>
            <form method="POST" action="{{route('parametre.update',$user->id)}}" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{asset('uploads/avatars/'.$user->avatar)}}" alt="avatar_image" id="avatar">
                    </div>
                    <div class="col-md-10 mt-5">
                        <label for="avatar_upload" class="mr-2">Changer votre image:</label> <input type="file" name="avatar" id="avatar_upload">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="adresse_email_pro" id="adresse_email_pro" class="inputs" style="width:60%" value="{{$user->email_profes}}">
                            <label for="adresse_email_pro" class="lb">Adresse email professionnelle (apparaît sur les documents)</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="prénom" id="prénom" class="inputs" value="{{$user->name}}">
                            <label for="prénom" class="lb">Prénom</label>
                            @if($errors->has('prénom'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="nom" id="nom" class="inputs" value="{{$user->lastname}}">
                            <label for="nom" class="lb">Nom de famille</label>
                            @if($errors->has('nom'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="adresse" id="adresse" class="inputs" value="{{$user->adresse}}">
                            <label for="adresse" class="lb">Adresse</label>
                            @if($errors->has('adresse'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="code_postal" id="code_postal" class="inputs" value="{{$user->codepostal}}">
                            <label for="code_postal" class="lb">Code postal</label>
                            @if($errors->has('code_postal'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="ville" id="ville" class="inputs" value="{{$user->ville}}">
                            <label for="ville" class="lb">Ville</label>
                            @if($errors->has('ville'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="pays" id="pays" class="inputs" value="{{$user->pays}}" readonly>
                            <label for="pays" class="lb">Pays</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="societe" id="societe" class="inputs" value="{{$user->name_company}}">
                            <label for="societe" class="lb">Société</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="telephone" id="telephone" class="inputs" value="{{$user->tel}}">
                            <label for="telephone" class="lb">Numéro de téléphone</label>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Enregister" class="btn btn-success btn-lg mt-4 font-weight-bold">
            </form>
    </div>
@endsection
@section('script_para')
<script>
    $(document).ready(function () {
            $(".inputs").each(function() {
                if (!$(this).val()) {
                    $(this).next("label").removeClass("floot");
                    $(this).css("borderBottom","solid 1px #000");
                    $(this).next("label").css("color","black");
                }
                else{
                    $(this).next("label").addClass("floot");
                    $(this).css("borderBottom","solid 1px #1B7FF0");
                    $(this).next("label").css("color","blue");
                }
            });
            $('.inputs').focusin(function(){
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
                var inp = $(this).val();
                if(inp == "")
                {
                    $(this).next("label").removeClass("floot");
                    $(this).css("borderBottom","solid 1px #000");
                    $(this).next("label").css("color","black");
                }
                else
                {
                    $(this).next("label").addClass("floot");
                    $(this).css("borderBottom","solid 1px #1B7FF0");
                    $(this).next("label").css("color","blue");
                }
            });
    });
</script>
@endsection

