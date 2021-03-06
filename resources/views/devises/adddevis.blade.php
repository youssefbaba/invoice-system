@extends('home')
@section('header_content')
    <h2 id="grand_title_addclient" class="text-uppercase">Nouveau Devis</h2>
@endsection
@section('contenu_inside')
<div class="contain_inside">
            <div class="card-body">
                    <form action="{{route('devises.store')}}" method="post" id="bigform2">
                        @csrf
                        <div class="client col-md-8">
                            <div class="form-group">
                                <label for="clients">Choisir le client</label>
                                <select name="clients" id="clients" class="form-control">
                                    @isset($client_determiner)
                                        <option value="{{$client_determiner->id}}">{{$client_determiner->nom_client}}&nbsp;&nbsp;{{$client_determiner->prenom_client}}</option>
                                    @endisset
                                    @empty($client_determiner)
                                        <option value=""></option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}">{{$client->nom_client}}&nbsp;&nbsp;{{$client->prenom_client}}</option>
                                        @endforeach
                                    @endempty
                                </select>
                                @error('clients')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-left font-weight-bold">Informations</h4>
                        </div>
                        <div class="client col-md-8">
                            <div class="form-group">
                                <label for="devis">Choisir Le Devis</label>
                                <select name="devis" id="devis" class="form-control">
                                    <option value="(DH)" selected>Dirham Marocain(DH)</option>
                                    <option value="($)">Dollar($)</option>
                                    <option value="(???)">Euro(???)</option>
                                </select>
                                @error('devis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="tva">Tva Pour Devis (%)</label>
                                <input onchange="change()" type="number" name="tvad[]" class="form-control showtva" step="any" min="0" max="100" >
                                @error('tvad')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                        <select name="typed[]" id="type" class="form-control">
                                            <option value="Acompte">Acompte</option>
                                            <option value="Jours">Jours</option>
                                            <option value="Heures">Heures</option>
                                            <option value="Produit">Produit</option>
                                            <option value="Service" selected>Service</option>
                                        </select>
                                        @error('typed')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
                                        <label for="quantit??">Quantit??</label>
                                        <input type="number" name="quantit??d[]" id="quantit??"
                                            class="form-control quantit??" step="any" min="0" >
                                            @error('quantit??d')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="prixht">Prix HT</label>
                                        <input type="number" name="prixhtd[]" id="prixht" class="form-control prixht"
                                            step="any" min="0"  >
                                            @error('prixhtd')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="reduction">Remise (%)</label>
                                        <input type="number" name="reductiond[]" id="reduction"
                                            class="form-control reduction" step="any" min="0" max="100">
                                            @error('reductiond')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totalht">Total HT</label>
                                        <input type="text" name="totalhtd[]" id="totalht" class="form-control totalht bg-white"
                                             readonly>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totalttc">Total TTC</label>
                                        <input type="text" name="totalttcd[]" id="totalttc"
                                            class="form-control totalttc bg-white"  readonly>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tva" hidden>TVA</label>
                                        <input type="text" name="tvad[]" id="tva" class="form-control tva hiddentva" step="any" min="0" max="100"  hidden >
                                    </div>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="descriptiond[]" id="description"
                                            class="form-control description"></textarea>
                                            @error('descriptiond')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr style="height: 1px; background-color: black">
                        </div>
                        <div class="contain_total col-md-8">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="div form-group">
                                        <input type="number" name="remise" id="remise" placeholder="remise gen (%)" class="form-control remise_class" step="any" min="0" max="100" >
                                        @error('remise')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light form-group rounded-sm">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="row my-1">
                                        <div class="col-md-6 font-weight-bold">Total HT</div>
                                        <input type="number" name="totalht_final_lastd" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_ht" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 font-weight-bold">Remise g??n??rale</div>
                                        <input type="number" name="remise_final_lastd" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="remise_general" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 font-weight-bold">Total HT final</div>
                                        <input type="number" name="total_ht_final_lastd" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="totalht_final" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 font-weight-bold">TVA</div>
                                        <input type="number" name="tva_final_lastd" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="tva_final" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-md-6 font-weight-bold">Total</div>
                                        <input type="number" name="total_total_lastd" class="col-md-3 font-weight-bold border-0 bg-transparent" readonly id="total_totald" placeholder="0.00">
                                        <span class="col-md-3 font-weight-bold spn_devis">DH</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-left font-weight-bold">R??glements</h4>
                        </div>
                        <div class="contain_reglement col-md-8">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="conditions_reglement" class="text-muted">Conditions de r??glement</label>
                                    <select name="condition_reglement" id="conditions_reglement" class="form-control">
                                        <option value="A R??ception" selected>A R??ception</option>
                                        <option value="Fin de mois">Fin de mois</option>
                                        <option value="10 Jours">10 Jours</option>
                                        <option value="30 Jours">30 Jours</option>
                                        <option value="30 Jours Fin De Mois">30 Jours Fin De Mois</option>
                                        <option value="60 Jours Fin De Mois">60 Jours Fin De Mois</option>
                                        <option value="60 Jours">60 Jours</option>
                                        <option value="120 Jours Fin De Mois">120 Jours Fin De Mois</option>
                                        <option value="120 Jours">120 Jours</option>
                                    </select>
                                    @error('condition_reglement')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="mode_reglement" class="text-muted">Mode de r??glement</label>
                                    <select name="mode_reglement" id="mode_reglement" class="form-control">
                                        <option value="Non sp??cifi??">Non sp??cifi??</option>
                                        <option value="Virement bancaire" selected>Virement bancaire</option>
                                        <option value="Carte bancaire">Carte bancaire</option>
                                        <option value="PayPal">PayPal</option>
                                        <option value="Esp??ces">Esp??ces</option>
                                    </select>
                                    @error('mode_reglement')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="interet">Int??r??t de retard</label>
                                    <select name="interet" id="interet" class="form-control">
                                        <option value="Pas d'int??r??ts de retard" selected>Pas d'int??r??ts de retard</option>
                                        <option value="1% par mois">1% par mois</option>
                                        <option value="1,5% par mois">1,5% par mois</option>
                                        <option value="2% par mois">2% par mois</option>
                                        <option value="Taux d???int??r??t l??gal en vigueur">Taux d???int??r??t l??gal en vigueur</option>
                                        <option value="?? pr??ciser">?? pr??ciser</option>
                                    </select>
                                    @error('interet')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-left font-weight-bold">Textes affich??s sur le document</h4>
                        </div>
                        <div class="contain_textes col-md-8">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_introd"  cols="30" rows="3" class="form-control" placeholder="Texte d'introduction (visible sur la facture)">{{old('text_introd')}}</textarea>
                                    @error('text_introd')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_concld" cols="30" rows="3" class="form-control" placeholder="Texte de conclusion (visible sur la facture)">{{old('text_concld')}}</textarea>
                                    @error('text_concld')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_piedd"  cols="30" rows="3" class="form-control" placeholder="Pied de page (visible sur la facture)">{{old('text_piedd')}}</textarea>
                                    @error('text_piedd')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <textarea name="text_cond" cols="30" rows="3" class="form-control" placeholder="Conditions g??n??rales de vente (visible sur le devis)">{{old('text_cond')}} </textarea>
                                    @error('text_cond')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <h4 class="text-left font-weight-bold">Mots Cl??s</h4>
                        </div>
                        <div class="contain_cl??s col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Mots cl??s:</h5>
                                    <div class="group_cle ">
                                        <select name="motcled[]" id="motcle_facture" multiple="multiple" class="cl?? form-control" data-placeholder="Ajouter/S??lectionner des mots cl??s">
                                            @foreach ($cles as $cle)
                                            <option>{{$cle->mot_cle}}</option>
                                            @endforeach
                                        </select>
                                        @error('motcled')
                                         <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end contain_button_submit mt-2" style="padding-left: 30px; padding-top:10px;">
                                <a href="{{ url()->previous() }}" class="btn addclient_retour btn-danger rounded font-weight-bold"><span><i class="fas fa-backspace font-weight-bold " style="margin-right:-4px"></i></span> Annuler</a>
                                 <button type="submit" id="addclient_sumbit_button" class=" btn btn-success rounded font-weight-bold"><span><i  class="fas fa-plus font-weight-bold "></i></span>Cr??er le devis</button>
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
        $('.cl??').select2({
            tags: true
        });
        function change() {
        var valueTva = $('.showtva').val();
        $('.hiddentva').val(valueTva);
       }
    </script>
@endsection
