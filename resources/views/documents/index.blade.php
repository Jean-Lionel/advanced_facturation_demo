@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documents</h1>
        <a href="{{ route('advanced.documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Document
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('advanced.documents.index') }}" method="GET" class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nom ou description...">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="date_start" class="form-label">Date Début</label>
                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ request('date_start') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="date_end" class="form-label">Date Fin</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ request('date_end') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Toutes</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                    <a href="{{ route('advanced.documents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Membre</th>
                            <th>Client</th>
                            <th>Description</th>
                            <th>Fichier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->document_type }}</td>
                                <td>{{ $document->member ? $document->member->firstname . ' ' . $document->member->last_name : '-' }}</td>
                                <td>{{ $document->client ? $document->client->name : '-' }}</td>
                                <td>{{ $document->description }}</td>
                                <td>
                                    @if($document->transactionFile)
                                        <a href="{{ asset($document->transactionFile->file_url) }}" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-download"></i> Télécharger
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('advanced.documents.show', $document) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('advanced.documents.edit', $document) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('advanced.documents.destroy', $document) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $documents->links() }}
        </div>
    </div>
</div>
@endsection
