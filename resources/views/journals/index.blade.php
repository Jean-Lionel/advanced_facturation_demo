@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')

<style>

.numbers {
    white-space: nowrap;
}

</style>

<div class="row">

	<div class="col-md-12">
		@include('journals.header')

        <div class="row">
            <form action="" class="col-4">
                <div class="row">
                    <div class="col-6">
                        <span>DU</span>
                        <input type="date" class="form-control form-control-sm" name="startDate"
                        value="{{ $startDate }}"
                        >
                    </div>
                    <div class="col-6">
                        <span>Au</span>
                        <input type="date" class="form-control form-control-sm" name="endDate"
                        value="{{ $endDate }}"
                        >
                    </div>
                    <div class="col-6 noprint">
                        <button type="submit" class="btn btn-info btn-sm">
                            Ok
                        </button>
                    </div>

                </div>
            </form>

            <div class=" col-4">
                <div class="gap-3 d-flex">
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
                <div class="gap-3 d-flex">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>MONTANT TOTAL DES FACTURE TVAC</th>
                            <th class="numbers">
                            {{ getPrice($total_amount) }}
                            </th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  TVA</th>
                            <th class="numbers">{{ getPrice($total_tva) }}</th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  HTVA</th>
                            <th class="numbers">{{ getPrice($total_amount_tax) }}</th>
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
					<th scope="col" class="noprint">
						@sortablelink('type_paiement', 'MODE DE PAIMENT')
					</th>
					<th scope="col" class="noprint">
                    TYPE DE FACTURE
					</th>
                    <th>
                        TVA
                    </th>
					<th scope="col" class="noprint">Action</th>
				</tr>
			</thead>
			<tbody>


				@foreach($orders as $key => $order)

				<tr>
					<th scope="row">{{ $order->id }}</th>

					<td class="">
						<ul class="">
							@foreach($order->products as $product)
							<li>{{ $product['name'] }} | Qte : {{ $product['quantite'] }} |
							PRIX : {{ getPrice($product['price'] )}}</li>
							@endforeach

							<li class="text-center list-unstyled">{{ $order->created_at }}</li>

							<li class="">
                               Client :  <b>{{ $order->client->name ?? "" }}</b>
                            </li>

                            
						</ul>
                       
					</td>
					<td class="numbers">{{ getPrice($order->amount )}}</td>
					<td class="noprint">{{ $order->type_paiement ?? ""}}</td>
					<td class="noprint">{{ $order->invoice_type ?? ""}}</td>
                    <td class="numbers">
                        {{ getPrice($order->tax ) }}
                    </td>
					<td class="d-flex noprint" >
                     
                    
						<a href="{{ route('orders.show', $order) }}" class="mr-2 btn btn-sm btn-success" title="imprimer"> <i class="fa fa-print" ></i></a>


					</td>

				</tr>

				@endforeach

			</tbody>
		</table>


	</div>

</div>



@stop
