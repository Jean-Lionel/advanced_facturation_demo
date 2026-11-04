@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier le document</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('advanced.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="name" class="form-label">Nom du document</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $document->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="document_type" class="form-label">Type de document</label>
                            <select name="document_type" id="document_type" class="form-control @error('document_type') is-invalid @enderror">
                                @foreach(TYPE_DOCUMENTS as $key => $value)
                                    <option value="{{ $key }}" {{ old('document_type', $document->document_type) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('document_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="member_id" class="form-label">Membre</label>
                            <select name="member_id" id="member_id" class="form-control @error('member_id') is-invalid @enderror">
                                <option value="">Sélectionnez un membre</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id', $document->member_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->last_name }} - {{ $member->organisation->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="client_id" class="form-label">Client</label>
                            <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror">
                                <option value="">Sélectionnez un client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $document->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $document->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Fichier</label>
                            @if($document->document_file)
                                <div class="d-flex align-items-center gap-2 border rounded p-2 mb-2 bg-light">
                                    @include('documents._thumbnail', ['document' => $document])
                                    <div class="flex-grow-1 text-break small">
                                        <strong class="d-block">Fichier actuel</strong>
                                        {{ $document->document_file }}
                                    </div>
                                    <a href="{{ $document->file_url }}" target="_blank" class="btn btn-sm btn-outline-info" title="Ouvrir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt,.jpg,.jpeg,.png,.gif,.webp" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ $document->document_file ? 'Laissez vide pour garder le fichier actuel.' : 'Aucun fichier pour le moment.' }}
                                PDF, Word, Excel, CSV, TXT, JPG, PNG, GIF, WEBP — {{ ini_get('upload_max_filesize') }} max.
                            </small>
                        </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.documents.show', $document) }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
