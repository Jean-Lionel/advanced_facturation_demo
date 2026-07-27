@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des Assurances</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('assurances.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOM</th>
                            <th scope="col">TELEPHONE</th>
                            <th scope="col">ADRESSE</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assurances as $assurance)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $assurance->name }}</td>
                            <td>{{ $assurance->phone }}</td>
                            <td>{{ $assurance->addresse }}</td>
                            <td class="d-flex">
                                <a href="{{ route('assurances.edit', $assurance->id) }}" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                                <form action="{{ route('assurances.destroy', $assurance->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette assurance ?');">
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
            {{ $assurances->links() }}
        </div>
    </div>
</div>
@endsection
