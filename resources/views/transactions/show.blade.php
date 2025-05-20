@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Transaction du {{ $transaction->date_transaction->format('d/m/Y') }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Montant:</strong>
                        <p>{{ number_format($transaction->montant, 2, ',', ' ') }} FBU</p>
                    </div>

                    <div class="mb-3">
                        <strong>Type de transaction:</strong>
                        <p>{{ $transaction->transactionType->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Membre:</strong>
                        <p>{{ $transaction->member->firstname }} {{ $transaction->member->last_name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $transaction->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Fichiers attachés:</strong>
                        <div class="row">
                            @foreach($transaction->files as $file)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $file->name }}</h6>
                                            <a href="{{ asset($file->file_url) }}" class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-download"></i> Télécharger
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                   <img src="{{ asset($file->file_url) }}" alt="{{ $file->name }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('advanced.transactions.edit', $transaction) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('advanced.transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                        <a href="{{ route('advanced.transactions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
