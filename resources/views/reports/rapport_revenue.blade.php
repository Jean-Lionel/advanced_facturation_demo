@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

@if(env('APP_USE_ABONEMENT', false))
@include('journals._header_file')
@endif

<div>
    @livewire('rapports.rapport-revenu')
</div>
@stop