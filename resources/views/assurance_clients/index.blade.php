@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('assurance_clients.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            <h4 class="text-center">Liste des Assurances Clients</h4>
        </div>
        <div class="col-md-6">
            {{-- Search form if needed --}}
        </div>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">CLIENT</th>
                <th scope="col">ASSURANCE</th>
                <th scope="col">DATE EXPIRATION</th>
                <th scope="col">PART CLIENT</th>
                <th scope="col">PART ASSURANCE</th>
                <th scope="col">Action</th>
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
    <div class="col-md-12">
        {{ $assuranceClients->links() }}
    </div>
</div>
@endsection
