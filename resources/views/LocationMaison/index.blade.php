@extends('layouts.app')
@section('content')
@include('maisonLocation._header')
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
    <!--
    <table class="table table-striped table-bordered border-dark">
    <thead>
        <tr>
            <th>Clients total</th>
            <th>Clients total non payé leurs loyers</th>
            <th>Montant total non payé</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span class="badge bg-primary" style="font-size: 1.5rem;">{{ $clientsMaisonTotal }}</span></td>
            <td><span class="badge bg-primary" style="font-size: 1.5rem;">{{ $nbreClientsNonPayeurs }} <span> = </span>{{ $nbreClientsNonPayeurs_percentage }} %</span></td>
            <td><span class="badge bg-primary" style="font-size: 1.5rem;">{{ $totalImpaye }} Fbu</span></td>
        </tr>
    </tbody>
    </table>
-->
    @if(isset($clientsMaisonnonpay) && $clientsMaisonnonpay->isNotEmpty())
    <table class="table table-striped table-bordered border-dark">
        <thead>
            <tr>
                 <th>Nom</th>
                <th>Telephone</th>
                <th>customer TIN</th>
                <th>vat customer payer</th>
                <th>addresse</th>
                <th>Maison</th>
                <th>Loyer mensuel</th>
                <th>Description du Dernièr paiement</th>
                <th>Dernière échéance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientsMaisonnonpay as $clientMaison)
            <tr style="border-width: 3px;">
                <td>{{ $clientMaison->client->name }}</td>
                <td>{{ $clientMaison->client->telephone }}</td>
                <td>{{ $clientMaison->client->customer_TIN }}</td>
                <td>{{ $clientMaison->client->vat_customer_payer }}</td>
                <td>{{ $clientMaison->client->addresse }}</td>
                <td>{{ $clientMaison->maisonlocation->adresse }}</td>
                <td>{{ $clientMaison->maisonlocation->montant }} Fbu</td>
                <td>
                    @if ($clientMaison->maisonlocation->paymentLocationMensuels()->count() > 0)
                         {{  $clientMaison->maisonlocation->paymentLocationMensuels()->latest()->first()->description }}
                    @else
                          -
                    @endif
                </td>
                <td>
                    @php
                         $dernierPaiement = $clientMaison->maisonlocation->paymentLocationMensuels()->orderBy('date_paiement', 'desc')->first();
                    @endphp
                    @if ($dernierPaiement)
                        {{ $dernierPaiement->date_paiement ? $dernierPaiement->date_paiement->format('d/m/Y') : 'Jamais payé' }}
                    @else
                         Jamais payé
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun client n'a de loyer en retard pour la période sélectionnée.</p>
    @endif
</div>
@endsection