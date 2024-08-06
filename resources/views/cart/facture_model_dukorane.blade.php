<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture dukorane No {{ $order->id }}</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    
    h2 {
        text-align: center;
        margin-bottom: 0;
        text-transform: uppercase;
        font-size: 1.2em;
    }
    
    .header, .client {
        display: flex;
        justify-content: space-between;
    }
    
    p {
        margin:  0;
    }
    .left, .right {
        width: 45%;
    }

    .client h3 {
        margin:  0;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    
    table, th, td {
        border: 1px solid #000;
    }
    
    th, td {
        padding: 10px;
        text-align: left;
    }
    
    th {
        background-color: #f8f8f8;
    }
    
    tfoot {
        font-weight: bold;
    }
    
    .amount {
        margin: 20px 0;
        /* font-weight: bold; */
        text-align: left;
        margin-left: 20px;
    }
    
    
    .footer {
        /* text-align: center; */
        margin-top: 20px;
        padding: 20px 0;
    }
    
    
    .footer p {
        margin: 0;
        font-weight:600;
        text-align: center;
    }
    
    .assujetti{
        display:flex;
        font-weight: 600;
        
    }
    .adresse{
        text-align: center;
        font-weight: 600;
        font-size: 90%;
    }
    .adresse > .p {
        color: rgba(1, 131, 238, 0.4);
        text-decoration: underline  rgba(1, 131, 238, 0.4);
    }
   
    .title_article{
        width: 50px;
    }

    @media print{
        .no_print{
            display: none;
        }
    }
    
</style>
</head>
<body>
    
    <div class="invoice">
        <div class="no_print">
            <a href="{{ URL::previous() }}">Retour</a>
            <button onclick="window.print()" class="btn">Imprimer</button>
        </div>
        <img src="{{ asset('img/logo_dukorane.jpg') }}" width="200" height="100"/>
        <h2>Facture no {{ $order->id }} du {{ $order->created_at->format('d/m/Y') }}</h2>
        <div class="header">
            <div class="left">
                <p>Nom et prénom ou Raison Social : <b>{{$order->company->tp_name ?? ""}}</b> </p>
                <p>NIF : <b>{{$order->company->tp_TIN}}</b></p>
                <p>Registre du commerce No : <b>{{ $order->company->tp_trade_number ?? "" }}</b></p>
                <p>BP: <b>{{ $order->company->tp_postal_number ?? "" }}</b> , Tél <b>{{ $order->company->tp_phone_number }}</b></p>
                <p>Commune : <b>{{ $order->company->tp_address_commune ?? ""}}</b>, Quartier : {{ $order->company->tp_address_quartier }}</p>
                <p>Avenue : <b>{{ $order->company->tp_address_avenue ?? ""}} </b></p>
                Assujetti à la TVA : <b>{{$order->company?->vat_taxpayer ? 'OUI' : 'NON'  }}</b>
                
                
            </div>
            <div class="right">
                
                <p>Centre Fiscal : <b>{{ $order->company->tp_fiscal_center }}</b></p>
                <p>{{ "Secteur d'activité" }} : <b> {{ $order->company->tp_activity_sector }} </b></p>
                <p>Forme juridique : <b> {{ $order->company->tp_legal_form }} </b></p>
                <hr>
                <p>Bank : KCB Bank </p>
                <p>Beneficiary: dukorane, SPR</p>
                <p>Account Number: 6690449521</p>
            </div>
        </div>
        <div class="left">
            <h5>B. Client</h5>
            <p>Nom et Prénom ou Raison Socail :</p>
            <p>
                <b>{{$order->client->name}}</b>
            </p>
            <p>Résident à : <b>{{ $order->client->addresse }}</b></p>
            <p>Assujeti à la TVA : {{$order->client->vat_customer_payer ? "OUI" : "NON" }}         </p>
            <p>NIF : <b>{{$order->client->customer_TIN ?? ""}}</b> </p>
        </div>
        <h5>Doit pour ce qui suit : </h5>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th colspan="2">Service</th>
                    <th>QTY</th>
                    {{--  <th>Période</th>  --}}
                    <th>P.U/BIF</th>
                    <th>P.T</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $key=> $product)
                <tr>
                    <td>
                        {{ $key +1 }}
                    </td >
                    <td colspan="2" style="width: 200px;"> {{  $product['name'] }}</td>
                    <td>{{ $product['quantite'] }}</td>
                    {{--  <td>Apr-24</td>  --}}
                    <td>{{ getPrice($product['price'] ) }}</td>
                    <td>{{ getPrice( $product['price'] * $product['quantite'])  }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">PVT HTVA </td>

                    <td class="adroite nowrap"><b>{{ getPrice($order->amount_tax) }}</b></td>
                </tr>
                <tr>
                    <td colspan="5">TVA </td>
                    <td class="adroite"><b>{{ getPrice($order->tax) }}</b></td>
                </tr>
                <tr>
                    <td colspan="5"><b>TOTAL TVAC</b></td>
                    {{-- <td class="adroite"><b>{{ $order->total_sacs}}</b></td>
                    <td class="adroite"><b>{{ $order->total_quantity}}</b></td> --}}
                    <td class="adroite"><b>{{ getPrice($order->amount) }}</b></td>
                </tr>
            </tbody>
        </table>
        
        
        <p class="amount">Nous disons  {{ getNumberToWord($order->amount) }} francs Burundais.</p>
        <hr>
        {{ $order->invoice_signature ?? "" }}
    
        <div class="footer">
            <p>Mrs Directeurs</p>
            <p>Business Manager</p>
        </div>
        <div class="adresse">
            <p class="p">Buja-Burundi , Muha;Kanyosha-Kajiji, 9eme Avenue, RN3;  Tel:+257 /79 598 316/ 69 50 65 65
            </p>
            <p>E-mail:leandrenkurunziza2015@gmail.com;dukorane@gmail.com </p>
        </div>
    </div>
</body>
</html>
