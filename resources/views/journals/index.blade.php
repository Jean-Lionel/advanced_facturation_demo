@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')


<div class="row">

	<div class="col-md-12">
		@include('journals.header')

		<table class="table table-sm ">
			<thead class="table-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">PRODUITS</th>
					<th scope="col">@sortablelink('montant','MONTANT')</th>
					<th scope="col">
						@sortablelink('type_paiement', 'MODE DE PAIMENT')
					</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>


				@foreach($orders as $key => $order)

				<tr>
					<th scope="row">{{ $order->id }}</th>

					<td>
						<ul class="">
							@foreach($order->products as $product)
							<li>{{ $product['name'] }} | Qte : {{ $product['quantite'] }} |
							PRIX : {{ getPrice($product['price'] )}}</li>
							@endforeach

							<li class="text-center list-unstyled">{{ $order->created_at }}</li>

						</ul>
					</td>
					<td>{{ getPrice($order->amount )}}</td>
					<td>{{ $order->type_paiement ?? ""}}</td>
					<td class="d-flex">
						<a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-success mr-2" title="imprimer"> <i class="fa fa-print" ></i></a>

{{--						<form action="{{ route('cancelFactures', $order) }}" method="post">--}}
{{--							@method("DELETE")--}}
{{--							@csrf--}}
{{--							<button type="submit" onclick="return confirm('êtez-vous sûr d\'annuler la facture?')" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fa fa-minus" ></i> </button>--}}
{{--							--}}
{{--						</form>--}}
					</td>

				</tr>

				@endforeach

			</tbody>
		</table>


	</div>

</div>



@stop
