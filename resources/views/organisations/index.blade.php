@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Organisations</h1>
        <a href="{{ route('advanced.organisations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle Organisation
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Créé par</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($organisations as $organisation)
                            <tr>
                                <td>{{ $organisation->name }}</td>
                                <td>{{ $organisation->description }}</td>
                                <td>{{ $organisation->user->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('advanced.organisations.show', $organisation) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('advanced.organisations.edit', $organisation) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                       <!--  <form action="{{ route('advanced.organisations.destroy', $organisation) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette organisation ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> -->
                                    </div>
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