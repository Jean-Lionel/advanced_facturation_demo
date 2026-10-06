@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Ajouter un Emballage') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('embalage.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Nom <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type_embalage_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Type d\'emballage') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('type_embalage_id') is-invalid @enderror
                                form-control
                                "
                                        id="type_embalage_id" name="type_embalage_id" required>
                                    <option value="">Sélectionnez un type</option>
                                    @foreach($typesEmballage as $type)
                                        <option value="{{ $type->id }}" {{ old('type_embalage_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('type_embalage_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">
                                {{ __('Prix') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                           id="price" name="price" value="{{ old('price', '0.00') }}" required>
                                    <span class="input-group-text">Fbu</span>
                                </div>

                                @error('price')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">
                                {{ __('Quantité initiale') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="number" step="0.01" class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity" name="quantity" value="{{ old('quantity', '0.00') }}" required>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">
                                {{ __('Description') }}
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>

                                @error('description')
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
                                <a href="{{ route('embalage.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> {{ __('Retour') }}
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
    // Mettre en forme le prix à la saisie
    document.getElementById('price').addEventListener('change', function(e) {
        let value = parseFloat(e.target.value);
        if (!isNaN(value)) {
            e.target.value = value.toFixed(2);
        }
    });

    // Mettre en forme la quantité à la saisie
    document.getElementById('quantity').addEventListener('change', function(e) {
        let value = parseFloat(e.target.value);
        if (!isNaN(value)) {
            e.target.value = value.toFixed(2);
        }
    });
</script>
@endpush
@endsection
