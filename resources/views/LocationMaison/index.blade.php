@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Clients n'ayant pas payé leur loyer</h4>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('LocationMaison.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="dateDebut">Date de début:</label>
                    <input type="date" class="form-control" id="dateDebut" name="dateDebut" value="{{ request()->input('dateDebut') }}">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="dateFin">Date de fin:</label>
                    <input type="date" class="form-control" id="dateFin" name="dateFin" value="{{ request()->input('dateFin') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Rechercher</button>
            </div>
        </div>
    </form>
    @if(isset($clientsMaisonnonpay) && $clientsMaisonnonpay->isNotEmpty())
    <table class="table table-striped">
        <thead>
            <tr>
                 <th>Nom</th>
                <th>Telephone</th>
                <th>customer TIN</th>
                <th>vat customer payer</th>
                <th>addresse</th>
                <th>Maison</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientsMaisonnonpay as $clientMaison)
            <tr>
                <td>{{ $clientMaison->client->name }}</td>
                <td>{{ $clientMaison->client->telephone }}</td>
                <td>{{ $clientMaison->client->customer_TIN }}</td>
                <td>{{ $clientMaison->client->vat_customer_payer }}</td>
                <td>{{ $clientMaison->client->addresse }}</td>
                <td>{{ $clientMaison->maisonlocation->adresse }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun client n'a de loyer en retard pour la période sélectionnée.</p>
    @endif
</div>
@endsection