@extends('home')
<style>
nav ul li a {
        margin: 0px;
        color:#8891AE !important;
        font-weight: bold;
    }
    .pagination li.active{
        border-bottom: 0px;
    }
    a.page-link{
        margin: 0px;
    }
    .pagination{
        margin-bottom:-20px;
        margin-top:12px;
    }
    .page-item.active .page-link{
        background-color:#ADB6D8 !important;
        border-color: #ADB6D8 !important;
    }
</style>
@section('header_content')
<h5 class="text-white d-inline ml-4 text-uppercase"><a href="{{route('factures.paye')}}" style="color: white;text-decoration: none">Liste des factures <sub>({{$factures->count()}})</sub></a> </h5>
<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_facture')}}" method="get">
        {{-- @csrf --}}
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search" id="search" name="q" />
            <button type="submit" class="btn"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
              <i class="fas fa-search"></i>
            </button>
          </div>
        {{-- <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control" placeholder="Search" id="search" name="q">
        <button type="submit" class="btn btn-primary mt-2 d-none"> Search</button> --}}
    </form>
</div>
@endsection
@section('contenu_inside')
<div class="contain_inside">
    <div class="etat_div">
        <ul class="list-inline" style="background-color: #F5F5F5">
        <li class="list-inline-item text-dark"><a href="{{route('factures.index')}}">TOUTES</a></li>
            <li class="list-inline-item text-dark"><a href="{{route('factures.provi')}}" >PROVISOIRES</a></li>
            <li class="list-inline-item text-dark"><a href="{{route('factures.finalise')}}">FINALISÉES</a></li>
            <li class="list-inline-item text-dark"><a href="{{route('factures.paye')}}" class="active">PAYÉES</a></li>
        </ul>
    </div>
    <div class="container-fluid pt-2 m-3">
                <a href="{{route('factures.create')}}" class="p-2 btn-primary rounded" id="ajouter_client" ><i class="fas fa-plus" style="margin-right:4px"></i>Ajouter une facture</a>
                @if ($factures->count() > 0)
                <div class="row">
                    <div class="col-8  d-flex justify-content-start mb-4 mt-2">{{ $factures->links() }}</div>
                    @foreach ($factures as $facture)
                                        @php
                                            $devis = $facture->devis
                                        @endphp
                                <div class="col-md-8 mb-4">
                                    <div class="card client_display " style="background-color: #F5F5F5">
                                        <div class="card-body">
                                            <div class="row">
                                                <a href="{{route('factures.voirplus',$facture->id)}}" class="card-title col-md-8 nm_client"><i class="fas fa-file-invoice-dollar text-muted" style="margin-right: 10px"></i>{{$facture->code_facture}}:{{$facture->etat_facture}}</a>
                                                <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                        @foreach ($clients as $client)
                                                        <a href="{{route('voirplus',$facture->client_id)}}" class="card-subtitle mb-2 nm_societe mr-5"><i class="fas fa-user text-muted" style="margin-right: 10px"></i>{{$client->getClient_Facture_code($facture->client_id)}}:{{$client->getClient_Facture_Name($facture->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($facture->client_id)}}</a>
                                                            @break
                                                        @endforeach
                                                </div>
                                                <div class="col-6 text-right">
                                                    <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$facture->created_at->format('Y-m-d')}}</p>
                                                    <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$facture->total_ht_articlesf}} <sub>@php echo $devis; @endphp</sub></p>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row ">
                                                <div class="col-6">
                                                    @foreach ($cles as $cle)
                                                    <div class="mot_cles" style="display: flex;">
                                                        @foreach ($cle->getCleFacture($facture->id) as $item => $motcle)
                                                        <form action="{{ route('recherche_facture') }}" method="get">
                                                         {{-- @csrf --}}
                                                            <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                                            <button type="submit" class=" btn p-1 btn-outline-secondary rounded ml-2"  >
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
                                                @foreach ($clients as $client)
                                                    @if($client->getClient_Facture_id($facture->client_id) != null)
                                                        <li><a href="{{route('facture.anulle_paiement',$facture->id)}}">Annuler le paiement</a></li>
                                                        <hr>
                                                        <li><a href="{{route('facture.generpdff',$facture->id)}}">Telécharger</a></li>
                                                        <li><a href="{{route('create_email_facture', ['facture_id'=>$facture->id,'client_id'=>$client->getClient_Facture_id($facture->client_id)])}}">Envoyer par email</a></li>
                                                        <hr>
                                                        <li><a href="{{route('avoirs.addavoirs',['facture_id'=>$facture->id,'client_id'=>$facture->client_id])}}">Créer un avoir</a></li>
                                                        <hr>
                                                    @endif
                                                @break
                                                @endforeach

                                                @if($client->getClient_Facture_id($facture->client_id) != null)
                                                    <li><a href="{{route('factures.duplicatefacture',['facture_id'=>$facture->id,'client_id'=>$client->getClient_Facture_id($facture->client_id)])}}">Dupliquer la facture</a></li>
                                                @else
                                                    <li><a href="{{route('factures.duplicatefacture_vide',$facture->id)}}">Dupliquer la  facture</a></li>
                                                @endif
                                                <li><a href="{{route('devises.duplicateen_devise',$facture->id)}}">Dupliquer  en devis</a></li>
                                            </ul>







                                        </div>
                                    </div>
                                </div>
                    @endforeach




                </div>
                @else
                    <h2 class="font-weight-bold text-center">
                      Aucun facture payée pour le moment
                    </h2>
                @endif



    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteCategoryForm">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    function handleClickModal(id) {
        var form = document.getElementById('deleteCategoryForm');
        form.action = 'factures/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
