@extends('layouts.app')
@section('content')
<div class="container-fluid table-responsive">
	<div>
		<h4 class="text-center">Mouvement du Produit # {{ $item_id }} </h4>
	</div>
	<div class="info"></div>
	<table id="fiche_stock" class="table display compact table-sm table-responsive" style="width: auto;">
		<thead>
			<tr>
                <th>Désignation </th>
                <th>Qté </th>
                <th>Unité </th>
                <th>Prix Unitaire </th>
                <th>Devise </th>
                <th>Mouvement </th>
                <th>Facture </th>
                <th>Description </th>
                <th>Date </th>
                <th>Envoyé à OBR </th>
                <th>Date d'envoie </th>

			</tr>
		</thead>

		<tbody>

			@foreach ($mouvements as $item)
            <tr>
                <td>{{ $item->item_designation}} </td>
                <td>{{ $item->item_quantity}} </td>
                <td>{{ $item->item_measurement_unit}} </td>
                <td>{{ $item->item_purchase_or_sale_price}} </td>
                <td>{{ $item->item_purchase_or_sale_currency}} </td>
                <td>{{getMouvement($item->item_movement_type) }} </td>
                <td>{{ $item->item_movement_invoice_ref}} </td>
                <td>{{ $item->item_movement_description}} </td>
                <td>{{ $item->item_movement_date}} </td>
                <td>{{ $item->is_send_to_obr}} </td>
                <td>{{ $item->is_sent_at}} </td>

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
