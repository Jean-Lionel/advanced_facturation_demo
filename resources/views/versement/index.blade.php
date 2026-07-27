@extends('layouts.app')

@section('content')
<div class="app-page">
    @include("versement._header")

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des versements</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('versement.create') }}" class="btn btn-primary btn-sm">Nouveau versement</a>
            </div>
        </header>

        @if(session('success'))
            <div class="app-card-body pb-0">
                <div class="alert alert-success mb-0">
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
                            <th>Utilisateur</th>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($versements as $versement)
                            <tr>
                                <td>{{ $versement->id }}</td>
                                <td>{{ $versement->user->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($versement->description, 30) }}</td>
                                <td>{{ number_format($versement->montant, 2, ',', ' ') }} Fbu</td>
                                <td>{{ $versement->versementType->name ?? 'Non défini' }}</td>
                                <td>{{ $versement->date_transaction->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('versement.show', $versement) }}" class="btn btn-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('versement.edit', $versement) }}" class="btn btn-warning" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('versement.destroy', $versement) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce versement ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun versement trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $versements->links() }}
        </div>
    </div>
</div>
@endsection
