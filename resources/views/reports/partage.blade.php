@extends('layouts.app')

@section('content')

@if(env('APP_USE_ABONEMENT', false))
    @include('journals._header_file')
@endif

<div class="container-fluid">
    <div class="row">
        <!-- Commissionnaires -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-tie"></i> Commissionnaires</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Nom</th>
                                    <th class="text-end">Commission</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($totaux['commissionnaires'] as $id => $montant)
                                <tr>
                                    <td>{{ $commissionnairesData[$id] ?? 'N/A' }}</td>
                                    <td class="text-end fw-bold">{{ number_format($montant, 0, ',', ' ') }} BIF</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="fas fa-tools"></i> En cours
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Aucun commissionnaire</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Clients</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Nom</th>
                                    <th class="text-end">Commission</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($totaux['clients'] as $id => $montant)
                                <tr>
                                    <td>{{ $clientsData[$id] ?? 'N/A' }}</td>
                                    <td class="text-end fw-bold">{{ number_format($montant, 0, ',', ' ') }} BIF</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="fas fa-tools"></i> En cours
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Aucun client</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Résumé Global -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Résumé Global</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <span class="text-muted">Entreprise</span>
                        <span class="h5 mb-0 text-primary">{{ number_format($totaux['entreprise'], 0, ',', ' ') }} BIF</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Informaticien</span>
                        <span class="h5 mb-0 text-success">{{ number_format($totaux['informaticien'], 0, ',', ' ') }} BIF</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Derniers Paiements</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Client</th>
                                    <th>Type</th>
                                    <th class="text-end">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historiquesPayment ?? [] as $pay)
                                <tr>
                                    <td><small>{{ $pay->client->name ?? 'N/A' }}</small></td>
                                    <td><small class="badge bg-secondary">{{ $pay->title }}</small></td>
                                    <td class="text-end"><small>{{ number_format($pay->montant, 0, ',', ' ') }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <small>Aucun paiement récent</small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails des Intérêts -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-list"></i> Détails des Intérêts</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="interet" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>N° Facture</th>
                            <th>Commissionnaire</th>
                            <th>Client</th>
                            <th class="text-end">Total</th>
                            <th>Répartition</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interets as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-center"><span class="badge bg-primary">{{ $item->order_id }}</span></td>
                            <td>{{ $item->commisionnaire?->name ?? '-' }}</td>
                            <td>{{ $item->client?->name ?? '-' }}</td>
                            <td class="text-end fw-bold">{{ number_format($item->montant, 0, ',', ' ') }}</td>
                            <td>
                                <small>
                                    @foreach ($item->interet as $key => $element)
                                        <span class="badge bg-secondary me-1">{{ $key }}: {{ number_format($element, 0, ',', ' ') }}</span>
                                    @endforeach
                                </small>
                            </td>
                            <td><small>{{ $item->created_at->format('d/m/Y H:i') }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
$(document).ready(function() {
    $('#interet').DataTable({
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
        },
        order: [[0, 'desc']]
    });
});
</script>

@endsection
