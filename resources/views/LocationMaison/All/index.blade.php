@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients n'ayant pas payé leurs loyers</div>
                <div class="card-body">
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
                            @foreach ($clientsMaisonnonpay as $clientMaison)
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection