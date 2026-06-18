@csrf

<div class="row">
    <div class="col-md-12">
        <h5 class="text-left">Catégorie de dépense</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">NOM</label>
            <input type="text"
                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   id="name"
                   name="name"
                   value="{{ old('name', $depense_category->name ?? '') }}"
                   required>
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description">DESCRIPTION</label>
            <textarea name="description"
                      id="description"
                      cols="30"
                      rows="3"
                      class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $depense_category->description ?? '') }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-3 offset-2">
        <div class="form-group">
            <label for=""></label>
            <a href="{{ route('depense-categories.index') }}" class="form-control btn btn-warning text-center">Annuler</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for=""></label>
            <input type="submit" value="{{ $btnMessage }}" class="form-control btn-primary">
        </div>
    </div>
</div>