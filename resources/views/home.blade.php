@extends('layouts.app')
@section('content')
                <div id="contain_image_sidebar">
                <a href="{{route('user')}}"><img src="{{asset('uploads/avatars/'.Auth::user()->avatar)}}" alt="avatar_image" style="width:50px;height:50px;border-radius:50%;margin-left:15%"> <span class="text-light ml-1">@if(Auth::user()->role === 0)
                Utilisateur
                @else
                Administrateur
                @endif </span></a>
                </div>
                <hr style="margin:0;">
                <ul id="nav_sidebar">
                    @if(Auth::user()->role === 1)
                    <li><a href="{{ route('admin') }}" ><i class="fas fa-users"></i><span class="second">&nbsp;&nbsp;Utilisateurs</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    @endif
                    <li><a href="{{route('clients.index')}}" ><i class="fas fa-user"></i><span class="second">&nbsp;&nbsp;Clients</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    <li><a href="{{route('devises.index')}}"><i class="fas fa-calculator"></i><span class="second">&nbsp;&nbsp;Devis</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    <li><a href="{{route('factures.index')}}" ><i class="fas fa-receipt"></i><span class="second">&nbsp;&nbsp;Factures</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    <li><a href="{{route('avoirs.index')}}" ><i class="fas fa-shopping-cart"></i><span class="second">&nbsp;&nbsp;Avoirs</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>

                    @if(Auth::user()->role === 0)
                    <li><a href="{{route('dashboard')}}"><i class="fas fa-chart-line"></i><span class="second">&nbsp;&nbsp;Dash Utilisateur</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    @else
                    <li><a href="{{route('dashboard')}}"><i class="fas fa-chart-line"></i><span class="second">&nbsp;&nbsp;Dash Administrateur</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    @endif
                    @if(Auth::user()->role === 1)
                    <li><a href="#" ><i class="fas fa-tachometer-alt"></i><span class="second">&nbsp;&nbsp;Dash Application</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    @endif
                    <li><a href="{{route('parametre')}}"><i class="fas fa-cog"></i><span class="second" >&nbsp;&nbsp;Paramétres</span><span><i class="fas fa-chevron-right"></i></span></a></li><hr>
                    <li><a href="{{route('deconnexion')}}"><i class="fas fa-sign-in-alt"></i><span class="second" >&nbsp;&nbsp;Déconnexion</span><span><i class="fas fa-chevron-right"></i></span></a></li>
                    <li><a href="#" ><span class="second"><i class="far fa-question-circle"></i>Aide</span></a></li><hr>

                </ul>
@endsection
