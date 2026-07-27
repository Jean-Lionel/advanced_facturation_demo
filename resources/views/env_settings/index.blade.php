@extends('layouts.app')

@section('content')
<div class="app-page">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('migration_output'))
        <div class="alert alert-info">
            <strong>Détail de l'exécution :</strong>
            <pre class="mb-0 mt-2 small">{{ session('migration_output') }}</pre>
        </div>
    @endif

    <div class="app-card mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Migrations de la base de données</h2>
            <div class="app-toolbar-actions">
                <span class="app-meta">{{ $ranMigrationsCount }} / {{ $totalMigrationsCount }} exécutées</span>
            </div>
        </header>

        <div class="app-card-body">
            @if (count($pendingMigrations) === 0)
                <p class="mb-0 text-success">
                    Toutes les migrations sont à jour. Aucune table manquante détectée.
                </p>
            @else
                <p class="mb-3">
                    <strong>{{ count($pendingMigrations) }}</strong> migration(s) en attente
                    @if (count($missingTables) > 0)
                        — <strong>{{ count($missingTables) }}</strong> table(s) absente(s) de la base
                    @endif
                </p>

                @if (count($missingTables) > 0)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Tables manquantes</h6>
                        <ul class="mb-0 pl-3">
                            @foreach ($missingTables as $item)
                                <li>
                                    <code>{{ $item['table'] }}</code>
                                    <span class="text-muted small">({{ $item['migration'] }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <h6 class="font-weight-bold">Migrations en attente</h6>
                    <div class="app-table-wrap" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-sm app-table">
                            <thead>
                                <tr>
                                    <th>Migration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingMigrations as $migration)
                                    <tr>
                                        <td class="small"><code>{{ $migration['name'] }}</code></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <form action="{{ route('env_settings.run_migrations') }}" method="POST"
                      onsubmit="return confirm('Exécuter les migrations en attente ? Cette action modifie la structure de la base de données.');">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">
                        Synchroniser la base (tables/colonnes manquantes)
                    </button>
                    <p class="mb-0 mt-2 text-muted small">
                        Les tables et colonnes déjà présentes seront ignorées. Seules les structures manquantes seront créées ou ajoutées.
                    </p>
                </form>
            @endif
        </div>
    </div>

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">{{ __('Environment Settings') }}</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('env_settings.index') }}" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="text" name="search" placeholder="Search by key or value..." value="{{ request('search') }}">
                </form>
                <a href="{{ route('env_settings.create') }}" class="btn btn-primary btn-sm">Add New Setting</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th scope="col">Key</th>
                            <th scope="col">Value</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                            <tr>
                                <td class="font-weight-bold">{{ $setting->key }}</td>
                                <td>
                                    @if (Str::contains(strtoupper($setting->key), ['PASSWORD', 'SECRET', 'KEY', 'TOKEN']))
                                        ******
                                    @else
                                        {{ Str::limit($setting->value, 50) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('env_settings.edit', $setting) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                    <form action="{{ route('env_settings.destroy', $setting) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $settings->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
