@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des Emballages</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('embalage.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
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
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($embalages as $embalage)
                            <tr>
                                <td>{{ $embalage->id }}</td>
                                <td>{{ $embalage->name }}</td>
                                <td>{{ $embalage->typeEmbalage->name ?? 'N/A' }}</td>
                                <td class="text-end">{{ number_format($embalage->price, 2, ',', ' ') }}</td>
                                <td class="text-end">{{ number_format($embalage->quantity, 2, ',', ' ') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('embalage.show', $embalage) }}" class="btn btn-info btn-sm me-1">Voir</a>
                                    <a href="{{ route('embalage.edit', $embalage) }}" class="btn btn-warning btn-sm me-1">Modifier</a>
                                    <form action="{{ route('embalage.destroy', $embalage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet emballage ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun emballage trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
