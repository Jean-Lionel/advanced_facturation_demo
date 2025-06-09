@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Détails du versement #{{ $versement->id }}</h4>
                    <div class="btn-group">
                        <a href="{{ route('versement.edit', $versement) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('versement.destroy', $versement) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce versement ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">ID :</div>
                        <div class="col-md-8">{{ $versement->id }}</div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">Utilisateur :</div>
                        <div class="col-md-8">{{ $versement->user->name ?? 'N/A' }}</div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">Type de versement :</div>
                        <div class="col-md-8">{{ $versement->versementType->name ?? 'Non défini' }}</div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">Montant :</div>
                        <div class="col-md-8">{{ number_format($versement->montant, 2, ',', ' ') }} €</div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">Date de transaction :</div>
                        <div class="col-md-8">{{ $versement->date_transaction->format('d/m/Y') }}</div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-4 fw-bold">Description :</div>
                        <div class="col-md-8">{{ $versement->description ?? 'Aucune description' }}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 fw-bold">Date de création :</div>
                        <div class="col-md-8">{{ $versement->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>


                <div class="card-footer">
                    <a href="{{ route('versement.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
