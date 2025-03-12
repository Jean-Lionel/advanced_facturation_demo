@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')

<div class="col-md-12">
		<h5 class="text-center">Historique</h5>

		<div>
			<div class="card card-header">
				<form  class="form">
					<div class="d-flex gap-3">

						<div>
							Du
							<input type="date"  value="{{ $start_date }}" name="start_date" >
						</div>

						<div>
							Au
							<input type="date"  value="{{ $end_date }}" name="end_date" >
						</div>
						<div>
							<input type="submit" value="OK" class="btn btn-sm btn-warning">
						</div>
					</div>
				</form>
			</div>
		</div>

		<table id="fiche_stock" class="table table-sm table-striped" style="width: 100%;">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">DATE</th>
					<th scope="col">No FACTURE</th>
					<th scope="col">NIF FOURNISSEUR</th>
					<th scope="col">NOM DU CLIENT</th>
					<th scope="col">NIF DU CLIENT</th>
					<th scope="col">MHTVA</th>
					<th scope="col">TVA COLL 1</th>
				</tr>
			</thead>
			<tbody>

                {{-- @dump($products) --}}

				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->created_at }}</td>
					<td>{{ $product->id }}</td>
					<td>{{ $product->company->tp_TIN }}</td>
					<td>{{ $product->client->name }}</td>
					<td>{{ $product->client->customer_TIN ?? "" }}</td>
					<td>{{ $product->amount_tax }}</td>
					<td>{{ $product->tax }}</td>
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
