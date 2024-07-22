@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

@if(USE_ABONEMENT)
@include('journals._header_file')
@endif

<div>
    @livewire('rapports.rapport-revenu')
</div>
@stop