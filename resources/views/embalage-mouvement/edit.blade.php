@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Modifier le Mouvement #{{ $mouvement->id }}</span>
                    <a href="{{ route('embalage-mouvement.show', $mouvement) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('embalage-mouvement.update', $mouvement) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">
                                {{ __('Type de Mouvement') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('type') is-invalid @enderror"
                                        id="type" name="type" required {{ $mouvement->date_retour ? 'disabled' : '' }}>
                                    <option value="entree" {{ old('type', $mouvement->type) == 'entree' ? 'selected' : '' }}>Entrée</option>
                                    <option value="sortie" {{ old('type', $mouvement->type) == 'sortie' ? 'selected' : '' }}>Sortie</option>
                                </select>

                                @if($mouvement->date_retour)
                                    <input type="hidden" name="type" value="{{ $mouvement->type }}">
                                    <small class="form-text text-muted">Le type ne peut pas être modifié pour un retour enregistré</small>
                                @endif

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
                                <select class="form-select @error('embalage_id') is-invalid @enderror"
                                        id="embalage_id" name="embalage_id" required {{ $mouvement->date_retour ? 'disabled' : '' }}>
                                    @foreach($embalages as $embalage)
                                        <option value="{{ $embalage->id }}"
                                            {{ old('embalage_id', $mouvement->embalage_id) == $embalage->id ? 'selected' : '' }}>
                                            {{ $embalage->name }} (Stock: {{ $embalage->quantity }})
                                        </option>
                                    @endforeach
                                </select>

                                @if($mouvement->date_retour)
                                    <input type="hidden" name="embalage_id" value="{{ $mouvement->embalage_id }}">
                                @endif

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
                                <select class="form-select @error('client_id') is-invalid @enderror"
                                        id="client_id" name="client_id" required {{ $mouvement->date_retour ? 'disabled' : '' }}>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ old('client_id', $mouvement->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if($mouvement->date_retour)
                                    <input type="hidden" name="client_id" value="{{ $mouvement->client_id }}">
                                @endif

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
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity" name="quantity"
                                       value="{{ old('quantity', number_format($mouvement->quantity, 2, '.', '')) }}"
                                       required {{ $mouvement->date_retour ? 'readonly' : '' }}>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if($mouvement->type === 'sortie' || old('type') === 'sortie')
                            <div class="row mb-3">
                                <label for="date_retour" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Date de retour prévue') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('date_retour') is-invalid @enderror"
                                           id="date_retour" name="date_retour"
                                           value="{{ old('date_retour', $mouvement->date_retour ? \Carbon\Carbon::parse($mouvement->date_retour)->format('Y-m-d') : '') }}"
                                           {{ $mouvement->date_retour ? 'readonly' : '' }}>

                                    @error('date_retour')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="notes" class="col-md-4 col-form-label text-md-end">
                                {{ __('Notes') }}
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('notes') is-invalid @enderror"
                                          id="notes" name="notes" rows="3">{{ old('notes', $mouvement->notes) }}</textarea>

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
                                    <i class="fas fa-save me-1"></i> {{ __('Mettre à jour') }}
                                </button>
                                <a href="{{ route('embalage-mouvement.show', $mouvement) }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Annuler
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
        const dateRetourGroup = document.getElementById('date_retour')?.closest('.row.mb-3');

        if (typeSelect && dateRetourGroup) {
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
        }
    });
</script>
@endpush
@endsection
