
<style>
.page-break {
    page-break-after: always;
}
table{
    width: 100%;
    border-collapse: collapse;
}
tr, th,td{
    border: 1px solid #000;
    padding-top: 5px;
    padding-bottom: 5px;


}
</style>
<div style="">




@foreach ($clientMaisons as $maison)
<div style="text-align: left;">
        <h2 style="margin-bottom: 0; text-transform: uppercase; text-align: center;">{{ $entreprise->tp_name }}</h2>
        <p style="margin: 0;">NIF : {{ $entreprise->tp_TIN }}</p>
        <p style="margin: 0;">RC : {{ $entreprise->tp_trade_number }}</p>
        <p style="margin: 0;">Tél : {{ $entreprise->tp_phone_number }}</p>
        <p style="margin: 0;">Commune : {{ $entreprise->tp_address_privonce }}</p>
        <p style="margin: 0;">Quartier : {{ $entreprise->tp_address_avenue }}</p>
        <p style="margin: 0;">Rue : {{ $entreprise->tp_address_quartier }}</p>
        <p style="margin: 0;">Commune : {{ $entreprise->tp_address_commune }}</p>
        <p style="margin: 0;">Rue : {{ $entreprise->tp_address_rue }}</p>
        <p style="margin: 0;">N° : {{ $entreprise->tp_address_number }}</p>

    </div>


<table>

    <tr>
        <th>SHOP</th>
        <th>{{$maison->name}}</th>
    </tr>
    <tr>
        <th>Client</th>
        <th>{{$maison->clients->first()->name}}</th>
    </tr>
    <tr>
        <th>Avance</th>
        <td>{{$maison->avance}}</td>
    </tr>
    <tr>
        <th>Téléphone</th>
        <td>{{$maison->clients->first()->telephone}}</td>
    </tr>
    <tr>
        <th>Rent</th>
        <td>{{$maison->montant}}</td>
    </tr>
    <tr>
        <th>Annee</th>
        <td>2025</td>
    </tr>

    @foreach ($months as $month)
    <tr>
        <th>{{$month}}</th>
        <td></td>
    </tr>
    @endforeach
</table>

<div class="page-break"></div>
@endforeach

