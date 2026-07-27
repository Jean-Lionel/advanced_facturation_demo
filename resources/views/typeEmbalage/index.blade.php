@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('versement._header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des Types d'Emballage</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('typeEmbalage.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        @if (session('success'))
            <div class="app-card-body pb-0">
                <div class="alert alert-success mb-0" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($typeEmbalages as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->description ?? 'N/A' }}</td>
                                <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('typeEmbalage.show', $type) }}" class="btn btn-info btn-sm me-1">Voir</a>
                                    <a href="{{ route('typeEmbalage.edit', $type) }}" class="btn btn-warning btn-sm me-1">Modifier</a>
                                    <form action="{{ route('typeEmbalage.destroy', $type) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'emballage ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun type d'emballage trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
