@extends('layouts.app')

@section('content')
<div class="app-page">
    @if (env('APP_USE_ABONEMENT', false))
        @include('compte._header')
    @endif

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des abonnées</h2>
            <div class="app-toolbar-actions">
                <form action="" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici">
                </form>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOM COMPTE</th>
                            <th>NOM</th>
                            <th>TELEPHONE</th>
                            <th>Adresse</th>
                            <th>Solde</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $value)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td class="justify-content">{{ $value->compte->name }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->telephone }}</td>
                            <td>{{ $value->addresse }}</td>
                            <td>{{ number_format($value->compte->montant, 2) }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('compte.recharge',$value->compte) }}" class="btn btn-outline-info btn-sm mr-2">Recharger</a>
                                <a href="{{ route('compte.retrait',$value->compte) }}" class="btn btn-outline-warning btn-sm mr-2">Retrait</a>
                                <a href="{{ route('historique', $value) }}" class="btn btn-outline-success btn-sm mr-2">Historique</a>
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
