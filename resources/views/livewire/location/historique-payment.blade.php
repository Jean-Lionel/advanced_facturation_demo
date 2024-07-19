<div>
    <h5 class="mb-4">Historique des Paiements</h5>
    {{--  <div class="mb-4">
        <input type="text" class="form-control" placeholder="Rechercher par nom de client..." wire:model.debounce.300ms="search">
    </div>  --}}

    <div class="row my-2">
        <input type="date" class="form-control mr-3 col-3" wire:model='startDate'>
        <input type="date" class="form-control mr-3 col-3" wire:model='endDate'>
        <button type="submit" class="btn btn-outline-primary" wire:model='searchDate'>OK</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID Paiement</th>
                <th>Client</th>
                <th>Description du Service</th>
                <th>Montant</th>
                <th>Tax</th>
                <th>Montant Total avec Tax</th>
                {{--  <th>Type de Paiement</th>  --}}
                <th>Periode de paiement</th>
              
              
                <th>Date de Facturation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->order?->id }}</td>
                    <td>
                       {{ $payment->order?->client->name ?? "" }}
                       
                    </td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($payment->order?->products as $product)
                                <li>
                                     {{ $product['name'] }}, Prix: {{ $product['price'] }} 
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $payment->order?->amount }}</td>
                    <td>{{ $payment->order?->tax }}</td>
                    <td>{{ $payment->order?->amount_tax }}</td>
                    <td>{{ $payment->periode?->periode ?? '' }}</td>
                    <td>{{ $payment->order?->date_facturation ?? "" }}</td>
                </tr>

            @endforeach
        </tbody>
    </table>

    {{ $payments->links() }}

</div>

<style>
    @media print {
        @page {
            size: landscape;
        }
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

