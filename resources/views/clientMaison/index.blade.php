@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('maisonLocation._header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des locataires</h2>
            <div class="app-toolbar-actions">
                <form action="" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici">
                </form>
                <a href="{{ route('client-maison.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Bien / Service</th>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Date de création</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientMaisons as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->client->name ?? '' }}</td>
                            <td>{{ $value->maisonlocation->name ?? '' }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->montant }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('client-maison.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
                                <form class="form-delete" action="{{ route('client-maison.destroy', $value) }}" style="display: inline;" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
