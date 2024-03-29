@extends('layouts.app')

@section('content')
<div class="noprint">
    @include('products._header_product')

    <div>
        <form action="" class="d-flex justify-content-between mb-3 d-gap-3">
            <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Rechercher ici ">
            <input type="number" name="quantite" class="form-control form-control-sm" value="{{ $quantite }}" placeholder="Quantite ">
            <input type="number" name="occurence" class="form-control form-control-sm" value="{{ $occurence }}" placeholder="Nombre par Pieces ">

            <input type="submit" class="btn btn-primary btn-sm" value="Rechercher">

        </form>
    </div>
</div>
@include('products.barcode_style')
<div class="container">
    <button class="print-button noprint" id="print-button"><span class="print-icon"></span></button>
    <div class="bar_code_lis A4">
        @foreach ($products as  $product)

        @for ($i = 0; $i < $occurence; $i++)
        <div>

            <div>
                {!! DNS2D::getBarcodeHTML("{$product->id}#{$product->name}", 'QRCODE', 5,5,'black', true) !!}
                <span> {{ $product->name  }}</span>
            </div>
        </div>
        @endfor

        @endforeach
    </div>
</div>
@stop

@section('javascript')
<script>
    $("#print-button").click(function(){
       window.print();
    });
</script>
@stop
