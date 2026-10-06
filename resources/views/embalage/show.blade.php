@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Détails de l'Emballage</span>
                    <div>
                        <a href="{{ route('embalage.edit', $embalage) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('embalage.index') }}" class="btn btn-secondary btn-sm">
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
                                    <td>{{ $embalage->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td>{{ $embalage->name }}</td>
                                </tr>
                                <tr>
                                    <th>Type d'emballage</th>
                                    <td>{{ $embalage->typeEmbalage->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Prix unitaire</th>
                                    <td>{{ number_format($embalage->price, 2, ',', ' ') }} FCFA</td>
                                </tr>
                                <tr>
                                    <th>Quantité en stock</th>
                                    <td>{{ number_format($embalage->quantity, 2, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <th>Valeur totale</th>
                                    <td>{{ number_format($embalage->price * $embalage->quantity, 2, ',', ' ') }} FCFA</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $embalage->description ?? 'Non renseignée' }}</td>
                                </tr>
                                <tr>
                                    <th>Date de création</th>
                                    <td>{{ $embalage->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Dernière mise à jour</th>
                                    <td>{{ $embalage->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <form action="{{ route('embalage.destroy', $embalage) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet emballage ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>

                        <a href="{{ route('embalage-mouvement.create', ['embalage_id' => $embalage->id]) }}" class="btn btn-primary">
                            <i class="fas fa-exchange-alt me-1"></i> Nouveau mouvement
                        </a>

                        <a href="{{ route('embalage.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-1"></i> Voir la liste
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section pour afficher l'historique des mouvements -->
            <div class="card mt-4">
                <div class="card-header">
                    Historique des mouvements
                </div>
                <div class="card-body">
                    @if($embalage->mouvements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Quantité</th>
                                        <th>Référence</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($embalage->mouvements->sortByDesc('created_at') as $mouvement)
                                        <tr>
                                            <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($mouvement->type === 'entree')
                                                    <span class="badge bg-success">Entrée</span>
                                                @else
                                                    <span class="badge bg-danger">Sortie</span>
                                                @endif
                                            </td>
                                            <td class="text-end">{{ number_format($mouvement->quantity, 2, ',', ' ') }}</td>
                                            <td>{{ $mouvement->reference ?? 'N/A' }}</td>
                                            <td>{{ $mouvement->notes ?? 'Aucune note' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0">Aucun mouvement enregistré pour cet emballage.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
