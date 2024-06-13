<div>
    <h5 class="mb-4">Historique des Paiements</h5>
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Rechercher par nom de client..." wire:model.debounce.300ms="search">
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID Paiement</th>
                <th>Montant</th>
                <th>Taxe</th>
                <th>Quantité Totale</th>
                <th>Sacs Totals</th>
                <th>Montant Total avec Taxe</th>
                <th>Type de Paiement</th>
                <th>Produits</th>
                <th>Entreprise</th>
                <th>Client</th>
                <th>Date de Facturation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->tax }}</td>
                    <td>{{ $payment->total_quantity }}</td>
                    <td>{{ $payment->total_sacs }}</td>
                    <td>{{ $payment->amount_tax }}</td>
                    <td>{{ $payment->type_paiement }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($payment->products as $product)
                                <li>
                                    Nom: {{ $product['name'] }}, Prix: {{ $product['price'] }}, Quantité: {{ $product['quantite'] }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <p>Nom: {{ $payment->company->tp_name }}</p>
                        <p>Type: {{ $payment->company->tp_type }}</p>
                        <p>Numéro de TIN: {{ $payment->company->tp_TIN }}</p>
                    </td>
                    <td>
                        <p>Nom: {{ $payment->client->name }}</p>
                        <p>Adresse: {!! nl2br(e($payment->client->addresse)) !!}</p>
                    </td>
                    <td>{{ $payment->date_facturation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary d-print-none mt-3" onclick="window.print()">Imprimer</button>
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

