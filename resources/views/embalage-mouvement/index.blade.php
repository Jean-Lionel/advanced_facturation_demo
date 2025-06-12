@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @include('versement._header')
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Historique des Mouvements d'Emballages</span>
                    <a href="{{ route('embalage-mouvement.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouveau Mouvement
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Emballage</th>
                                    <th>Client</th>
                                    <th>Quantité</th>
                                    <th>Utilisateur</th>
                                    <th>Date retour</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mouvements as $mouvement)
                                    <tr>
                                        <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($mouvement->type === 'entree')
                                                <span class="badge bg-success">Entrée</span>
                                            @else
                                                <span class="badge bg-danger">Sortie</span>
                                            @endif
                                        </td>
                                        <td>{{ $mouvement->embalage->name ?? 'N/A' }}</td>
                                        <td>{{ $mouvement->client->name ?? 'N/A' }}</td>
                                        <td class="text-end">{{ number_format($mouvement->quantity, 2, ',', ' ') }}</td>
                                        <td>{{ $mouvement->user->name ?? 'N/A' }}</td>
                                        <td>{{ $mouvement->date_retour ? \Carbon\Carbon::parse($mouvement->date_retour)->format('d/m/Y') : '-' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('embalage-mouvement.show', $mouvement) }}" class="btn btn-info btn-sm me-1" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($mouvement->type === 'sortie' && !$mouvement->date_retour)
                                                <form action="{{ route('embalage-mouvement.retour', $mouvement) }}" method="POST" class="me-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Enregistrer le retour">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('embalage-mouvement.destroy', $mouvement) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce mouvement ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucun mouvement enregistré</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $mouvements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
