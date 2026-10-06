@extends('layouts.app')

@section('content')
<div class="container-fluid">
@include('journals.header')
    <h1>Recherche de facture</h1>

    <form action="{{ route('facture.search') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-2">
            <label for="facture_number">Numéro de facture</label>
            <input type="text" name="facture_number" id="facture_number" class="form-control" value="{{ $facture_number }}">
        </div>
        <div class="col-md-2">
            <label for="search">Mot Cle Recherche</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ $search }}">
        </div>
        <div class="col-md-2">
            <label for="start_date">Date de debut</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
        </div>
        <div class="col-md-2">
            <label for="end_date">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if($orders->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Numéro de facture</th>
                    <th>Client</th>
                    <th>Description</th>
                    <th>Date de facture</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->client->name ?? "" }}</td>
                        <td>
                            @foreach($order->products as $index => $product)
                               <span>{{ $index + 1 }} - {{ $product['name'] }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Imprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
