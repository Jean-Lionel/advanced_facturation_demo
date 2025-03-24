<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ $order->company->tp_name }} - {{ $order->id }}</title>
    <style>
        :root {
            --primary-color: #0D69B3;
            --text-color: #4D4D4D;
            --white: #FFFFFF;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            color: var(--text-color);
            position: relative;
            background: var(--white);
        }

        /* A4 Format */
        @page {
            size: A4;
            margin: 5mm;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                color: var(--text-color) !important;
                background-color: var(--white) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print {
                display: none !important;
            }

            .container {
                padding: 5mm;
                width: 100%;
                height: 100%;
                box-shadow: none;
            }

            .diagonal-stripes, .bottom-stripes {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .table_header {
                background-color: var(--primary-color) !important;
                color: var(--white) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        .hr-footer {
            position: absolute;
            bottom: 80px;
            left: 20px;
            right: 20px;
            border: 3px solid var(--primary-color);
            margin: 10px 0;
            width: 95%;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;

        }

        .company-info-footer {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            gap: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .btn {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-print {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-back {
            background-color: var(--text-color);
            color: var(--white);
        }

        .diagonal-stripes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg,
                var(--primary-color) 0%, var(--primary-color) 25px,
                #e8f0fe 25px, #e8f0fe 50%);
            background-size: 50px 50px;
            z-index: -1;
        }

        .bottom-stripes {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg,
                var(--primary-color) 0%, var(--primary-color) 25px,
                #e8f0fe 25px, #e8f0fe 50%);
            background-size: 50px 50px;
            z-index: -1;
            transform: rotate(180deg);
        }

        .container {
            background: var(--white);
            padding: 2mm;
            min-height: 297mm;
            width: 210mm;
            margin: 0 auto;
            position: relative;
            box-sizing: border-box;
        }

        .header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 0px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .company-info h2 {
            color: var(--primary-color);
            margin: 0 0 10px 0;
        }

        .company-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .invoice-details {
            text-align: right;
        }
        .invoice-details h1 {
            color: var(--primary-color);
            margin: 0 0 20px 0;
        }

        .client-info {
            text-align: right;
            margin-bottom: 10px;
        }

        .client-info h3 {
            color: var(--primary-color);
            margin: 0 0 15px 0;
        }

        .client-info p {
            margin: 5px 0;
            font-size: 14px;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }


        .table_header {
            background-color: var(--primary-color) !important;
            color: var(--white) !important;
            font-weight: normal !important;
        }

        td {
            font-size: 14px;
        }

        .totals {
            width: 350px;
            margin-left: auto;
        }

        .totals table {
            margin-top: 20px;
            background: #f8f9fa;
        }

        .totals table td {
            padding: 8px 12px;
        }

        .totals table td:last-child {
            text-align: right;
        }

        .footer {
            margin-top: 5px;
            font-size: 13px;
        }

        .payment-info {
            margin-bottom: 30px;
        }

        .payment-info h4 {
            color: var(--primary-color);
            margin: 0 0 10px 0;
        }

        .legal-notice {
            color: var(--text-color);
            font-size: 12px;
            margin-top: 20px;
            padding: 20px 0;
            border-top: 1px solid #ddd;
        }

        .object-title {
            color: var(--primary-color);
            margin: 0 0 20px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn btn-print">Imprimer</button>
        <a href="{{ url()->previous() }}" class="btn btn-back">Retour</a>
    </div>

    <div class="diagonal-stripes"></div>
    <div class="bottom-stripes"></div>
    <div class="container">
        <div class="header">
            <div>
                <img src="{{ asset('img/logo_advanced.jpg') }}" alt="Logo" class="logo">
                <div class="company-info">
                    <h2>{{ $order->company->tp_name }}</h2>
                    <p>NIF: {{ $order->company->tp_TIN }}</p>
                    <p>RC: {{ $order->company->tp_trade_number }}</p>
                    <p>{{ $order->company->tp_address_commune }}, {{ $order->company->tp_address_quartier }}</p>
                    <p>Tél: {{ $order->company->tp_phone_number }}</p>
                </div>
            </div>
            <div class="invoice-details">
                <h1>FACTURE</h1>
                <p>N°: {{ getInvoiceNumber($order->id)  }}</p>
                <p>Date: {{  $order->date_facturation }}</p>
               <!--  <p>Signature: {{ $order->invoice_signature }}</p> -->
            </div>
        </div>

        <div class="client-info">
            <h3>Client</h3>
            <p>Nom: {{ $order->client->name }}</p>
            <p>Adresse: {{ $order->addresse_client }}</p>
            <p>Téléphone: {{ $order->client->telephone }}</p>
            <p>NIF: {{ $order->client->customer_TIN }}</p>
            @if($order->client->email)
            <p>Email: {{ $order->client->email }}</p>
            @endif
        </div>
        <div> Droit à </div>
        <table>
            <thead class="table_header">
                <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>P.U</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantite'] }}</td>
                    <td>{{ number_format($product['price'], 2) }}</td>
                    <td>{{ number_format($product['item_price_nvat'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td><strong>Montant Total</strong></td>
                    <td>{{ number_format($order->amount_tax, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Tax</strong></td>
                    <td>{{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Montant Total</strong></td>
                    <td>{{ number_format($order->amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="payment-info">
                <p class="payment-info-text">Nous disons {{ getNumberToWord($order->amount)}}  FBU</p>
                <h4 class="text-center payment-info-text">MERCI DE NOUS FAIRE CONFIANCE !!!</h4>
            </div>
            <hr class="hr-footer">
            <div class="company-info-footer">
               <div> Site web : {{ $order->company->tp_website ?? "" }}</div>
               <div> Email : {{ $order->company->tp_email ?? "" }}</div>
               <div> Tél : {{ $order->company->tp_phone_number ?? "" }}</div>
               <div> Banque : {{ $order->company->tp_bank ?? "" }}</div>
               <div> Numero compte : {{ $order->company->tp_account_number ?? "" }}</div>
            </div>

        </div>
    </div>
</body>
</html>