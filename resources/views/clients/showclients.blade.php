@extends('home')
@section('header_content')
<style>

    nav ul li a {
        margin: 0px;
        color:#8891AE !important;
        font-weight: bold;
    }
    .active{
        border-bottom: 0px;

    }
    .pagination{
        margin-bottom: -20px;
        margin-top: 12px;

    }
    .page-item.active .page-link{
        background-color:#ADB6D8 !important;
        border-color: #ADB6D8 !important;
    }

</style>
{{--  hnaya mssayfat wasst view clients et cles et user --}}
@if ($clients === [])
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}"
        style="color: white;text-decoration: none">Liste des clients <sub>(0)</sub></a></h5>
@else
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}"
        style="color: white;text-decoration: none">Liste des clients <sub>({{$clients->count()}})</sub></a></h5>
@endif

<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('recherche_client')}}" method="get">
        {{-- @csrf --}}
        <div class="input-group ">
            <input type="search" class="form-control" placeholder="Search" id="search" name="q" />
            <button type="submit" class="btn" style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>


@endsection

@section('contenu_inside')
<div class="contain_inside p-3">

    <div class="container-fluid pt-2 mb-4">
            <a href="{{route('clients.create')}}" class="p-2 btn-primary rounded"
            id="ajouter_client"><i class="fas fa-plus" style="margin-right:4px"></i>Ajouter un client</a>
        @if ($clients->count() > 0)
        <div class="row ">
            <div class="col-8  d-flex justify-content-start mb-4 mt-2">{{ $clients->links() }}</div>
            @foreach ($clients as $client)
            {{-- {{dd($client)}} --}}

            <div class="col-md-8 mb-4">
                <div class="card client_display " style="background-color: #F5F5F5" >
                    <div class="card-body">
                        <div class="row">
                            <a href="{{route('voirplus',$client->id)}}" class="card-title col-md-8 nm_client"><i class="fas fa-user text-muted" style="margin-right: 12px"></i><span>{{$client->code_client}}</span>:{{$client->nom_client}}&nbsp;&nbsp;&nbsp;{{$client->prenom_client}}</a>
                            <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted part" style="color: rgb(104, 104, 211) !important;">Particulier</h6>
                        <i class="far fa-envelope text-muted mb-2"></i><a href="mailto:{{$client->adresse_email_client}}"
                            class="em_client mb-2">{{$client->adresse_email_client}}</a><br>
                        <i class="fas fa-phone text-muted mb-2"></i><a href="tel:{{$client->tel_client}}"
                            class="em_client mb-2">{{$client->tel_client}}</a>
                        <hr>
                        @foreach ($cles as $cle)
                        <div class="mot_cles" style="display: flex;">
                            @foreach ($cle->getCleClient($client->id) as $item => $motcle)
                            <form action="{{ route('recherche_client') }}" method="get">
                                {{-- @csrf --}}
                                <input type="hidden" class="form-control" value="{{$motcle['mot_cle']}}" id="search"
                                    name="q" />
                                <button type="submit" class=" btn btn-outline-secondary p-1 ml-2">
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
    </div>



</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteCategoryForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Supprimer Ce Client</h5>
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="font-weight-bold text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer ce client !!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ligh text-secondary" data-dismiss="modal">Annuler</button>
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
