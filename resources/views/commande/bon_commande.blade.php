@extends('layouts.app')


@section('content')
@include('products._header_product')

<div>
    @livewire('commands.bon-comand-compont')
</div>

@stop
