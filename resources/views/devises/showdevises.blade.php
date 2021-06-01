@extends('home')
@section('header_content')
<h5 class="text-white d-inline ml-2 text-uppercase"><a href="{{ route('devises.index') }}" style="color: white;text-decoration: none">Liste des devis<sub>({{$devises->count()}})</sub> </a> </h5>
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
    {{-- etat_div --}}
    <div class="etat_div">
        <ul class="list-inline">
            <li class="list-inline-item "><a href="{{route('devises.index')}}" class="active">Toutes</a></li>
            <li class="list-inline-item"><a href="{{route('devises.showprovi')}}">PROVISOIRES</a></li>
            <li class="list-inline-item"><a href="{{route('devises.showfinalise')}}">Finalisé</a></li>
            <li class="list-inline-item"><a href="{{route('devises.showrefuse')}}">Refusés</a></li>
            <li class="list-inline-item"><a href="{{route('devises.showsigne')}}">Signés</a></li>
        </ul>
    </div>
    {{-- End etat_div --}}

    {{-- start container li fih les cards dyal les devis  --}}
    <div class="container-fluid  pt-2 m-3 ">

                <a href="{{route('devises.create')}}" class="p-2 border" style="background-color: #4DBCED;" id="ajouter_client">Ajouter un devis</a>
                {{-- hnaya ila kano 3andna les devis deja m2ajautine --}}
               @if ($devises->count() > 0)
                    <div class="row">
                     {{-- Start bouclage 3la les devis --}}
                    @foreach ($devises as $devis)

                                         @php
                                            $devise = $devis->devis
                                        @endphp
                                <div class="col-md-8 mt-3">
                                    <div class="card client_display bg-light " >
                                        <div class="card-body">
                                            <div class="row">
                                                <a href="{{route('devises.voirplus',$devis->id)}}" class="card-title col-md-8 nm_client">{{$devis->code_devis}}:{{$devis->etat_devis}}</a>
                                                <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{-- {{dd($clients)}} --}}
                                                    {{-- youssef:1 reda:2 haza:3--}}
                                                        @foreach ($clients as $client)
                                                            <a href="{{route('voirplus',$devis->client_id)}}" class="card-subtitle mb-2 nm_societe mr-5">{{$client->getClient_Facture_Name($devis->client_id)}}&nbsp;&nbsp;{{$client->getClient_Facture_Prenom($devis->client_id)}}</a>
                                                            {{-- {{dd($devis->client_id)}} --}}
                                                            @break
                                                        @endforeach
                                                </div>
                                                <div class="col-6 text-right">
                                                    <i class="fas fa-calendar-week text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold" >{{$devis->created_at->format('Y-m-d')}}</p>
                                                    <i class="fas fa-coins text-muted d-inline mr-2"></i><p class="mr-3 d-inline font-weight-bold">{{$devis->total_ht_articlesdf}} <sub>@php echo $devise; @endphp</sub></p>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row ">
                                                <div class="col-6">
                                                    @foreach ($cles as $cle)
                                                    <div class="mot_cles" style="display: flex;">
                                                        @foreach ($cle->getCleDevi($devis->id) as $item => $motcle)
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

                                                </div>
                                                <div class="col-6">

                                                </div>
                                            </div>




                                        </div>



                                        {{--  start traiemt  suivant  etat dyal devis ghadi nbdaw n3amro hadouk 3 point li kaynine fi card  ... --}}
                                        <div class="absolute" style="z-index:100;">
                                            <ul>
                                                @foreach ($clients as $client)
                                                    @if($client->getClient_Facture_id($devis->client_id) != null)
                                                        @if ($devis->etat_devis=='Provisoire')
                                                            <li> <a href="{{route('devises.finalise',$devis->id)}}">Finaliser</a></li>
                                                            <li><a href="{{route('devises.editdevis',['devi_id'=>$devis->id,'client_id'=>$client->getClient_Facture_id($devis->client_id)])}}">Modifier</a></li>
                                                            <li><a href="#" onclick="handleClickModal({{$devis->id}})">Supprimer</a></li>
                                                            <hr>
                                                        @else
                                                        @endif
                                                        @if ($devis->etat_devis=='Finalisé')
                                                            <li><a href="{{route('devises.signe',$devis->id)}}">Marquer comme signé</a></li>
                                                            <li><a href="{{route('devises.refuse',$devis->id)}}">Marquer comme refusé</a></li>
                                                            <hr>
                                                        @else
                                                        @endif
                                                        @if ($devis->etat_devis=='Refusés')
                                                            <li><a href="{{route('devises.finalise',$devis->id)}}">Annuler le refus</a></li>
                                                            <hr>
                                                        @else
                                                        @endif
                                                        @if ($devis->etat_devis=='Signés')
                                                            <li><a href="{{route('devises.finalise',$devis->id)}}">Annuler la signature</a></li>
                                                            <hr>
                                                        @else
                                                        @endif


                                                        <li><a href="{{route('devise.generpdf',$devis->id)}}">Telécharger</a></li>
                                                        <li><a href="{{route('create_email_devi',['devi_id'=>$devis->id,'client_id'=>$devis->client_id])}}">Envoyer par email</a></li>
                                                        <hr>
                                                        <li><a href="{{route('devises.duplicatedevise',['devi_id'=>$devis->id,'client_id'=>$devis->client_id])}}">Dupliquer le devis</a></li>
                                                        <li><a href="{{route('devises.duplicateen_facture',$devis->id)}}">Dupliquer en facture</a></li>


                                                    @else
                                                        <li><a href="{{route('devises.editdevis_vide',$devis->id)}}">Modifier</a></li>
                                                        <li><a href="#" onclick="handleClickModal({{$devis->id}})">Supprimer</a></li>
                                                        <li><a href="{{route('devises.duplicatedevise_vide',$devis->id)}}">Dupliquer le  devis</a></li>
                                                        <li><a href="{{route('devises.duplicateen_facture',$devis->id)}}">Dupliquer en  facture</a></li>

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
                        <h2 class="font-weight-bold text-center">
                            Aucun devis ajouté pour le moment
                        </h2>
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
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer  Ce Devis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer ce devis !!!!
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
