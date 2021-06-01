@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase"><a style="color: white" href="{{route('factures.voirplus', ['id'=>$facture->id]) }}">Facture&nbsp;{{$facture->code_facture}}</a>&nbsp;envoi par email</h2>
@endsection
@section('contenu_inside')
<div class="container-fluid mt-2">
    <form method="POST" action="{{ route('envoi_email_facture')}}" enctype="multipart/form-data" id="bigform2">
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
                <input type="text" class="form-control @error('objet_email') is-invalid @enderror bg-white" id="objet_email" name="objet_email" value="Votre&nbsp;Facture&nbsp;{{$facture->code_facture}}" required>
                @error('objet_email')
                <div class="invalid-feedback">
                   {{$errors->first('objet_email')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">

                <input type="hidden"  name="facture_id" value="{{$facture->id}}">

            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="message_email">Message</label>
                <textarea class="form-control @error('message_email') is-invalid @enderror" name="message_email" id="message_email" rows="10" cols="50" style="overflow:hidden;padding-left: 0px">

                Bonjour&nbsp;{{$client->nom_client}}&nbsp;{{$client->prenom_client}},

                Je vous prie de trouver ci joint votre facture {{$facture->code_facture}} en date {{$facture->created_at->format('Y-m-d')}}.
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
        <div class="client col-md-8">
            <div class="form-group">
                {{-- <a type="button" class="btn btn-danger" href="{{route('f}}" >Annuler</a> --}}
                <button class="btn btn-success" type="submit">Envoyer</button>
            </div>
        </div>

      </form>

</div>

@endsection
@section('select2')
<script>

</script>
@endsection
