@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')

<div class="row">

	<div class="col-md-12">
		@include('journals.header')

        <div class="row">
            <form action="" class="col-4">
                <div class="row">
                    <div class="col-6">
                        <span>DU</span>
                        <input type="date" class="form-control  form-control-sm" name="startDate"
                        value="{{ $startDate }}"
                        >
                    </div>
                    <div class="col-6">
                        <span>Au</span>
                        <input type="date" class="form-control form-control-sm" name="endDate"
                        value="{{ $endDate }}"
                        >
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-info btn-sm">
                            Ok
                        </button>
                    </div>
                   
                    
                    
                </div>
            </form>

            <div class=" col-4">
                <div class="d-flex gap-3">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>DATE</th>
                            <th>
                                DU {{ $startDate  }} AU {{ $endDate }}
                            </th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL DE FACTURE</th>
                            <th>{{ getPrice($total_facture) }}</th>
                        </tr>
                    </table>
                </div>

            </div>
            <div class=" col-4">
                <div class="d-flex gap-3">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>MONTANT TOTAL DES FACTURE TVAC</th>
                            <th>
                               {{ getPrice($total_amount) }}
                            </th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  TVA</th>
                            <th>{{ getPrice($total_tva) }}</th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  HTVA</th>
                            <th>{{ getPrice($total_amount_tax) }}</th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

		<table class="table table-sm ">
			<thead class="table-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">PRODUITS</th>
					<th scope="col">@sortablelink('montant','MONTANT')</th>
					<th scope="col">
						@sortablelink('type_paiement', 'MODE DE PAIMENT')
					</th>
                    <th>
                        TVA
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
                    <td>
                        {{ getPrice($order->tax ) }}
                    </td>
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
