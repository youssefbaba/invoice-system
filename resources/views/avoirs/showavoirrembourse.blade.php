@extends('home')
@section('header_content')
<h5 class="text-white d-inline ml-4 text-uppercase"><a href="{{route('avoirs.rembourse')}}" style="color: white;text-decoration: none">Liste des factures <sub>({{$avoirs->count()}})</sub></a> </h5>
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
    <div class="etat_div">
        <ul class="list-inline">
            <li class="list-inline-item "><a href="{{ route('avoirs.index') }}" >Toutes</a></li>
            <li class="list-inline-item"><a href="{{route('avoirs.provi')}}">PROVISOIRES</a></li>
            <li class="list-inline-item"><a href="{{ route('avoirs.finalise') }}">FINALISÉES</a></li>
            <li class="list-inline-item"><a href="{{ route('avoirs.rembourse') }}" class="active">Remboursé</a></li>
        </ul>
    </div>
    <div class="container-fluid mt-4">
                @if ($avoirs->count() > 0)
                <div class="row">
                    @foreach ($avoirs as $avoir)
                                        @php
                                            $devis = $avoir->devis
                                        @endphp
                                <div class="col-md-8 mt-3">
                                    <div class="card client_display bg-light">
                                        <div class="card-body">
                                            <div class="row">
                                                <a href="{{route('avoirs.voirplus',$avoir->id)}}" class="card-title col-md-8 nm_client">{{$avoir->code_avoir}}:{{$avoir->etat_facture}}</a>
                                                <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                        @foreach ($clients as $client)
                                                        <a href="{{route('voirplus',$avoir->client_id)}}" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_Name($avoir->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($avoir->client_id)}}</a>
                                                            @break
                                                        @endforeach
                                                </div>
                                                <div class="col-6 text-right">
                                                    <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$avoir->created_at->format('Y-m-d')}}</p>
                                                    <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$avoir->total_ht_articlesf}} <sub>@php echo $devis; @endphp</sub></p>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row ">
                                                <div class="col-6">
                                                    @foreach ($cles as $cle)
                                                    <div class="mot_cles" style="display: flex;">
                                                        @foreach ($cle->getCleAvoir($avoir->id) as $item => $motcle)
                                                        <form action="{{ route('recherche_avoir') }}" method="post">
                                                         @csrf
                                                            <input type="hidden" class="form-control"  value="{{$motcle['mot_cle']}}" id="search" name="q" />
                                                            <button type="submit" class=" btn p-1 border-2 mot_cles_link text-white rounded ml-2 "  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
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
                                                    @if($client->getClient_Facture_id($avoir->client_id) != null)
                                                        <li><a href="{{route('avoir.anulle_remboursement',$avoir->id)}}">Annuler le remboursement</a></li>
                                                        <hr>
                                                        <li><a href="{{route('avoir.genererpdfa',$avoir->id)}}">Telécharger</a></li>
                                                        <li><a href="{{route('create_email_avoir',['avoir_id'=>$avoir->id,'client_id'=>$client->getClient_Facture_id($avoir->client_id)])}}">Envoyer par email</a></li>
                                                        <hr>

                                                    @endif
                                                @break
                                                @endforeach


                                                <li><a href="{{route('avoir.duplicate_en_devi',$avoir->id)}}">Dupliquer en devis</a></li>
                                                @if($client->getClient_Facture_id($avoir->client_id) != null)
                                                    <li><a href="{{route('avoirs.duplicateen_facture',['avoir_id'=>$avoir->id,'client_id'=>$client->getClient_Facture_id($avoir->client_id)])}}">Dupliquer en facture</a></li>
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
                @else
                    <h2 class="font-weight-bold text-center">
                      Aucun facture remboursé pour le moment
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
