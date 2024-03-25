@if (session()->get('obr_response'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ session()->get('obr_response') }}</strong>
</div>

@endif
<div class="card-body row">
    <div class="col-md-12">
        <h5 class="text-left">Nouveau Client</h5>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="client_type">TYPE DE CLIENT</label>
            <select name="client_type" id="client_type" class="form-control form-control-sm">
                <option value="">--- SELECT ---</option>
                <option  value="PERSONNE PHYSIQUE"  @if(old('client_type') === 'PERSONNE PHYSIQUE') selected @endif>PERSONNE PHYSIQUE OU SOCIETE ETRANGERE</option>
                <option value="PERSONNE MORAL"  @if(old('client_type') === 'PERSONNE MORAL') selected @endif>PERSONNE MORAL</option>
            </select>
            @error('client_type')
            <small class="help-block invalid-feedback text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-4" id="vat_customer_payer" >
        <div class="form-group">
            <label for="vat_customer_payer">CLIENT ASSUJETI A LA TVA OU NON</label>
            <select name="vat_customer_payer" id="vat_customer_payer" class="form-control form-control-sm">
                <option value="">---- SELECT ---</option>
                <option  value="1" @if(old('vat_customer_payer') == 1) selected @endif>assujetti à la TVA</option>
                <option value="0" @if(old('vat_customer_payer') == 0) selected @endif>Non assujetti </option>
            </select>
            @error('vat_customer_payer')
            <small class="help-block invalid-feedback text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">NOM</label>
            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="name" name="name" value="{{ old('name') ?? $client->name?? ' ' }}">
            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

        </div>
    </div>
    <div class="col-md-4" id="customer_TIN">
        <div class="form-group">
            <label for="customer_TIN">NIF DU CLIENT</label>
            <input type="text" id="currentTIn" class="form-control {{$errors->has('customer_TIN') ? 'is-invalid' : 'is-valid' }} form-control-sm"  name="customer_TIN" value="{{ old('customer_TIN') ?? $client->customer_TIN?? ' ' }}">
            {!! $errors->first('customer_TIN', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="telephone">TELEPHONE</label>
            <input type="text" class="form-control {{$errors->has('telephone') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="telephone" name="telephone" value="{{ old('telephone') ?? $client->telephone?? ' ' }}">
            {!! $errors->first('telephone', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="addresse">ADRESSE</label>
            <input type="text" class="form-control {{$errors->has('addresse') ? 'is-invalid' : 'is-valid' }} form-control-sm" id="addresse" name="addresse" value="{{ old('addresse') ?? $client->addresse?? ' ' }}">
            {!! $errors->first('addresse', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control form-control-sm"  row="15" {{$errors->has('description') ? 'is-invalid' : 'is-valid'}} name="description">{{ old('description') ?? $client->description?? ' ' }}
            </textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-4 mt-3">
        <br>
        <input type="submit" value="{{ $btnMessage ?? 'Enregitrer' }}" class="form-control btn-primary">
    </div>

</div>
<div>

    <div>
        {{ $errors }}
    </div>
    @if($errors->any())
        @foreach($errors->getMessages() as $this_error)
            <p style="color: red;">{{$this_error[0]}}</p>
        @endforeach
    @endif
</div>
</div>
@section('javascript')
<script>
    /*const client_type = $("#client_type")
    client_type.on('change', function(e){
        if( e.target.value === 'PERSONNE PHYSIQUE'){
            $("#customer_TIN").hide();
            $("#customer_TIN").val("");
            $("#vat_customer_payer").hide();
            $("#currentTIn").val("");
        }else{
            $("#customer_TIN").show();
            $("#vat_customer_payer").show();
        }
    })*/
</script>
@endsection
