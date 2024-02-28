<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FACTURE  {{ RAISON_ENTREPRISE }}</title>
	<link rel="stylesheet" href="{{ asset('css/print.min.css') }}">
	<script src="{{ asset('js/print.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/prothem.css') }}">
	<style>
		@media print {
			.noprint {
				display: none;
			}
		}
		.adroite{
			text-align:right !important;
			padding-right: 15px;

		}
		.text-center{
			text-align: center !important;
		}
		.img_logo{
			width: 100px;
			height: 100px;
		}
		body{
			margin: 0;
			padding: 0;
		}
        p, h3{
            margin: 0;
            padding: 0;

        }
        .header-element{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            gap: 200px;
        }
	</style>
</head>
<body>
	<div class="noprint header-element">
        <a href="{{ route('ventes.index') }}" class="noprint btn">Retour</a>
		<button onclick="print()" class="noprint btn">Imprimer</button>
	</div>
	<div class="main-content">
		{{-- Entete --}}
		<header class="header-facture">
			<div>
				<div >
					<img class="img_logo" src="{{asset('img/logo.jpg')}}" alt="">
				</div>
			</div>
			<div style="width: 80%;">

				<h3>{{ $order->company?->tp_name }} </h3>


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
        <h3 class="text-center">FACTURE  </h3>
		{{-- SIDE A --}}
		<article class="identification_a">
			<div>
				<h5>A. Identification du vendeur</h5>

				<p>Nom et prénom ou Raison Social : <b>{{$order->company?->tp_name}}</b> </p>
				<p>NIF : <b>{{$order->company?->tp_TIN}}</b></p>
				<p>Registre du commerce No : <b>{{ $order->company?->tp_trade_number }}</b></p>
				<p>BP: <b>{{ $order->company?->tp_postal_number }}</b> , Tél <b>{{ $order->company?->tp_phone_number }}</b></p>
				<p>Commune : <b>{{ $order->company?->tp_address_commune }}</b>, Quartier : {{ $order->company?->tp_address_quartier }}</p>
				<p>Avenue : <b>{{ $order->company?->tp_address_quartier }} </b></p>
				Assujetti à la TVA : <b>OUI</b>

			</div>
			<div class="aling-right partie-droite">
				<div>
                    <b>N° {{ $order->id }} du {{ $order->created_at->format('d-m-Y') }}</b>
					<p>Centre Fiscal : <b>{{ $order->company?->tp_fiscal_center }}</b></p>
					<p>Secteur d'activité : <b> {{ $order->company?->tp_activity_sector }} </b></p>
					<p>Forme juridique : <b> {{ $order->company?->tp_legal_form }} </b></p>
				</div>

			</div>
		</article>
		{{-- END SIDE A --}}

		{{-- SIDE B --}}
		<article class="identification_b">
			<div>
				<h5>B. Client</h5>
				<p>Nom et Prénom ou Raison Socail : <b>

					{{$order->client->name}}
				</b></p>
				<p>Résident à : <b>{{ $order->addresse_client }}</b></p>
				<p>Assujeti à la TVA : {{$order->client->vat_customer_payer ? "OUI" : "NON" }}         </p>
				<p>NIF : <b>{{$order->client->customer_TIN ?? ""}}</b> </p>
				<h5>Doit pour ce qui suit : </h5>
			</div>
		</article>
		{{-- END SIDE B --}}

		<article>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Nature de l'article</th>
						{{-- <th>Nbre de sacs</th> --}}
						<th>Quantité</th>
						<th>PU</th>
						<th>PV-HTVA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order->products as $key=> $product)
					<tr>
						<td>{{ $key +1 }}</td>
						<td> {{ $product['name'] }}</td>
						{{-- <td class="adroite">{{ $product['nombre_sac'] ?? 0 }}</td> --}}
						<td class="adroite"> {{ $product['quantite'] }}</td>
						<td class="adroite"> {{ getPrice($product['price'] ) }}</td>
						<td class="adroite"> {{ getPrice( $product['price'] * $product['quantite'])  }}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4">PVT HTVA </td>
						<td class="adroite"><b>{{ getPrice($order->amount_tax) }}</b></td>
					</tr>
					<tr>
						<td colspan="4">TVA ( 18 %)</td>
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
                <br>
                <br>
			</article>

{{--			<footer>--}}
{{--				<div>--}}
{{--					<h4>Confirming Order</h4>--}}
{{--					<h4>Head of Commercial</h4>--}}
{{--					<h4>Tanguy HICUBURUNDI</h4>--}}
{{--				</div>--}}
{{--				<div class="aling-right">--}}
{{--					<h4>Confirming Full Payment</h4>--}}
{{--					<h4>Head of Finance ai</h4>--}}
{{--					<h4>Eric KAPARAYE</h4>--}}
{{--				</div>--}}
{{--			</footer>--}}
{{--			<div>--}}
{{--				<h4 class="text-center">MANAGING DIRECTOR</h4>--}}
{{--				<h4 class="text-center">Fabien GAHUNGU</h4>--}}
{{--			</div>--}}
			<div>
				<hr>
				<h4 class="text-center"> {{$order->invoice_signature}}</h4>
			</div>
		</div>
		<script>
			function print(){
				printJS({
					printable: "printJS-form",
					type: 'html',
					css : {{"". asset('css/facture.css')."" }}
				}
				);
			}
		</script>
	</body>
	</html>
