@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Détails du Mouvement #{{ $mouvement->id }}</span>
                    <div>
                        <a href="{{ route('embalage-mouvement.edit', $mouvement) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('embalage-mouvement.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th class="w-25">ID</th>
                                    <td>{{ $mouvement->id }}</td>
                                </tr>
                                <tr>
                                    <th>Type de mouvement</th>
                                    <td>
                                        @if($mouvement->type === 'entree')
                                            <span class="badge bg-success">Entrée</span>
                                        @else
                                            <span class="badge bg-danger">Sortie</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Emballage</th>
                                    <td>{{ $mouvement->embalage->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td>{{ $mouvement->client->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Quantité</th>
                                    <td>{{ number_format($mouvement->quantity, 2, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <th>Date du mouvement</th>
                                    <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @if($mouvement->type === 'sortie')
                                    <tr>
                                        <th>Date de retour prévue</th>
                                        <td>{{ $mouvement->date_retour ? \Carbon\Carbon::parse($mouvement->date_retour)->format('d/m/Y') : 'Non spécifiée' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Statut</th>
                                        <td>
                                            @if($mouvement->date_retour)
                                                <span class="badge bg-success">Retourné le {{ \Carbon\Carbon::parse($mouvement->date_retour)->format('d/m/Y') }}</span>
                                            @else
                                                <span class="badge bg-warning">En attente de retour</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Enregistré par</th>
                                    <td>{{ $mouvement->user->name ?? 'N/A' }}</td>
                                </tr>
                                @if($mouvement->notes)
                                    <tr>
                                        <th>Notes</th>
                                        <td>{{ $mouvement->notes }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <form action="{{ route('embalage-mouvement.destroy', $mouvement) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce mouvement ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>

                        @if($mouvement->type === 'sortie' && !$mouvement->date_retour)
                            <form action="{{ route('embalage-mouvement.retour', $mouvement) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle me-1"></i> Enregistrer le retour
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('embalage-mouvement.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-1"></i> Voir tous les mouvements
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
