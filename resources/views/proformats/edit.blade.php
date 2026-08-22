@extends('layouts.app')
@section('content')
@include("ventes._header")
<div class="mb-3">
    <a href="{{ route('proformats.index') }}" class="btn btn-secondary btn-sm">
        <i class="fa fa-arrow-left"></i> Retour à la liste
    </a>
    <span class="ml-3">
        <strong>Modification du Proforma #{{ $proformat->id }}</strong>
    </span>
</div>
@livewire('ventes.service-vente', ['proformat' => $proformat])
@stop
