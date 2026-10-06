@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('assurances.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            <h4 class="text-center">Liste des Assurances</h4>
        </div>
        <div class="col-md-6">
            {{-- Search form if needed --}}
        </div>
    </div>

    <table class="table table-sm">
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
    <div class="col-md-12">
        {{ $assurances->links() }}
    </div>
</div>
@endsection
