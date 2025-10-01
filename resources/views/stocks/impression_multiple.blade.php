@extends('layouts.app')

@section('content')
<div class="container mt-4">
<h1 class="mb-4">Impression multiple</h1>

<form action="" method="GET" class="row g-3 align-items-end">
<div class="col-md-4">
<label for="dateDebut" class="form-label">Date du Début</label>
<input type="date" name="dateDebut" id="dateDebut" class="form-control">
</div>
<div class="col-md-4">
<label for="dateFin" class="form-label">Date de Fin</label>
<input type="date" name="dateFin" id="dateFin" class="form-control">
</div>
<div class="col-md-4">
<button type="submit" class="btn btn-primary w-100">Ok</button>
</div>
</form>

<div>

<button type="button" class="btn btn-primary" onclick="printMultipleOrders()">Imprimer</button>
<div id="list_reciept">

@foreach ($orders as $order)
<div class="thermal-receipt">
<style>
.thermal-receipt {
    width: 58mm; /* Largeur standard imprimante thermique */
    font-family: 'Courier New', monospace;
    font-size: 12px;
    line-height: 1.2;
    margin: 0;
    padding: 2px;
    color: #000;
    background: #fff;
}

.center { text-align: center; }
.left { text-align: left; }
.right { text-align: right; }
.bold { font-weight: bold; }
.large { font-size: 14px; }
.small { font-size: 10px; }

.line {
    border-top: 1px dashed #000;
    margin: 5px 0;
}

.double-line {
    border-top: 2px solid #000;
    margin: 5px 0;
}

.flex-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.no-wrap { white-space: nowrap; }

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}

th, td {
    padding: 2px;
    text-align: center;
}

th {
    border-bottom: 1px solid #000;
    font-weight: bold;
}

.qty { width: 15%; }
.item { width: 50%; }
.price { width: 35%; text-align: right; }

.total-section {
    margin-top: 10px;
}

.total-line {
    display: flex;
    justify-content: space-between;
    margin: 2px 0;
}

/* Styles pour impression */
@media print {
    .thermal-receipt {
        width: 58mm;
        margin: 0;
        padding: 0;
    }

    body {
        margin: 0;
        padding: 0;
    }
}

.page-break {
    page-break-after: always;
}
</style>

<!-- En-tête -->

<div class="center" style="overflow-wrap: break-word;">
{{ $order->invoice_signature }}
</div>
<div class="center bold">
FACTURE
@if ($order->type_paiement == 3)
{{ TYPE_PAYMENT[$order->type_paiement] }}
@endif
</div>


<div class="center">
N° {{ $order->id }}
</div>
<div class="center small">
{{ $order->created_at->format('d/m/Y H:i') }}
</div>

@if ($order->is_cancelled)
<div class="center bold">*** ANNULÉE ***</div>
@include('cart._partial')
@endif

<div class="line"></div>

<!-- Vendeur -->
<div class="bold">A. VENDEUR</div>
<div>{{ $order->company->tp_name ?? "" }}</div>
<div class="small">
NIF: {{ $order->company->tp_TIN }}<br>
RC: {{ $order->company->tp_trade_number ?? "" }}<br>
@if($order->company->tp_postal_number)
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

<!-- Client -->
<div class="bold">B. CLIENT</div>
<div>{{ $order->client->name }}</div>
<div class="small">
Adresse: {{ $order->addresse_client }}<br>
TVA: {{ $order->client->vat_customer_payer ? "OUI" : "NON" }}<br>
@if($order->client->customer_TIN)
NIF: {{ $order->client->customer_TIN }}
@endif
</div>

<div class="line"></div>

<!-- Mode de paiement -->
<div class="flex-row">
<span class="bold">Paiement:</span>
<span>{{ TYPE_PAYMENT[$order->type_paiement] }}</span>
</div>

<div class="line"></div>

<!-- Articles -->
<table>
<thead>
<tr>
<th class="qty">QTÉ</th>
<th class="item">ARTICLE</th>
<th class="price">TOTAL</th>
</tr>
</thead>
<tbody>
@foreach($order->products as $product)
<tr>
<td class="qty">{{ $product['quantite'] }}</td>
<td class="item">
{{ substr($product['name'], 0, 15) }}
@if(strlen($product['name']) > 15)...@endif
<br>
<span class="small">{{ getPrice($product['price']) }} x {{ $product['quantite'] }}</span>
</td>
<td class="price">{{ getPrice($product['price'] * $product['quantite']) }}</td>
</tr>
@endforeach
</tbody>
</table>

<div class="line"></div>

<!-- Totaux -->
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

<!-- Pied de page -->
<div class="center bold">
=== MERCI ===
</div>
<div class="center">
{!! DNS2D::getBarcodeHTML("{$order->invoice_signature}", 'QRCODE', 5,5,'black', true) !!}
</div>

<div class="center small">
{{ now()->format('d/m/Y H:i:s') }}
</div>

<div class="page-break"></div>
</div>
@endforeach

</div>

@endsection

@section('javascript')

<script>
function printMultipleOrders(){
    const el = document.getElementById('list_reciept');
    if (!el) return alert('Élément introuvable : ' + 'list_reciept');

    const html = `
    <html>
      <head>
        <title>Impression</title>
        <style>
          /* Ajoute ici ton CSS pour l'impression si besoin */
          body { font-family: Arial, sans-serif; margin: 20px; }
        </style>
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
    // attendre que le contenu soit chargé avant print (compatible la plupart des navigateurs)
    w.onload = () => { w.print();  };
}
</script>

@endsection
