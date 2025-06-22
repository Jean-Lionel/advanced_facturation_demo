
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
}
</style>

@foreach ($clientMaisons as $maison)

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
        <td>0</td>
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

