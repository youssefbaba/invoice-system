@extends('home')
@section('header_content')
<div class="row d-flex justify-content-lg-between justify-content-md-between justify-content-end">
    <h2 id="grand_title_addfacture" class="text-uppercase d-none d-md-block d-lg-block text-white ml-10">Facture
        &nbsp;{{$facture->etat_facture}}</h2>
    <div class="voirplus_display">
        <div>
            <div class="row icons">
                @if ($facture->etat_facture == 'Provisoire')
                @if ($facture->client_id != null)
                    <a href="{{route('facture.change.finalise',$facture->id)}}" class="bg-success text-white"
                        id="finalise_span"><i class="far fa-check-circle"></i>
                        <p id="hover_finalise">Finaliser</p>
                    </a>
                    <a href="{{route('factures.editfacture',['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}" id="finalise_edit" style="background-color: #1976D2"><i class="fas fa-pencil-alt"></i>
                        <p id="hover_editfacture">Modifier</p>
                    </a>
                @else
                    <a href="{{route('factures.editfacture_vide',$facture->id)}}" id="finalise_edit"><i
                        class="fas fa-pencil-alt"></i>
                    <p id="hover_editfacture">Modifier</p>
                    </a>
                @endif
                @else
                @endif



                @if ($facture->etat_facture == 'Payée')
                @if ($facture->client_id
                != null)
                <a href="{{route('facture.anulle_paiement',$facture->id)}}" class="bg-danger text-white"
                    id="finalise_paye"><i class="fas fa-backspace"></i>
                    <p id="hover_paye">Annuler le paiment</p>
                </a>
                @else
                @endif
                @else
                @endif



                @if ($facture->etat_facture == 'Finalisé')
                <a  {{route('facture.change.payé',$facture->id)}}" class="bg-success text-white"
                    id="finalise_commepaye"><i class="fas fa-file-invoice-dollar" style="width: 16px;padding-left: 2px;"></i>
                    <p id="hover_commepaye">Marquer comme payée</p>
                </a>
                @else
                @endif
                @if ($facture->client_id!= null)
                <a href="{{route('facture.generpdff',$facture->id)}}" class="bg-dark text-white"
                    id="finalise_download"><i class="fas fa-download"></i>
                    <p id="hover_download">Télecharger</p>
                </a>
                <a href="{{route('create_email_facture', ['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}" class="bg-dark text-white" id="finalise_email"><i class="far fa-envelope"></i>
                    <p id="hover_email">Envoyer par email</p>
                </a>
                @else
                @endif

                @if ($facture->etat_facture == 'Provisoire')
                <a href="#" data-href="{{route('deletefacture',$facture->id)}}" data-toggle="modal" data-target="#confirm-delete" class="bg-danger text-white" id="finalise_trash" >
                    <i class="far fa-trash-alt"></i>
                    <p id="hover_trash">Supprimer</p></a>
                </a>
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer facture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-white">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer cette facture!!!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white text-secondary" data-dismiss="modal">Annuler</button>
                                <a class="btn btn-danger btn-ok" style="background-color: #bb2124 !important;border-radius: 0.25rem;">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @endif

                <a class="options_voirplus ml-2"><i class="fas fa-ellipsis-v ellipse"></i></a>
            </div>
        </div>
        <div id="absolute_voirplus">
            <ul>
                @if ($facture->etat_facture == 'Provisoire')
                @if ($facture->client_id!= null)
                    <li><a href="{{route('facture.change.finalise',$facture->id)}}">Finaliser</a></li>
                    <li><a href="{{route('factures.editfacture',['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}">Modifier</a></li>
                @else
                    <li><a href="{{route('factures.editfacture_vide',$facture->id)}}">Modifier</a></li>
                @endif
                @else
                @endif


                @if ($facture->etat_facture == 'Finalisé')
                <li><a href="{{route('facture.change.payé',$facture->id)}}">Marquer comme Payée</a></li>
                <hr class="m-0">
                @else
                @endif


                @if ($facture->etat_facture == 'Payée')
                <li><a href="{{route('facture.anulle_paiement',$facture->id)}}">Annuler le paiment</a></li>
                @else
                @endif

                @if ($facture->etat_facture == 'Provisoire')
                <li>
                    <a href="#" data-href="{{route('deletefacture',$facture->id)}}" data-toggle="modal" data-target="#confirm-delete"  >
                        Supprimer
                    </a>
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer facture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer cette facture!!!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white text-secondary" data-dismiss="modal">Annuler</button>
                                    <a class="btn btn-danger btn-ok" style="background-color: #bb2124 !important;border-radius: 0.25rem;">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <hr class="m-0">
                @else
                @endif
                <hr class="m-0">
                @if ($facture->client_id!= null)
                <li><a href="{{route('facture.generpdff',$facture->id)}}">Télecharger</a></li>
                <li><a href="{{route('create_email_facture', ['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}">Envoyer par email</a></li>
                <hr class="m-0">
                @else
                @endif
                @if ($facture->etat_facture == 'Payée')
                <li><a href="{{route('avoirs.addavoirs',['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}">Créer un avoir</a></li>
                <hr class="m-0">
                @else
                @endif

                @if($facture->client_id!= null)
                <li><a href="{{route('factures.duplicatefacture',['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}">Dupliquer la facture</a></li>
                @else
                <li><a href="{{route('factures.duplicatefacture_vide',$facture->id)}}">Duplicquer la facture</a></li>
                @endif
                <li><a href="{{route('devises.duplicateen_devise',$facture->id)}}">Dupliquer en devis</a></li>

            </ul>
        </div>
    </div>
