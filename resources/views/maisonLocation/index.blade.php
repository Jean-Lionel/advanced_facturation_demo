@extends('layouts.app')

@section('content')
@include('maisonLocation._header')

<div>
	<div class="row">
		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('maison-location.create') }}"
			class="btn btn-primary btn-sm">Nouveau</a>
			<h4 class="text-center">
				Liste biens ou service à Louer 
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="search" class="form-control form-control-sm" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>
	

	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Montant</th>
				<th scope="col">Description</th>
				<th scope="col">Client</th>
				<th scope="col">Tax (%)</th>
				<th scope="col">Date de création</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($maisonLocations as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->name}}
				</td>
				
				<td>
					{{ $value->montant}}
				</td>

				<td>{{ $value->description }}</td>
				<td>
					{{ $value->clients_count}}
				</td>
				<th scope="col">{{$value->tax }}</th>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('maison-location.show', $value) }}" class="btn btn-outline-info btn-sm mr-2">Locataire</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>


</div>

<div class="col-md-12" style="">
		{{ $maisonLocations->links()}}
</div>


@endsection
