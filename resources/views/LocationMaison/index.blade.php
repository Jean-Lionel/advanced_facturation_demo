@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Loueurs Impayés</h4>

    <form action="{{ route('LocationMaison.index') }}" method="GET">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="dateDebut">Date de début :</label>
                    <input type="date" class="form-control" id="dateDebut" name="dateDebut" value="{{ $dateDebut ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="dateFin">Date de fin :</label>
                   <input type="date" class="form-control" id="dateFin" name="dateFin" value="{{ $dateFin ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <br>
               <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>

    @if (isset($nonPayeursData) && count($nonPayeursData) > 0)
    <div class="row">
        <div class="col-12"> <h5>Récapitulatif</h5></div>
        <div class="col-3">  <p>Nombre de non-payeurs : {{ $nbreNonPayeurs }}</p></div>
        <div class="col-3">   <p>Total des loyers impayés : {{ $totalImpaye }}</p></div>

    </div>
   
  
 

    <h5>Liste des non-payeurs de loyer</h5>
    <table class="table">
        <thead>
            <tr>
            <tr>
                <th>Nom du client</th>
                <th>Téléphone</th>
                <th>maison louée</th>
                <th>Adresse de la maison louée</th>
                <th>Loyer mensuel</th>
                <th>Description</th>
                <th>Dernière échéance</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            @foreach ($nonPayeursData as $nonPayeur)
                <tr>
                    <td>{{ $nonPayeur['name'] }}</td>
                    <td>{{ $nonPayeur['telephone'] }}</td>
                    <td>{{ $nonPayeur['maison_louee'] }}</td>
                    <td>{{ $nonPayeur['adresse'] }}</td>
                    <td>{{ $nonPayeur['montant'] }}</td>
                    <td>{{ $nonPayeur['description'] }}</td>
                    <td>{{ $nonPayeur['Derniereecheance'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Aucun client locataire n'a été trouvé pour la période sélectionnée.</p>
    @endif
</div>
@endsection