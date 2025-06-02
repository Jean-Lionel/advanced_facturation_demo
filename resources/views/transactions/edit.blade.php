@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier Transaction</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('advanced.transactions.update', $transaction->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="date_transaction" class="form-label">Date de la transaction</label>
                            <input type="date" name="date_transaction" id="date_transaction" class="form-control @error('date_transaction') is-invalid @enderror" value="{{ old('date_transaction', $transaction->date_transaction) }}" required>
                            @error('date_transaction')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant</label>
                            <div class="input-group">
                                <span class="input-group-text">BIF</span>
                                <input type="number" step="0.01" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $transaction->montant) }}" required>
                            </div>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transaction_type_id" class="form-label">Type de transaction</label>
                            <select name="transaction_type_id" id="transaction_type_id" class="form-control @error('transaction_type_id') is-invalid @enderror" required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($transaction_types as $type)
                                    <option value="{{ $type->id }}" {{ old('transaction_type_id', $transaction->transaction_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('transaction_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="member_id" class="form-label">Membre</label>
                            <select name="member_id" id="member_id" class="form-control @error('member_id') is-invalid @enderror" required>
                                <option value="">Sélectionnez un membre</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id', $transaction->member_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->last_name }} - {{ $member->organisation->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $transaction->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Affichage des fichiers existants -->
                        @if($transaction->transactionFiles && $transaction->transactionFiles->count() > 0)
                            <div class="mb-3">
                                <label class="form-label">Fichiers existants</label>
                                <div class="row">
                                    @foreach($transaction->transactionFiles as $file)
                                        <div class="col-md-4 mb-2">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <small class="text-muted">{{ $file->name }}</small>
                                                    <div class="mt-1">
                                                        <a href="{{ asset($file->file_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">Voir</a>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteFile({{ $file->id }})">
                                                            Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="file_item" class="form-label">Nouveau fichier (optionnel)</label>
                            <input type="file" name="file_item" id="file_item" class="form-control @error('file_item') is-invalid @enderror">
                            @error('file_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas ajouter de nouveau fichier</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.transactions.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteFile(fileId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?')) {
        fetch(`/advanced/transaction-files/${fileId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression du fichier');
            }
        })
        .catch(error => {
            alert('Erreur lors de la suppression du fichier');
        });
    }
}
</script>
@endsection
