@extends('admin')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dashboard') }}" style="color: white;text-decoration: none">Listes des utilisateurs</a> </h5>
<div class="form-group has-search d-inline-flex">
    <form action="#" method="POST">
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
<div class="container">
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">Gestion des utilisateurs</h5>
            </div>
            <div class="table-responsive">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th class="border-0 text-uppercase">Nom</th>
                      <th class="border-0 text-uppercase">Prenom</th>
                      <th  class="border-0 text-uppercase">Email Professionnel</th>
                      <th  class="border-0 text-uppercase">Ajouter à</th>
                      <th  class="border-0 text-uppercase">Type</th>
                      <th  class="border-0 text-uppercase">Action</th>
                    </tr>
                  </thead>
                    @foreach ($users as  $user)
                    <tbody>
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->lastname}}</td>
                        <td> {{$user->email_profes}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            @if($user->role === 0)
                            Utilisateur
                            @else
                            Administrateur
                            @endif
                        </td>
                      <td>
                        @if($user->role === 0)
                        <a href="{{ route('admin.edit', ['user_id'=>$user->id]) }}" type="button" class="btn btn-success text-white"><i class="far fa-edit"></i></a>
                        <a href="#" data-href="{{route('admin.delete',['user_id'=>$user->id])}}" data-toggle="modal" data-target="#confirm-delete" class=" btn btn-danger  text-white" id="finalise_trash" >
                            <i class="far fa-trash-alt"></i>
                        </a>
                        <div class="modal fade top" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer un utilisateur </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer cette utilisateur !!!
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

