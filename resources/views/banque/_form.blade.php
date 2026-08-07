@csrf

<div class="row">
    <div class="col-md-12">
        <h5 class="text-left">Banque</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">NOM DE LA BANQUE</label>
            <input type="text"
                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   id="name"
                   name="name"
                   value="{{ old('name', $banque->name ?? '') }}"
                   required>
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="account_number">NUMERO DE COMPTE</label>
            <input type="text"
                   class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}"
                   id="account_number"
                   name="account_number"
                   value="{{ old('account_number', $banque->account_number ?? '') }}"
                   required>
            {!! $errors->first('account_number', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="account_name">NOM DU COMPTE</label>
            <input type="text"
                   class="form-control {{ $errors->has('account_name') ? 'is-invalid' : '' }}"
                   id="account_name"
                   name="account_name"
                   value="{{ old('account_name', $banque->account_name ?? '') }}">
            {!! $errors->first('account_name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="account_type">TYPE DE COMPTE</label>
            <input type="text"
                   class="form-control {{ $errors->has('account_type') ? 'is-invalid' : '' }}"
                   id="account_type"
                   name="account_type"
                   value="{{ old('account_type', $banque->account_type ?? '') }}">
            {!! $errors->first('account_type', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="currency">DEVISE</label>
            <select class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}"
                    id="currency"
                    name="currency"
                    required>
                @foreach (TYPE_MONNAIE as $currency)
                    <option value="{{ $currency }}" {{ old('currency', $banque->currency ?? 'BIF') === $currency ? 'selected' : '' }}>
                        {{ $currency }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('currency', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="description">DESCRIPTION</label>
            <textarea name="description"
                      id="description"
                      cols="30"
                      rows="3"
                      class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $banque->description ?? '') }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox"
                   class="form-check-input"
                   id="is_active"
                   name="is_active"
                   value="1"
                   {{ old('is_active', $banque->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Actif</label>
        </div>
    </div>

    <div class="col-md-3 offset-2">
        <div class="form-group">
            <label for=""></label>
            <a href="{{ route('banque.index') }}" class="form-control btn btn-warning text-center">Annuler</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for=""></label>
            <input type="submit" value="{{ $btnMessage }}" class="form-control btn-primary">
        </div>
    </div>
</div>
