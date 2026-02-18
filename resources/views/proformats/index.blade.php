@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div class="row">

	<div class="col-md-12">
		@include('journals.header')
	</div>

    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-4">
                <h5>Liste des Proformas</h5>
            </div>
            <div class="col-md-5">
                <form action="{{ route('proformats.index') }}" method="GET" id="searchForm">
                    <input type="hidden" name="sort" value="{{ $sort ?? 'desc' }}">
                    <input type="search" name="search" class="form-control form-control-sm"
                        value="{{ $search ?? '' }}"
                        placeholder="Rechercher par client ou service...">
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ route('proformats.index') }}" method="GET" id="sortForm">
                    <input type="hidden" name="search" value="{{ $search ?? '' }}">
                    <select name="sort" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="desc" {{ ($sort ?? 'desc') === 'desc' ? 'selected' : '' }}>Plus récent</option>
                        <option value="asc" {{ ($sort ?? 'desc') === 'asc' ? 'selected' : '' }}>Plus ancien</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Client</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date d'entrée</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proformats as $proformat)
                <tr>
                    <td>{{ $proformat->id }}</td>
                    <td>
                        <ul>
                            @foreach($proformat->products as $product)
                                <li>
                                    {{ $product['name'] }} X  {{ $product['quantite'] }}
                                    <b>{{ number_format($product['price'], 2) }}</b>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $proformat->client->name ?? '-' }}</td>
                    <td><b>{{ number_format($proformat->amount, 2) }}</b></td>
                    <td>{{ $proformat->created_at }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('proformats.show', $proformat) }}" class="mr-2 btn btn-sm btn-success" title="Imprimer">
                                <i class="fa fa-print"></i>
                            </a>
                            <form action="{{ route('proformats.destroy', $proformat) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce proforma ?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun proforma trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $proformats->links() }}
        </div>
    </div>
</div>

@stop