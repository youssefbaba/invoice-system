@extends('home')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dashboard') }}" style="color: white;text-decoration: none">Dashboard</a> </h5>
@endsection
@section('contenu_inside')
<div class="etat_div">
    <ul class="list-inline">
        <li class="list-inline-item "><a href="{{route('dashboard')}}" >STATISTIQUES</a></li>
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
                   @for($i = 0; $i < count($total_debours_facture_monthly_dirham); $i++)
                         <tr>
                             <td>{{$keys_facture_dh[$i]}}</td>
                             <td>{{$total_debours_facture_monthly_dirham[$i]}}</td>
                             <td>{{$total_debours_avoir_monthly_dirham[$i]}}</td>
                             <td>{{$total_debours_facture_monthly_dirham[$i] - $total_debours_avoir_monthly_dirham[$i]}}</td>
                         </tr>
                    @endfor

               </tbody>
             </table>
       </div>
    </div>
</div>


@endsection
@section('script')

@endsection


