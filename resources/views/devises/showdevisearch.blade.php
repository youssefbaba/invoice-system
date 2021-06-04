@extends('home')
@section('header_content')
@if($devis_cles_clients === [])
<h5 class="text-white d-inline ml-2 text-uppercase"><a href="#" style="color: white;text-decoration: none;">liste des devis recherchés <sub>(0)</sub></a> </h5>
@else
<h5 class="text-white d-inline ml-2 text-uppercase">
    <a href="#" style="color: white;text-decoration: none;"> liste des devis recherchés <sub>({{$devis_cles_clients->count()}})</sub></a></h5>
@endif



<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_devi')}}" method="POST">
        @csrf
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

    {{-- start container li fih les cards dyal les devis  --}}
    <div class="container-fluid pt-2 m-3">
                @if ($devis_cles_clients === [])
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$status}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @else

                        {{-- hnaya ila kano 3andna les devis deja m2ajautine --}}
                    @if ($devis_cles_clients->count() > 0)
                            <div class="row">
                            {{-- Start bouclage 3la les devis --}}
                            @foreach ($devis_cles_clients as $devi_cle_client)
{{-- {{dd($devi_cle_client->devis)}} --}}
                                                @php
                                                    $devise = $devi_cle_client->devis
                                                @endphp
                                        <div class="col-md-8 mt-3">
                                            <div class="card client_display bg-light " >
                                                <div class="card-body">
                                                    <div class="row">
                                                        <a href="{{route('devises.voirplus',$devi_cle_client->id)}}" class="card-title col-md-8 nm_client">{{$devi_cle_client->code_devis}}:{{$devi_cle_client->etat_devis}}</a>
                                                        <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            {{-- {{dd($clients)}} --}}
                                                            {{-- youssef:1 reda:2 haza:3--}}
                                                                @foreach ($clients as $client)
                                                                    <a href="{{route('voirplus',$client->id)}}" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_Name($devi_cle_client->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($devi_cle_client->client_id)}}</a>
                                                                    @break
                                                                @endforeach
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$devi_cle_client->created_at->format('Y-m-d')}}</p>
                                                            <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$devi_cle_client->total_ht_articlesdf}} <sub>@php echo $devise; @endphp</sub></p>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="row ">
                                                        <div class="col-6">
                                                            @foreach ($cles as $cle)
                                                            <div class="mot_cles" style="display: flex;">
                                                                @foreach ($cle->getCleDevi($devi_cle_client->id) as $item => $motcle)
                                                                <form action="{{ route('recherche_devi') }}" method="post">
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

{{--
                                                            @foreach ($cles as $cle)
                                                                <div class="mot_cles">
                                                                    @foreach ($cle->getCleDevi($devi_cle_client->id) as $item => $motcle)
                                                                        <a href="#" class="p-1 border-2 mot_cles_link text-white rounded" >{{$motcle['mot_cle']}}</a>
                                                                    @endforeach
                                                                </div>
                                                                    @break
                                                            @endforeach --}}
                                                        </div>
                                                        <div class="col-6">

                                                        </div>
                                                    </div>



                                                </div>



                                                {{--  start traiemt  suivant  etat dyal devis ghadi nbdaw n3amro hadouk 3 point li kaynine fi card  ... --}}
                                                <div class="absolute" style="z-index:100;">
                                                    <ul>
                                                        @foreach ($clients as $client)
                                                            @if($client->getClient_Facture_id($devi_cle_client->client_id) != null)
                                                                @if ($devi_cle_client->etat_devis=='Provisoire')
                                                                    <li> <a href="{{route('devises.finalise',$devi_cle_client->id)}}">Finaliser</a></li>
                                                                    <li><a href="{{route('devises.editdevis',['devi_id'=>$devi_cle_client->id,'client_id'=>$client->getClient_Facture_id($devi_cle_client->client_id)])}}">Modifier</a></li>
                                                                    <li><a href="#" onclick="handleClickModal({{$devi_cle_client->id}})">Supprimer</a></li>
                                                                    <hr>
                                                                @else
                                                                @endif
                                                                @if ($devi_cle_client->etat_devis=='Finalisé')
                                                                    <li><a href="{{route('devises.signe',$devi_cle_client->id)}}">Marquer comme signé</a></li>
                                                                    <li><a href="{{route('devises.refuse',$devi_cle_client->id)}}">Marquer comme refusé</a></li>
                                                                    <hr>
                                                                @else
                                                                @endif
                                                                @if ($devi_cle_client->etat_devis=='Refusés')
                                                                    <li><a href="{{route('devises.finalise',$devi_cle_client->id)}}">Annuler le refus</a></li>
                                                                    <hr>
                                                                @else
                                                                @endif
                                                                @if ($devi_cle_client->etat_devis=='Signés')
                                                                    <li><a href="{{route('devises.finalise',$devi_cle_client->id)}}">Annuler la signature</a></li>
                                                                    <hr>
                                                                @else
                                                                @endif


                                                                <li><a href="{{route('devise.generpdf',$devi_cle_client->id)}}">Telécharger</a></li>
                                                                <li><a href="{{ route( 'create_email_devi',['devi_id'=>$devi_cle_client->id,'client_id'=>$client->getClient_Facture_id($devi_cle_client->client_id)] )}}">Envoyer par email</a></li>
                                                                <hr>
                                                                @if ($devi_cle_client->etat_devis=='Signés')
                                                                    <li><a href="#">créer une facture</a></li>
                                                                    <hr>
                                                                @else
                                                                @endif

                                                                <li><a href="{{route('devises.duplicatedevise',['devi_id'=>$devi_cle_client->id,'client_id'=>$devi_cle_client->client_id])}}">Dupliquer le devis</a></li>
                                                                <li><a href="{{route('devises.duplicateen_facture',$devi_cle_client->id)}}">Dupliquer en facture</a></li>


                                                            @else
                                                                <li><a href="{{route('devises.editdevis_vide',$devi_cle_client->id)}}">Modifier</a></li>
                                                                <li><a href="#" onclick="handleClickModal({{$devi_cle_client->id}})">Supprimer</a></li>
                                                                <li><a href="{{route('devises.duplicateen_facture',$devi_cle_client->id)}}">Dupliquer en  facture</a></li>
                                                                <li><a href="{{route('devises.duplicatedevise_vide',$devi_cle_client->id)}}">Dupliquer le  devis</a></li>
                                                            @endif
                                                            @break
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                {{-- end traitement suivant cas dyal etat devis  --}}



                                            </div>
                                        </div>
                            @endforeach
                            {{-- End bouclage 3la les devis  --}}


                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="font-weight-bold text-center">
                                    Aucun devis ajouté pour le moment
                                </h2>
                            </div>
                        </div>
                        @endif

                @endif
    </div>
    {{-- End container li fih les devis --}}

</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteCategoryForm">
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
        form.action = 'devises/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
