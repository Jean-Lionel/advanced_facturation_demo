@extends('layouts.app')

@section('content')
<div>
    <center>
        <form action="{{ route('updatecompte')}}" method="POST">
            @csrf
            <div class="col-md-4">
                <div class="form-group">
                    <label for="montant">MONTANT</label>
                    <input type="number7" class="form-control form-control-sm" id="montant" name="montant" min="1000"
                        required>
                    {!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}

                </div>
            </div>
            <div class="col-md-4 mb-4">
                <label for="type_paiement">MODE DE PAIEMENT</label>
                <select required="" class="form-control" name="type_paiement" id="">
                    <option value="">Choisissez ...</option>
                    <option value="1">en espèce</option>
                    <option value="2">banque</option>
                    <option value="3">à crédit</option>
                    <option value="4">autres</option>
                </select>
            </div>
            <input type="text" class="form-control" value="{{ $id }}" name="id" id="validationCustom04" hidden required>
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