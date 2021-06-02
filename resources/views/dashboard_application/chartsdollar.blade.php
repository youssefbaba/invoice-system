@extends('admin')
@section('header_content')
<h5 class="text-white ml-4 d-inline text-uppercase"><a href="{{ route('dashapplication.chartdollar') }}" style="color: white;text-decoration: none">Dashboard</a> </h5>
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
        <li class="list-inline-item "><a href="{{route('dashapplication.chartdollar')}}" class="active">STATISTIQUES</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.chiffre_affaire') }}">CHIFFRE D'AFFAIRES</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.encaissements') }}">ENCAISSEMENTS</a></li>
        <li class="list-inline-item"><a href="{{ route('dashapplication.debours') }}">DÉBOURS</a></li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <form action="">
                <div class="form-group">
                  <select class="form-control" id="sampleSelect">
                    <option value="{{ route('dashapplication.charteuro') }}" >Euro (€)</option>
                    <option value="{{ route('dashapplication.chartdollar') }}" selected >Dollar ($)</option>
                    <option value="{{ route('dashapplication.chartdirham') }}" >Dirham (DH)</option>
                  </select>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    {{-- <div class="row">
        <div class="card col-md-12 border-0 mx-auto" >
            <div class="card-header font-weight-bold">
              CHIFRE AFFAIRES PAR MOIS
            </div>
            <div class="card-body">
                {{$chart_chiffre_affaire->container()}}

            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="card col-md-6 border-0" >
            <div class="card-header font-weight-bold ">
              TOTAL FACTURES ET NOMBRE FACTURES PAR MOIS
            </div>
            <div class="card-body">
                {{$chart_factures->container()}}
            </div>
        </div>


        <div class="card col-md-6 border-0" >
            <div class="card-header font-weight-bold ">
              TOTAL DEVIS ET NOMBRE DEVIS PAR MOIS
            </div>
            <div class="card-body">
                {{$chart_devis->container()}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="card col-md-6 border-0" >
            <div class="card-header font-weight-bold ">
              TOTAL AVOIRS ET NOMBRE AVOIRS PAR MOIS
            </div>
            <div class="card-body">
                {{$chart_avoirs->container()}}
            </div>
        </div>
        <div class="card col-md-6 border-0" >
            <div class="card-header font-weight-bold">
              NOMBRE CLIENTS PAR MOIS
            </div>
            <div class="card-body">
                {{$chart_clients->container()}}
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script src="{{ LarapexChart::cdn() }}"></script>
<script src="{{ asset('js/Chart.min.js') }}" charset="utf-8"></script>
{!! $chart_factures->script() !!}
{!! $chart_devis->script() !!}
{!! $chart_clients->script() !!}
{!! $chart_chiffre_affaire->script() !!}
{!! $chart_avoirs->script() !!}
<script >
    $("select").click(function() {
    var open = $(this).data("isopen");
    if(open) {
      window.location.href = $(this).val()
    }
    //set isopen to opposite so next time when use clicked select box
    //it wont trigger this event
    $(this).data("isopen", !open);
  });
</script>


@endsection

