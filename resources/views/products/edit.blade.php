@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Modifier produit</h2>
        </header>

        <form action="{{ route('products.update', $product) }}" method="post">
            @method('put')
            @include('products._form',['btnMessage' => 'Modifier'])
        </form>
    </div>
</div>
@endsection
