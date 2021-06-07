@extends('home')
@section('header_content')
<div class="row d-flex justify-content-lg-between justify-content-md-between justify-content-end">
    <h2 id="grand_title_addfacture" class="text-uppercase d-none d-md-block d-lg-block text-white ml-10">Devis
        &nbsp;{{$devise->etat_devis}}</h2>
    <div class="voirplus_display">
        <div>
            <div class="row icons">
                @if ($devise->etat_devis == 'Provisoire')
                @if ($devise->client_id != null)
                <a href="{{route('devises.finalise',$devise->id)}}" class="bg-success text-white" id="finalise_span"><i
                        class="far fa-check-circle"></i>
                    <p id="hover_finalise">Finaliser</p>
                </a>
                @endif
                @endif

                @if ($devise->etat_devis == 'Finalisé')
                @if ($devise->client_id != null)
                <a href="{{route('devises.signe',$devise->id)}}" class="bg-info text-white" id="finalise_paye"><i class="fas fa-file-signature" style="padding:0px -2px "></i>
                    <p id="hover_paye">Marquer comme signé</p>
                </a>

                <a href="{{route('devises.refuse',$devise->id)}}" class="text-white" style="background-color:coral"
                    id="finalise_span"><i class="far fa-times-circle"></i>
                    <p id="hover_finalise">Marquer comme refusé</p>
                </a>
                @endif
                @endif

                @if ($devise->etat_devis == 'Signés')
                @if ($devise->client_id != null)
                <a href="{{route('devises.finalise',$devise->id)}}" class="bg-warning text-white" id="finalise_span"><i
                        class=" fas fa-undo-alt"></i>
                    <p id="hover_finalise">Annuler la signature</p>
                </a>
                @endif
                @endif

                @if ($devise->etat_devis == 'Refusés')
                @if ($devise->client_id != null)
                <a href="{{route('devises.finalise',$devise->id)}}" class="bg-danger text-white" id="finalise_span"><i
                        class="fas fa-backspace"></i>
                    <p id="hover_finalise">Annuler le refus</p>
                </a>
                @endif
                @endif

                @if ($devise->etat_devis == 'Provisoire')
                @if ($devise->client_id != null)
                <a href="{{route('devises.editdevis',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}"
                    id="finalise_edit" style="background-color:#1976D2"><i class="fas fa-pencil-alt" ></i>
                    <p id="hover_editfacture">Modifier</p>
                </a>
                @else
                <a href="{{route('devises.editdevis_vide',$devise->id)}}" id="finalise_edit"><i
                        class="fas fa-pencil-alt"></i>
                    <p id="hover_editfacture">Modifier</p>
                </a>
                @endif
                @else
                @endif
                @if ($devise->client_id != null)
                <a href="{{route('devise.generpdf',$devise->id)}}" class="bg-dark text-white" id="finalise_download"><i
                    class="fas fa-download"></i>
                    <p id="hover_download">Télecharger</p>
               </a>
                <a href="{{route('create_email_devi',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}"
                    class="bg-dark text-white" id="finalise_email"><i class="far fa-envelope"></i>
                    <p id="hover_email">Envoyer par email</p>
                </a>
                @else
                @endif
                @if ($devise->etat_devis == 'Provisoire')
                <a href="#" data-href="{{route('deletedevise',$devise->id)}}" data-toggle="modal" data-target="#confirm-delete" class="bg-danger text-white" id="finalise_trash">
                    <i class="far fa-trash-alt"></i>
                    <p id="hover_trash">Supprimer</p>
                </a>
                <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer Devis</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true " class="text-white">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer ce devis !!!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-ligh text-secondary" data-dismiss="modal">Annuler</button>
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
                @if ($devise->etat_devis == 'Provisoire')
                @if ($devise->client_id != null)
                <li><a href="{{route('devises.finalise',$devise->id)}}">Finaliser</a></li>
                @else
                @endif
                @else
                @endif
                @if ($devise->etat_devis == 'Finalisé')
                @if ($devise->client_id != null)
                <li><a href="{{route('devises.signe',$devise->id)}}">Marquer comme signé</a></li>
                <li><a href="{{route('devises.refuse',$devise->id)}}">Marquer comme refusé</a></li>
                <hr class="m-0">
                @else
                @endif
                @else
                @endif

                @if ($devise->etat_devis == 'Signés')
                @if ($devise->client_id != null)
                <li><a href="{{route('devises.finalise',$devise->id)}}">Annuler la signature</a></li>
                <hr class="m-0">
                @else
                @endif
                @else
                @endif

                @if ($devise->etat_devis == 'Refusés')
                @if ($devise->client_id != null)
                <li><a href="{{route('devises.finalise',$devise->id)}}">Annuler le refus</a></li>
                <hr class="m-0">
                @else
                @endif
                @else
                @endif

                @if ($devise->etat_devis == 'Provisoire')
                @if ($devise->client_id != null)
                <li><a
                        href="{{route('devises.editdevis',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}">Modifier</a>
                </li>
                @else
                <li><a href="{{route('devises.editdevis_vide',$devise->id)}}">Modifier</a></li>
                @endif
                @else
                @endif
                @if ($devise->etat_devis == 'Provisoire')
                <li>
                    <a href="#" data-href="{{route('deletedevise',$devise->id)}}" data-toggle="modal" data-target="#confirm-delete" id="finalise_trash">
                        Supprimer
                    </a>
                    <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer Devis</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer ce devis !!!
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

                @if ($devise->client_id != null)
                <li><a href="{{route('devise.generpdf',$devise->id)}}">Télecharger</a></li>
                <li><a href="{{route('create_email_devi',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}">Envoyer par
                        email</a></li>
                @else
                @endif
                <hr class="m-0">
                @if($devise->client_id != null)
                <li><a href="{{route('devises.duplicatedevise',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}">Dupliquer le devis</a></li>
                @else
                <li><a href="{{route('devises.duplicatedevise_vide',$devise->id)}}">Dupliquer le devis</a></li>
                @endif
                <li><a href="{{route('devises.duplicateen_facture',$devise->id)}}">Dupliquer en facture</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection


