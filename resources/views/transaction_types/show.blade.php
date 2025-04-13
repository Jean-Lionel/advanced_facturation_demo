@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $type->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $type->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Créé par:</strong>
                        <p>{{ $type->user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Créé le:</strong>
                        <p>{{ $type->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Transactions associées:</strong>
                        <p>{{ $type->transactions->count() }} transactions</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('advanced.transaction_types.edit', $type) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('advanced.transaction_types.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection