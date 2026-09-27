<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Journal des ventes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0 0 5px;
        }
        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .summary td {
            border: 1px solid #ccc;
            padding: 5px 8px;
        }
        .summary td.label {
            background: #f2f2f2;
            font-weight: bold;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-table th,
        .report-table td {
            border: 1px solid #ccc;
            padding: 5px 6px;
            vertical-align: top;
        }
        .report-table th {
            background: #343a40;
            color: #fff;
        }
        .report-table thead {
            display: table-header-group;
        }
        .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .text-danger {
            color: #c0392b;
        }
        .text-success {
            color: #27ae60;
        }
        .total-row td {
            font-weight: bold;
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>JOURNAL DES VENTES</h2>
        <div>Du {{ $startDate }} au {{ $endDate }}</div>
    </div>

    <table class="summary">
        <tr>
            <td class="label">Nombre total de factures</td>
            <td class="text-right">{{ $total_facture }}</td>
            <td class="label">Montant total TVAC</td>
            <td class="text-right">{{ getPrice($total_amount) }}</td>
        </tr>
        <tr>
            <td class="label">Total TVA</td>
            <td class="text-right">{{ getPrice($total_tva) }}</td>
            <td class="label">Total HTVA</td>
            <td class="text-right">{{ getPrice($total_amount_tax) }}</td>
        </tr>
    </table>

    <table class="report-table">
        <thead>
            <tr>
                <th>#</th>
                <th>DATE</th>
                <th>PRODUITS</th>
                <th>CLIENT</th>
                <th>VENDU PAR</th>
                <th>MODE DE PAIEMENT</th>
                <th>TYPE DE FACTURE</th>
                <th>MONTANT</th>
                <th>TVA</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                @php
                    $typePaiement = $order->type_paiement;
                    if ($typePaiement === 'DETTE') {
                        $typePaiement = 3;
                    } elseif ($typePaiement === 'CACHE') {
                        $typePaiement = 1;
                    }
                    $typePaiement = is_numeric($typePaiement) ? (int) $typePaiement : $typePaiement;
                    $dette = $order->dette;
                    $montantRestant = $dette ? max(0, (float) $dette->montant_restant) : (float) $order->amount;
                    if ($montantRestant > 0 && $dette) {
                        $typePaiement = 3;
                    }
                @endphp
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @foreach($order->products as $product)
                            {{ $product['name'] }} | Qte : {{ $product['quantite'] }} | PRIX : {{ getPrice($product['price']) }}@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>{{ $order->client->name ?? "" }}</td>
                    <td>{{ $order->user->name ?? "" }}</td>
                    <td>
                        {{ $typePaiement ? (TYPE_PAYMENT[$typePaiement] ?? $order->type_paiement) : "" }}
                        @if ($typePaiement === 3)
                            <div class="{{ $montantRestant > 0 ? 'text-danger' : 'text-success' }}">
                                {{ $montantRestant > 0 ? 'Reste : ' . getPrice($montantRestant) : 'Tout est payé' }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $order->invoice_type ?? "" }}</td>
                    <td class="text-right">{{ getPrice($order->amount) }}</td>
                    <td class="text-right">{{ getPrice($order->tax) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Aucune facture pour cette période</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="7">TOTAL</td>
                <td class="text-right">{{ getPrice($total_amount) }}</td>
                <td class="text-right">{{ getPrice($total_tva) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
