@extends('layouts.app')
@section('content')
<div class="app-page">
    @include('products._header_product')

    <livewire:produits.importation-dmc />
</div>
@endsection
