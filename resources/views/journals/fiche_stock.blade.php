@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div>
	<div>
		<h4 class="text-center">Mouvement de stock</h4>
	</div>
	<div class="info"></div>
	<table id="fiche_stock" class="display compact" style="width:100%">
		<thead>
			<tr>
				<th>Code</th>
				<th>Article</th>
				<th>Unité</th>
				<th>St.Initial</th>
				<th>Action</th>
				<th>Qte</th>
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

				@endphp
				<tr>
				<td>{{ ++$loop->index }}</td>
				<td>{{ $article->name}} </td>
				<td>{{ $article->unite_mesure }}</td>
				<td>{{ $article->quantite }}</td>
				<td>{{ $product->action }}</td>
				<td>{{ $product->quantite }}</td>
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
