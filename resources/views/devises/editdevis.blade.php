@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase">Modifier&nbsp;devis</h2>
@endsection
@section('contenu_inside')
<div class="contain_inside">
    <div class="card-body">
        <form action="{{route('devises.update',$devis->id)}}" method="post" id="bigform">
            @csrf
            @method('PUT')
            <div class="client col-md-8">
                <div class="form-group">
                    <label for="clients">Choisir le client</label>
                    <select name="clients" id="clients" class="form-control">
                        @foreach($clientes as $client)
                        <option value="{{$client->id}}" @if($client->id == $clients->id) selected @endif>{{$client->nom_client}}&nbsp;{{$client->prenom_client}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="text-left font-weight-bold">Informations</h4>
            </div>
            <div class="client col-md-8">
                <div class="form-group">
                    <label for="devis">Choisir Le Devis</label>
                    <select name="devis" id="devis" class="form-control">
                        <option value="(DH)" @if($devis->devis == '(DH)') selected @endif>Dirham Marocain(DH)</option>
                        <option value="($)" @if($devis->devis == '($)') selected @endif>Dollar($)</option>
                        <option value="(€)" @if($devis->devis == '(€)') selected @endif>Euro(€)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="tva">Tva Pour Devi (%)</label>
                    <input value="" onchange="change()" type="number" id="tvashow" class="form-control showtva"
                        step="any">
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="text-left font-weight-bold">Articles</h4>
            </div>
            {{-- {{dd($articles)}} --}}
            @foreach ($articles as $article)
            <div class="containe_article col-md-8">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="type">Nom</label>
                            <select name="typed[]" id="type" class="form-control">
                                <option value="Acompte" @if($article->type_article == 'Acompte') selected @endif>Acompte
                                </option>
                                <option value="Jours" @if($article->type_article == 'Jours') selected @endif>Jours
                                </option>
                                <option value="Heures" @if($article->type_article == 'Heures') selected @endif>Heures
                                </option>
                                <option value="Produit" @if($article->type_article == 'Produit') selected @endif>Produit
                                </option>
                                <option value="Service" @if($article->type_article == 'Service') selected @endif>Service
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-1 form-group">
                        <button type="button" class="btn btn-info btn-sm duplicate  form-control"><i
                                class="far fa-clone"></i></button>
                    </div>
                    <div class="col-1 form-group">
                        <button type="button" class="btn btn-danger btn-sm deleteclass form-control"><i
                                class="far fa-trash-alt"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="quantité">Quantité</label>
                            <input type="number" name="quantitéd[]" id="quantité" class="form-control quantité" min="0"
                                step="any" value="{{$article->quantité_article}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="prixht">Prix HT</label>
                            <input type="number" name="prixhtd[]" id="prixht" class="form-control prixht" min="0"
                                step="any" value="{{$article->prix_ht_article}}">
                        </div>
                    </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="reduction">Remise (%)</label>
                    <input type="number" name="reductiond[]" id="reduction" class="form-control reduction" step="any"
                        value="{{$article->reduction_article}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="totalht">Total HT</label>
                    <input type="text" name="totalhtd[]" id="totalht" class="form-control totalht" step="any" readonly
                        value="{{$article->total_ht_article}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="totalttc">Total TTC</label>
                    <input type="text" readonly name="totalttcd[]" id="totalttc" class="form-control totalttc"
                        step="any" value="{{$article->total_ttc_article}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tva" hidden>TVA</label>
                    <input type="number" hidden name="tvad[]" id="tva" class="form-control tva hiddentva" step="any"
                        value="{{$article->tva}}">
                </div>
            </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="descriptiond[]" id="description"
                    class="form-control description">{{$article->description_article}}</textarea>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="contain_total col-md-8">
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="div form-group">
                <input type="number" value="{{$devis->remised}}" name="remise" id="remise" placeholder="remise"
                    class="form-control remise_class">
            </div>
        </div>
    </div>
    <div class="row bg-light form-group rounded-sm">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="row my-1">
                <div class="col-md-6 font-weight-bold">Total HT</div>
                <input type="number" name="total_ht_articlesdf"
                    class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_ht" placeholder="0.00"
                    value="{{$devis->total_ht_articlesdf}}">
                <span class="col-md-3 font-weight-bold spn_devis">DH</span>
            </div>
            <div class="row mb-1">
                <div class="col-md-6 font-weight-bold">Remise générale</div>
                <input type="number" name="total_ht_apres_remise_gendf"
                    class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="remise_general"
                    value="{{$devis->remise_gendf}}" placeholder="0.00">
                <span class="col-md-3 font-weight-bold spn_devis">DH</span>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 font-weight-bold">Total HT final</div>
                <input type="number" name="total_ht_apres_remise_gendf"
                    class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="totalht_final"
                    placeholder="0.00" value="{{$devis->total_ht_apres_remise_gendf}}">
                <span class="col-md-3 font-weight-bold spn_devis">DH</span>
            </div>
            <div class="row mb-1">
                <div class="col-md-6 font-weight-bold">TVA</div>
                <input type="number" name="tvadf" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly
                    id="tva_final" placeholder="0.00" value="{{$devis->tvadf}}">
                <span class="col-md-3 font-weight-bold spn_devis">DH</span>
            </div>
            <div class="row my-1">
                <div class="col-md-6 font-weight-bold">Total</div>
                <input type="number" name="total_facturedf" class="col-md-3 font-weight-bold border-0 bg-transparent"
                    readonly id="total_totald" placeholder="0.00" value="{{$devis->total_facturedf}}">
                <span class="col-md-3 font-weight-bold spn_devis">DH</span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8">
    <h4 class="text-left font-weight-bold">Réglements</h4>
</div>
<div class="contain_reglement col-md-8">
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="conditions_reglement" class="text-muted">Conditions de règlement</label>
            <select name="condition_reglement" id="conditions_reglement" class="form-control">
                <option value="A Réception" @if($devis->condition_regld == 'A Réception') selected @endif>A Réception
                </option>
                <option value="Fin de mois" @if($devis->condition_regld == 'Fin de mois') selected @endif>Fin de mois
                </option>
                <option value="10 Jours" @if($devis->condition_regld == '10 Jours') selected @endif>10 Jours</option>
                <option value="30 Jours" @if($devis->condition_regld == '30 Jours') selected @endif>30 Jours</option>
                <option value="30 Jours Fin De Mois" @if($devis->condition_regld == '30 Jours Fin De Mois') selected
                    @endif>30 Jours Fin De Mois</option>
                <option value="60 Jours Fin De Mois" @if($devis->condition_regld == '60 Jours Fin De Mois') selected
                    @endif>60 Jours Fin De Mois</option>
                <option value="60 Jours" @if($devis->condition_regld == '60 Jours') selected @endif>60 Jours</option>
                <option value="120 Jours Fin De Mois" @if($devis->condition_regld == '120 Jours Fin De Mois') selected
                    @endif>120 Jours Fin De Mois</option>
                <option value="120 Jours" @if($devis->condition_regld == '120 Jours') selected @endif>120 Jours</option>
            </select>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="mode_reglement" class="text-muted">Mode de règlement</label>
            <select name="mode_reglement" id="mode_reglement" class="form-control">
                <option value="Non spécifié" @if($devis->mode_regld == 'Non spécifié') selected @endif>Non spécifié
                </option>
                <option value="Virement bancaire" @if($devis->mode_regld == 'Virement bancaire') selected
                    @endif>Virement bancaire</option>
                <option value="Carte bancaire" @if($devis->mode_regld == 'Carte bancaire') selected @endif>Carte
                    bancaire</option>
                <option value="PayPal" @if($devis->mode_regld == 'PayPal') selected @endif>PayPal</option>
                <option value="Espèces" @if($devis->mode_regld == 'Espèces') selected @endif>Espèces</option>
            </select>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="interet">Intérêt de retard</label>
            <select name="interet" id="interet" class="form-control">
                <option value="none" @if($devis->interet_regld == 'none') selected @endif>Pas d'intérêts de retard
                </option>
                <option value="1% par mois" @if($devis->interet_regld == '1% par mois') selected @endif>1% par mois
                </option>
                <option value="1,5% par mois" @if($devis->interet_regld == '1,5% par mois') selected @endif>1,5% par
                    mois</option>
                <option value="2% par mois" @if($devis->interet_regld == '2% par mois') selected @endif>2% par mois
                </option>
                <option value="Taux d’intérêt légal en vigueur" @if($devis->interet_regld == 'Taux d’intérêt légal en
                    vigueur') selected @endif>Taux d’intérêt légal en vigueur</option>
                <option value="À préciser" @if($devis->interet_regld == 'À préciser') selected @endif>À préciser
                </option>
            </select>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
<div class="col-md-8">
    <h4 class="text-left font-weight-bold">Textes affichés sur le document</h4>
</div>
<div class="contain_textes col-md-8">
    <div class="row">
        <div class="col-md-6 form-group">
            <textarea name="text_intro" cols="30" rows="3" class="form-control"
                placeholder="Texte d'introduction (visible sur la devis)">{{$devis->text_introductiond}}</textarea>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <textarea name="text_concl" cols="30" rows="3" class="form-control"
                placeholder="Texte de conclusion (visible sur la devis)">{{$devis->text_conclusiond}}</textarea>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <textarea name="text_pied" cols="30" rows="3" class="form-control"
                placeholder="Pied de page (visible sur la devis)">{{$devis->pied_paged}}</textarea>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <textarea name="text_pied" cols="30" rows="3" class="form-control"
                placeholder="Conditions de vente (visible sur la devis)">{{$devis->condition_vented}}</textarea>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
<div class="col-md-8">
    <h4 class="text-left font-weight-bold">Mots Clés</h4>
</div>
<div class="contain_clés col-md-8">
    <div class="row">
        <div class="col-md-6">
            <h5>Mots clés:</h5>
            <div class="group_cle ">
                <select name="motcle[]" id="motcle_facture" multiple="multiple" class="clé form-control">
                    @foreach ($cle as $item)
                    <option>{{$item->mot_cle}}</option>
                    @endforeach
                    @foreach ($cles as $cle)
                    <option value="{{$cle->mot_cle}}" selected>{{$cle->mot_cle}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
<div class="row mt-3 col-md-6">
    <div class="col-md-6">
        <input type="submit" value="Modifier le Devis" name="submit"
            class="btn btn-success form-control font-weight-bold text-weight">
    </div>
    <div class="col-md-6">
    </div>
</div>
</form>
</div>
</div>
@endsection
@section('script')
<script src="{{asset('js/devis.js')}}"></script>
<script>
    $('.clé').select2({
        tags: true
    });

    function change() {
        var valueTva = $('.showtva').val();
        $('.hiddentva').val(valueTva);
    }

    var valueTva = $('.hiddentva').val();
    document.getElementById("tvashow").value = valueTva;

</script>
@endsection
