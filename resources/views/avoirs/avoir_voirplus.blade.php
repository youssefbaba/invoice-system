@extends('home')
@section('header_content')
<div class="row d-flex justify-content-lg-between justify-content-md-between justify-content-end">
    <h2 id="grand_title_addfacture" class="text-uppercase d-none d-md-block d-lg-block text-white">Avoir
        &nbsp;{{$avoir->etat_facture}}</h2>
    <div class="voirplus_display">
        <div>
            <div class="row icons">
                @if ($avoir->etat_facture == 'Provisoire')
                @if ($avoir->client_id != null)
                    <a href="{{route('avoir.change.finalise',$avoir->id)}}" class="bg-success text-white"
                        id="finalise_span"><i class="far fa-check-circle"></i>
                        <p id="hover_finalise">Finaliser</p>
                    </a>
                    <a href="{{route('avoirs.editavoir',['avoir_id'=>$avoir->id,'client_id'=>$avoir->client_id])}}" id="finalise_edit"><i class="fas fa-pencil-alt"></i>
                        <p id="hover_editfacture">Modifier</p>
                    </a>
                @else
                    {{-- <a href="{{route('factures.editfacture_vide',$facture->id)}}" id="finalise_edit"><i
                        class="fas fa-pencil-alt"></i>
                    <p id="hover_editfacture">Modifier</p>
                    </a> --}}
                    <a href="#" id="finalise_edit"><i
                        class="fas fa-pencil-alt"></i>
                    <p id="hover_editfacture">Modifier</p>
                    </a>
                @endif
                @else
                @endif
                @if ($avoir->etat_facture == 'Remboursé')
                @if ($avoir->client_id!= null)
                <a href="{{route('avoir.anulle_remboursement',$avoir->id)}}" class="bg-warning text-white"
                    id="finalise_paye"><i class="fas fa-not-equal"></i>
                    <p id="hover_paye">Annuler le remboursement</p>
                </a>
                @else
                @endif
                @else
                @endif
                @if ($avoir->etat_facture == 'Finalisé')
                <a href="{{route('avoir.change.remboursé',$avoir->id)}}" class="bg-success text-white"
                    id="finalise_commepaye"><i class="fas fa-euro-sign"></i>
                <p id="hover_commepaye">Marquer comme remboursé</p>
                </a>
                @else
                @endif
                @if ($avoir->client_id!= null)
                <a href="mailto:{{$avoir->getClient($avoir->client_id)->adresse_email_client}}" class="bg-dark text-white" id="finalise_email"><i class="far fa-envelope"></i>
                    <p id="hover_email">Envoyer par email</p>
                </a>
                <a href="{{route('avoir.genererpdfa',$avoir->id)}}" class="bg-dark text-white"
                    id="finalise_download"><i class="fas fa-download"></i>
                    <p id="hover_download">Télecharger</p>
                </a>
                @else
                @endif

                @if ($avoir->etat_facture == 'Provisoire')
                <a href="#" data-href="{{route('deleteavoir',$avoir->id)}}" data-toggle="modal" data-target="#confirm-delete" class="bg-danger text-white" id="finalise_trash" >
                    <i class="far fa-trash-alt"></i>
                    <p id="hover_trash">Supprimer</p>
                </a>
                <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer avoir</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer cette avoir!!!
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary btn-lg" data-dismiss="modal">Annuler</a>
                                <a class="btn btn-danger btn-ok btn-lg" style="background-color: #bb2124 !important;border-radius: 0.25rem;;">
                                Supprimer
                                </a>


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
                @if ($avoir->etat_facture == 'Provisoire')
                @if ($avoir->client_id!= null)
                    <li><a href="{{route('avoir.change.finalise',$avoir->id)}}">Finaliser</a></li>
                    <li><a href="{{route('avoirs.editavoir',['avoir_id'=>$avoir->id,'client_id'=>$avoir->client_id])}}">Modifier</a></li>
                @else
                    {{-- <li><a href="{{route('factures.editfacture_vide',$facture->id)}}">Modifier</a></li> --}}
                    <li><a href="#">Modifier</a></li>

                @endif
                @else
                @endif
                @if ($avoir->etat_facture == 'Finalisé')
                <li><a href="{{route('avoir.change.remboursé',$avoir->id)}}">Marquer comme  remboursé</a></li>
                <hr class="m-0">
                @else
                @endif
                @if ($avoir->etat_facture == 'Remboursé')
                <li><a href="{{route('avoir.anulle_remboursement',$avoir->id)}}">Annuler le remboursement</a></li>
                <hr class="m-0">

                @else
                @endif
                @if ($avoir->etat_facture == 'Provisoire')
                <li>
                    <a href="#" data-href="{{route('deleteavoir',$avoir->id)}}" data-toggle="modal" data-target="#confirm-delete"   >

                        Supprimer
                    </a>
                    <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer avoir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer cette avoir!!!
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary btn-lg" data-dismiss="modal">Annuler</a>
                                    <a class="btn btn-danger btn-ok btn-lg" style="background-color: #bb2124 !important;border-radius: 0.25rem;;">
                                    Supprimer
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>

                </li>
                <hr class="m-0">
                @else
                @endif
                <hr class="m-0">
                @if ($avoir->client_id!= null)
                <li><a href="{{route('avoir.genererpdfa',$avoir->id)}}">Télecharger</a></li>
                <li><a href="mailto:{{$avoir->getClient($avoir->client_id)->adresse_email_client}}">Envoyer par email</a></li>
                <hr class="m-0">
                @else
                @endif
                <li><a href="{{route('avoirs.duplicateen_devise',$avoir->id)}}">Dupliquer en devis</a></li>
                @if($avoir->client_id!= null)
                <li><a  href="{{route('avoirs.duplicateen_facture',['avoir_id'=>$avoir->id,'client_id'=>$avoir->client_id])}}">Dupliquer en  facture</a></li>
                @else
                {{-- <li><a href="{{route('factures.duplicatefacture_vide',$facture->id)}}">Duplicquer la facture</a></li> --}}
                <li><a href="#">Duplicquer en facture</a></li>

                @endif


            </ul>
        </div>
    </div>
