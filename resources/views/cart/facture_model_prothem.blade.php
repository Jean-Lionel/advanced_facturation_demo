<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURE  {{ auth()->user()->company()->tp_name ?? "" }} Numero {{ $order->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}">
    <script src="{{ asset('js/print.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/prothem.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reciept.css') }}">

    <style>
        .item_name{
            width: 47%;
            padding: 5px;
        }
        .element-center{
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>

</head>
<body>
    <div class="container_body">
        <div class="noprint header-element">
            <a href="{{URL::previous() }}" class="noprint btn">Retour</a>
            <button id="printElement" class=" btn noprint">Imprimer</button>
            <button id="print_reciept"  class="noprint btn">Imprimer Reciept</button>
        </div>
        <div class="main-content" id="printJS-form" >
            {{-- Entete --}}
            <header class="header-facture ">
                @if (env('APP_USE_LOGO', false))
                <div>
                    <div >
                        <img class="img_logo" src="{{asset('img/'.   env('USE_LOGO_NAME', 'logo.jpg'))}}" alt="">
                    </div>
                </div>
                @endif
                <div style="width: 100%;">

                    <h3>{{ $order->company->tp_name ?? "" }} </h3>


                    {{-- <h3>{{COMPANY_DESCRIPTION}} </h3>
                    <h3>

                        {{BOITE_POSTAL}}
                    </h3>
                    <h3>
                        Tél : {{BASE_TELELEPHONE}}
                    </h3>
                    <h3>
                        Email : {{EMAIL_ENTREPRISE}}, WebSite: {{WEBSITE_ENTREPRISE}}
                    </h3> --}}
                    <hr>
                </div>

            </header>
            {{-- Fin --}}
            <h3 class="text-center">FACTURE N° {{ $order->id }} du {{ $order->created_at->format('d-m-Y') }} </h3>
            {{-- SIDE A --}}


            <article class="identification_a">
                <div>
                    <h5>A. Identification du vendeur</h5>

                    <p>Nom et prénom ou Raison Social : <b>{{$order->company->tp_name ?? ""}}</b> </p>
                    <p>NIF : <b>{{$order->company->tp_TIN}}</b></p>
                    <p>Registre du commerce No : <b>{{ $order->company->tp_trade_number ?? "" }}</b></p>
                    <p>BP: <b>{{ $order->company->tp_postal_number ?? "" }}</b> , Tél <b>{{ $order->company->tp_phone_number }}</b></p>
                    <p>Commune : <b>{{ $order->company->tp_address_commune ?? ""}}</b>, Quartier : {{ $order->company->tp_address_quartier }}</p>
                    <p>Avenue : <b>{{ $order->company->tp_address_avenue ?? ""}} </b></p>
                    Assujetti à la TVA : {{$order->company?->vat_taxpayer ? 'OUI' : 'NON'  }}<b>
                        
                    </b>

                </div>
                <div class="aling-right partie-droite">
                    <div>
                        <b> </b>
                        <p>Centre Fiscal : <b>{{ $order->company->tp_fiscal_center }}</b></p>
                        <p>{{ "Secteur d'activité" }} : <b> {{ $order->company->tp_activity_sector }} </b></p>
                        <p>Forme juridique : <b> {{ $order->company->tp_legal_form }} </b></p>
                    </div>

                </div>
            </article>
            {{-- END SIDE A --}}

            {{-- SIDE B --}}
            <article class="identification_b">
                <div>
                    <h5>B. Client</h5>
                    <p>Nom et Prénom ou Raison Socail :</p>
                    <p>
                        <b>{{$order->client->name}}</b>
                    </p>
                    <p>Résident à : <b>{{ $order->client->addresse }}</b></p>
                    <p>Assujeti à la TVA : {{$order->client->vat_customer_payer ? "OUI" : "NON" }}         </p>
                    <p>NIF : <b>{{$order->client->customer_TIN ?? ""}}</b> </p>

                    <p>Doit pour ce qui suit :</p>
                    <br>

                </div>
            </article>
            {{-- END SIDE B --}}

            <article>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ "Nature de l'article" }}</th>
                            {{-- <th>Nbre de sacs</th> --}}
                            <th>Quantité</th>
                            <th>PU HTVA</th>
                            <th>PV-HTVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $key=> $product)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td class="item_name"> {{ $product['name'] }}</td>
                            {{-- <td class="adroite">{{ $product['nombre_sac'] ?? 0 }}</td> --}}
                            <td class="adroite" style="width: 40px;"> {{ $product['quantite'] }}
                                 {{ $product['unite_mesure'] ?? ""}}</td>
                            <td class="adroite"> {{ getPrice($product['price'] ) }}</td>
                            <td class="adroite"> {{ getPrice( $product['price'] * $product['quantite'])  }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">PVT HTVA </td>

                            <td class="adroite"><b>{{ getPrice($order->amount_tax) }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4">TVA </td>
                            <td class="adroite"><b>{{ getPrice($order->tax) }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>TOTAL TVAC</b></td>
                            {{-- <td class="adroite"><b>{{ $order->total_sacs}}</b></td>
                            <td class="adroite"><b>{{ $order->total_quantity}}</b></td> --}}
                            <td class="adroite"><b>{{ getPrice($order->amount) }}</b></td>
                        </tbody>
                    </table>
                    {{-- <h4>Mention Obligatoire</h4>
                        <h4>NB: Les non assujettis à la TVA ne remplissent pas les deux dernières lignes</h4> --}}
                        <br>
                        <h4 class="text-center"> {{$order->invoice_signature}}</h4>
                        <div class="element-center">
                            {!! DNS2D::getBarcodeHTML("{$order->invoice_signature}", 'QRCODE', 5,5,'black', true) !!}
                        </div>
                    </article>

                </div>

                <div id="reciept" style="display: none;">
                    <div  class="container">

                        <h6 class="invoice_signature"> {{$order->invoice_signature}}  </h6>
                        <h6>FACTURE N° {{ $order->id }} du {{ $order->created_at->format('d-m-Y H:i:s') }}</h6>

                        <h5>A. Identification du vendeur</h5>
                        <p><b>{{$order->company->tp_name ?? ""}}</b></p>
                        <p>NIF : <b>{{$order->company->tp_TIN}}</b></p>
                        <p>Registre du commerce No : <b>{{ $order->company->tp_trade_number ?? "" }}</b></p>
                        <p>BP: <b>{{ $order->company->tp_postal_number ?? "" }}</b> </p>
                        <p>Tél <b>{{ $order->company->tp_phone_number }}</b></p>
                        <p>Commune : {{ $order->company->tp_address_commune ?? ""}}, </p>
                        <p>Quartier : {{ $order->company->tp_address_quartier }}</p>
                        <p>Avenue : {{ $order->company->tp_address_quartier ?? ""}} </p>
                        <p>Centre Fiscal : <b>{{ $order->company->tp_fiscal_center }}</b></p>
                        <p>{{ "Secteur d'activité" }} : <b> {{ $order->company->tp_activity_sector }} </b></p>
                        <p>Forme juridique : <b> {{ $order->company->tp_legal_form }} </b></p>


                        <h5>B. Client</h5>
                        <p>Nom et Prénom ou Raison Socail :</p>
                        <p>{{$order->client->name}}</p>

                        <p>Résident à : {{ $order->addresse_client }}</p>
                        <p>Assujeti à la TVA : {{$order->client->vat_customer_payer ? "OUI" : "NON" }}         </p>
                        <p>NIF : <b>{{$order->client->customer_TIN ?? ""}}</b> </p>
                        <h5>Doit pour ce qui suit : </h5>

                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ "Produits" }}</th>
                                        {{-- <th>Nbre de sacs</th> --}}
                                        <th>Qté</th>
                                        <th>PU</th>
                                        <th>PV-HTVA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->products as $key=> $product)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td class="item_name"> {{ $product['name'] }}</td>
                                        {{-- <td class="adroite">{{ $product['nombre_sac'] ?? 0 }}</td> --}}
                                        <td class="adroite" > {{ $product['quantite'] }}</td>
                                        <td class="adroite nowrap"> {{ getPrice($product['price'] ) }}</td>
                                        <td class="adroite nowrap"> {{ getPrice( $product['price'] * $product['quantite'])  }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">PVT HTVA </td>

                                        <td class="adroite nowrap"><b>{{ getPrice($order->amount_tax) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">TVA </td>
                                        <td class="adroite"><b>{{ getPrice($order->tax) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>TOTAL TVAC</b></td>
                                        {{-- <td class="adroite"><b>{{ $order->total_sacs}}</b></td>
                                        <td class="adroite"><b>{{ $order->total_quantity}}</b></td> --}}
                                        <td class="adroite"><b>{{ getPrice($order->amount) }}</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h6 class="text-center">==== MERCI !! ===</h6>
                                <br>
                                <p>===================================================</p>

                            </div>

                        </div>
                    </div>
                </div>
                <script>

                    const printElement = document.getElementById("printElement")

                    printElement.addEventListener("click", function(e){
                        e.preventDefault();
                        window.print();
                    })
                    

                    const reciept = document.getElementById('print_reciept')
                    reciept.addEventListener('click',function(event){
                        document.getElementById('reciept').style.display = 'block';
                        printJS({
                            printable: "reciept",
                            type: 'html',
                            css: ` {{ asset('css/reciept.css')  }},
                            @media print {
                                body {
                                    width: 80mm;
                                }
                            }
                            `,
                            showModal: true
                        }
                        );
                        document.getElementById('reciept').style.display = 'none';
                    })

                </script>
            </body>
            </html>
