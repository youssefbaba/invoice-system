@extends('home')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dashapplication.chartdirham') }}" style="color: white;text-decoration: none">Dashboard</a> </h5>
{{-- <div class="form-group has-search d-inline-flex"> --}}
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
    {{-- <form action="#" method="POST">
        @csrf
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search" id="search" name="q" />
            <button type="submit" class="btn"  style="background-color: white;border-radius: 0px 0.25rem 0.25rem 0;">
              <i class="fas fa-search"></i>
            </button>
          </div>
    </form> --}}
{{-- </div> --}}
@endsection
@section('contenu_inside')
<div class="etat_div">
    <ul class="list-inline">
        <li class="list-inline-item "><a href="{{route('dashapplication.chartdirham')}}">STATISTIQUES</a></li>
        {{-- @if()

        @else --}}
        <li class="list-inline-item"><a href="{{ route('dashapplication.chiffre_affaire') }}" class="active">CHIFFRE D'AFFAIRES</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.debours') }}" >DÉBOURS</a></li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 ml-4">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Mois</th>
                    <th scope="col">Facturés </th>
                    <th scope="col">Avoirs</th>
                    <th scope="col">Chiffre d'affaires</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mai 2021</td>
                    <td>5027,42 €</td>
                    <td>2940,30 €</td>
                    <td>2087,12 €</td>
                  </tr>
                  <tr>
                    <td>Mai 2021</td>
                    <td>1000,00 $</td>
                    <td></td>
                    <td>1000,00 $</td>
                  </tr>
                  <tr>
                    <td>Avril 2021</td>
                    <td>1200,00 €</td>
                    <td></td>
                    <td>1 200,00 €</td>
                  </tr>
                  <tr>
                     <td>Mai 2021</td>
                     <td>1000,00 DH</td>
                     <td>900,00 DH</td>
                     <td>100,00 DH</td>
                  </tr>
                  <tr style="font-weight: bold">
                     <td>Total €</td>
                     <td>6227,42 €</td>
                     <td>2940,30 €</td>
                     <td>3287,12 €</td>
                  </tr>
                  <tr style="font-weight: bold">
                     <td>Total $</td>
                     <td>1000,00 $</td>
                     <td>00,00 $</td>
                     <td>1000,00 $</td>
                  </tr>
                  <tr style="font-weight: bold">
                     <td>Total DH</td>
                     <td>1000,00 DH</td>
                     <td>900,00 DH</td>
                     <td>100,00 DH</td>
                  </tr>
                </tbody>
              </table>
        </div>
     </div>
</div>


@endsection
@section('script')

@endsection


