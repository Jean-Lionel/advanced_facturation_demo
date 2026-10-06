@extends('layouts.app')
@section('content')
@include("ventes._header")

<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fa fa-folder-open"></i> Factures en brouillon</h5>
        <a href="{{ route('ventes.create') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Nouvelle facture
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('brouillons.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm mr-2" placeholder="Client ou N° brouillon">
        <button type="submit" class="btn btn-sm btn-primary mr-2">Rechercher</button>
        <a href="{{ route('brouillons.index') }}" class="btn btn-sm btn-secondary">Effacer</a>
    </form>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Type</th>
                <th>Lignes</th>
                <th>Montant</th>
                <th>Créé par</th>
                <th>Dernière modification</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($brouillons as $brouillon)
            <tr>
                <td>{{ $brouillon->id }}</td>
                <td>{{ $brouillon->client_name ?? '—' }}</td>
                <td>{{ $brouillon->type_facture }}</td>
                <td>{{ count($brouillon->lignes ?? []) }}</td>
                <td>{{ number_format($brouillon->amount) }} {{ $brouillon->invoice_currency }}</td>
                <td>{{ $brouillon->user->name ?? '' }}</td>
                <td>{{ $brouillon->updated_at }}</td>
                <td class="d-flex">
                    <a href="{{ route('ventes.create', ['brouillon' => $brouillon->id]) }}" class="btn btn-sm btn-primary mr-2">
                        <i class="fa fa-edit"></i> Reprendre
                    </a>
                    <form action="{{ route('brouillons.destroy', $brouillon) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">Aucun brouillon</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $brouillons->links() }}
</div>
@stop
