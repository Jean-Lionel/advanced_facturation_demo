@extends('layouts.app')

@section('content')

<div>
	@if (session('error'))
	<div
	class="alert alert-primary"
	role="alert"
	>
	<h4 class="alert-heading">{{ session('error') }}</h4>
	
</div>
@endif

</div>
<div>
	<div class="row">
		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('clients.create') }}"
			class="btn btn-primary btn-sm">Ajouter</a>
			<h4 class="text-center">
				Liste des clients
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="search" class="form-control form-control-sm" placeholder="Rechercher ici " name="search" value="{{ \Request::get('search') ?? '' }}">
			</form>
		</div>
	</div>
	
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">NUMERO</th>
				<th scope="col">NOM</th>
				<th scope="col">TELEPHONE</th>
				<th scope="col">NIF</th>
				<th scope="col">Adresse</th>
				@if (env('APP_USE_ABONEMENT', false))
				<th scope="col">Fournisseur</th>
				<th>Abonnées</th>
				@endif
				<th>Date</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach ($clients as $value)
			{{-- expr description  --}}
			<tr>
				<td>{{ ++$loop->index }}</td>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->name}}
				</td>
				<td>{{ $value->telephone }}</td>
				<td>
					{{ $value->customer_TIN}}
				</td>
				
				<td>
					{{ $value->addresse}}
				</td>
				
				@if (env('APP_USE_ABONEMENT', false))
				<td>
					{{ $value->is_fournisseur}}
				</td>
				<td>{{ $value->compte->name  ?? "" }}</td>
				@endif
				
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					{{--  <a href="{{ route('clients.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>  --}}
					<form class="form-delete" action="{{ route('clients.destroy' , $value) }}" style="display: inline;" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button class="btn btn-outline-danger btn-sm delete_client"
						
						onclick="return confirm('Are you sure you want to delete this client ?')"
						
						>Supprimer</button>
						@if(env('APP_USE_ABONEMENT', false))
						<a href="{{ route('clients_abones', $value->id) }}" class="btn btn-outline-info btn-sm mr-2">Abonée</a>
						<a href="{{ route('make_commissionnaire', $value->id) }}" class="btn btn-outline-info btn-sm mr-2">Commissionnaire</a>
						
						@endif
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-12" style="height: 20px; overflow: hidden;">
	{{ $clients->links()}}
</div>
@endsection
