@extends('layouts.app')

@section('title', 'Paiements de la dette - Facture #' . $order_id)

@section('content')
<div class="container-fluid py-3">

    {{-- Header & Navigation --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('facture.credit') }}" class="btn btn-outline-secondary btn-sm mr-3 noprint">
                <i class="fas fa-arrow-left mr-1"></i> Retour
            </a>
            <div>
                <h4 class="mb-0 text-dark font-weight-bold">
                    <i class="fas fa-file-invoice-dollar text-primary mr-2"></i>Détails et Paiements de la Facture #{{ $order_id }}
                </h4>
                <small class="text-muted">Historique des remboursements et suivi du compte client</small>
            </div>
        </div>

        <div class="noprint d-flex gap-2">
            <button class="btn btn-outline-info btn-sm mr-2" onclick="window.print()">
                <i class="fas fa-print mr-1"></i> Imprimer
            </button>
            <a href="{{ route('facture.credit') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-list mr-1"></i> Factures à crédit
            </a>
        </div>
    </div>

    {{-- Feedback Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @php
        $clientName = $order->client->name ?? 'Client comptant';
        $clientPhone = $order->client->telephone ?? $order->client->phone ?? null;
        $orderAmount = (float) ($order->amount ?? 0);
        $totalDette = $dettes->sum('montant');
        $totalRestant = $dettes->sum('montant_restant');
        if ($dettes->isEmpty() && $order) {
            $totalDette = $orderAmount;
            $totalRestant = $orderAmount;
        }
        $totalPaye = max(0, $totalDette - $totalRestant);
        $isSolde = $totalRestant <= 0;
    @endphp

    {{-- Summary Cards (KPIs) --}}
    <div class="row mb-4">
        {{-- Card: Client Info --}}
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-primary text-white mr-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="text-uppercase text-muted font-weight-bold small">Client</span>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-1">{{ $clientName }}</h5>
                    @if($clientPhone)
                        <div class="small text-muted"><i class="fas fa-phone-alt mr-1"></i>{{ $clientPhone }}</div>
                    @endif
                    @if($order && $order->created_at)
                        <div class="small text-muted mt-1"><i class="far fa-calendar-alt mr-1"></i>Date : {{ $order->created_at->format('d/m/Y H:i') }}</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Card: Montant Total --}}
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-info text-white mr-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <span class="text-uppercase text-muted font-weight-bold small">Montant Total</span>
                    </div>
                    <h4 class="font-weight-bold text-dark mb-1">{{ getPrice($totalDette > 0 ? $totalDette : $orderAmount) }}</h4>
                    <span class="badge badge-info">TVAC Inclus</span>
                </div>
            </div>
        </div>

        {{-- Card: Déjà Payé --}}
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle p-2 bg-success text-white mr-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-uppercase text-muted font-weight-bold small">Déjà Payé</span>
                    </div>
                    <h4 class="font-weight-bold text-success mb-1">{{ getPrice($totalPaye) }}</h4>
                    <span class="text-muted small">Remboursements enregistrés</span>
                </div>
            </div>
        </div>

        {{-- Card: Reste à Payer --}}
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 {{ $isSolde ? 'border-left-success' : 'border-left-danger' }} bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="rounded-circle p-2 {{ $isSolde ? 'bg-success' : 'bg-danger' }} text-white mr-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas {{ $isSolde ? 'fa-check-double' : 'fa-hand-holding-usd' }}"></i>
                        </div>
                        <span class="text-uppercase font-weight-bold small {{ $isSolde ? 'text-success' : 'text-danger' }}">Reste à Payer</span>
                    </div>
                    <h4 class="font-weight-bold {{ $isSolde ? 'text-success' : 'text-danger' }} mb-1">{{ getPrice($totalRestant) }}</h4>
                    @if($isSolde)
                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i>Soldé / Tout est payé</span>
                    @else
                        <span class="badge badge-warning text-dark"><i class="fas fa-clock mr-1"></i>En attente de paiement</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="row">

        {{-- Liste des Dettes Enregistrées --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-coins text-warning mr-2"></i>État de la dette
                    </h6>
                    @if($totalRestant > 0 && $order)
                    <button class="btn btn-success btn-sm noprint" data-toggle="modal" data-target="#modalPaiementRapide">
                        <i class="fas fa-plus-circle mr-1"></i> Effectuer un paiement
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Montant Initial</th>
                                    <th>Reste à Payer</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th class="text-right noprint">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dettes as $dette)
                                    <tr>
                                        <td class="align-middle font-weight-bold">#{{ $dette->id }}</td>
                                        <td class="align-middle font-weight-bold">{{ getPrice($dette->montant) }}</td>
                                        <td class="align-middle">
                                            <span class="font-weight-bold {{ $dette->montant_restant > 0 ? 'text-danger' : 'text-success' }}">
                                                {{ getPrice($dette->montant_restant) }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if ($dette->montant_restant <= 0 || $dette->status == 'DEJA PAYE')
                                                <span class="badge badge-success px-2 py-1">Payé</span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1">Impayé</span>
                                            @endif
                                        </td>
                                        <td class="align-middle small text-muted">
                                            {{ $dette->created_at ? $dette->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="align-middle text-right noprint">
                                            @if($dette->montant_restant > 0)
                                                <a href="{{ route('paimenent_dette.create', ['dette' => $dette->id]) }}" class="btn btn-outline-primary btn-sm" title="Payer via formulaire">
                                                    <i class="fas fa-money-bill-wave"></i> Payer
                                                </a>
                                            @else
                                                <span class="text-success small font-weight-bold"><i class="fas fa-check"></i> Réglé</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle fa-2x mb-2 d-block text-secondary"></i>
                                            Aucun enregistrement de dette spécifique trouvé pour cette facture.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Historique des Remboursements / Versements --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-history text-info mr-2"></i>Historique des paiements reçus
                    </h6>
                    <span class="badge badge-secondary badge-pill">
                        @php
                            $allDetails = $dettes->flatMap->details;
                        @endphp
                        {{ $allDetails->count() }} versement(s)
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Date & Heure</th>
                                    <th>Montant Versé</th>
                                    <th>Encaissé par</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allDetails as $detail)
                                    <tr>
                                        <td class="align-middle font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <i class="far fa-calendar-alt text-muted mr-1"></i>
                                            {{ $detail->created_at ? $detail->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="align-middle font-weight-bold text-success">
                                            + {{ getPrice($detail->montant) }}
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-user-circle text-muted mr-1"></i>
                                            {{ $detail->user->name ?? 'Utilisateur #' . $detail->user_id }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-receipt fa-2x mb-2 d-block text-secondary"></i>
                                            Aucun paiement partiel ou total n'a encore été enregistré.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($allDetails->isNotEmpty())
                            <tfoot class="thead-light">
                                <tr>
                                    <th colspan="2" class="text-right">Total des versements :</th>
                                    <th class="text-success font-weight-bold">{{ getPrice($allDetails->sum('montant')) }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- Modal de Paiement Rapide --}}
@if($totalRestant > 0 && $order)
<div class="modal fade noprint" id="modalPaiementRapide" tabindex="-1" role="dialog" aria-labelledby="modalPaiementRapideLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('facture.payer', $order) }}" method="POST" class="modal-content border-0 shadow">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="modalPaiementRapideLabel">
                    <i class="fas fa-cash-register mr-2"></i>Enregistrer un paiement - Facture #{{ $order->id }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="bg-light p-3 rounded mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Client :</span>
                        <span class="font-weight-bold">{{ $clientName }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Total Facture :</span>
                        <span>{{ getPrice($totalDette) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Déjà payé :</span>
                        <span class="text-success font-weight-bold">{{ getPrice($totalPaye) }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between">
                        <span class="text-dark font-weight-bold">Reste à payer :</span>
                        <span class="text-danger font-weight-bold h5 mb-0">{{ getPrice($totalRestant) }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="montant_paye" class="font-weight-bold">Montant à verser (Fbu)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                        </div>
                        <input type="number"
                               min="0.01"
                               max="{{ $totalRestant }}"
                               step="0.01"
                               name="montant_paye"
                               id="montant_paye"
                               value="{{ $totalRestant }}"
                               class="form-control form-control-lg font-weight-bold text-primary"
                               required>
                    </div>
                    <small class="form-text text-muted">Saisissez le montant versé par le client.</small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="payer_tout" value="1" class="btn btn-outline-success">
                    <i class="fas fa-check-double mr-1"></i> Tout Payer ({{ getPrice($totalRestant) }})
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Enregistrer le versement
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@endsection