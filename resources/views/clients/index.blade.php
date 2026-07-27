@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('compte._header')

    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des clients</h2>
            <div class="app-toolbar-actions">
                <span class="app-meta">Total: <b>{{ $nombre_total_clients }}</b></span>
                <form action="" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici" value="{{ \Request::get('search') ?? '' }}">
                </form>
                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NUMERO</th>
                            <th>NOM</th>
                            <th>TELEPHONE</th>
                            <th>NIF</th>
                            <th>Adresse</th>
                            @if (env('APP_USE_ABONEMENT', false))
                                <th>Commissionnaire</th>
                                <th>Fournisseur</th>
                                <th>Porteur</th>
                                <th>Abonnées</th>
                            @endif
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $value)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->telephone }}</td>
                                <td>{{ $value->customer_TIN }}</td>
                                <td>{{ $value->addresse }}</td>
                                @if (env('APP_USE_ABONEMENT', false))
                                    <td>{{ $value->is_commissionaire ? 'on' : '' }}</td>
                                    <td>{{ $value->is_fournisseur }}</td>
                                    <td>{{ $value?->commissionaire?->name }}</td>
                                    <td>{{ $value->compte->name ?? '' }}</td>
                                @endif
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a href="{{ route('clients.edit', $value) }}" class="mr-1 btn btn-outline-info btn-sm">Modifier</a>
                                    @if(env('APP_USE_ABONEMENT', false))
                                        <a href="{{ route('clients_abones', $value->id) }}" class="mr-1 btn btn-outline-info btn-sm">Abonée</a>
                                        <a href="{{ route('make_commissionnaire', $value->id) }}" class="mr-1 btn btn-outline-info btn-sm">Commissionnaire</a>
                                    @endif
                                    @if(env('APP_USE_ASSURANCE', false))
                                        <a href="{{ route('assurance_clients.create', $value->id) }}" class="mr-1 btn btn-outline-info btn-sm">Assurances</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection
