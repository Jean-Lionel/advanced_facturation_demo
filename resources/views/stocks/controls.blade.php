@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('journals.header')

    @livewire('stock.control-stock')
</div>
@endsection
