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
