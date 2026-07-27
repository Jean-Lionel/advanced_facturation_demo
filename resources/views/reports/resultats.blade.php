@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('versement._header')

    <div class="app-card mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Résultats financiers</h2>
        </header>

        <div class="app-card-body">
            <form action="" method="get" class="mb-0">
                <div class="app-form-grid">
                    <div class="form-group mb-0">
                        <label for="start_date">Date de début</label>
                        <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="{{ $start_date }}">
                    </div>
                    <div class="form-group mb-0">
                        <label for="end_date">Date de fin</label>
                        <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="{{ $end_date }}">
                    </div>
                    <div class="form-group mb-0 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="app-card">
                <div class="app-card-body text-center">
                    <h5 class="mb-2">Stock Vendu</h5>
                    <p class="display-6 text-success fw-bold mb-0">
                        {{ number_format($controls->sum('total'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="app-card">
                <div class="app-card-body text-center">
                    <h5 class="mb-2">Versements</h5>
                    <p class="display-6 text-info fw-bold mb-0">
                        {{ number_format($versements->sum('montant'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="app-card">
                <div class="app-card-body text-center">
                    <h5 class="mb-2">Dépenses</h5>
                    <p class="display-6 text-danger fw-bold mb-0">
                        {{ number_format($depenses->sum('montant'), 0, ',', ' ') }} FBu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="app-card">
        <div class="app-card-body text-center">
            <h4 class="mb-3">Résultat de cette période</h4>
            <p class="display-5 fw-bold mb-0 {{ ($controls->sum('total') - $versements->sum('montant') - $depenses->sum('montant')) >= 0 ? 'text-success' : 'text-danger' }}">
                {{ number_format($controls->sum('total') - $versements->sum('montant') - $depenses->sum('montant'), 0, ',', ' ') }} FBu
            </p>
        </div>
    </div>
</div>
@endsection
