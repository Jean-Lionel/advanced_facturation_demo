@extends('layouts.app')

@section('content')
@include('products._header_product')
@include('journals.header')

<div>
    @livewire('stock.control-stock')
</div>
@endsection
