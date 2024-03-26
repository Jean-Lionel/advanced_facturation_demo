@extends('layouts.app')


@section('content')
<div class="noprint">
    @include('products._header_product')
</div>
@include('products.barcode_style')
<div class="container">
    <button class="print-button noprint" id="print-button"><span class="print-icon"></span></button>

    <div class="bar_code_lis A4">
        @foreach ($products as $product)
        <div>
            <div>
                {!! DNS2D::getBarcodeHTML("{$product->id}#{$product->name}", 'QRCODE', 5,5,'black', true) !!}
                <span> {{ $product->name  }}</span>
            </div>
        </div>
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
