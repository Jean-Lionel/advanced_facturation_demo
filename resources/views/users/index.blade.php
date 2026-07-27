@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('users._header_config')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des utilisateurs</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('users.index') }}" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher ici">
                </form>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th>Rôles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        <span class="badge badge-light border">{{ $role->name }}</span>
                                    @empty
                                        <span class="text-muted">—</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="app-table-actions">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-info btn-sm">
                                            Modifier
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="post" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (method_exists($users, 'links'))
            <div class="app-pagination">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
