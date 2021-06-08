@extends('admin')
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
    html{
        line-height: 1.5rem
    }

</style>
{{--  hnaya mssayfat wasst view clients et cles et user --}}
@if ($users === [])
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}"
        style="color: white;text-decoration: none">Listes des employés recherchès<sub>(0)</sub></a></h5>
@else
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('clients.index') }}"
        style="color: white;text-decoration: none">Listes des employés  recherchès<sub>({{$users->count()}})</sub></a></h5>
@endif


<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    <form action="{{route('admin.search')}}" method="get">
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
        @if($users === [])
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Pas de résultat
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
       </div>
        @else
        @if ($users->count() > 0)
        <div class="row ">
            <div class="col-8  d-flex justify-content-start mb-2 ">{{$users ->appends(Request::all())->links()}}</div>
            @foreach ($users as $user)
            <div class="col-md-8 mb-4">
                <div class="card client_display " style="background-color: #F5F5F5" >
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('admin.show', ['user_id'=>$user->id])}}" class="card-title col-md-8 nm_client  mb-2"><i class="fas fa-user text-muted" style="margin-right:12px"></i>{{$user->name}}&nbsp;&nbsp;&nbsp;{{$user->lastname}}</a>
                            <span class="col-md-4 text-right options"><i class="fas fa-ellipsis-v ellipse"></i></span>
                        </div>
                        @if($user->role === 0)
                             <h6 class="card-subtitle mb-1 mt-1  part " style="margin-left:40px;color: #F25C05 !important;">Employé</h6>
                        @else
                            <h6 class="card-subtitle mb-1 mt-1  part " style="margin-left:40px;color: #F25C05 !important;">Administrateur</h6>
                        @endif
                        @if($user->complete === 0)
                            <h6 class="card-subtitle mb-2 mt-1 part" style="margin-left:40px;color: #F25C05 !important;">Informations incomplète</h6>
                        @else
                            <h6 class="card-subtitle mb-2 mt-1  part" style="margin-left:40px;color: #F25C05 !important;">Informations complète</h6>
                        @endif
                        <i class="far fa-envelope text-muted mb-2"></i><a href="mailto:{{$user->email}}"
                            class="em_client mb-2">{{$user->email}}</a><br>
                        <i class="fas fa-phone text-muted mb-2"></i><a href="tel:{{$user->tel}}"
                            class="em_client mb-2">{{$user->tel}}</a>
                        <hr>
                        <div class="mot_cles" style="display: flex;">
                            <a href="{{ route('admin.show', ['user_id'=>$user->id])}}" class="btn btn-success text-white mr-2"
                                id="finalise_edit"><i class="fas fa-eye"></i>
                                <p id="hover_editfacture">Voir</p>
                            </a>
                             @if($user->role === 0)
                                <a href="{{ route('admin.edit', ['user_id'=>$user->id]) }}" class="btn btn-warning text-white mr-2 @if($user == Auth::user())
                                    disabled @endif""
                                    id="finalise_edit"><i class="fas fa-pencil-alt"></i>
                                    <p id="hover_editfacture">Modifier le role</p>
                                </a>
                                <a  href="#" data-href="{{route('admin.delete',['user_id'=>$user->id])}}" data-toggle="modal" data-target="#confirm-delete" class=" btn btn-danger text-white mr-2 @if($user == Auth::user())
                                    disabled @endif" id="finalise_trash" >
                                    <i class="far fa-trash-alt"></i>
                                    <p id="hover_trash">Supprimer</p>
                                </a>
                                <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer un employé </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer ce employé !!!
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn text-secondary btn-white" data-dismiss="modal">Annuler</a>
                                                <a class="btn btn-danger btn-ok  text-white" style="background-color: #bb2124 !important;border-radius: 0.25rem;;">
                                                Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           @endif
                        </div>
                    </div>
                    <div class="absolute">
                        <ul>
                            <li><a href="{{ route('admin.show', ['user_id'=>$user->id])}}">Voir</a></li>
                            @if($user->role === 0)
                            <li>
                                <a href="{{ route('admin.edit', ['user_id'=>$user->id]) }}" id="finalise_edit">
                                    Modifier le role
                                </a>
                            </li>
                            <li>
                                <a  href="#" data-href="{{route('admin.delete',['user_id'=>$user->id])}}" data-toggle="modal" data-target="#confirm-delete" id="finalise_trash"> Supprimer
                                </a>
                                <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer un employé </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer ce employé !!!
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn text-secondary btn-white" data-dismiss="modal">Annuler</a>
                                                <a class="btn btn-danger btn-ok  text-white" style="background-color: #bb2124 !important;border-radius: 0.25rem;;">
                                                Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @else
        <h2 class="font-weight-bold text-center">
            Aucun employé ajouté pour le moment
        </h2>
        @endif


        @endif

    </div>
</div>
@endsection
@section('script')
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
@endsection



