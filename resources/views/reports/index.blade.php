@extends('layouts.app')

{{-- Stocke Controller Journal --}}


@section('content')
@include('journals._header_file')
<div class="row">
    <div class="col-md-4">
        @livewire('repports.tax')
    </div>

    <div class="col-md-4"></div>
</div>
@stop
