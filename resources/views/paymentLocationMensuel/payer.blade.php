@extends('layouts.app')

@section('content')
@include('maisonLocation._header')

<div class="container-fluid py-3">
    @livewire('location.payment-mensuel-form', [
        'maisonLocation' => $maisonLocation->id,
        'periode' => $periode->id,
        'returnTo' => $returnTo,
    ])
</div>
@endsection