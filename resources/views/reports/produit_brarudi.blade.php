@extends('layouts.app')
{{-- StockController Rapport  --}}
@section('content')

@include('journals._header_file')

<div>

    <h4 class="text-center">Historique des ventes des produits de BRARUDI</h4>
    <table class="display compact" style="width:100%" id="datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Facture</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($brarudi_product as $item)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $item->product?->name ?? "" }}</td>
                <td>{{ $item->quantite ?? "" }}</td>
                <td>{{ $item->order_id }}</td>
                <td>
                   
                    {{ $item->price_unitaire * $item->quantite  }}</td>
                <td>
                    {{ $item->created_at }}
                </td>
            </tr> 
            @endforeach

        </tbody>
    </table>
</div>

@stop