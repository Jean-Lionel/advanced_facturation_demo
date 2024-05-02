@extends('layouts.app')

{{-- {"id":2,"code_product":"Tempora similique te","name":"Kameko Leblanc","marque":"Ad enim ea non numqu","unite_mesure":"Rem dolor magna veni","quantite":75,"quantite_alert":100,"price":390,"price_max":687,"price_min":35,"date_expiration":"2013-11-30","description":"Rem commodo aliquam","category_id":1,"created_at":"2020-12-05T15:11:59.000000Z","updated_at":"2020-12-05T15:11:59.000000Z","deleted_at":null}
 --}}

@section('content')
@include('products._header_product')

<div class="card-group">
  <div class="card">
    <div class="card-body">
    	<ul class="list-group list-group-flush">
			<li class="list-group-item"><b>CODE DE PRODUIT</b> : {{ $product->code_product }}</li>
			<li class="list-group-item"><b>DESIGNATION</b> : {{ $product->name }}</li>
			<li class="list-group-item"><b>MARQUE </b> : {{  $product->marque}}</li>
			<li class="list-group-item"><b>Le dernier mis à jour  </b> : {{  $product->updated_at}}</li>

		</ul>



    </div>
  </div>
  <div class="card">

    <div class="card-body">
      <ul class="list-group list-group-flush">
			<li class="list-group-item"><b>UNITE DE MESURE </b> : {{ $product->unite_mesure }}</li>
			<li class="list-group-item"><b>QUANTITE EN STOCK</b> :
				@if ($product->quantite <= $product->quantite_alert)
					{{-- expr --}}
					<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>
				@endif

				 <span class="{{ $product->quantite <= $product->quantite_alert ? 'text-danger' : '' }}">{{ $product->quantite  .' '. $product->unite_mesure}}
				 </span>
				</li>
			<li class="list-group-item"><b>QUANTITE D ALERTER </b> : {{  $product->quantite_alert}}</li>
			<li class="list-group-item"><b>QUANTITE EN STOCK </b> : {{  $product->quantite}}</li>


		</ul>


    </div>
  </div>
  <div class="card">
        <div class="card-body">
    	<ul class="list-group list-group-flush">
			<li class="list-group-item"><b>PRIX </b> : {{  getPrice($product->price)}}</li>
			<li class="list-group-item"><b>PRIX MINIMUM</b> : {{ getPrice($product->price_min) }}</li>
			<li class="list-group-item"><b>PRIX MAXIMUM </b> : {{ getPrice(  $product->price_max)}}</li>
		</ul>

    </div>
  </div>
</div>

<div>

	<div class="card justify-content-center">
		{!! nl2br($product->description) !!}
	</div>
</div>

<div>

    <table class="table table-sm table-stripped">
        <thead>
            <tr>
                <td>STOCK</td>
                <td>PRODUCT</td>
                <td>PRIX DE REVIENT</td>
                <td>QUANTITE ENTRE</td>
                <td>QUANTITE RESTAN EN STOCK</td>
            </tr>
        </thead>

        <tbody>

            @foreach ($product->productDetails as $item)
                <tr>
                    <td>{{ $item->stock_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $item->prix_revient }}</td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ $item->quantite_restant }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>


@stop