</div>
@endsection
@section('contenu_inside')
<div class="contain_inside row mt-3 container" id="facture" style="padding-left: 34px;">
    <div class="col-md-6 ">
        <h4 class="font-weight-bold">Informations</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Status:</p>
            </div>
            <div class="col-md-8">
                <p>
                    @if($facture->client_id== null)
                    Incompléte
                    @else
                    @if($facture->etat_facture == 'Provisoire')<a href="{{route('factures.provi')}}"  class="link-hover-focus">{{$facture->etat_facture}}</a> @endif
                    @if($facture->etat_facture == 'Finalisé')<a href="{{route('factures.finalise')}}"  class="link-hover-focus">{{$facture->etat_facture}}</a> @endif
                    @if($facture->etat_facture == 'Payée')<a href="{{route('factures.paye')}}"  class="link-hover-focus">{{$facture->etat_facture}}</a> @endif
                    @if($facture->etat_facture == 'APayée')<a href="{{route('factures.apayé')}}"  class="link-hover-focus">{{$facture->etat_facture}}</a> @endif
                    @endif
                </p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Code Facture:</p>
            </div>
            <div class="col-md-8">
                <form action="{{ route('recherche_facture') }}" method="post">
                    @csrf
                        <button type="submit" class="border-0 p-0 rounded code " style="background-color: white;">{{$facture->code_facture}}</button>
                        <input type="hidden" class="form-control"  value="{{$facture->code_facture}}" id="search" name="q" />

                    </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Créée le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->created_at->format('Y-m-d')}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Dernière modification le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->updated_at->format('Y-m-d')}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mot cle :</p>
            </div>
            <div class="col-md-8">

                @foreach ($cles as $cle)
                <div class="mot_cles" style="display: flex;">
                    @foreach ($cle->getCleFacture($facture->id) as $item => $motcle)
                    <form action="{{ route('recherche_facture') }}" method="post">
                     @csrf
                        <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                        <button type="submit" class=" btn p-1 btn-outline-primary rounded ml-2"  >
                        {{$motcle['mot_cle']}}
                        </button>
                    </form>
                    @endforeach
                 </div>
                 @break
              @endforeach

            </div>
        </div>

    </div>
    @if ($facture->etat_facture == 'Provisoire')
    <div class="col-md-6">
        <h4 class="font-weight-bold">Votre facture est prête ?</h4>

        <p>Finalisez votre facture à l'aide du bouton ci-dessus pour pouvoir l'envoyer au client.
            Attention une facture finalisée n'est plus modifiable.</p>
    </div>
    @else
    @endif
    <div class="col-md-6">
        @if ($facture->client_id
        == null)
        <h4 class="font-weight-bold text-danger">Destinataire</h4>
        @else
        <h4 class="font-weight-bold">Destinataire</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Destinataire:</p>
            </div>
            <div class="col-md-8">
                <a href="{{route('voirplus',$facture->client_id)}}" class="link-hover-focus">{{$facture->getClient($facture->client_id)->nom_client}}&nbsp;{{$facture->getClient($facture->client_id)->prenom_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->getClient($facture->client_id)->adresse_client}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Ville:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->getClient($facture->client_id)->ville_client}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Numéro de téléphone:</p>
            </div>
            <div class="col-md-8">
                <a href="tel:{{$facture->getClient($facture->client_id)->tel_client}}}}" class="link-hover-focus">{{$facture->getClient($facture->client_id)->tel_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse email:</p>
            </div>
            <div class="col-md-8">
                <a href="mailto:{{$facture->getClient($facture->client_id)->adresse_email_client}}" class="link-hover-focus">{{$facture->getClient($facture->client_id)->adresse_email_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Site internet:</p>
            </div>
            <div class="col-md-8">
                <a href="{{$facture->getClient($facture->client_id)->site_client}}" class="link-hover-focus">{{$facture->getClient($facture->client_id)->site_client}}</a>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-6">
        <h4 class="font-weight-bold">Conditions</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Conditions de règlement:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->condition_reglf}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mode de règlement:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->mode_reglf}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Intérêt de retard:</p>
            </div>
            <div class="col-md-8">
                <p>{{$facture->interet_reglf}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 my-5">
        <h4 class="font-weight-bold ">Détail</h4>
        <div>
            <table class="table table-borderless table-responsive col-md-12">
                <thead>
                    <tr>
                        <th scope="col" class="text-muted">Type</th>
                        <th scope="col" class="text-muted">Description</th>
                        <th scope="col" class="text-muted">Prix unitaire HT</th>
                        <th scope="col" class="text-muted">Quantité</th>
                        @if ($facture->getArticle($facture->id)->tva != null)
                        <th scope="col" class="text-muted">TVA</th>
                        @else
                        @endif
                        @if ($facture->getArticle($facture->id)->reduction_article != null)
                        <th scope="col" class="text-muted">Réduction</th>
                        @else
                        @endif
                        <th scope="col" class="text-muted">Total HT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td scope="col">{{$article->type_article}}</td>
                        <td scope="col">{{$article->description_article}}</td>
                        <td scope="col">{{$article->prix_ht_article}} <sub>{{$facture->devis}}</sub></td>
                        <td scope="col">{{$article->quantité_article}}</td>
                        @if ($facture->getArticle($facture->id)->tva != null)
                        <td scope="col">{{$article->tva}}%</td>
                        @else
                        @endif
                        @if ($facture->getArticle($facture->id)->reduction_article != null)
                        <td scope="col">{{$article->reduction_article}}%</td>
                        @else
                        @endif
                        <td scope="col">{{$article->total_ht_article}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                    @endforeach
                    @isset($facture->getDebours($facture->id)->montant_ht_debours)
                    @foreach ($debourses as $debours)
                    <tr>
                        <td scope="col">Débours</td>
                        <td scope="col">{{$debours->description_debours}}</td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        @if ($facture->getArticle($facture->id)->tva != null)
                        <td scope="col"></td>
                        @else
                        @endif
                        @if ($facture->getArticle($facture->id)->reduction_article != null)
                        <td scope="col"></td>
                        @else
                        @endif
                        <td scope="col">{{$debours->montant_ht_debours}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                    @endforeach
                    @endisset

                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Total HT</td>
                        <td scope="col">{{$facture->total_ht_articlesf}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                    @if ($facture->getArticle($facture->id)->tva != null)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">TVA</td>
                        <td scope="col">{{$facture->tvaf}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                    @else
                    @endif
                    @isset($facture->getDebours($facture->id)->montant_ht_debours)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Débours</td>
                        <td scope="col">{{$facture->total_debours}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                    @endisset
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Total TTC</td>
                        <td scope="col">{{$facture->total_facturef}}<sub>{{$facture->devis}}</sub></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/voirplus_facture.js') }}"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

</script>
@endsection
