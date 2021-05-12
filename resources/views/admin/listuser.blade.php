@extends('admin')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dash.chartdirham') }}" style="color: white;text-decoration: none">Listes des utilisateurs</a> </h5>
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
                      <th  class="border-0 text-uppercase">Email</th>
                      <th  class="border-0 text-uppercase">Ajouter à</th>
                      <th  class="border-0 text-uppercase">Type</th>
                      <th  class="border-0 text-uppercase">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>nom</td>
                        <td>prenom</td>
                        <td>email</td>
                        <td>ajouter</td>
                        <td>administrateur</td>
                      <td>
                        <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection

