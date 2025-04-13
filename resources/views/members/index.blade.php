@extends('layouts.advanced')

@section('content')
<div class="container-fluid mt-2">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>Membres</h1>
        <a href="{{ route('advanced.members.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Membre
        </a>
    </div>

    <!-- Formulaire de recherche -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Rechercher des membres</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('advanced.members.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Rechercher</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Nom, prénom, email ou organisation" value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <label for="organisation_id" class="form-label">Organisation</label>
                    <select name="organisation_id" id="organisation_id" class="form-control">
                        <option value="">Toutes les organisations</option>
                        @foreach($organisations as $organisation)
                            <option value="{{ $organisation->id }}" {{ request('organisation_id') == $organisation->id ? 'selected' : '' }}>
                                {{ $organisation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="is_active" class="form-label">Statut</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="">Tous les statuts</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                    <a href="{{ route('advanced.members.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des membres -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Titre</th>
                            <th>Téléphone</th>
                            <th>Organisation</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->firstname }} {{ $member->last_name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->title }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->organisation->name ?? 'Aucune' }}</td>
                                <td>
                                    <span class="badge {{ $member->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $member->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('advanced.members.show', $member) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('advanced.members.edit', $member) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('advanced.members.destroy', $member) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
