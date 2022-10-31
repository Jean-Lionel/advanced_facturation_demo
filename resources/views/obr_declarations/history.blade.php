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
					

					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop

