<div>
    <h5 class="mb-4">Historique des Paiements</h5>
    {{--  <div class="mb-4">
        <input type="text" class="form-control" placeholder="Rechercher par nom de client..." wire:model.debounce.300ms="search">
    </div>  --}}

    <div>
        <input type="date" wire:model="startDate">
        <input type="date" wire:model="endDate">
        <button wire:model="searchData">Ok</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID Paiement</th>
                <th>Montant</th>
                <th>Taxe</th>
                <th>Quantité Totale</th>
                <th>Montant Total avec Taxe</th>
                <th>Type de Paiement</th>
                <th>Produits</th>
                  <th>Client</th>
                <th>Date de Facturation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->order?->id }}</td>
                    <td>{{ $payment->order?->amount }}</td>
                    <td>{{ $payment->order?->tax }}</td>
                    <td>{{ $payment->order?->total_quantity }}</td>
                    <td>{{ $payment->order?->amount_tax }}</td>
                    <td>{{ $payment->order?->type_paiement }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($payment->order?->products as $product)
                                <li>
                                    Nom: {{ $product['name'] }}, Prix: {{ $product['price'] }}, Quantité: {{ $product['quantite'] }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    
                    <td>
                        <p>Nom: {{ $payment->order?->client->name ?? "" }}</p>
                        <p>Adresse: {!! nl2br(e($payment->order?->client->addresse ?? "")) !!}</p>
                    </td>
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

