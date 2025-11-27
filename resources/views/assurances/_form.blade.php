<div class="card-body row">
    <div class="col-md-12">
        <h5 class="text-left">Assurance</h5>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="name">NOM</label>
            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="name" name="name" value="{{ old('name') ?? $assurance->name ?? '' }}">
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="phone">TELEPHONE</label>
            <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="phone" name="phone" value="{{ old('phone') ?? $assurance->phone ?? '' }}">
            {!! $errors->first('phone', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="addresse">ADRESSE</label>
            <textarea class="form-control {{$errors->has('addresse') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="addresse" name="addresse">{{ old('addresse') ?? $assurance->addresse ?? '' }}</textarea>
            {!! $errors->first('addresse', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <br>
        <input type="submit" value="{{ $btnMessage ?? 'Enregistrer' }}" class="form-control btn-primary">
    </div>

</div>
