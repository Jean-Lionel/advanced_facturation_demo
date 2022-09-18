<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FACTURE  {{ RAISON_ENTREPRISE }}</title>
	  <link rel="stylesheet" href="{{ asset('css/prothem.css') }}">
</head>
<body>

	<div class="main-content">
		{{-- Entete --}}
		<header class="header-facture">
			<div>
			<h3>LOGO DE	</h3>
			<h3>L'ENTREPRISE</h3>
			</div>
			<div style="width: 80%;">
				<h3>{{ RAISON_ENTREPRISE }} Siège Social : Gisozi-Mwaro</h3>
				<h3>Bureau de liaison: Rohero II, Boulevard de l'UPRONA N°97, </h3>
				<h3>
					B.P.176 Bujumbura, BURUNDI,
				</h3>
				<h3>
					Tél : {{BASE_TELELEPHONE}}
				</h3>
				<h3>
					Email : info@prothem.bi, WebSite: www.prothem.bi
				</h3>
				<hr>
			</div>
			
		</header>
		{{-- Fin --}}

		{{-- SIDE A --}}
		<article class="identification_a">
			<div>
				<h5>A. Identification du vendeur</h5>
				<p>Nom et prénom ou Raison Social : <b>{{RAISON_ENTREPRISE}}</b></p>
				<p>NIF : <b>{{BASE_NIF}}</b></p>
				<p>Registre du commerce No : <b>{{BASE_RC}}</b></p>
				<p>BP: <b>{{BASE_BP}}</b> , Tél <b>{{BASE_TELELEPHONE}}</b></p>
				<p>Commune : <b>{{ BASE_COMMUNE }}</b>, Quartier : {{BASE_QUARTIER}}</p>
				<p>Avenue : <b>{{BASE_AVENUE}}</b></p>
				Assujetti à la TVA : <b>OUI</b>
				
			</div>
			<div class="aling-right partie-droite">
				<div class="right-border">
				</div>
				<div>
					<h5>Facture N° 8 du {{date('d m Y')}} </h5>
					<p>Centre Fiscal : <b>DGC</b></p>
					<p>Secteur d'activité : <b>INDUSTRIEL</b></p>
					<p>Forme juridique : <b>SA</b></p>
					
				</div>
				
			</div>
		</article>
		{{-- END SIDE A --}}

		{{-- SIDE B --}}
		<article class="identification_b">
			<div>
				<h5>B. Client</h5>
				<p>Nom et Prénom ou Raison Socail : <b>........x...</b></p>
				<p>Résident à : <b>Gihosha</b></p>
				<p>Assujeti à la TVA : OUI        NON</p>
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
						<th>Nbre de sacs</th>
						<th>Qté en Kg</th>
						<th>PU/ Kg</th>
						<th>PV-HTVA</th>
					</tr>
				</thead>
				<tbody>

                @foreach([45,45,14,2,524,2] as $key=> $product)

                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $key +1 }}</td>
                </tr>

                @endforeach
                <tr>
                    <td colspan="3">PVT HTVA </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">TVA ( 18 %)</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">TOTAL TVAC</td>
                    <td></td>
				</tbody>
			</table>
			<h4>Mention Obligatoire</h4>
			<h4>NB: Les non assujettis à la TVA ne remplissent pas les deuc dernières lignes</h4>
		</article>

		<footer>
			<div>
				<h4>Confirming Oder</h4>
				<h4>Head of Commercial</h4>
				<h4>Tanguy HICUBURUNDI</h4>
			</div>
			<div class="aling-right">
				<h4>Confirming Full Payment</h4>
				<h4>Head of Finance ai</h4>
				<h4>Eric KAPARAYE</h4>
			</div>
		</footer>
	</div>
</body>
</html>