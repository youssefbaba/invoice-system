@extends('admin')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dashboard') }}" style="color: white;text-decoration: none">Listes des employés</a> </h5>
<div class="form-group has-search d-inline-flex">
    <form action="{{ route('admin.search') }}" method="POST">
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
{{-- <link rel="stylesheet" href="{{ asset('css/listusers.css') }}"> --}}
<div class="container-fluid">
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">Gestion des employés</h5>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="ml-3">
                    <ul class="nav nav-tabs">
                        <a  href="{{ route('admin') }}" class="btn btn-secondary" style="border-radius: 0px;color: white;margin-right:2px">
                            Tous <span class="badge badge-light">{{$users->count()}}</span>
                          </a>
                          <a   href="{{ route('admin.listadmin') }}" class="btn btn-secondary" style="border-radius: 0px;color: white;margin-right:2px">
                            Administrateurs <span class="badge badge-light">{{$useradmin->count()}}</span>
                          </a>
                          <a href="{{ route('admin.listuser') }}" class="btn btn-secondary" style="border-radius: 0px;color: white;margin-right:2px">
                            Employés <span class="badge badge-light">{{$listuser->count()}}</span>
                          </a>
                      </ul>
                </div>

                <div >
                    <ul class="nav nav-tabs mr-3">
                        <a  href="{{ route('admin.create') }}" class="btn " style="border-radius: 0px;background-color: #4DBCED;color: white;margin-right:2px">
                            Ajouter un employé
                          </a>
                      </ul>
                </div>
            </div>
            <div class="table">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th class="border-0 text-uppercase">Nom</th>
                      <th class="border-0 text-uppercase">Prenom</th>
                      <th  class="border-0 text-uppercase">Email</th>
                      <th  class="border-0 text-uppercase">Ajouter à</th>
                      <th  class="border-0 text-uppercase">Type</th>
                      <th  class="border-0 text-uppercase">Action</th>
                    </tr>
                  </thead>
                    @foreach ($useradmin as $user)
                    <tbody>
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->lastname}}</td>
                        <td> {{$user->email}}</td>
                        <td>{{$user->created_at->format('Y-m-d')}}</td>
                        <td>
                            @if($user->role === 0)
                            Employé
                            @else
                            Administrateur
                            @endif
                        </td>
                      <td>
                        <a href="{{ route('admin.show', ['user_id'=>$user->id])}}" class="btn btn-success text-white"
                            id="finalise_edit"><i class="fas fa-eye"></i>
                            <p id="hover_editfacture">Voir</p>
                        </a>



                        @if($user->role === 0)
                        <a href="{{ route('admin.edit', ['user_id'=>$user->id]) }}" class="btn btn-warning text-white @if($user == Auth::user())
                            disabled @endif""
                            id="finalise_edit"><i class="fas fa-pencil-alt"></i>
                            <p id="hover_editfacture">Modifier le role</p>
                        </a>
                        <a  href="#" data-href="{{route('admin.delete',['user_id'=>$user->id])}}" data-toggle="modal" data-target="#confirm-delete" class=" btn btn-danger text-white @if($user == Auth::user())
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
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer ce employé !!!
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-secondary btn-lg text-white" data-dismiss="modal">Annuler</a>
                                        <a class="btn btn-danger btn-ok btn-lg text-white" style="background-color: #bb2124 !important;border-radius: 0.25rem;;">
                                        Supprimer
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                   @endif


                      </td>
                    </tr>
                  </tbody>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
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

