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
				<th>
					
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
					<td></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@stop