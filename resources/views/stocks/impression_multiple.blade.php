@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="noprint">
        @include('journals.header')
    </div>

    <div class="app-card noprint mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Impression multiple</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('impression_multiple') }}" method="GET" class="app-toolbar-filters">
                    <div class="form-group mb-0">
                        <label for="dateDebut" class="sr-only">Date de début</label>
                        <input
                            type="date"
                            name="dateDebut"
                            id="dateDebut"
                            class="form-control form-control-sm"
                            value="{{ $dateDebut }}"
                        >
                    </div>
                    <div class="form-group mb-0">
                        <label for="dateFin" class="sr-only">Date de fin</label>
                        <input
                            type="date"
                            name="dateFin"
                            id="dateFin"
                            class="form-control form-control-sm"
                            value="{{ $dateFin }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="printMultipleOrders()">
                        <i class="fa fa-print"></i> Imprimer
                    </button>
                </form>
            </div>
        </header>

        <div class="app-card-body">
            <div class="app-meta">
                <span>Factures affichées : <b>{{ $orders->count() }}</b></span>
                @if ($dateDebut || $dateFin)
                    <span class="ml-3">
                        Période :
                        <b>
                            @if ($dateDebut)
                                du {{ \Carbon\Carbon::parse($dateDebut)->format('d/m/Y') }}
                            @endif
                            @if ($dateFin)
                                au {{ \Carbon\Carbon::parse($dateFin)->format('d/m/Y') }}
                            @endif
                        </b>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="app-card">
        <header class="app-card-header noprint">
            <h2 class="app-card-heading">Aperçu des reçus</h2>
        </header>

        <div class="app-card-body">
            @if ($orders->isEmpty())
                <p class="text-muted text-center py-4 mb-0 noprint">
                    Aucune facture trouvée pour cette période.
                </p>
            @else
                <div id="list_reciept" class="impression-multiple-preview">
                    <style>
                        .impression-multiple-preview {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 16px;
                            justify-content: flex-start;
                        }

                        .thermal-receipt {
                            width: 58mm;
                            font-family: 'Courier New', monospace;
                            font-size: 12px;
                            line-height: 1.2;
                            margin: 0;
                            padding: 8px;
                            color: #000;
                            background: #fff;
                            border: 1px solid #e2e8f0;
                            border-radius: 8px;
                        }

                        .thermal-receipt .center { text-align: center; }
                        .thermal-receipt .left { text-align: left; }
                        .thermal-receipt .right { text-align: right; }
                        .thermal-receipt .bold { font-weight: bold; }
                        .thermal-receipt .large { font-size: 14px; }
                        .thermal-receipt .small { font-size: 10px; }

                        .thermal-receipt .line {
                            border-top: 1px dashed #000;
                            margin: 5px 0;
                        }

                        .thermal-receipt .double-line {
                            border-top: 2px solid #000;
                            margin: 5px 0;
                        }

                        .thermal-receipt .flex-row {
                            display: flex;
                            justify-content: space-between;
                            align-items: flex-start;
                        }

                        .thermal-receipt table {
                            width: 100%;
                            border-collapse: collapse;
                            font-size: 11px;
                        }

                        .thermal-receipt th,
                        .thermal-receipt td {
                            padding: 2px;
                            text-align: center;
                        }

                        .thermal-receipt th {
                            border-bottom: 1px solid #000;
                            font-weight: bold;
                        }

                        .thermal-receipt .qty { width: 15%; }
                        .thermal-receipt .item { width: 50%; }
                        .thermal-receipt .price { width: 35%; text-align: right; }

                        .thermal-receipt .total-section { margin-top: 10px; }

                        .thermal-receipt .total-line {
                            display: flex;
                            justify-content: space-between;
                            margin: 2px 0;
                        }

                        .page-break {
                            page-break-after: always;
                        }

                        @media print {
                            .thermal-receipt {
                                width: 58mm;
                                margin: 0;
                                padding: 0;
                                border: none;
                                border-radius: 0;
                            }

                            body {
                                margin: 0;
                                padding: 0;
                            }
                        }
                    </style>

                    @foreach ($orders as $order)
                        <div class="thermal-receipt">
                            <div class="center" style="overflow-wrap: break-word;">
                                {{ $order->invoice_signature }}
                            </div>
                            <div class="center bold">
                                FACTURE
                                @if ($order->type_paiement == 3)
                                    {{ TYPE_PAYMENT[$order->type_paiement] }}
                                @endif
                            </div>

                            <div class="center">N° {{ $order->id }}</div>
                            <div class="center small">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </div>

                            @if ($order->is_cancelled)
                                <div class="center bold">*** ANNULÉE ***</div>
                                @include('cart._partial')
                            @endif

                            <div class="line"></div>

                            <div class="bold">A. VENDEUR</div>
                            <div>{{ $order->company->tp_name ?? "" }}</div>
                            <div class="small">
                                NIF: {{ $order->company->tp_TIN }}<br>
                                RC: {{ $order->company->tp_trade_number ?? "" }}<br>
                                @if ($order->company->tp_postal_number)
                                    BP: {{ $order->company->tp_postal_number }}<br>
                                @endif
                                Tél: {{ $order->company->tp_phone_number }}<br>
                                {{ $order->company->tp_address_commune ?? "" }}<br>
                                {{ $order->company->tp_address_quartier }}<br>
                                Centre Fiscal: {{ $order->company->tp_fiscal_center }}<br>
                                Activité: {{ $order->company->tp_activity_sector }}<br>
                                Forme: {{ $order->company->tp_legal_form }}
                            </div>

                            <div class="line"></div>

                            <div class="bold">B. CLIENT</div>
                            <div>{{ $order->client->name }}</div>
                            <div class="small">
                                Adresse: {{ $order->addresse_client }}<br>
                                TVA: {{ $order->client->vat_customer_payer ? "OUI" : "NON" }}<br>
                                @if ($order->client->customer_TIN)
                                    NIF: {{ $order->client->customer_TIN }}
                                @endif
                            </div>

                            <div class="line"></div>

                            <div class="flex-row">
                                <span class="bold">Paiement:</span>
                                <span>{{ TYPE_PAYMENT[$order->type_paiement] }}</span>
                            </div>

                            <div class="line"></div>

                            <table>
                                <thead>
                                    <tr>
                                        <th class="qty">QTÉ</th>
                                        <th class="item">ARTICLE</th>
                                        <th class="price">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td class="qty">{{ $product['quantite'] }}</td>
                                            <td class="item">
                                                {{ substr($product['name'], 0, 15) }}
                                                @if (strlen($product['name']) > 15)...@endif
                                                <br>
                                                <span class="small">{{ getPrice($product['price']) }} x {{ $product['quantite'] }}</span>
                                            </td>
                                            <td class="price">{{ getPrice($product['price'] * $product['quantite']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="line"></div>

                            <div class="total-section">
                                <div class="total-line">
                                    <span>P.HTVA:</span>
                                    <span class="bold">{{ getPrice($order->amount_tax) }}</span>
                                </div>
                                <div class="total-line">
                                    <span>TVA:</span>
                                    <span class="bold">{{ getPrice($order->tax) }}</span>
                                </div>
                                <div class="double-line"></div>
                                <div class="total-line bold large">
                                    <span>TOTAL:</span>
                                    <span>{{ getPrice($order->amount) }}</span>
                                </div>
                            </div>

                            <div class="double-line"></div>

                            <div class="center bold">=== MERCI ===</div>
                            <div class="center">
                                {!! DNS2D::getBarcodeHTML("{$order->invoice_signature}", 'QRCODE', 5, 5, 'black', true) !!}
                            </div>
                            <div class="center small">
                                {{ now()->format('d/m/Y H:i:s') }}
                            </div>

                            <div class="page-break"></div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
function printMultipleOrders() {
    const el = document.getElementById('list_reciept');
    if (!el) {
        return alert('Aucune facture à imprimer.');
    }

    const html = `
    <html>
      <head>
        <title>Impression multiple</title>
      </head>
      <body>
        ${el.outerHTML}
      </body>
    </html>`;

    const w = window.open('', '_blank', 'width=800,height=600');
    w.document.open();
    w.document.write(html);
    w.document.close();
    w.focus();
    w.onload = () => { w.print(); };
}
</script>
@endsection
