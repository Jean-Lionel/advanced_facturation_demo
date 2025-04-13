@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Nouvelle Transaction</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('advanced.transactions.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
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
                            <input type="date" name="date_transaction" id="date_transaction" class="form-control @error('date_transaction') is-invalid @enderror" value="{{ old('date_transaction', now()->format('Y-m-d')) }}" required>
                            @error('date_transaction')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant</label>
                            <div class="input-group">
                                <span class="input-group-text">BIF</span>
                                <input type="number" step="0.01" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}" required>
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
                                    <option value="{{ $type->id }}" {{ old('transaction_type_id') == $type->id ? 'selected' : '' }}>
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
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
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
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_item" class="form-label">Fichiers</label>
                            <input type="file" name="file_item" id="file_item" class="form-control @error('file_item') is-invalid @enderror">
                            @error('file_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Vous pouvez sélectionner plusieurs fichiers</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.transactions.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection