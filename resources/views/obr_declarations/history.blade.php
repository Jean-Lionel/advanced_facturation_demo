@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	<h5>Facture en attente</h5>
	<table class="table table-bordered tab-content table-sm">
		<thead>
			<tr>
				<th>#</th>
				<th>Signature de la facture</th>
				<th>Client</th>
				<th>Montant</th>
				<th>Tax</th>
				
				<td>Date</td>
				<th>
					Action
				</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach ($orders as $order)
			{{-- expr --}}
			<tr>
				<td>{{$order->id}}</td>
				<td>{{$order->invoice_signature}}</td>
				<td>{{ $order->client->name }}</td>
				<td>{{ $order->amount }}</td>
				<td>{{ $order->tax }}</td>
				
				<td>{{ $order->created_at }}</td>
				<td>
					<div id="order_{{$order->id}}">
						<button onclick="cancelIncome('{{$order->invoice_signature}}',{{$order->id}} )">Annuler</button>
					</div>
								
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop

@section('javascript')

<script>
	function cancelIncome(invoice_signature, order_id){
		 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');



		 $("#order_"+order_id).html(`<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
</div>`)
		$.ajax({
				url: 'cancelInvoice',
				type: 'post',
				data: {
					invoice_signature :invoice_signature,
					_token: CSRF_TOKEN,
					order_id: order_id,
					
				},
				success: function (data) {
					console.log(data);
					$("#order_"+order_id).html(`
						<span class="bg-warning">${data.msg} </span>
						`)
				}
			});
	}
</script>

@stop