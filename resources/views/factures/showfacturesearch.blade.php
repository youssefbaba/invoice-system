@extends('home')
@section('header_content')

@if($factures_cles_clients === [])
<h5 class="text-white d-inline ml-2 text-uppercase">
    <a href="#" style="color: white;text-decoration: none;">liste des factures recherchés <sub>(0)</sub></a></h5>
@else
<h5 class="text-white d-inline ml-2 text-uppercase">
    <a href="#" style="color: white;text-decoration: none;">liste des factures recherchés <sub>({{$factures_cles_clients->count()}})</sub></a></h5>
@endif
<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_facture')}}" method="POST">
        @csrf
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

    <div class="container-fluid  pt-2 m-3">
               @if ($factures_cles_clients === [])
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pas de résultat
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
               @else


                    @if ($factures_cles_clients->count() > 0)
                    <div class="row">
                        {{-- {{dd($factures)}} --}}
                        @foreach ($factures_cles_clients as $facture_cle_client)
                                            @php
                                                $devis = $facture_cle_client->devis
                                            @endphp
                                    <div class="col-md-8 mt-3">
                                        <div class="card client_display " style="background-color: #F5F5F5">
                                            <div class="card-body">

                                                <div class="row">
                                                    <a href="{{route('factures.voirplus',$facture_cle_client->id)}}" class="card-title col-md-8 nm_client">{{$facture_cle_client->code_facture}}:{{$facture_cle_client->etat_facture}}</a>
                                                    <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">

                                                            @foreach ($clients as $client)
                                                            {{-- {{dd($facture->id_client)}} --}}
                                                            <a href="{{route('voirplus',$facture_cle_client->client_id)}}" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_code($facture_cle_client->client_id)}}:{{$client->getClient_Facture_Name($facture_cle_client->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($facture_cle_client->client_id)}}</a>
                                                            {{-- <a href="#" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_Name($devis->id_client)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($devis->id_client)}}</a> --}}
                                                                @break
                                                            @endforeach
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$facture_cle_client->created_at->format('Y-m-d')}}</p>
                                                        <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$facture_cle_client->total_ht_articlesf}} <sub>@php echo $devis; @endphp</sub></p>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row ">
                                                    <div class="col-6">
                                                        @foreach ($cles as $cle)
                                                        <div class="mot_cles" style="display: flex;">
                                                            @foreach ($cle->getCleFacture($facture_cle_client->id) as $item => $motcle)
                                                            <form action="{{ route('recherche_facture') }}" method="post">
                                                             @csrf
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
                                                        @if($client->getClient_Facture_id($facture_cle_client->client_id) != null)
                                                            @if($facture_cle_client->etat_facture == 'Provisoire')
                                                                <li> <a href="{{route('facture.change.finalise',$facture_cle_client->id)}}">Finaliser</a></li>
                                                                <li><a href="{{route('factures.editfacture',['facture_id'=>$facture_cle_client->id,'client_id'=>$client->getClient_Facture_id($facture_cle_client->client_id)])}}">Modifier</a></li>
                                                                <li><a href="#" onclick="handleClickModal({{$facture_cle_client->id}})">Supprimer</a></li>
                                                                <hr>
                                                            @else
                                                            @endif
                                                            @if($facture_cle_client->etat_facture == 'Finalisé')
                                                                <li><a href="{{route('facture.change.payé',$facture_cle_client->id)}}">Marquer comme Payée</a></li>
                                                                <hr>
                                                            @else
                                                            @endif
                                                            @if ($facture_cle_client->etat_facture == 'Payée')
                                                                <li><a href="{{route('facture.anulle_paiement',$facture_cle_client->id)}}">Annuler le paiment</a></li>
                                                                <hr>
                                                            @else
                                                            @endif

                                                            <li><a href="{{route('facture.generpdff',$facture_cle_client->id)}}">Telécharger</a></li>
                                                            <li><a <a href="{{route('create_email_facture',['facture_id'=>$facture_cle_client->id,'client_id'=>$client->getClient_Facture_id($facture_cle_client->client_id)])}}">Envoyer par email</a></li>
                                                            <hr>
                                                        @else
                                                            <li><a href="{{route('factures.editfacture_vide',$facture_cle_client->id)}}">Modifier</a></li>
                                                        @endif
                                                    @break
                                                    @endforeach
                                                    {{-- <li><a href="#" onclick="handleClickModal({{$facture->id}})">Supprimer</a></li>
                                                    <hr> --}}
                                                    @if($client->getClient_Facture_id($facture_cle_client->client_id) != null)
                                                        <li><a href="{{route('factures.duplicatefacture',['facture_id'=>$facture_cle_client->id,'client_id'=>$client->getClient_Facture_id($facture_cle_client->client_id)])}}">Dupliquer la  facture</a></li>
                                                    @else
                                                        <li><a href="{{route('factures.duplicatefacture_vide',$facture_cle_client->id)}}">Dupliquer la  facture</a></li>
                                                    @endif
                                                    <li><a href="{{route('devises.duplicateen_devise',$facture_cle_client->id)}}">Dupliquer en devis</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                    @else
                        <h2 class="font-weight-bold text-center">
                            Aucun facture ajouté pour le moment
                        </h2>
                    @endif

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
