@extends('layouts.app')

@section('content')

<div>
	<table class="table table-bordered tab-content table-sm">
		<thead>
			<tr>
				<th>#</th>
				<th>Client</th>
				<th>Montant</th>
				<th>Tax</th>
				<td>Product</td>
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
					<td>{{ $order->client->name }}</td>
					<td>{{ $order->amount }}</td>
					<td>{{ $order->tax }}</td>
					<td>@dump( $order->products)</td>
					<td>{{ $order->created_at }}</td>
					<td>
						<button onclick="sendInvoice({{$order->id}})">Envoyer</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop

@section('javascript')

<script>
	function sendInvoice(invoince_id){
		
		$.ajax({
				url: 'sendInvoinceToObr/'+invoince_id,
				type: 'get',
				success: function (data) {
					console.log(data);
				}
			});
	}
</script>

@stop