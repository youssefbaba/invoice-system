@extends('layouts.apppara')
@section('contenu_inside')
    <div class="container-fluid">
            <h3 class="text-dark font-weight-bold mt-2">Compte</h3>
            @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <form method="POST" action="{{route('parametre.updateCompte',$user->id)}}" class="mt-3">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="text" name="adresse_email" id="adresse_email" class="inputs" style="width:60%" value="{{$user->email}}">
                            <label for="adresse_email" class="lb">Adresse email</label>
                            @if($errors->has('adresse_email'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="hidden" name="change_mot_de_passe" value="1" >
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="password" name="pass_actuel" id="pass_actuel" class="inputs">
                            <label for="pass_actuel" class="lb">Mot de pass actuel</label>
                            @if($errors->has('pass_actuel'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="password" name="passnew" id="pass_new" class="inputs" >
                            <label for="pass_new" class="lb">Nouveau mot de pass</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="password" name="passnew_confirmation" id="pass_new_confirmation" class="inputs">
                            <label for="pass_new_confirmation" class="lb">Confirmez votre nouveau mot de passt</label>
                            @if($errors->has('passnew'))
                                <p class="text-danger eror">Le mot de pass non identique</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end contain_button_submit mt-2" style="padding-left:30px;padding-top:10px;">
                        <a href="{{ url()->previous() }}" class="btn addclient_retour  btn-danger rounded font-weight-bold mr-2 btn-sm" style="margin-left: -14px"><span><i class="fas fa-backspace font-weight-bold" style="margin-right:-2px"></i></span> Annuler</a>
                        <button type="submit" id="addclient_sumbit_button" class=" btn btn-warning rounded font-weight-bold ml-2 btn-sm"><span><i class="far fa-edit font-weight-bold" style="color:#212529"></i></span>Mettre à jour</button>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </form>
    </div>
@endsection
@section('script_para')
<script>
    $(document).ready(function () {
        function load() {
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
        };
        load();

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

