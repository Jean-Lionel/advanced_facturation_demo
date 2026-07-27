@extends('layouts.app')

@section('content')
<div class="vente-page">
    @include('ventes._header')
    @livewire('facture-avoir')
</div>
@endsection
