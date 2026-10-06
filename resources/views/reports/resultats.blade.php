@extends('layouts.app')

@section('content')
@include("versement._header")
<div class="container mt-4">

    <form action="" method="get" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Date de début</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $start_date }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">Date de fin</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $end_date }}">
                </div>
            </div>
        </div>
        <button type="submit" class="mt-2 btn btn-primary">Rechercher</button>
    </form>

    <div class="mb-4 text-center row">
        <div class="col-md-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">Stock Vendu</h5>
                    <p class="display-6 text-success fw-bold">
                        {{ number_format($controls->sum('total'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">Versements</h5>
                    <p class="display-6 text-info fw-bold">
                        {{ number_format($versements->sum('montant'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">Dépenses</h5>
                    <p class="display-6 text-danger fw-bold">
                        {{ number_format($depenses->sum('montant'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <h4>Résultat de cette période :</h4>
        <p class="display-5 fw-bold {{ ($controls->sum('total') - $versements->sum('montant') - $depenses->sum('montant')) >= 0 ? 'text-success' : 'text-danger' }}">
            {{ number_format($controls->sum('total') - $versements->sum('montant') - $depenses->sum('montant'), 0, ',', ' ') }} FBu
        </p>
    </div>

</div>
@endsection
