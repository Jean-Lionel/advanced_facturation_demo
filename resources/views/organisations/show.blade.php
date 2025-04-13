@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $organisation->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $organisation->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Créé par:</strong>
                        <p>{{ $organisation->user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Créé le:</strong>
                        <p>{{ $organisation->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('advanced.organisations.edit', $organisation) }}" class="btn btn-warning me-2">Modifier</a>
                        <a href="{{ route('advanced.organisations.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection