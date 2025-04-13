@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Transactions</h1>
        <a href="{{ route('advanced.transactions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle Transaction
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Membre</th>
                            <th>Description</th>
                            <th>Fichiers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date_transaction->format('d/m/Y') }}</td>
                                <td>{{ number_format($transaction->montant, 2, ',', ' ') }} €</td>
                                <td>{{ $transaction->transactionType->name }}</td>
                                <td>{{ $transaction->member->firstname }} {{ $transaction->member->last_name }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $transaction->files->count() }} fichier(s)
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('advanced.transactions.show', $transaction) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- <a href="{{ route('advanced.transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('advanced.transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection