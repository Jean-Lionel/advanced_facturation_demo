<div class="card-body row">
    <div class="col-md-12">
        <h5 class="text-left">Assurance Client</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="client_id">CLIENT</label>
            <select name="client_id" id="client_id" class="form-control form-control-sm {{ $errors->has('client_id') ? 'is-invalid' : '' }}">
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ (old('client_id') ?? $assuranceClient->client_id ?? $selected_client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('client_id', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="assurance_id">ASSURANCE</label>
            <select name="assurance_id" id="assurance_id" class="form-control form-control-sm {{ $errors->has('assurance_id') ? 'is-invalid' : '' }}">
                <option value="">-- Sélectionner une assurance --</option>
                @foreach($assurances as $assurance)
                    <option value="{{ $assurance->id }}" {{ (old('assurance_id') ?? $assuranceClient->assurance_id ?? '') == $assurance->id ? 'selected' : '' }}>
                        {{ $assurance->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('assurance_id', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="expire_date">DATE D'EXPIRATION</label>
            <input type="date" class="form-control {{$errors->has('expire_date') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="expire_date" name="expire_date" value="{{ old('expire_date') ?? (isset($assuranceClient) && $assuranceClient->expire_date ? $assuranceClient->expire_date->format('Y-m-d') : '') }}">
            {!! $errors->first('expire_date', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="par_client">PART CLIENT (%)</label>
            <input type="number" step="0.01" class="form-control {{$errors->has('par_client') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="par_client" name="par_client" value="{{ old('par_client') ?? $assuranceClient->par_client ?? '' }}">
            {!! $errors->first('par_client', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="par_assurance">PART ASSURANCE (%)</label>
            <input type="number" step="0.01" class="form-control {{$errors->has('par_assurance') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="par_assurance" name="par_assurance" value="{{ old('par_assurance') ?? $assuranceClient->par_assurance ?? '' }}">
            {!! $errors->first('par_assurance', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="description">DESCRIPTION</label>
            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="description" name="description">{{ old('description') ?? $assuranceClient->description ?? '' }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <br>
        <input type="submit" value="{{ $btnMessage ?? 'Enregistrer' }}" class="form-control btn-primary">
    </div>

</div>
