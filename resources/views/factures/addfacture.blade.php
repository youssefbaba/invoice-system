@extends('home')
@section('header_content')
<h2 id="grand_title_addclient" class="text-uppercase">Nouveau&nbsp;en&nbsp;facture</h2>
@endsection


@section('contenu_inside')
<div class="contain_inside">
            <div class="card-body">
                    <form action="{{route('factures.store')}}" method="post" id="bigform">
                        @csrf
                        <div class="client col-md-8">
                            <div class="form-group">
                                <label for="clients">Choisir le client</label>
                                <select name="clients" id="clients" class="form-control">
                                    @isset($client_determiner)
                                        <option value="{{$client_determiner->id}}">{{$client_determiner->nom_client}}&nbsp;{{$client_determiner->prenom_client}}</option>
                                    @endisset
                                    @empty($client_determiner)
                                        <option value=""></option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}">{{$client->nom_client}}&nbsp;{{$client->prenom_client}}</option>
                                        @endforeach
                                    @endempty
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
                                    <option value="(DH)">Dirham Marocain(DH)</option>
                                    <option value="($)">Dollar($)</option>
                                    <option value="(€)">Euro(€)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="tva">Tva Pour Facture (%)</label>
                                <input onchange="change()" type="number" name="" id="" class="form-control showtva" step="any">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-left font-weight-bold">Articles</h4>
                        </div>
                        <div class="containe_article col-md-8">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="type">Nom</label>
                                        <select name="type[]" id="type" class="form-control">
                                            <option value="Acompte">Acompte</option>
                                            <option value="Jours">Jours</option>
                                            <option value="Heures">Heures</option>
                                            <option value="Produit">Produit</option>
                                            <option value="Service">Service</option>
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
                            <div class="row contain_calc">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantité">Quantité</label>
                                        <input type="number" name="quantité[]" id="quantité"
                                            class="form-control quantité" min="0" step="any">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="prixht">Prix HT</label>
                                        <input type="number" name="prixht[]" id="prixht" class="form-control prixht"
                                            min="0" step="any">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="reduction">Remise (%)</label>
                                        <input type="number" name="reduction[]" id="reduction"
                                            class="form-control reduction" step="any">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totalht">Total HT</label>
                                        <input type="text" name="totalht[]" id="totalht" class="form-control totalht"
                                            step="any" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totalttc">Total TTC</label>
                                        <input type="text" name="totalttc[]" id="totalttc"
                                            class="form-control totalttc" step="any" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tva" class="d-none">TVA</label>
                                        <input type="hidden"  name="tva[]" id="tva" class="form-control tva hiddentva" step="any" >
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="description[]" id="description"
                                            class="form-control description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr style="height: 1px; background-color: black">
                        </div>



                        {{-- start debour  --}}

                        <div class="col-md-8">
                            <h4 class="text-left font-weight-bold">Débours</h4>
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-light btn-md" id="ajout_debours">Ajouter un débours</button>
                        </div>
                        <div class="contain_debours d-none col-md-8" id="contain_debours">
                            <button type="button" class="btn btn-info btn-sm duplicate_debours my-3 form-control">Duplicate</button>
                            <div id="contain_debours2" class="contain_debours_count">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="references[]" placeholder="References de la facture"
                                                class="form-control referdebours" id="references">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="number" name="montant_ht[]" placeholder="Montant HT" id="montant_debours"
                                                class="form-control montant_debours_class">
                                        </div>
                                    </div>
                                    <div class="col-2 form-group">
                                        <button type="button" class="btn btn-danger btn-sm delete_debours form-control" onclick="delete_row(this)" id="delete_debo"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea type="text" name="descriptiond[]" id="descriptiond"
                                                class="form-control description_debours" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- end -debours --}}




                        <div class="contain_total col-md-8">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="div form-group">
                                        <input type="number" name="remise" id="remise" placeholder="remise (%)" class="form-control remise_class" >
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light form-group rounded-sm">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="row my-1">
                                        <div class="col-md-6 font-weight-bold">Total HT</div>
                                        <input type="number" name="totalht_final_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_ht" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 font-weight-bold">Remise générale</div>
                                        <input type="number" name="remise_final_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="remise_general" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 font-weight-bold">Total HT final</div>
                                        <input type="number" name="total_ht_final_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="totalht_final" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 font-weight-bold">TVA</div>
                                        <input type="number" name="tva_final_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="tva_final" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 font-weight-bold">Débours</div>
                                        <input type="number" name="debours_final_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_debours" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-md-6 font-weight-bold">Total</div>
                                        <input type="number" name="total_total_last" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_total" placeholder="0.00">
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
                                        <option value="A Réception">A Réception</option>
                                        <option value="Fin de mois">Fin de mois</option>
                                        <option value="10 Jours">10 Jours</option>
                                        <option value="30 Jours">30 Jours</option>
                                        <option value="30 Jours Fin De Mois">30 Jours Fin De Mois</option>
                                        <option value="60 Jours Fin De Mois">60 Jours Fin De Mois</option>
                                        <option value="60 Jours">60 Jours</option>
                                        <option value="120 Jours Fin De Mois">120 Jours Fin De Mois</option>
                                        <option value="120 Jours">120 Jours</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="mode_reglement" class="text-muted">Mode de règlement</label>
                                    <select name="mode_reglement" id="mode_reglement" class="form-control">
                                        <option value="Non spécifié">Non spécifié</option>
                                        <option value="Virement bancaire">Virement bancaire</option>
                                        <option value="Carte bancaire">Carte bancaire</option>
                                        <option value="PayPal">PayPal</option>
                                        <option value="Espèces">Espèces</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="interet">Intérêt de retard</label>
                                    <select name="interet" id="interet" class="form-control">
                                        <option value="Pas d'intérêts de retard">Pas d'intérêts de retard</option>
                                        <option value="1% par mois">1% par mois</option>
                                        <option value="1,5% par mois">1,5% par mois</option>
                                        <option value="2% par mois">2% par mois</option>
                                        <option value="Taux d’intérêt légal en vigueur">Taux d’intérêt légal en vigueur</option>
                                        <option value="À préciser">À préciser</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="compte_bancaire">Compte bancaire</label>
                                    <input  type="text" name="compte_bancaire" id="compte_bancaire" placeholder="Compte bancaire" class="form-control">
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
                                    <textarea name="text_intro"  cols="30" rows="3" class="form-control" placeholder="Texte d'introduction (visible sur la facture)"></textarea>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_concl"  cols="30" rows="3" class="form-control" placeholder="Texte de conclusion (visible sur la facture)"></textarea>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_pied"  cols="30" rows="3" class="form-control" placeholder="Pied de page (visible sur la facture)"></textarea>
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
                                        <select name="motcle[]" id="motcle_facture" multiple="multiple" class="clé form-control" data-placeholder="Ajouter/Sélectionner des mots clés">
                                            @foreach ($cles as $cle)
                                            <option>{{$cle->mot_cle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('motcle'))
                                        <p class="text-danger eror" >doit être rempli(e)</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 col-md-6">
                            <div class="col-md-6">
                                <input type="submit" value="Créer la facture" name="submit"
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
    <script src="{{asset('js/facture1.js')}}"></script>

    <script>
        $('.clé').select2({
            tags: true
        });

       function change() {
        var valueTva = $('.showtva').val();
        $('.hiddentva').val(valueTva);
       }
    </script>
@endsection
