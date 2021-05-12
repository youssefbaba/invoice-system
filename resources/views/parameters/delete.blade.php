@extends('layouts.apppara')
@section('contenu_inside')
    <div class="container-fluid">
            <h3 class="text-dark font-weight-bold mt-2">Compte</h3>
            @if (session('error'))
                <div class="alert alert-danger text-left">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{route('parametre.deleteCompte',$user->id)}}" class="mt-3">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <select name="raison" id="raison" class="form-control" class="inputs">
                                <option value="" class="text-muted font-weight-bold">Selectionner votre raison (Requis)</option>
                                <option value="technical_issues">Je rencontre des problèmes techniques</option>
                                <option value="expactation">Le site ne répond pas à mes attentes</option>
                                <option value="other_account">J'ai un autre compte</option>
                                <option value="other">Autre</option>
                            </select>
                            @if($errors->has('raison'))
                                <p class="text-danger eror" >Selectionner votre raison</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <textarea name="remarque" id="remarque" cols="30" rows="10" placeholder="Remarques" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                        <div class="group_form">
                            <input type="password" name="pass" id="pass" class="inputs">
                            <label for="raison" class="lb">Mot de pass (Requis)</label>
                            @if($errors->has('pass'))
                                <p class="text-danger eror" >Doit être rempli</p>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="submit" value="Supprimer mon compte" class="btn btn-danger btn-lg mt-4 font-weight-bold">
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

