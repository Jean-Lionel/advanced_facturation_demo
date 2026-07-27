@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouveau produit</h2>
        </header>

        <form action="{{ route('products.store') }}" method="post">
            @method('post')
            @include('products._form')
        </form>
    </div>
</div>
@endsection
