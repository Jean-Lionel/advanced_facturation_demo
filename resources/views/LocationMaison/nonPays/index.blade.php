@extends('layouts.app')

@section('content')
<div class="container">
    <h5>Locataires en retard de paiement</h5>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Loyer mensuel</th>
                <th>Description</th>
                <th>Dernière échéance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nonPayeurs as $nonPayeur)
            <tr>
                <td>{{ $nonPayeur->client->name }}</td>
                <td>{{ $nonPayeur->client->telephone }}</td>
                <td>{{ $nonPayeur->maisonlocation->adresse }}</td>
                <td>{{ $nonPayeur->maisonlocation->montant }} Fbu</td>
                <td>   @if ($nonPayeur->payments()->count() > 0)
                    {{ $nonPayeur->payments()->latest()->first()->description }}
                 @else
                      -
                 @endif
                </td>
                <td>
                    @php
                    $dernierPaiement = $nonPayeur->payments()->orderBy('date_paiement', 'desc')->first();
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
</div>
@endsection