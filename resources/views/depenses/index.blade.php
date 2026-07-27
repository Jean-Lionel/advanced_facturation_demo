@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Toutes les dépenses</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depense-categories.index') }}" class="app-btn-ghost">Catégories</a>
                <a href="{{ route('depenses.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body">
            <form action="{{ route('depenses.index') }}" method="GET" id="depenses-filter-form">
                <div class="app-form-grid">
                    <div class="form-group mb-0">
                        <label for="start_date">Du</label>
                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ $startDate }}">
                    </div>
                    <div class="form-group mb-0">
                        <label for="end_date">Au</label>
                        <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ $endDate }}">
                    </div>
                    <div class="form-group mb-0">
                        <label for="search">Recherche</label>
                        <input type="text" name="search" id="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Action ou description">
                    </div>
                    <div class="form-group mb-0 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                    </div>
                </div>
            </form>

            @if ($startDate && $endDate)
                <div class="mt-3 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="app-meta">
                        <strong>Période :</strong>
                        {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
                        &rarr;
                        {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
                        @if (!is_null($totalMontant))
                            <span class="ml-2 text-danger">
                                <strong>Total :</strong> {{ number_format($totalMontant, 2, ',', ' ') }} FBu
                            </span>
                        @endif
                    </div>
                    <div class="app-toolbar-actions mt-2 mt-md-0">
                        @php
                            $exportParams = [
                                'start_date' => $startDate,
                                'end_date' => $endDate,
                                'search' => $search,
                            ];
                        @endphp
                        <a href="{{ route('depenses.export.excel', $exportParams) }}" class="btn btn-success btn-sm">Exporter Excel</a>
                        <a href="{{ route('depenses.export.pdf', $exportParams) }}" class="btn btn-danger btn-sm">Exporter PDF</a>
                        <a href="{{ route('depenses.print', $exportParams) }}" class="btn btn-info btn-sm" target="_blank">Imprimer</a>
                    </div>
                </div>
            @else
                <p class="mb-0 mt-2 text-muted small">
                    Sélectionnez une période (du / au) puis cliquez sur « Filtrer » pour afficher, exporter ou imprimer les dépenses.
                </p>
            @endif
        </div>
    </div>

    <div class="app-card">
        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Catégorie</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Fait par</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($depenses as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->category->name ?? '-' }}</td>
                                <td>{{ number_format($value->montant, 2, ',', ' ') }}</td>
                                <td>{{ $value->date_depense ? $value->date_depense->format('d/m/Y') : $value->created_at->format('d/m/Y') }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->user->name ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }})">Supprimer</button>
                                    <form id="delete-form-{{ $value->id }}" action="{{ route('depenses.destroy', $value) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune dépense trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="app-pagination">
            {{ $depenses->links() }}
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function confirmDelete(event, id) {
        event.preventDefault();
        if (confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
