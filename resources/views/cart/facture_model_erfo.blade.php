<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FACTURE  {{ auth()->user()->company()->tp_name ?? "" }} Numero {{ $order->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/facture_obr_erfo.css') }}">
</head>
<body>
    <div class="invoice_item">
        <div class="noprint header-element">
            <a href="{{URL::previous() }}" class="noprint btn">Retour</a>
            <button id="printElement" onclick="window.print()" class=" btn noprint">Imprimer</button>
         
        </div>

        <header>
            <div class="header-left">
             
                <p style="font-weight: 800;">{{$order->company->tp_name ?? ""}}</p>
                <p style="font-weight: 800;">NIF : {{$order->company->tp_TIN ?? ""}}</p>
            </div>
            <div class="header-right">
                <p style="font-weight: 800;">RC : {{ $order->company->tp_trade_number ?? "" }}</p>
            </div>
            
        </header>
        
        <section>
            <p>Facture no. {{ $order->id }} , Date : {{ $order->created_at->format('d-m-Y') }}</p>
            
            <div class="facture-info">
                <div>
                    <p>A. Identification du vendeur</p>
                    <p>Personne physique: || &nbsp; Société |X|</p>                        <p>Centre Fiscal: {{ $order->company->tp_fiscal_center }}</p>
                    <p>
                        Nom du contribuable: {{ $order->company->tp_name ?? "" }}
                    </p>
                    <div>
                        <p>
                            {{ "Secteur d'activité" }} : {{ $order->company->tp_activity_sector }}
                        </p>
                        <p>NIF: {{ $order->company->customer_TIN ?? "" }}</p>
                        <p>Registre de commerce: {{ $order->company->tp_trade_number ?? "" }}</p>
                        <p>B.P:{{ $order->company->tp_postal_number ?? "" }} <br>
                            Tél:{{ $order->company->tp_phone_number ?? "" }} <br>
                            Commune: {{ $order->company->tp_address_commune ?? ""}} <br>
                            Numero: {{ $order->company->tp_address_number ? 'OUI' : 'NON' }}</p>
                        </div>
                        
                        <div>
                            <p>Exonéré à la TVA: | | OUI |X| NON</p>
                            <p>Assujetti à la TVA:  | | OUI |X| NON</p>
                            <p>Assujetti à la TC: | | OUI |X| NON</p>
                            <p>Assujetti au PF: | | OUI |X| NON</p>
                        </div>
                        
                    </div>
                    <div>
                        <p>B. Client</p>
                        <div>
                            <p>Personne physique: | | OUI |X| NON</p>
                            <p>Nom: {{$order->client->name}}</p>
                            <p>NIF:  {{$order->company->tp_TIN ?? ""}}</p>
                            <p>Resident à: rohero</p>
                            <p>Assujetti à la TVA: {{$order->client->customer_TIN ?? ""}}  | | OUI |X| NON</p>
                        </div>
                    </div>
                </div>

                <div>
                    <p>C. Droit ce qui suit</p>
                </div>

                <div>
                    <table >
                        <thead>
                            <tr>
                                <th>Articles</th>
                                <th>Qtés</th>
                                <th>P.U</th>
                                <th>TC</th>
                                <th>A.TAX</th>
                                <th>PV-HTVA</th>
                                <th>TVA</th>
                                <th>TVAC</th>
                                <th>PF</th>
                                <th>PVT</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($order->products as $key=> $product)
                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['quantite'] }}</td>
                                <td class="no-break">{{ getPrice($product['price'] ) }}</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="no-break">
                                    {{ getPrice($product['item_price_nvat'] )  }}
                                </td>
                                <td class="no-break">
                                    
                                    {{ getPrice($product['vat'] )  }}
                                </td>
                                <td class="no-break">
                                    {{ getPrice($product['item_price_wvat'] )  }}
                                </td>
                                <td>0</td>
                                <td class="no-break">
                                    {{ getPrice($product['item_total_amount'] )  }}
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">TOTAL (FBU)</td>
                                <td>{{ getPrice( collect($order->products)->sum('item_price_nvat'))  }}</td>
                                <td>
                                    {{ getPrice( collect($order->products)->sum('vat'))  }}
                                </td>
                                <td>
                                    {{ getPrice( collect($order->products)->sum('item_price_wvat'))  }}
                                </td>
                                <td>0</td>
                                <td>
                                    {{ getPrice( collect($order->products)->sum('item_total_amount'))  }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <br><br>
                    <p class="id-info">ID: {{$order->invoice_signature}}</p>
                </div>
            </section>
                <br><br>
                
            <footer>
                 <p class="text-center">{!! "Ce montant est à verser sur le compete no :<strong>181649 FBU ouvert à la Banque BANCOBU  au nom de l'Entreprise EREFO COMPANY" !!}</strong></p>

                 <hr>
                 <p class="text-center">
                     <strong>EMAIL : erefocompany@gmail.com | gilbert.nibigira@yahoo.com</strong>
                 </p>
            </footer>
        </div>
    </body>
    </html>