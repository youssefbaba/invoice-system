@extends('home')
@section('header_content')
{{--  hnaya ssayfat m3a view clients li howa ghir client wa7ad o ssayfat user   --}}
<h2 class="text-white d-inline ml-4 text-uppercase">{{$clients->nom_client}}&nbsp;&nbsp;{{$clients->prenom_client}}</</h2>
@endsection
@section('contenu_inside')
<div class="contain_inside p-3">



    {{-- start container  li fih les infos dyal client --}}
    <div class="container-fluid row voir_plus ">
        <div class="col-md-6 ">
            <h2>Informations</h2>
            <div>
                <p class="text-muted d-inline-flex">Fonction:</p>
                <p class="d-inline-flex">{{$clients->fonction_client}}</p>
            </div>
            <hr>
            <div>
                <p class="text-muted d-inline-flex">Adresse email:</p>
                <a class="link-hover-focus" href="mailto:{{$clients->adresse_email_client}}">{{$clients->adresse_email_client}}</a>
            </div>
            <hr>
            <div>
                <p class="text-muted d-inline-flex">Numéro de téléphone:</p>
                <a class="link-hover-focus" href="tel:{{$clients->tel_client}}">{{$clients->tel_client}}</a>
            </div>
            <hr>
            <div>
                <p class="text-muted d-inline-flex">Société:</p>
                <a href="#" style="color: red">{{$clients->societe_client}} (mzl madart  had partie  dyal société)</a>
            </div>
            <div>
                <p class="text-muted d-inline-flex">Adresse:</p>
                <p class="d-inline-flex">{{$clients->adresse_client}}</p>
            </div>
             <hr>
             <div>
                <p class="text-muted d-inline-flex">Ville:</p>
                <p class="d-inline-flex">{{$clients->ville_client}}</p>
            </div>
            <hr>
            <div>
                <p class="text-muted d-inline-flex">Langue:</p>
                <p class="d-inline-flex">{{$clients->langue_client}}</p>
            </div>
            <hr>
            <div style="display: flex">
                <p class="text-muted" style="margin-top: 12px" >Mot clés:</p>
                <p>
                    @foreach ($cles as $cle)
                            <div class="mot_cles" style="display: flex;">
                                @foreach ($clients->get_cles_client($clients->id) as $item => $motcle)
                                <form action="{{ route('recherche_client') }}" method="post">
                                @csrf
                                    <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                    <button type="submit" class=" btn p-1 border-2 mot_cles_link text-white rounded ml-2 mt-2"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
                                    {{$motcle['mot_cle']}}
                                    </button>
                                </form>
                                @endforeach
                            </div>
                            @break
                    @endforeach
                </p>
            {{-- </form> --}}
            </div>
            <hr>
            <div>
                <p class="text-muted d-inline-flex">Note:</p>
                <p class="d-inline-flex">{{$clients->note_client}}</p>
            </div>
        </div>

        <div class="col-md-6 ">
            <h2>Activités</h2>
            <div>
                <p class="text-muted d-inline-flex">Création:</p>
                <p class="d-inline-flex">{{$clients->created_at->format('Y-m-d')}}</p>
                <hr>
                <p class="text-muted d-inline-flex">Dernière modification :</p>
                <p class="d-inline-flex">{{$clients->updated_at->format('Y-m-d')}}</p>
                <hr>
                @if ($clients->get_facture_client($clients->id)->count() > 0)
                <h6 class="d-inline-flex ">Factures :</h6>
                <p class="d-inline-flex ">{{$clients->get_facture_client($clients->id)->count()}}</p>
                <hr>
                @else
                <h6 class="d-inline-flex ">Factures :</h6>
                <p class="d-inline-flex ">0</p>
                <hr>
                @endif
                @if($clients->get_devise_client($clients->id)->count() > 0)
                <h6 class="d-inline-flex ">Devises :</h6>
                <p class="d-inline-flex ">{{$clients->get_devise_client($clients->id)->count()}}</p>
                <hr>
                @else
                <h6 class="d-inline-flex ">Devises :</h6>
                <p class="d-inline-flex ">0</p>
                <hr>
                @endif
            </div>
        </div>
    </div>
    {{-- End dyal container li fih les infos dyal client --}}




    <hr>



    {{-- start ghadi nbdaw nssawbo les cardes dyal les factures dyal hadak client  --}}
    <div class="container_fluid row voir_plus">
        <div class="col-md-8">
            {{-- ila kano bbzzzffff dyal les factures dyal client --}}
             {{-- {{dd($clients->get_facture_client($clients->id))}} --}}
            @if ($clients->get_facture_client($clients->id)->count() > 0)
            <h2>Factures: <sub>({{$clients->get_facture_client($clients->id)->count()}})</sub></h2>
                @foreach ($clients->get_factures_client($clients->id) as  $facture)
                    @php
                    $devis = $facture->devis
                    @endphp
                <div class="col-md-10 mt-3">
                    <div class="card client_display bg-light  mb-4">
                        <div class="card-body">
                            <div class="row">
                                <a href="{{route('factures.voirplus',$facture->id)}}" class="card-title col-md-8 nm_client">{{$facture->code_facture}}:{{$facture->etat_facture}}</a>
                                <span class="col-md-4 text-right options"><i
                                        class="fas fa-ellipsis-v ellipse"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <a href="#"
                                        class="card-subtitle mb-2 nm_societe mr-5">{{$clients->nom_client}}&nbsp;&nbsp;{{$clients->prenom_client}}</a>
                                </div>
                                <div class="col-8 text-right">
                                    <i class="fas fa-calendar-week text-muted d-inline mr-2"></i>
                                    <p class="mr-3 d-inline font-weight-bold">{{$facture->created_at->format('Y-m-d')}}
                                    </p>
                                    <i class="fas fa-coins text-muted d-inline mr-2"></i>
                                    <p class="mr-3 d-inline font-weight-bold">{{$facture->total_ht_articlesf}} <sub>@php
                                            echo $devis; @endphp</sub></p>
                                </div>
                            </div>

                            <hr >
                            <div class="row">
                                <div class="col-6">
                                    @foreach ($cles as $cle)
                                            <div class="mot_cles" style="display: flex;">
                                                @foreach ($cle->getCleFacture($facture->id) as $item => $motcle)
                                                <form action="#" method="post">
                                                @csrf
                                                    <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                                    <button type="submit" class=" btn p-1 border-2 mot_cles_link text-white rounded ml-2 mt-2"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
                                                    {{$motcle['mot_cle']}}
                                                    </button>
                                                </form>
                                                @endforeach
                                            </div>
                                            @break
                                    @endforeach

                                </div>
                                <div class="col-6">

                                </div>
                            </div>


                        </div>
                        <div class="absolute" style="z-index:100;">
                            <ul>
                            @if($clients->getClient_Facture_id($facture->client_id) != null)

                                @if($facture->etat_facture == 'Provisoire')
                                <li><a href="{{route('facture.change.finalise',$facture->id)}}">Finaliser</a></li>
                                <li><a href="{{route('factures.editfacture',['facture_id'=>$facture->id,'client_id'=>$clients->getClient_Facture_id($facture->client_id)])}}">Modifier</a></li>
                                <li><a href="#" onclick="handleClickModal({{$facture->id}})">Supprimer</a></li>
                                <hr>
                                @else
                                @endif

                                @if($facture->etat_facture == 'Finalisé')
                                <li><a href="{{route('facture.change.payé',$facture->id)}}">Marquer comme Payée</a></li>
                                <hr>
                                @else
                                @endif

                                @if ($facture->etat_facture == 'Payée')
                                <li><a href="{{route('facture.anulle_paiement',$facture->id)}}">Annuler le paiment</a>
                                </li>
                                <hr>
                                @else
                                @endif

                                <li><a href="{{route('facture.generpdff',$facture->id)}}">Telécharger</a></li>
                                <li><a href="mailto:{{$facture->getClient($facture->client_id)->adresse_email_client}}">Envoyer
                                        par email</a></li><hr>
                                @else
                                <li><a href="{{route('factures.editfacture_vide',$facture->id)}}">Modifier</a></li>
                                @endif



                                @if($clients->getClient_Facture_id($facture->client_id) != null)
                                <li><a
                                        href="{{route('factures.duplicatefacture',['facture_id'=>$facture->id,'client_id'=>$clients->getClient_Facture_id($facture->client_id)])}}">Dupliquer
                                        la facture</a></li>
                                @else
                                <li><a href="{{route('factures.duplicatefacture_vide',$facture->id)}}">Dupliquer la
                                        facture</a></li>
                                @endif
                                <li><a href="{{route('devises.duplicateen_devise',$facture->id)}}">Dupliquer en devis</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="modal fade" id="{{$facture->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('factures.destroy',$facture->id)}}" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer facture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer cette facture!!!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-sm bg-danger">Supprimer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
          @else

            <h6 class="text-muted">Aucun facture pour ce client</h6>
            <a href="{{route('create_determine_facture',$clients->id)}}" class="text-info btn btn-sm"> <u>Cliquer ici pour
                    créer une facture pour ce client</u><span class="ml-2"><i class="far fa-plus-square"></i></span> </a>


          @endif
      </div>
    </div>
  {{-- End les cardes dya les factures de client --}}





    {{-- start ghadi nssawbo les cardes dyal les devises pour ce client --}}
    <div class="container_fluid row voir_plus">
        <div class="col-md-8">
            {{-- hnaya 3andna 3 devis F , F , P --}}
            @if ($clients->get_devise_client($clients->id)->count() > 0)
            <h2>Devise: <sub>({{$clients->get_devise_client($clients->id)->count()}})</sub></h2>
                @foreach ($clients->get_devises_client($clients->id) as $item => $devise)
                @php
                $devis = $devise->devis
                @endphp
                <div class="col-md-10 mt-3">
                    <div class="card client_display bg-light mb-4">
                        <div class="card-body">
                            <div class="row">
                                <a href="{{route('devises.voirplus',$devise->id)}}" class="card-title col-md-8 nm_client">{{$devise->code_devis}}:{{$devise->etat_devis}}</a>
                                <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <a href="#"class="card-subtitle mb-2  nm_societe mr-5">{{$clients->nom_client}}&nbsp;&nbsp;{{$clients->prenom_client}}</a>
                                </div>

                                <div class="col-8 text-right">
                                    <i class="fas fa-calendar-week text-muted d-inline mr-2"></i>
                                    <p class="mr-3 d-inline font-weight-bold">{{$devise->created_at->format('Y-m-d')}}</p>
                                    <i class="fas fa-coins text-muted d-inline mr-2"></i>
                                    <p class="mr-3 d-inline font-weight-bold">{{$devise->total_ht_articlesdf}} <sub>@php echo $devis; @endphp</sub></p>
                                    <hr>


                                </div>
                            </div>

                            <hr >
                            <div class="row">
                                <div class="col-6">
                                    @foreach ($cles as $cle)
                                            <div class="mot_cles" style="display: flex;">
                                                @foreach ($cle->getCleDevi($devise->id) as $item => $motcle)
                                                <form action="{{ route('recherche_devi') }}" method="post">
                                                @csrf
                                                    <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                                    <button type="submit" class=" btn p-1 border-2 mot_cles_link text-white rounded ml-2 mt-2"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
                                                    {{$motcle['mot_cle']}}
                                                    </button>
                                                </form>
                                                @endforeach
                                            </div>
                                            @break
                                    @endforeach

                                </div>
                                <div class="col-6">

                                </div>
                            </div>

                        </div>
                        <div class="absolute" style="z-index:100;">
                            <ul>
                                    @if($clients->getClient_devise_id($devise->client_id) != null)
                                        @if ($devise->etat_devis=='Provisoire')
                                            <li> <a href="{{route('devises.finalise',$devise->id)}}">Finaliser</a></li>
                                            <li><a href="{{route('devises.editdevis',['devi_id'=>$devise->id,'client_id'=>$clients->getClient_devise_id($devise->client_id)])}}">Modifier</a></li>
                                            <li><a href="#" onclick="handleClickModal({{$devise->id}})">Supprimer</a></li>
                                            <hr>
                                        @else
                                        @endif
                                        @if ($devise->etat_devis=='Finalisé')
                                            <li><a href="{{route('devises.signe',$devise->id)}}">Marquer comme signé</a></li>
                                            <li><a href="{{route('devises.refuse',$devise->id)}}">Marquer comme refusé</a></li>
                                            <hr>
                                        @else
                                        @endif

                                        @if ($devise->etat_devis=='Refusés')
                                            <li><a href="{{route('devises.finalise',$devise->id)}}">Annuler le refus</a></li>
                                            <hr>
                                        @else
                                        @endif
                                        @if ($devise->etat_devis=='Signés')
                                            <li><a href="{{route('devises.finalise',$devise->id)}}">Annuler la signature</a></li>
                                            <hr>
                                        @else
                                        @endif
                                        <li><a href="{{route('devise.generpdf',$devise->id)}}">Telécharger</a></li>
                                        <li><a href="mailto:{{$devise->getClient($devise->client_id)->adresse_email_client}}">Envoyer par email</a></li>
                                        <hr>
                                        @if ($devise->etat_devis=='Signés')
                                        <li><a href="#">créer une facture</a></li>
                                        <hr>
                                    @else
                                    @endif
                                        <hr>
                                        <li><a href="{{route('devises.duplicatedevise',['devi_id'=>$devise->id,'client_id'=>$devise->client_id])}}">Dupliquer le  devis</a></li>
                                        <li><a href="{{route('devises.duplicateen_facture',$devise->id)}}">Dupliquer en facture</a></li>
                                    @else
                                        <li><a href="{{route('devises.editdevis_vide',$devise->id)}}">Modifier</a></li>
                                        <li><a href="#" onclick="handleClickModal({{$devise->id}})">Supprimer</a></li>
                                        <li><a href="{{route('devises.duplicatedevise_vide',$devise->id)}}">Dupliquer le devis</a></li>
                                        <li><a href="{{route('devises.duplicateen_facture',$devise->id)}}">Dupliquer en facture</a></li>

                                    @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="{{$devise->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('devises.destroy',$devise->id)}}" method="POST" id="deleteCategoryForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer devis</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer cette devis!!!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-sm bg-danger">Supprimer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <h6 class="text-muted">Aucun devis pour ce client</h6>
                <a href="{{route('create_determine_devis',$clients->id)}}" class="text-info btn btn-sm"> <u>Cliquer ici pour créer une devis pour ce client</u><span class="ml-2"><i class="far fa-plus-square"></i></span> </a>
            @endif
        </div>
    </div>
    {{-- End les devis dyal hadak client --}}



</div>

@endsection
@section('script')
<script>
    function handleClickModal(id) {
        //alert((this).parent.html());
        //$('#deleteModal').modal('show');
        $('#' + id + '').modal('show');
    }
    // $(document).ready(function(){
    // $('.supp').on('click',function(){
    //     //$(this).parent().parent().parent().parent().parent().parent().children().show();
    //     alert();
    // });
    // });
</script>
@endsection
