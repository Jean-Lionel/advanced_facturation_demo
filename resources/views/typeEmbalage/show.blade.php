@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Détails du Type d'Emballage</span>
                    <div>
                        <a href="{{ route('typeEmbalage.edit', $typeEmbalage) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('typeEmbalage.index') }}" class="btn btn-secondary btn-sm">
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
                                    <td>{{ $typeEmbalage->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td>{{ $typeEmbalage->name }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $typeEmbalage->description ?? 'Non renseignée' }}</td>
                                </tr>
                                <tr>
                                    <th>Date de création</th>
                                    <td>{{ $typeEmbalage->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Dernière mise à jour</th>
                                    <td>{{ $typeEmbalage->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <form action="{{ route('typeEmbalage.destroy', $typeEmbalage) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'emballage ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>

                        <a href="{{ route('typeEmbalage.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-1"></i> Voir la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
