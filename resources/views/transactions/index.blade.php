@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Transactions</h1>
        <a href="{{ route('advanced.transactions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle Transaction
        </a>
    </div>

    <!-- Formulaire de recherche -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Rechercher des transactions</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('advanced.transactions.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="date_transaction" class="form-label">Date</label>
                    <input type="date" name="date_transaction" id="date_transaction" class="form-control" value="{{ request('date_transaction') }}">
                </div>

                <div class="col-md-3">
                    <label for="montant" class="form-label">Montant</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" step="0.01" name="montant" id="montant" class="form-control" value="{{ request('montant') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="transaction_type_id" class="form-label">Type de transaction</label>
                    <select name="transaction_type_id" id="transaction_type_id" class="form-control">
                        <option value="">Tous les types</option>
                        @foreach($transaction_types as $type)
                            <option value="{{ $type->id }}" {{ request('transaction_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="member_id" class="form-label">Membre</label>
                    <select name="member_id" id="member_id" class="form-control">
                        <option value="">Tous les membres</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->firstname }} {{ $member->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ request('description') }}">
                </div>

                <div class="col-md-3">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
                </div>

                <div class="col-md-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                    <a href="{{ route('advanced.transactions.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des transactions -->
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
                                        <a href="{{ route('advanced.transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('advanced.transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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