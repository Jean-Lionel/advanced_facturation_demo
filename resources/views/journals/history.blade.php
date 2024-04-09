@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')

<div class="col-md-12">
		<h5 class="text-center">Historique des entrées</h5>

		<table id="fiche_stock" class="table table-sm table-striped" style="width: 100%;">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">DESIGNATION</th>
					<th scope="col">QUANTITE</th>
					<th scope="col">PRIX</th>
					<th scope="col">DATE D'EXPIRATION</th>
					<th scope="col">DATE D'ENTRE</th>
				</tr>
			</thead>
			<tbody>


				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->quantite }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->date_expiration }}</td>
					<td>{{ $product->created_at }}</td>
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
