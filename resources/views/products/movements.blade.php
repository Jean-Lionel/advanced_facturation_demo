@extends('layouts.app')


@section('content')

<div>
	<div>
		<h4 class="text-center">Mouvement du Produit # {{ $item_id }} </h4>
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

			@foreach ($mouvements as $item)

            <tr>

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
