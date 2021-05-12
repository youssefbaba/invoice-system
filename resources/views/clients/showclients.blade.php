@extends('home')
@section('header_content')

{{--  hnaya mssayfat wasst view clients et cles et user --}}
@if ($clients === [])
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}" style="color: white;text-decoration: none">Liste des  clients <sub>(0)</sub></a></h5>
@else
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}" style="color: white;text-decoration: none" >Liste des  clients <sub>({{$clients->count()}})</sub></a></h5>
@endif



<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_client')}}" method="POST">
        @csrf
        <div class="input-group ">
            <input type="search" class="form-control" placeholder="Search" id="search" name="q" />
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
<div class="contain_inside p-3">
    <div class="container-fluid pt-2 mt-2">

        @if ($clients === [])
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{$status}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else

        <a href="{{route('clients.create')}}" class=" p-2 border" style="background-color: #4DBCED" id="ajouter_client">Ajouter un client</a>
        @if ($clients->count() > 0)
        <div class="row">
            @foreach ($clients as $client)
            {{-- {{dd($client)}} --}}
                        <div class="col-md-4 mt-3">
                            <div class="card client_display bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <a href="{{route('voirplus',$client->id)}}" class="card-title col-md-8 nm_client">{{$client->nom_client}}&nbsp;&nbsp;&nbsp;{{$client->prenom_client}}</a>
                                        <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted nm_societe">Particulier</h6>
                                    <i class="far fa-envelope text-muted"></i><a href="mailto:{{$client->adresse_email_client}}" class="em_client">{{$client->adresse_email_client}}</a><br>
                                    <i class="fas fa-phone text-muted"></i><a href="tel:{{$client->tel_client}}" class="em_client">{{$client->tel_client}}</a>
                                    <hr>
                                    @foreach ($cles as $cle)
                                       <div class="mot_cles" style="display: flex;">
                                           @foreach ($cle->getCleClient($client->id) as $item => $motcle)
                                           <form action="{{ route('recherche_client') }}" method="post">
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
                                <div class="absolute">
                                    <ul>
                                        <li><a href="{{route('clients.edit',$client->id)}}">modifier</a></li>
                                        <li><a href="#" onclick="handleClickModal({{$client->id}})">supprimer</a></li>
                                        <hr>
                                        <label for="clients">Pour ce client:</label>
                                        <li><a href="{{route('create_determine_devis',$client->id)}}">Créer un devi</a></li>
                                        <li><a href="{{route('create_determine_facture',$client->id)}}">Créer une facture</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>
        @else
                <h2 class="font-weight-bold text-center">
                    Aucun client ajouté pour le moment
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer cette client!!!
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
        form.action = 'clients/' + id
        $('#deleteModal').modal('show');
    }


</script>
@endsection
