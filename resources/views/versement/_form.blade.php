

<div class="mb-3 form-group row">
    <label for="versement_type_id" class="col-md-4 col-form-label text-md-end">
        Type de versement
    </label>
    <div class="col-md-6">
        <select id="versement_type_id" name="versement_type_id"
                class="form-control form-select @error('versement_type_id') is-invalid @enderror">
            <option value="">Sélectionner un type</option>
            @foreach($versementTypes as $type)
                <option value="{{ $type->id }}"
                    {{ old('versement_type_id', $versement->versement_type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        @error('versement_type_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-3 form-group row">
    <label for="montant" class="col-md-4 col-form-label text-md-end">
        Montant <span class="text-danger">*</span>
    </label>
    <div class="col-md-6">
        <div class="input-group">
            <input type="number"
                   id="montant"
                   name="montant"
                   value="{{ old('montant', $versement->montant ?? '') }}"
                   class="form-control @error('montant') is-invalid @enderror"
                   step="0.01"
                   min="0"
                   required>
            <span class="input-group-text">€</span>
            @error('montant')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3 form-group row">
    <label for="date_transaction" class="col-md-4 col-form-label text-md-end">
        Date de transaction <span class="text-danger">*</span>
    </label>
    <div class="col-md-6">
        <input type="date"
               id="date_transaction"
               name="date_transaction"
               value="{{ old('date_transaction', isset($versement->date_transaction) ? $versement->date_transaction->format('Y-m-d') : now()->format('Y-m-d')) }}"
               class="form-control @error('date_transaction') is-invalid @enderror"
               required>
        @error('date_transaction')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-3 form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-end">
        Description
    </label>
    <div class="col-md-6">
        <textarea id="description"
                  name="description"
                  class="form-control @error('description') is-invalid @enderror"
                  rows="3">{{ old('description', $versement->description ?? '') }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-0 form-group row">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ $method === 'POST' ? 'Créer' : 'Mettre à jour' }}
        </button>
        <a href="{{ route('versement.index') }}" class="btn btn-link">
            Annuler
        </a>
    </div>
</div>
