@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div>
	<div class="info"></div>
	<table id="fiche_stock" style="width:100%">
		<thead>
			<tr>     
				<th>Code</th>
				<th>Article</th>
				<th>Unité</th>
				<th>St.Initial</th>
				<th>Entrées</th>
				<th>Sorties</th>
				<th>St.Théoriq.</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
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