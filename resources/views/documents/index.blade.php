@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documents</h1>
        <a href="{{ route('advanced.documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Document
        </a>
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
    </div>
</div>
@endsection