@section('contenu_inside')
<div class="contain_inside row mt-3 container ml-1" id="facture">
    <div class="col-md-6 ">
        <h4 class="font-weight-bold">Informations</h4>

        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Status:</p>
            </div>
            <div class="col-md-8">
                    @if($devise->etat_devis == 'Provisoire')<a href="{{route('devises.showprovi')}}"  class="link-hover-focus">{{$devise->etat_devis}}</a> @endif
                    @if($devise->etat_devis == 'Finalisé')<a href="{{route('devises.showfinalise')}}"  class="link-hover-focus">{{$devise->etat_devis}}</a> @endif
                    @if($devise->etat_devis == 'Refusés')<a href="{{route('devises.showrefuse')}}"  class="link-hover-focus">{{$devise->etat_devis}}</a> @endif
                    @if($devise->etat_devis == 'Signés')<a href="{{route('devises.showsigne')}}"  class="link-hover-focus">{{$devise->etat_devis}}</a> @endif
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Code Devis</p>
            </div>
            <div class="col-md-8">
                <form action="{{ route('recherche_devi') }}" method="post">
                    @csrf
                        <button type="submit" class="border-0 p-0 rounded code " style="background-color: white;">{{$devise->code_devis}}</button>
                        <input type="hidden" class="form-control"  value="{{$devise->code_devis}}" id="search" name="q" />

                    </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Créée le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->created_at->format('Y-m-d')}}</p>
            </div>
        </div>

        {{-- <hr style="margin: 0.5px"> --}}

        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Dernière modification le:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->updated_at->format('Y-m-d')}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}

        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mot cle:</p>
            </div>
            <div class="col-md-8">
                @foreach ($cles as $cle)
                        <div class="mot_cles" style="display: flex;">
                            @foreach ($cle->getCleDevi($devise->id) as $item => $motcle)
                            <form action="{{ route('recherche_devi') }}" method="post">
                                @csrf
                                <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                <button type="submit" class=" btn p-1 btn-outline-primary rounded ml-2">
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
    @if ($devise->etat_devis == 'Provisoire')
    <div class="col-md-6">
        <h4 class="font-weight-bold">Votre devis est prête ?</h4>

        <p>Finalisez votre devis à l'aide du bouton ci-dessus pour pouvoir l'envoyer au client.
            Attention une facture finalisée n'est plus modifiable.</p>
    </div>
    @else
    @endif

    <div class="col-md-6">
        @if ($devise->client_id == null)
        <h4 class="font-weight-bold text-danger">Destinataire</h4>
        @else
        <h4 class="font-weight-bold">Destinataire</h4>
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Destinataire:</p>
            </div>
            <div class="col-md-8">
                <a class="link-hover-focus" href="{{route('voirplus',$devise->client_id)}}"
                    class="text-dark">{{$devise->getClient($devise->client_id)->nom_client}}&nbsp;{{$devise->getClient($devise->client_id)->prenom_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px">
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Société:</p>
            </div>
            <div class="col-md-8">
                <p style="color: red">{{$devise->getClient($devise->client_id)->societe_client}} had partie ya ima khasssni n7aydha ola n9adha ila dart partie dyal societe</p>
            </div>
        </div> --}}
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->getClient($devise->client_id)->adresse_client}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Ville:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->getClient($devise->client_id)->ville_client}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Numéro de téléphone:</p>
            </div>
            <div class="col-md-8">
                <a class="link-hover-focus" href="tel:{{$devise->getClient($devise->client_id)->tel_client}}}}"
                    class="text-dark">{{$devise->getClient($devise->client_id)->tel_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Adresse email:</p>
            </div>
            <div class="col-md-8">
                <a class="link-hover-focus" href="mailto:{{$devise->getClient($devise->client_id)->adresse_email_client}}"
                    class="text-dark">{{$devise->getClient($devise->client_id)->adresse_email_client}}</a>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Site internet:</p>
            </div>
            <div class="col-md-8">
                <a class="link-hover-focus" href="{{$devise->getClient($devise->client_id)->site_client}}"
                    class="text-dark">{{$devise->getClient($devise->client_id)->site_client}}</a>
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
                <p>{{$devise->condition_regld}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Mode de règlement:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->mode_regld}}</p>
            </div>
        </div>
        {{-- <hr style="margin: 0.5px"> --}}
        <div class="row">
            <div class="col-md-4">
                <p class="text-muted">Intérêt de retard:</p>
            </div>
            <div class="col-md-8">
                <p>{{$devise->interet_regld}}</p>
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
                        @if ($devise->getArticle($devise->id)->tva != null)
                        <th scope="col" class="text-muted">TVA</th>
                        @else
                        @endif
                        @if ($devise->getArticle($devise->id)->reduction_article != null)
                        <th scope="col" class="text-muted">Réduction</th>
                        @else
                        @endif
                        <th scope="col" class="text-muted">Total HT</th>
                        {{-- <th scope="col" class="text-muted">Total TTC</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td scope="col">{{$article->type_article}}</td>
                        <td scope="col">{{$article->description_article}}</td>
                        <td scope="col">{{$article->prix_ht_article}} <sub>{{$devise->devis}}</sub></td>
                        <td scope="col">{{$article->quantité_article}}</td>
                        @if ($devise->getArticle($devise->id)->tva != null)
                        <td scope="col">{{$article->tva}}%</td>
                        @else
                        @endif
                        @if ($devise->getArticle($devise->id)->reduction_article != null)
                        <td scope="col">{{$article->reduction_article}}%</td>
                        @else
                        @endif
                        <td scope="col">{{$article->total_ht_article}}<sub>{{$devise->devis}}</sub></td>

                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Total HT final</td>
                        <td scope="col">{{$devise->total_ht_articlesdf}}<sub>{{$devise->devis}}</sub></td>
                    </tr>
                    @if ($devise->tvadf != null)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">TVA</td>
                        <td scope="col">{{$devise->tvadf}}<sub>{{$devise->devis}}</sub></td>
                    </tr>
                    @else
                    @endif
                    <tr>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col" class="font-weight-bold">Total TTC</td>
                        <td scope="col">{{$devise->total_facturedf}}<sub>{{$devise->devis}}</sub></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-start contain_button_submit">
            <a href="{{ route('devises.showprovi') }}" class="btn showprovi_retour">Retour</a>
</div> --}}
</div>
@endsection
@section('script')
<script src="{{ asset('js/voirplus_devis.js') }}"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

</script>
@endsection
