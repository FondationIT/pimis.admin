@extends('layouts.app')

@section('content')
 @include('dash')
 @include('agent')

 @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('pimis')
 @endif

 @if (Auth::user()->role == 'MAG' || Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('stock')
 @endif

 @if (Auth::user()->role == 'R.H' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('rh')
 @endif

 @if (Auth::user()->role == 'CAISS' || Auth::user()->role == 'COMPT' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('finance')
 @endif
@endsection
