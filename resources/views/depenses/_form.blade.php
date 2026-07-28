@csrf

<div class="app-card-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <p class="app-meta mb-0">Renseignez les détails de la dépense</p>
        <a href="{{ route('depense-categories.index') }}" class="app-btn-ghost">Gérer les catégories</a>
    </div>

    @if ($depenseCategories->isEmpty())
        <div class="alert alert-warning py-2 mb-3">
            Aucune catégorie disponible.
            <a href="{{ route('depense-categories.create') }}">Créer une catégorie</a>
        </div>
    @endif

    <div class="app-form-layout">
        <div class="app-form-field">
            <label for="name">Action</label>
            <input
                type="text"
                class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                id="name"
                name="name"
                value="{{ old('name', $depense->name ?? '') }}"
                required
            >
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>

        <div class="app-form-field">
            <label for="depense_category_id">Catégorie</label>
            <select
                name="depense_category_id"
                id="depense_category_id"
                class="form-control form-control-sm {{ $errors->has('depense_category_id') ? 'is-invalid' : '' }}"
                {{ $depenseCategories->isEmpty() ? 'disabled' : '' }}
            >
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($depenseCategories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string) old('depense_category_id', $depense->depense_category_id ?? '') === (string) $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('depense_category_id', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>

        <div class="app-form-field">
            <label for="montant">Montant</label>
            <input
                type="number"
                step="0.01"
                class="form-control form-control-sm {{ $errors->has('montant') ? 'is-invalid' : '' }}"
                id="montant"
                name="montant"
                value="{{ old('montant', $depense->montant ?? '') }}"
                required
            >
            {!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>

        <div class="app-form-field">
            <label for="date_depense">Date de la dépense</label>
            <input
                type="date"
                class="form-control form-control-sm {{ $errors->has('date_depense') ? 'is-invalid' : '' }}"
                id="date_depense"
                name="date_depense"
                value="{{ old('date_depense', isset($depense->date_depense) ? $depense->date_depense->format('Y-m-d') : now()->format('Y-m-d')) }}"
            >
            {!! $errors->first('date_depense', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>

        <div class="app-form-field app-form-field--full">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                class="form-control form-control-sm {{ $errors->has('description') ? 'is-invalid' : '' }}"
            >{{ old('description', $depense->description ?? '') }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="app-form-actions mt-3">
        <a href="{{ route('depenses.index') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
        <button type="submit" class="btn btn-primary btn-sm">{{ $btnMessage }}</button>
    </div>
</div>
