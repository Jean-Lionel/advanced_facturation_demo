@extends('layouts.app')

@section('content')

<div>
    @if (env('APP_USE_ABONEMENT', false))
        <div>
            @include('compte._header')
        </div>
    @endif
	@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
		{{ session('success') }}
	</div>
	@endif
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
        <div>
            <a href="{{ route('assurances.index') }}"
            class="btn btn-primary btn-sm">Assurances</a>
        </div>
		<div class="col-12">
			<h2>Le Nombre total des clients : <b>{{ $nombre_total_clients }}</b></h2>
			@if (request('search'))
				<p class="text-muted mb-2">
					{{ $clients->total() }} résultat(s) pour « {{ request('search') }} »
					<a href="{{ route('clients.index') }}" class="ml-2">Effacer la recherche</a>
				</p>
			@endif
		</div>
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

	<div class="table-responsive">
	<table class="table table-sm table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">NUMERO</th>
				<th scope="col">NOM</th>
				<th scope="col">TELEPHONE</th>
				<th scope="col">NIF</th>
				<th scope="col">Adresse</th>
				@if (env('APP_USE_ABONEMENT', false))
                <th scope="col">Commissionnaire</th>
				<th scope="col">Fournisseur</th>
                <th>Porteur</th>
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
				<td>{{ $clients->firstItem() + $loop->index }}</td>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->name}}
				</td>
				<td>{!! $value->telephone ? e($value->telephone) : '<span class="text-muted">-</span>' !!}</td>
				<td>
					{{ $value->customer_TIN}}
				</td>

				<td>
					{{ $value->addresse}}
				</td>

				@if (env('APP_USE_ABONEMENT', false))
                <td>
                    {{ $value->is_commissionaire ? "on" : "" }}</td>
				<td>
					{{ $value->is_fournisseur}}
				</td>
                <td>{{ $value?->commissionaire?->name}}</td>
				<td>{{ $value->compte->name  ?? "" }}</td>
				@endif

				<td class="text-nowrap">{{ $value->created_at ? $value->created_at->format('d/m/Y H:i') : '-' }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('clients.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
					<form class="form-delete" action="{{ route('clients.destroy' , $value) }}" style="display: inline;" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button class="btn btn-outline-danger btn-sm delete_client"
						onclick="return confirm('Voulez-vous vraiment supprimer ce client ?')"
						>Supprimer</button>
						@if(env('APP_USE_ABONEMENT', false))
						<a href="{{ route('clients_abones', $value->id) }}" class="mr-2 btn btn-outline-info btn-sm">Abonée</a>
						<a href="{{ route('make_commissionnaire', $value->id) }}" class="mr-2 btn btn-outline-info btn-sm">Commissionnaire</a>

						@endif
					</form>
				</td>
			</tr>
			@endforeach
			@if ($clients->isEmpty())
				<tr>
					<td colspan="20" class="text-center text-muted py-4">Aucun client trouvé</td>
				</tr>
			@endif
		</tbody>
	</table>
	</div>
</div>
<div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
	<small class="text-muted mb-2">
		@if ($clients->total())
			Affichage de {{ $clients->firstItem() }} à {{ $clients->lastItem() }} sur {{ $clients->total() }} client(s)
		@endif
	</small>
	{{ $clients->links() }}
</div>
@endsection
