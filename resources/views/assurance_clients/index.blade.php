@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des Assurances Clients</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('assurance_clients.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CLIENT</th>
                            <th>ASSURANCE</th>
                            <th>DATE EXPIRATION</th>
                            <th>PART CLIENT</th>
                            <th>PART ASSURANCE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assuranceClients as $item)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $item->client->name ?? 'N/A' }}</td>
                            <td>{{ $item->assurance->name ?? 'N/A' }}</td>
                            <td>{{ $item->expire_date ? $item->expire_date->format('d/m/Y') : '' }}</td>
                            <td>{{ $item->par_client }}%</td>
                            <td>{{ $item->par_assurance }}%</td>
                            <td class="d-flex">
                                <a href="{{ route('assurance_clients.edit', $item->id) }}" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                                <form action="{{ route('assurance_clients.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette assurance client ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $assuranceClients->links() }}
        </div>
    </div>
</div>
@endsection
