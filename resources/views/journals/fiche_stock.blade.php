@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')


<div class="">
	<div>
		<h4 class="text-center">Mouvement de stock</h4>
	</div>
	<div class="info"></div>

	<form action="{{ route('fiche_stock') }}" method="GET" class="row align-items-end mb-3">
		<div class="col-md-3">
			<label for="start_date" class="form-label">Date de début</label>
			<input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
		</div>
		<div class="col-md-3">
			<label for="end_date" class="form-label">Date de fin</label>
			<input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary w-100">Filtrer</button>
		</div>
	</form>

	<div class="row mb-3">
		<div class="col-md-4">
			<div class="">
				<strong>Quantité totale vendue :</strong> {{ $total_quantite_vendue }}
			</div>
		</div>
		<div class="col-md-4">
			<div class="">
				<strong>Total PV vendu :</strong> {{ getPrice($total_pv_vendu) }}
			</div>
		</div>
	</div>

	<table id="fiche_stock" class="display compact" style="width:100%">
		<thead>
			<tr>
				<th>Code</th>
				<th>Article</th>
				<th>Unité</th>
				<th>St.Initial</th>
				<th>Action</th>
				<th>Qte</th>
				<th>PV</th>
				<th>St.Théoriq.</th>
				<th>Date</th>
			</tr>
		</thead>

		<tbody>

			@foreach ($follow_products as $product)
				{{-- expr --}}
				@php
				$article = json_decode($product->details);
				$total = ($product->action == "VENTE") ?
				$article->quantite + $product->quantite :
				$article->quantite - $product->quantite ;
				$pv = ($product->action == "VENTE") ?
				floatval($article->price ?? 0) * floatval($product->quantite ?? 0) :
				0;

				@endphp
				<tr>
				<td>{{ ++$loop->index }}</td>
				<td>{{ $article->name}} </td>
				<td>{{ $article->unite_mesure }}</td>
				<td>{{ $article->quantite }}</td>
				<td>{{ $product->action }}</td>
				<td>{{ $product->quantite }}</td>
				<td>{{ getPrice($pv) }}</td>
				<td>{{ $total }}</td>
				<td>{{ $product->created_at}}</td>
			</tr>
			@endforeach


		</tbody>
	</table>
</div>

@stop

@section('javascript')

<script>
	$(document).ready( function () {
    $('#fiche_stock').dataTable({
			dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print',
			],
			pagingType: "full_numbers",
			scrollX: true,
	});


} );
</script>

@stop
