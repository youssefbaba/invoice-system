@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase">Feedback</h2>
@endsection
@section('contenu_inside')
<div class="container-fluid mt-2">
    <form method="POST" action="{{route('user.envoiemailfeedback') }}" enctype="multipart/form-data" id="bigform2">
        @csrf
        <div class="client col-md-8">
            <div class="form-group">
                <label for="objet">Objet</label>
                <select class="form-control @error('objet') is-invalid @enderror  " name="objet" id="objet">
                <option value="Commentaire">Commentaire</option>
                <option value="Amélioration" selected>Amélioration</option>
                <option value="Bug">Bug</option>
                <option value="Idée">Idée</option>
                </select>
                @error('objeT')
                <div class="invalid-feedback">
                   {{$errors->first('objeT')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">

                <input type="hidden"  name="email_employe" value="{{$user->email}}">

            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">

                <input type="hidden"  name="email_admin" value="{{$admin->email}}">

            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" name="message" value="{{old('message')}}" id="message" rows="10" cols="50" style="overflow:hidden;">
                </textarea>
                @error('message')
                <div class="invalid-feedback">
                   {{$errors->first('message')}}
                </div>
                @enderror
            </div>
        </div>
        <div class="client col-md-8">
            <div class="form-group">
                <label for="file">Fichier Joint</label>
                <input type="file" class="form-control-file @error('file') is-invalid @enderror"  value="{{old('file')}}" name="file" id="file">
                @error('file')
                <div class="invalid-feedback">
                   {{$errors->first('file')}}
                </div>
                @enderror
            </div>
        </div>

        <div class="client col-md-8 ml-0">
            <div class="d-flex contain_button_submit mt-2 ">
                <a href="{{ url()->previous() }}" class="btn addclient_retour btn-danger rounded font-weight-bold"><span><i class="fas fa-backspace font-weight-bold " style="margin-right:-4px"></i></span> Annuler</a>
                    <button type="submit" id="addclient_sumbit_button" class=" btn rounded font-weight-bold text-white" style="background-color:#1976D2"><span><i class="fas fa-paper-plane font-weight-bold "></i></span>Envoyer</button>
            </div>
        </div>

      </form>

</div>

@endsection
@section('select2')
<script>

</script>
@endsection
