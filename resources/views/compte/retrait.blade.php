@extends('layouts.app')

@section('content')
<div>
    <center>
        <form action="{{ route('updatecompte')}}" method="POST">
            @csrf
            <div class="col-md-4">
                <!-- Information du Client -->
                <div class="form-group">
                    <label for="name">Nom du Client</label>
                    <input type="text" class="form-control form-control-sm" id="name" name="name" disabled
                        value="{{ $compte->client->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email du Client</label>
                    <input type="email" class="form-control form-control-sm" id="email" name="email" disabled
                        value="{{ $compte->client->addresse }}">
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone du Client</label>
                    <input type="text" class="form-control form-control-sm" id="phone" name="phone" disabled
                        value="{{ $compte->client->telephone }}">
                </div>
                <div class="form-group">
                    <label for="montant">MONTANT</label>
                    <input type="number" class=" form-control form-control-sm" id="montant" name="montant"
                        required>
                    {!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}

                </div>
            </div>
            <div class="col-md-4 mb-4">
                <label for="type_paiement">MODE DE PAIEMENT</label>
                <select required="" class="form-control" name="type_paiement" id="">
                    <option value="">Choisissez ...</option>
                    <option value="en espèce">en espèce</option>
                    <option value="banque">banque</option>
                    <option value="à crédit">à crédit</option>
                    <option value="autres">autres</option>
                </select>
            </div>
            <input type="text" class="form-control" value="{{ $compte->id }}" name="id" id="validationCustom04" hidden required>
            <input type="text" class="form-control" value="RETRAIT" name="operation" id="operation" hidden required>
            <div class="col-md-4">
                <button type="submit" id="validate"
                    class="btn btn-info rounded-pill py-2 btn-block col-6">Valider</button>
            </div>

        </form>
    </center>
</div>
@endsection
@section('javascript')
<script>
$("#validate").on("click", function(e) {
    e.preventDefault();


    $.ajax({
        url: 'route('
        updatecompte ')',
        type: 'POST',

        data: {
            montant: $('input[name="montant"]').val(),
            id: $('input[name="id"]').val(),
            operation: $('input[name="operation"]').val(),
            type_paiement: $('input[name="type_paiement"]').val(),

        },
        success: function(data) {


        },
        error: function(data) {

        },
    });
});
</script>
@stop
