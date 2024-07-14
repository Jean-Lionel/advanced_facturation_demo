@extends('layouts.app')
@section('content')
@include('maisonLocation._header')
<div class="container">
    <h4>Clients n'ayant pas payé leurs loyers mensuels</h4>
    <table class="table table-striped table-bordered border-dark">
        <thead>
            <tr>
                <th>Nombre total de clients</th>
                <th>Nombre de clients n'ayant pas payé leurs loyers</th>
                <th>Montant total impayé</th>
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

    @if(isset($clientsMaisonnonpay) && $clientsMaisonnonpay->isNotEmpty())
    <table class="table table-striped table-bordered border-dark">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Numéro d'identification fiscale du client</th>
                <th>TVA payée par le client</th>
                <th>Adresse</th>
                <th>Maison</th>
                <th>Loyer mensuel</th>
                <th>Description du dernier paiement</th>
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
                         {{ $clientMaison->maisonlocation->paymentLocationMensuels()->latest()->first()->description }}
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