@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="noprint">
        @include('products._header_product')
    </div>

    <div class="app-card noprint mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Codes-barres / QR</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('bar_code') }}" method="GET" class="app-toolbar-filters">
                    <div class="app-search">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input type="search" name="search" placeholder="Rechercher ici" value="{{ $search }}">
                    </div>
                    <input
                        type="number"
                        name="quantite"
                        class="form-control form-control-sm"
                        value="{{ $quantite }}"
                        placeholder="Quantité"
                        title="Nombre de produits"
                        min="1"
                        style="width: 110px;"
                    >
                    <input
                        type="number"
                        name="occurence"
                        class="form-control form-control-sm"
                        value="{{ $occurence }}"
                        placeholder="Par pièce"
                        title="Nombre par pièce"
                        min="1"
                        style="width: 110px;"
                    >
                    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="print-button">
                        <i class="fa fa-print"></i> Imprimer
                    </button>
                </form>
            </div>
        </header>

        <div class="app-card-body">
            <div class="app-meta">
                <span>Produits affichés : <b>{{ $products->count() }}</b></span>
                <span class="ml-3">Occurrences : <b>{{ $occurence }}</b></span>
            </div>
        </div>
    </div>

    @include('products.barcode_style')

    <div class="app-card">
        <div class="app-card-body">
            @if ($products->isEmpty())
                <p class="text-muted mb-0 text-center py-4">Aucun produit trouvé.</p>
            @else
                <div class="bar_code_lis A4">
                    @foreach ($products as $product)
                        @for ($i = 0; $i < $occurence; $i++)
                            <div>
                                <div>
                                    {!! DNS2D::getBarcodeHTML("{$product->id}#{$product->name}", 'QRCODE', 5, 5, 'black', true) !!}
                                    <span>{{ $product->name }}</span>
                                </div>
                            </div>
                        @endfor
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $("#print-button").click(function () {
        window.print();
    });
</script>
@stop
