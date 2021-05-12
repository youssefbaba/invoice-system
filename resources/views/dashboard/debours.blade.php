@extends('home')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dash.chartdirham') }}" style="color: white;text-decoration: none">Dashboard</a> </h5>
<div class="form-group has-search d-inline-flex">
    {{--  hnaya 3andi moteur du recherche li kaydir recherche 3la les client --}}
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
<div class="etat_div">
    <ul class="list-inline">
        <li class="list-inline-item "><a href="{{route('dash.chartdirham')}}" >STATISTIQUES</a></li>
        <li class="list-inline-item"><a href="{{ route('dash.chiffre_affaire') }}">CHIFFRE D'AFFAIRES</a></li>
        <li class="list-inline-item"><a href="{{ route('dash.debours') }}" class="active">DÉBOURS</a></li>
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
                   <th scope="col">Total</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>Mai 2021</td>
                   <td>100,00 €</td>
                   <td></td>
                   <td>100,00 €	</td>
                 </tr>
                 <tr>
                   <td>Mai 2021</td>
                   <td>200,00 $	</td>
                   <td>200,00 $	</td>
                   <td>00,00 $</td>
                 </tr>
                 <tr>
                   <td>Avril 2021</td>
                   <td>100,00 €</td>
                   <td></td>
                   <td>100,00 €</td>
                 </tr>

                 <tr style="font-weight: bold">
                    <td>Total €</td>
                    <td>200,00 €</td>
                    <td>00,00€</td>
                    <td>3287,12 €</td>
                 </tr>
                 <tr style="font-weight: bold">
                    <td>Total $</td>
                    <td>200,00 $</td>
                    <td>200,00 $</td>
                    <td>00,00 $</td>
                 </tr>
               </tbody>
             </table>
       </div>
    </div>
</div>


@endsection
@section('script')

@endsection