</div>
@endsection
@section('contenu_inside')
<div class="contain_inside row mt-3 container" id="facture">
    <div class="col-md-6 ">
        <h4 class="font-weight-bold">Informations</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Status:</p>
            </div>
            <div class="col-md-8">
                <p>
                    @if($avoir->client_id== null)
                    Incompléte
                    @else
                    @if($avoir->etat_facture == 'Provisoire')<a href="#"  class="link-hover-focus">{{$avoir->etat_facture}}</a> @endif
                    @if($avoir->etat_facture == 'Finalisé')<a href="#"  class="link-hover-focus">{{$avoir->etat_facture}}</a> @endif
                    @if($avoir->etat_facture == 'Remboursé')<a href="#"  class="link-hover-focus">{{$avoir->etat_facture}}</a> @endif
                    @endif
                </p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Code Avoir:</p>
            </div>
            <div class="col-md-8">
                <p><a href="#" class="link-hover-focus">{{$avoir->code_avoir}}</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Créée le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->created_at->format('Y-m-d')}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Dernière modification le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->updated_at->format('Y-m-d')}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mot cle :</p>
            </div>
            <div class="col-md-8">

                @foreach ($cles as $cle)
                <div class="mot_cles" style="display: flex;">
                    @foreach ($cle->getCleAvoir($avoir->id) as $item => $motcle)
                    <form action="{{ route('recherche_avoir') }}" method="post">
                     @csrf
                        <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                        <button type="submit" class=" btn p-1 border-2 mot_cles_link text-white rounded ml-2"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
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
    @if ($avoir->etat_facture == 'Provisoire')
    <div class="col-md-6">
        <h4 class="font-weight-bold">Votre avoir est prête ?</h4>

        <p>Finalisez votre avoir à l'aide du bouton ci-dessus pour pouvoir l'envoyer au client.
            Attention un  avoir finalisée n'est plus modifiable.</p>
        <h4 class="font-weight-bold">Documents liée</h4>
        <h6 class="text-center text-muted ">aucun document lié</h6>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    @else
    @endif
    @if ($avoir->etat_facture == 'Finalisé')
    <div class="col-md-6">
        <h4 class="font-weight-bold">Documents liée</h4>
        <h6 class="text-center text-muted ">aucun document lié</h6>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    @else
    @endif
    @if ($avoir->etat_facture == 'Payée')
    <div class="col-md-6">
        <h4 class="font-weight-bold">Documents liée</h4>
        <h6 class="text-center text-muted ">aucun document lié</h6>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    @else
    @endif

    <div class="col-md-6">
        @if ($avoir->client_id== null)
        <h4 class="font-weight-bold text-danger">Destinataire</h4>
        @else
        <h4 class="font-weight-bold">Destinataire</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Destinataire:</p>
            </div>
            <div class="col-md-8">
                <a href="{{route('voirplus',$avoir->client_id)}}" class="link-hover-focus">{{$avoir->getClient($avoir->client_id)->nom_client}}&nbsp;{{$avoir->getClient($avoir->client_id)->prenom_client}}</a>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Société:</p>
            </div>
            <div class="col-md-8">
                <p style="color: red">{{$avoir->getClient($avoir->client_id)->societe_client}} had partie khass ya ima t7ayad ola n9adha ila dart partie dyal societe</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->getClient($avoir->client_id)->adresse_client}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Ville:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->getClient($avoir->client_id)->ville_client}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Numéro de téléphone:</p>
            </div>
            <div class="col-md-8">
                {{-- <a href="tel:{{$facture->getClient($facture->client_id)->tel_client}}}}" class="link-hover-focus">{{$facture->getClient($facture->client_id)->tel_client}}</a> --}}
                <a href="tel:{{$avoir->getClient($avoir->client_id)->tel_client}}}}" class="link-hover-focus">{{$avoir->getClient($avoir->client_id)->tel_client}}</a>

            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse email:</p>
            </div>
            <div class="col-md-8">
                <a href="mailto:{{$avoir->getClient($avoir->client_id)->adresse_email_client}}" class="link-hover-focus">{{$avoir->getClient($avoir->client_id)->adresse_email_client}}</a>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Site internet:</p>
            </div>
            <div class="col-md-8">
                <a href="{{$avoir->getClient($avoir->client_id)->site_client}}" class="link-hover-focus">{{$avoir->getClient($avoir->client_id)->site_client}}</a>
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
                <p>{{$avoir->condition_reglf}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mode de règlement:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->mode_reglf}}</p>
            </div>
        </div>
        <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Intérêt de retard:</p>
            </div>
            <div class="col-md-8">
                <p>{{$avoir->interet_reglf}}</p>
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
                        @if ($avoir->getArticle($avoir->id)->tva != null)
                        <th scope="col" class="text-muted">TVA</th>
                        @else
                        @endif
                        @if ($avoir->getArticle($avoir->id)->reduction_article != null)
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
                        <td scope="col">{{$article->prix_ht_article}} <sub>{{$avoir->devis}}</sub></td>
                        <td scope="col">{{$article->quantité_article}}</td>
                        @if ($avoir->getArticle($avoir->id)->tva != null)
                        <td scope="col">{{$article->tva}}%</td>
                        @else
                        @endif
                        @if ($avoir->getArticle($avoir->id)->reduction_article != null)
                        <td scope="col">{{$article->reduction_article}}%</td>
                        @else
                        @endif
                        <td scope="col">{{$article->total_ht_article}}<sub>{{$avoir->devis}}</sub></td>
                    </tr>
                    @endforeach
                    @isset($avoir->getDebours($avoir->id)->montant_ht_debours)
                    @foreach ($debourses as $debours)
                    <tr>
                        <td scope="col">Débours</td>
                        <td scope="col">{{$debours->description_debours}}</td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        @if ($avoir->getArticle($avoir->id)->tva != null)
                        <td scope="col"></td>
                        @else
                        @endif
                        @if ($avoir->getArticle($avoir->id)->reduction_article != null)
                        <td scope="col"></td>
                        @else
                        @endif
                        <td scope="col">{{$debours->montant_ht_debours}}<sub>{{$avoir->devis}}</sub></td>
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
                        <td scope="col">{{$avoir->total_ht_articlesf}}<sub>{{$avoir->devis}}</sub></td>
                    </tr>
                    @if ($avoir->getArticle($avoir->id)->tva != null)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">TVA</td>
                        <td scope="col">{{$avoir->tvaf}}<sub>{{$avoir->devis}}</sub></td>
                    </tr>
                    @else
                    @endif
                    @isset($avoir->getDebours($avoir->id)->montant_ht_debours)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Débours</td>
                        <td scope="col">{{$avoir->total_debours}}<sub>{{$avoir->devis}}</sub></td>
                    </tr>
                    @endisset
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Total TTC</td>
                        <td scope="col">{{$avoir->total_facturef}}<sub>{{$avoir->devis}}</sub></td>
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
