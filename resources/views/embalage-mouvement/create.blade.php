@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Nouveau Mouvement d\'Emballage') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('embalage-mouvement.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">
                                {{ __('Type de Mouvement') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('type') is-invalid @enderror form-control"
                                        id="type" name="type" required autofocus>
                                    <option value="">Sélectionnez un type</option>
                                    <option value="entree" {{ old('type') == 'entree' ? 'selected' : '' }}>Entrée</option>
                                    <option value="sortie" {{ old('type') == 'sortie' ? 'selected' : '' }}>Sortie</option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="embalage_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Emballage') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('embalage_id') is-invalid @enderror form-control"
                                        id="embalage_id" name="embalage_id" required>
                                    <option value="">Sélectionnez un emballage</option>
                                    @foreach($embalages as $embalage)
                                        <option value="{{ $embalage->id }}"
                                            {{ old('embalage_id') == $embalage->id ? 'selected' : '' }}>
                                            {{ $embalage->name }} (Stock: {{ $embalage->quantity }})
                                        </option>
                                    @endforeach
                                </select>

                                @error('embalage_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="client_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Client') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('client_id') is-invalid @enderror form-control"
                                        id="client_id" name="client_id" required>
                                    <option value="">Sélectionnez un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">
                                {{ __('Quantité') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="number" step="0.01" min="0.01"
                                       class="form-control @error('quantity') is-invalid @enderror form-control"
                                       id="quantity" name="quantity" value="{{ old('quantity') }}" required>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_retour" class="col-md-4 col-form-label text-md-end">
                                {{ __('Date de retour prévue') }}
                            </label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('date_retour') is-invalid @enderror form-control"
                                       id="date_retour" name="date_retour"
                                       value="{{ old('date_retour') }}">

                                @error('date_retour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">
                                    À remplir uniquement pour les sorties
                                </small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="notes" class="col-md-4 col-form-label text-md-end">
                                {{ __('Notes') }}
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('notes') is-invalid @enderror form-control"
                                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>

                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> {{ __('Enregistrer') }}
                                </button>
                                <a href="{{ route('embalage-mouvement.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> {{ __('Annuler') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Masquer/afficher le champ date de retour en fonction du type de mouvement
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const dateRetourGroup = document.getElementById('date_retour').closest('.row.mb-3');

        function toggleDateRetour() {
            if (typeSelect.value === 'sortie') {
                dateRetourGroup.style.display = 'flex';
            } else {
                dateRetourGroup.style.display = 'none';
            }
        }

        // Initial state
        toggleDateRetour();

        // On change
        typeSelect.addEventListener('change', toggleDateRetour);
    });
</script>
@endpush
@endsection
