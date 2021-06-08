@extends('home')
@section('header_content')

@if($avoirs_cles_clients === [])
<h5 class="text-white d-inline ml-2 text-uppercase">liste des avoirs recherchés <sub>(0)</sub> </h5>
@else
<h5 class="text-white d-inline ml-2 text-uppercase">liste des avoirs recherchés <sub>({{$avoirs_cles_clients->count()}})</sub> </h5>
@endif
<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_avoir')}}" method="get">
        {{-- @csrf --}}
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search" id="search" name="q" />
            <button type="submit" class="btn"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
              <i class="fas fa-search"></i>
            </button>
          </div>
    </form>
</div>
@endsection
@section('contenu_inside')
<div class="contain_inside">

    <div class="container-fluid pt-2 m-3">
               @if ($avoirs_cles_clients === [])
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pas de résultat
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
               @else


                    @if ($avoirs_cles_clients->count() > 0)
                    <div class="row">
                        {{-- {{dd($factures)}} --}}
                        <div class="col-8  d-flex justify-content-start mb-2 ">{{$avoirs_cles_clients->appends(Request::all())->links()}}</div>
                        @foreach ($avoirs_cles_clients as $avoir_cle_client)
                                            @php
                                                $devis = $avoir_cle_client->devis
                                            @endphp
                                    <div class="col-md-8 mt-3 mb-2">
                                        <div class="card client_display " style="background-color: #F5F5F5">
                                            <div class="card-body">

                                                <div class="row">
                                                    <a href="{{route('avoirs.voirplus',$avoir_cle_client->id)}}" class="card-title col-md-8 nm_client"><i class="fas fa-shopping-cart text-muted" style="margin-right: 10px"></i>{{$avoir_cle_client->code_avoir}}:{{$avoir_cle_client->etat_facture}}</a>
                                                    <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">

                                                            @foreach ($clients as $client)
                                                            {{-- {{dd($facture->id_client)}} --}}
                                                            <a href="{{route('voirplus',$avoir_cle_client->client_id)}}" class="card-subtitle mb-2 nm_societe mr-5"><i class="fas fa-user text-muted" style="margin-right: 10px"></i>{{$client->getClient_Facture_code($avoir_cle_client->client_id)}}:{{$client->getClient_Facture_Name($avoir_cle_client->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($avoir_cle_client->client_id)}}</a>
                                                            {{-- <a href="#" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_Name($devis->id_client)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($devis->id_client)}}</a> --}}
                                                                @break
                                                            @endforeach
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$avoir_cle_client->created_at->format('Y-m-d')}}</p>
                                                        <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$avoir_cle_client->total_ht_articlesf}} <sub>@php echo $devis; @endphp</sub></p>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row ">
                                                    <div class="col-6">
                                                        @foreach ($cles as $cle)
                                                        <div class="mot_cles" style="display: flex;">
                                                            @foreach ($cle->getCleAvoir($avoir_cle_client->id) as $item => $motcle)
                                                            <form action="{{ route('recherche_avoir') }}" method="get">
                                                             {{-- @csrf --}}
                                                                <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                                                <button type="submit" class=" btn p-1 btn-outline-secondary rounded ml-2">
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
                                                        @if($client->getClient_Facture_id($avoir_cle_client->client_id) != null)
                                                            @if($avoir_cle_client->etat_facture == 'Provisoire')
                                                                <li> <a href="{{route('avoir.change.finalise',$avoir_cle_client->id)}}">Finaliser</a></li>
                                                                <li><a href="{{route('avoirs.editavoir',['avoir_id'=>$avoir_cle_client->id,'client_id'=>$client->getClient_Facture_id($avoir_cle_client->client_id)])}}">Modifier</a></li>
                                                                <li><a href="#" onclick="handleClickModal({{$avoir_cle_client->id}})">Supprimer</a></li>
                                                                <hr>
                                                            @else
                                                            @endif
                                                            @if($avoir_cle_client->etat_facture == 'Finalisé')
                                                                <li><a href="{{route('avoir.change.remboursé',$avoir_cle_client->id)}}">Marquer comme  remboursé</a></li>

                                                                <hr>
                                                            @else
                                                            @endif
                                                            @if ($avoir_cle_client->etat_facture == 'Remboursé')
                                                            <li><a href="{{route('avoir.anulle_remboursement',$avoir_cle_client->id)}}">Annuler le remboursement</a></li>
                                                            <hr>
                                                            @else
                                                            @endif

                                                            <li><a href="{{route('avoir.genererpdfa',$avoir_cle_client->id)}}">Telécharger</a></li>
                                                            <li><a href="{{route('create_email_avoir',['avoir_id'=>$avoir_cle_client->id,'client_id'=>$client->getClient_Facture_id($avoir_cle_client->client_id)])}}">Envoyer par email</a></li>
                                                            <hr>
                                                        @else
                                                            <li><a href="#">Modifier</a></li>
                                                        @endif
                                                    @break
                                                    @endforeach
                                                        <li><a href="{{route('avoir.duplicate_en_devi',$avoir_cle_client->id)}}">Dupliquer en devis</a></li>
                                                    @if($client->getClient_Facture_id($avoir_cle_client->client_id) != null)
                                                        <li><a href="{{route('avoirs.duplicateen_facture',['avoir_id'=>$avoir_cle_client->id,'client_id'=>$client->getClient_Facture_id($avoir_cle_client->client_id)])}}">Dupliquer en facture</a></li>
                                                    @else
                                                        {{-- <li><a href="{{route('factures.duplicatefacture_vide',$facture->id)}}">Dupliquer la  facture</a></li> --}}
                                                        <li><a href="#">Dupliquer en facture</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
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
        form.action = 'avoirs/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
