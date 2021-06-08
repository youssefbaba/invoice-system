@extends('admin')
<style>
    .table-hover th
    {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #ADB6D8;
        color: black;
    }
    .table-hover tr:nth-child(2n-1)
    {
       background-color: #f2f2f2;;
    }
</style>
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
    <ul class="list-inline" style="background-color: #F5F5F5">
        <li class="list-inline-item "><a href="{{route('dashapplication.chartdirham')}}">STATISTIQUES</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.chiffre_affaire') }}" >CHIFFRE D'AFFAIRES</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.encaissements') }}" class="active">ENCAISSEMENTS</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.debours') }}" >DÉBOURS</a></li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 ml-4 mt-4">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Mois</th>
                    <th scope="col">Facturés </th>
                    <th scope="col">Avoirs</th>
                    <th scope="col">Encaissements</th>
                  </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i<count($keys_facture_dirham); $i++)
                            @php
                                $total = 0
                            @endphp
                            @php
                                $compteur = 0
                            @endphp
                            <tr>

                                <td>{{Carbon\Carbon::parse($keys_facture_dirham[$i])->format('m/Y') }}</td>
                                <td>{{$total_facture_monthly_dirham[$i]}}&nbsp;DH</td>
                                @for($j = 0; $j<count($keys_avoir_dirham); $j++)
                                    @if($keys_facture_dirham[$i]===$keys_avoir_dirham[$j])
                                        <td>{{$total_avoir_monthly_dirham[$j]}}&nbsp;DH</td>
                                        @php
                                            $total = $total_avoir_monthly_dirham[$j]
                                        @endphp
                                        @break
                                    @endif
                                    @php
                                        $compteur++
                                    @endphp
                                @endfor
                                @if($compteur === count($keys_avoir_dirham))
                                <td></td>
                                <td>{{$total_facture_monthly_dirham[$i]}}&nbsp;DH</td>
                                @else
                                <td>{{$total_facture_monthly_dirham[$i] - $total }}&nbsp;DH</td>
                                @endif
                            </tr>
                    @endfor
                    @for($i = 0; $i<count($keys_facture_dollar); $i++)
                            @php
                                $total = 0
                            @endphp
                            @php
                                $compteur = 0
                            @endphp
                            <tr>

                                <td>{{Carbon\Carbon::parse($keys_facture_dollar[$i])->format('m/Y') }}</td>
                                <td>{{$total_facture_monthly_dollar[$i]}}&nbsp;$</td>
                                @for($j = 0; $j<count($keys_avoir_dollar); $j++)
                                    @if($keys_facture_dollar[$i]===$keys_avoir_dollar[$j])
                                        <td>{{$total_avoir_monthly_dollar[$j]}}&nbsp;$</td>
                                        @php
                                            $total = $total_avoir_monthly_dollar[$j]
                                        @endphp
                                        @break
                                    @endif
                                    @php
                                        $compteur++
                                    @endphp
                                @endfor
                                @if($compteur === count($keys_avoir_dollar))
                                <td></td>
                                <td>{{$total_facture_monthly_dollar[$i]}}&nbsp;$</td>
                                @else
                                <td>{{$total_facture_monthly_dollar[$i] - $total }}&nbsp;$</td>
                                @endif
                            </tr>
                    @endfor
                    @for($i = 0; $i<count($keys_facture_euro); $i++)
                            @php
                                $total = 0
                            @endphp
                            @php
                                $compteur = 0
                            @endphp
                            <tr>

                            <td>{{Carbon\Carbon::parse($keys_facture_euro[$i])->format('m/Y') }}</td>
                            <td>{{$total_facture_monthly_euro[$i]}}&nbsp;€</td>
                            @for($j = 0; $j<count($keys_avoir_euro); $j++)
                                @if($keys_facture_euro[$i]===$keys_avoir_euro[$j])
                                    <td>{{$total_avoir_monthly_euro[$j]}}&nbsp;€</td>
                                    @php
                                        $total = $total_avoir_monthly_euro[$j]
                                    @endphp
                                    @break
                                @endif
                                @php
                                    $compteur++
                                @endphp
                            @endfor
                            @if($compteur === count($keys_avoir_euro))
                            <td></td>
                            <td>{{$total_facture_monthly_euro[$i]}}&nbsp;€</td>
                            @else
                            <td>{{$total_facture_monthly_euro[$i] - $total }}&nbsp;€</td>
                            @endif
                            </tr>
                    @endfor
                    <tr>
                        <td class="font-weight-bold" >
                            Total &nbsp;DH
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_facture_dirham = 0
                            @endphp
                            @for($i=0 ;$i<count($total_facture_monthly_dirham);$i++)
                                 @php
                                     $somme_facture_dirham += $total_facture_monthly_dirham[$i]
                                 @endphp
                            @endfor
                            {{$somme_facture_dirham}}&nbsp;DH
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_avoir_dirham = 0
                            @endphp
                            @for($i=0 ;$i<count($total_avoir_monthly_dirham);$i++)
                                @php
                                    $somme_avoir_dirham += $total_avoir_monthly_dirham[$i]
                                @endphp
                            @endfor
                            {{$somme_avoir_dirham}}&nbsp;DH</td>
                        <td class="font-weight-bold" >
                            {{$somme_facture_dirham - $somme_avoir_dirham}}&nbsp;DH
                        </td>
                    </tr>
                    <tr>

                        <td class="font-weight-bold" >
                            Total &nbsp;$
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_facture_dollar = 0
                            @endphp
                            @for($i=0 ;$i<count($total_facture_monthly_dollar);$i++)
                                 @php
                                     $somme_facture_dollar += $total_facture_monthly_dollar[$i]
                                 @endphp
                            @endfor
                            {{$somme_facture_dollar}}&nbsp;$
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_avoir_dollar = 0
                            @endphp
                            @for($i=0 ;$i<count($total_avoir_monthly_dollar);$i++)
                                @php
                                    $somme_avoir_dollar += $total_avoir_monthly_dollar[$i]
                                @endphp
                            @endfor
                            {{$somme_avoir_dollar}}&nbsp;$</td>
                        <td class="font-weight-bold" >
                            {{$somme_facture_dollar - $somme_avoir_dollar}}&nbsp;$
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" >
                            Total &nbsp;€
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_facture_euro = 0
                            @endphp
                            @for($i=0 ;$i<count($total_facture_monthly_euro);$i++)
                                 @php
                                     $somme_facture_euro += $total_facture_monthly_euro[$i]
                                 @endphp
                            @endfor
                            {{$somme_facture_euro}}&nbsp;€
                        </td>
                        <td class="font-weight-bold" >
                            @php
                                $somme_avoir_euro = 0
                            @endphp
                            @for($i=0 ;$i<count($total_avoir_monthly_euro);$i++)
                                @php
                                    $somme_avoir_euro += $total_avoir_monthly_euro[$i]
                                @endphp
                            @endfor
                            {{$somme_avoir_euro}}&nbsp;€</td>
                        <td class="font-weight-bold" >
                            {{$somme_facture_euro - $somme_avoir_euro}}&nbsp;€
                        </td>
                    </tr>

                </tbody>
              </table>
        </div>
     </div>
</div>


@endsection
@section('script')

@endsection


