@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $member->firstname }} {{ $member->last_name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($member->profile_image)
                                <img src="{{ asset($member->profile_image) }}"
                                     alt="{{ $member->firstname }} {{ $member->last_name }}"
                                     class="img-fluid rounded-circle"
                                     style="max-width: 200px;">
                            @else
                                <div class="rounded-circle bg-light text-center p-4">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <strong>Email:</strong>
                                <p>{{ $member->email }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Titre:</strong>
                                <p>{{ $member->title }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Téléphone:</strong>
                                <p>{{ $member->phone }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Adresse:</strong>
                                <p>{{ $member->address }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Description:</strong>
                                <p>{{ $member->description }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Statut:</strong>
                                <span class="badge {{ $member->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $member->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Organisation:</strong>
                                <p>{{ $member->organisation->name ?? 'Aucune organisation' }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Créé par:</strong>
                                <p>{{ $member->user->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Dernière mise à jour:</strong>
                                <p>{{ $member->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('advanced.members.edit', $member) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('advanced.members.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection