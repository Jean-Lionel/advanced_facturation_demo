@extends('layouts.app')


@section('content')

@include('products._header_product')

<div>
    @livewire('stocks.comand-product', ['stock' => $stock])
</div>
@endsection
