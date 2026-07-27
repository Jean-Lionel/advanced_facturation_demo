@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')
    @livewire('obr-stock.retour-product')
</div>
@stop
