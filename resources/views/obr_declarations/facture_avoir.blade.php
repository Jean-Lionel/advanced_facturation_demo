@extends('layouts.app')

@section('content')
@include("ventes._header")

<div>
    @livewire('facture-avoir')
</div>
@endsection
