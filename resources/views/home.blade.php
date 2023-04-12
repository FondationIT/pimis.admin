@extends('layouts.app')

@section('content')
 @include('dash')
 @include('agent')

 @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('pimis')
 @endif

 @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'MAG' || Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('stock')
 @endif

 @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'R.H' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('rh')
 @endif

 @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'CAISS' || Auth::user()->role == 'COMPT1'|| Auth::user()->role == 'COMPT2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('finance')
 @endif

 @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'C.P' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
    @include('projet')
 @endif
@endsection
