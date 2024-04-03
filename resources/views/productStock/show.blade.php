
    @extends('layouts.app')

    @section('content')
    @include('products._header_product')
       <div>
        @livewire('stocks.product-stock-component', ['stock' => $productStock])
       </div>
    @endsection

