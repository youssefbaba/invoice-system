@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase"><a style="color: white" href="{{route('devises.voirplus', ['id'=>$devi->id]) }}">Devis&nbsp;{{$devi->code_devis}}</a>&nbsp;envoi par email</h2>
@endsection
@section('contenu_inside')
<div class="container-fluid mt-2">
    <form method="POST" action="{{ route('envoi_email_devi') }}" enctype="multipart/form-data" id="bigform2">
        @csrf
        <div class="client col-md-8">
            <div class="form-group">
                <label for="email_client">À</label>
                <select class="form-control @error('email_client') is-invalid @enderror  " name="email_client" id="email_client">
                <option selected value="{{$client->adresse_email_client}}">{{$client->adresse_email_client}}</option>
                @foreach ($clientes  as $cliente)
                <option value="{{$cliente->adresse_email_client}}">{{$cliente->adresse_email_client}}</option>
                @endforeach
                </select>
                @error('email_client')
                <div class="invalid-feedback">
                   {{$errors->first('email_client')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="objet_email">Objet</label>
                <input type="text" class="form-control @error('objet_email') is-invalid @enderror bg-white" id="objet_email" name="objet_email" value="Votre&nbsp;Devis&nbsp;{{$devi->code_devis}}" required>
                @error('objet_email')
                <div class="invalid-feedback">
                   {{$errors->first('objet_email')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">

                <input type="hidden"  name="devi_id" value="{{$devi->id}}">

            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="message_email">Message</label>
                <textarea class="form-control @error('message_email') is-invalid @enderror" name="message_email" id="message_email" rows="10" cols="50" style="overflow:hidden;padding-left: 0px">

                Bonjour&nbsp;{{$client->nom_client}}&nbsp;{{$client->prenom_client}},

                Je vous prie de trouver ci joint votre devis {{$devi->code_devis}} en date {{$devi->created_at->format('Y-m-d')}}.
                Vous en souhaitant bonne réception.

                Cordialement,
                {{$user->name}}&nbsp;{{$user->lastname}}

                </textarea>
                @error('message_email')
                <div class="invalid-feedback">
                   {{$errors->first('message_email')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8 ml-0">
            <div class="form-group">
                <div class="d-flex contain_button_submit mt-2">
                    <a href="{{ route('devises.index') }}" class="btn addclient_retour btn-danger rounded font-weight-bold"><span><i class="fas fa-backspace font-weight-bold " style="margin-right:-4px"></i></span> Annuler</a>
                     <button type="submit" id="addclient_sumbit_button" class=" btn rounded font-weight-bold text-white" style="background-color:#1976D2"><span><i class="fas fa-paper-plane font-weight-bold "></i></span>Envoyer</button>
                </div>
            </div>
        </div>

      </form>

</div>

@endsection
@section('select2')
<script>

</script>
@endsection
