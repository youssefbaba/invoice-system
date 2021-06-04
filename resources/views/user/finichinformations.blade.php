@extends('home')
@section('header_content')
<h2 id="grand_title_addclient " style="color: white" class="text-uppercase ml-2">
    compléter&nbsp;vos&nbsp;informations</h2>
@endsection
@section('contenu_inside')
<div class="container my-4" >
    <h5 class="my-4 ">Veuillez compléter les informations suivantes : </h5>
    <form method="POST" action="{{route('user.store', ['user_id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="adresse" >Adresse</label>
            <input type="text" name="adresse"  id="adresse" placeholder="Adresse"  class="form-control col-12 mb-4" required>
          </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="societe" >Nom de société</label>
              <input type="text" name="societe" id="societe" placeholder="Nom de société"  class="form-control col-12 mb-4" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="postal" >Code_postal</label>
              <input type="text" name="postal" id="postal" placeholder="Code_postal"  class="form-control col-12 mb-4" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="ville" >Ville</label>
              <input type="text" name="ville" id="ville" placeholder="Ville" class=" form-control col-12 mb-4" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="pays" >Pays</label>
              <select name="pays" id="pays" class="form-control col-12 mb-4" required>
                <option>Selectionner Votre Pays</option>
                <option value="maroc">Morocco</option>
                <option value="france">France</option>
            </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="phone" >Numéro de telephone</label>
              <input type="text" name="phone" id="phone" placeholder="Numéro de telephone" class="form-control col-12 mb-4">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </form>
</div>

@endsection
@section('select2')
<script>

</script>
@endsection
