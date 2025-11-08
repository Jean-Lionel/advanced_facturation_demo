@extends('layouts.app')

@section('content')

@if(env('APP_USE_ABONEMENT', false))
    @include('journals._header_file')
@endif

<div class="container-fluid">
    <!-- Barre de recherche globale -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="searchGlobal" class="form-control form-control-lg"
                               placeholder="Rechercher un commissionnaire ou un client...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Commissionnaires -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div  class="card-header bg-primary text-white d-flex justify-content-between ">
                    <h5 class="mb-0"><i class="fas fa-user-tie"></i> Commissionnaires</h5>
                    <h5 class="text-white fw-bold">{{$commissionnairesData->count()}}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover mb-0" id="tableCommissionnaires">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Nom</th>
                                    <th class="text-end">Commission</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commissionnairesData as $compte)
                                {{-- {{$commissionnaire}} --}}
                                <tr class="searchable-row">
                                    <td class="searchable-name">{{ $compte?->client?->name ?? 'N/A' }}</td>
                                    <td class="text-end fw-bold">{{ number_format($compte?->montant, 2, ',', ' ') }} BIF</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success btn-payer"
                                                data-type="commissionnaire"
                                                data-id="{{ $compte->id }}"
                                                data-client="{{ $compte?->client_id }}"
                                                data-name="{{ $compte?->client?->name ?? 'N/A' }}"
                                                data-montant="{{ $compte?->montant }}"
                                                >
                                            <i class="fas fa-money-bill-wave"></i> Payer
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
                <div class="card-header bg-primary text-white  d-flex   justify-content-between">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Clients</h5>
                    <h5 class="text-white fw-bold">{{$clientsData->count()}}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover mb-0" id="tableClients">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Nom</th>
                                    <th class="text-end">Commission</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clientsData as $compte)
                                <tr class="searchable-row">
                                    <td class="searchable-name">{{ $compte?->client?->name ?? 'N/A' }}</td>
                                    <td class="text-end fw-bold">{{ number_format($compte->montant, 2, ',', ' ') }} BIF</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success btn-payer"
                                                data-type="client"
                                                data-id="{{ $compte->id }}"
                                                data-client="{{ $compte?->client_id }}"
                                                data-name="{{ $compte?->client?->name ?? 'N/A' }}"
                                                data-montant="{{ $compte?->montant }}">
                                            <i class="fas fa-money-bill-wave"></i> Payer
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
                <div class="card-header bg-primary text-white">
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
                <div class="card-header bg-primary text-white">
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
                                    <td><small>{{ $pay->title }}</small></td>
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
        <div class="card-header bg-primary text-white">
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
                            <td class="text-center text-white"><span class="badge bg-primary">{{ $item->order_id }}</span></td>
                            <td>{{ $item->commisionnaire?->name ?? '-' }}</td>
                            <td>{{ $item->client?->name ?? '-' }}</td>
                            <td class="text-end fw-bold">{{ number_format($item->montant, 0, ',', ' ') }}</td>
                            <td>
                                <small>
                                    @foreach ($item->interet as $key => $element)
                                        <span >{{ $key }}: {{ number_format($element, 1, ',', ' ') }}</span> <strong>;</strong>
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

<!-- Modal de confirmation de paiement -->
<div class="modal fade" id="modalPaiement" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-money-bill-wave"></i> Confirmer le Paiement</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formPaiement" method="POST" action="{{ route('paiement.interet') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="type" id="paymentType">
                    <input type="hidden" name="compte_id" id="paymentCompteId">
                    <input type="hidden" name="client_id" id="paymentClientId">


                    <div class="alert alert-info">
                        <strong>Bénéficiaire :</strong> <span id="paymentName"></span><br>
                        <strong>Type :</strong> <span id="paymentTypeText"></span><br>
                        <strong>Montant :</strong> <span id="paymentMontant"></span> BIF
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Montant à payer <span class="text-danger">*</span></label>
                        <input type="number" name="montant" id="inputMontant" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarque</label>
                        <textarea name="remarque" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Confirmer le Paiement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}
.searchable-row.hidden {
    display: none;
}
</style>
@endsection
@section('javascript')
<script>
$(document).ready(function() {
    // DataTable pour les détails
    $('#interet').DataTable({
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
        },
        order: [[0, 'desc']]
    });

    // Recherche globale
    $('#searchGlobal').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();

        $('.searchable-row').each(function() {
            const name = $(this).find('.searchable-name').text().toLowerCase();
            if (name.includes(searchTerm)) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    });

    // Gestion du bouton payer
    $('.btn-payer').on('click', function() {
        const type = $(this).data('type');
        const id = $(this).data('id');
        const client = $(this).data('client');
        const name = $(this).data('name');
        const montant = $(this).data('montant');

        $('#paymentType').val(type);
        $('#paymentCompteId').val(id);
        $('#paymentClientId').val(client);
        $('#paymentName').text(name);
        $('#paymentTypeText').text(type === 'client' ? 'Client' : 'Commissionnaire');
        $('#paymentMontant').text(new Intl.NumberFormat('fr-FR').format(montant));
        $('#inputMontant').val(montant);

        const modal = new bootstrap.Modal(document.getElementById('modalPaiement'));
        modal.show();
    });

    // Soumission du formulaire
    $('#formPaiement').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Paiement enregistré avec succès !');
                    location.reload();
                } else {
                    alert('Erreur: ' + (response.message || 'Une erreur est survenue'));
                }
            },
            error: function(xhr) {
                alert('Erreur lors du paiement: ' + (xhr.responseJSON?.message || 'Erreur serveur'));
            }
        });
    });
});
</script>

@endsection
