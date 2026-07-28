@csrf

<div class="app-card-body">
    <div class="app-form-layout">
        <div class="app-form-field app-form-field--full">
            <label for="name">Nom</label>
            <input
                type="text"
                class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                id="name"
                name="name"
                value="{{ old('name', $depense_category->name ?? '') }}"
                required
            >
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>

        <div class="app-form-field app-form-field--full">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                class="form-control form-control-sm {{ $errors->has('description') ? 'is-invalid' : '' }}"
            >{{ old('description', $depense_category->description ?? '') }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="app-form-actions mt-3">
        <a href="{{ route('depense-categories.index') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
        <button type="submit" class="btn btn-primary btn-sm">{{ $btnMessage }}</button>
    </div>
</div>
