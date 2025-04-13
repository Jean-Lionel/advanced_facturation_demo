@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $document->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Type de document:</strong>
                        <p>{{ $document->document_type }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Membre:</strong>
                        <p>{{ $document->member ? $document->member->firstname . ' ' . $document->member->last_name : '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Client:</strong>
                        <p>{{ $document->client ? $document->client->name : '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $document->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Fichier:</strong>
                        <div class="mt-2">
                            @if($document->document_file)
                                <a href="{{ asset('documents/' . $document->document_file) }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            @endif

                            <iframe src="{{ asset('documents/' . $document->document_file) }}" width="100%" height="600px"></iframe>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Membres associés:</strong>
                        <ul class="list-group">
                            @foreach($document->members as $member)
                                <li class="list-group-item">
                                    {{ $member->firstname }} {{ $member->last_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection