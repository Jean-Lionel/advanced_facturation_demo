@extends('layouts.advanced')

@section('content')
    <style>
        :root {
            --primary-color: #3498db;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #9b59b6;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }

        .page-header {
            background: linear-gradient(135deg, #003366 0%, #004d99 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .page-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
        }

        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 20px;
            background: white;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .kpi-card {
            border-left: 4px solid;
            min-height: 120px;
            position: relative;
            overflow: hidden;
        }

        .kpi-card.members { border-left-color: var(--primary-color); }
        .kpi-card.finance { border-left-color: var(--success-color); }
        .kpi-card.documents { border-left-color: var(--warning-color); }
        .kpi-card.transactions { border-left-color: var(--info-color); }

        .kpi-card .card-icon {
            font-size: 3rem;
            opacity: 0.1;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }

        .kpi-card .card-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .kpi-card .card-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #7f8c8d;
            margin-bottom: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .kpi-card .trend {
            font-size: 0.85rem;
            margin-top: 8px;
        }

        .trend.positive { color: var(--success-color); }
        .trend.negative { color: var(--danger-color); }
        .trend.neutral { color: var(--warning-color); }

        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }

        .table-section .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.25rem;
        }

        .table-section .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #2c3e50;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table th {
            font-weight: 600;
            color: #7f8c8d;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-top: none;
        }

        .badge-type {
            padding: 0.4em 0.8em;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 20px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #95a5a6;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.95rem;
        }

        .member-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .filters-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .filters-card .form-select {
            border: 1px solid #dee2e6;
            font-size: 0.9rem;
        }

        .btn-filter {
            background: #003366;
            border: none;
        }

        .btn-filter:hover {
            background: #004d99;
        }

        .form-label {
            font-weight: 500;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .filters-card .form-select:focus {
            border-color: #003366;
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.15);
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1rem;
            }
            .page-header h1 {
                font-size: 1.25rem;
            }
            .kpi-card .card-value {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="py-1 container-fluid">
        <!-- Page Header -->
       
        <!-- Filters -->
        <div class="mb-4 card dashboard-card filters-card">
            <div class="card-body py-3">
                <form method="GET" action="{{ route('advanced.index') }}" id="filterForm">
                    <div class="row align-items-end">
                        <div class="mb-2 col-md-3 mb-md-0">
                            <label class="form-label small text-muted mb-1">Annee</label>
                            <select class="form-select" name="year" id="yearFilter">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ $filters['year'] == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3 mb-md-0">
                            <label class="form-label small text-muted mb-1">Organisation</label>
                            <select class="form-select" name="organisation" id="departmentFilter">
                                <option value="">Toutes les organisations</option>
                                @foreach($organisations as $organisation)
                                    <option value="{{ $organisation->id }}" {{ $filters['organisation'] == $organisation->id ? 'selected' : '' }}>
                                        {{ $organisation->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3 mb-md-0">
                            <label class="form-label small text-muted mb-1">Membre</label>
                            <select class="form-select" name="member_id" id="memberFilter">
                                <option value="">Tous les membres</option>
                                @foreach($allMembers as $member)
                                    <option value="{{ $member->id }}" {{ $filters['member_id'] == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-filter btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Appliquer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Active Filters Tags -->
        @if($filters['member_id'] || $filters['organisation'] || $filters['year'] != now()->year)
            <div class="mb-3">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="text-muted small">Filtres actifs:</span>
                    @if($filters['year'] != now()->year)
                        <span class="badge bg-primary">
                            <i class="fas fa-calendar me-1"></i>{{ $filters['year'] }}
                        </span>
                    @endif
                    @if($filters['organisation'])
                        @php $selectedOrg = $organisations->find($filters['organisation']); @endphp
                        @if($selectedOrg)
                            <span class="badge bg-info">
                                <i class="fas fa-building me-1"></i>{{ $selectedOrg->name }}
                            </span>
                        @endif
                    @endif
                    @if($filters['member_id'])
                        @php $selectedMember = $allMembers->find($filters['member_id']); @endphp
                        @if($selectedMember)
                            <span class="badge bg-success">
                                <i class="fas fa-user me-1"></i>{{ $selectedMember->firstname }} {{ $selectedMember->last_name }}
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        @endif

        <!-- KPIs -->
        <div class="mb-4 row">
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card members">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Membres actifs</h6>
                        <div class="card-value">{{ number_format($stats['activeMembers']) }}</div>
                        <div class="trend {{ $stats['membersDiff'] >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-{{ $stats['membersDiff'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                            {{ $stats['membersDiff'] >= 0 ? '+' : '' }}{{ $stats['membersDiff'] }} en {{ $filters['year'] }}
                        </div>
                        <i class="fas fa-users card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card finance">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Revenus {{ $filters['year'] }}</h6>
                        <div class="card-value">{{ number_format($stats['totalRevenue'], 0, ',', ' ') }} <small class="text-muted" style="font-size: 0.6em;">FBU</small></div>
                        <div class="trend {{ $stats['revenuePercentChange'] >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-{{ $stats['revenuePercentChange'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                            {{ $stats['revenuePercentChange'] >= 0 ? '+' : '' }}{{ $stats['revenuePercentChange'] }}% vs {{ $filters['year'] - 1 }}
                        </div>
                        <i class="fas fa-coins card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card documents">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Documents {{ $filters['year'] }}</h6>
                        <div class="card-value">{{ number_format($stats['documentsThisYear']) }}</div>
                        <div class="trend {{ $stats['documentsDiff'] > 0 ? 'positive' : ($stats['documentsDiff'] < 0 ? 'negative' : 'neutral') }}">
                            @if($stats['documentsDiff'] > 0)
                                <i class="fas fa-arrow-up"></i> +{{ $stats['documentsDiff'] }} vs {{ $filters['year'] - 1 }}
                            @elseif($stats['documentsDiff'] < 0)
                                <i class="fas fa-arrow-down"></i> {{ $stats['documentsDiff'] }} vs {{ $filters['year'] - 1 }}
                            @else
                                <i class="fas fa-equals"></i> Stable
                            @endif
                        </div>
                        <i class="fas fa-folder-open card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card transactions">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Transactions {{ $filters['year'] }}</h6>
                        <div class="card-value">{{ number_format($stats['transactionsThisYear']) }}</div>
                        <div class="trend {{ $stats['transactionsDiff'] >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-{{ $stats['transactionsDiff'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                            {{ $stats['transactionsDiff'] >= 0 ? '+' : '' }}{{ $stats['transactionsDiff'] }} vs {{ $filters['year'] - 1 }}
                        </div>
                        <i class="fas fa-exchange-alt card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts - Transactions par membre -->
        <div class="row">
            <div class="mb-4 col-lg-8">
                <div class="card dashboard-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-chart-area me-2 text-primary"></i>Evolution des transactions par membre</h5>
                        <span class="badge bg-primary">{{ $filters['year'] }}</span>
                    </div>
                    <div class="card-body">
                        @if($transactionsByMemberAndMonth->count() > 0)
                            <div class="chart-container">
                                <canvas id="transactionsChart"></canvas>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-chart-line"></i>
                                <p>Aucune transaction enregistree cette annee</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-4">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-pie-chart me-2 text-success"></i>Repartition des membres</h5>
                    </div>
                    <div class="card-body">
                        @if($membersByOrganisation->count() > 0)
                            <div class="chart-container">
                                <canvas id="membersPieChart"></canvas>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Aucun membre enregistre</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts - Transactions par type -->
        <div class="row">
            <div class="mb-4 col-lg-8">
                <div class="card dashboard-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2 text-info"></i>Evolution des transactions par type</h5>
                        <span class="badge bg-info">{{ $filters['year'] }}</span>
                    </div>
                    <div class="card-body">
                        @if($transactionsByTypeAndMonth->count() > 0)
                            <div class="chart-container">
                                <canvas id="transactionsByTypeChart"></canvas>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-chart-bar"></i>
                                <p>Aucune transaction avec type defini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-4">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-tags me-2 text-warning"></i>Repartition par type</h5>
                    </div>
                    <div class="card-body">
                        @if($transactionsByType->count() > 0)
                            <div class="chart-container">
                                <canvas id="transactionTypePieChart"></canvas>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-tags"></i>
                                <p>Aucune transaction avec type defini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Resume par type de transaction -->
        @if($transactionsByType->count() > 0)
        <div class="row">
            <div class="mb-4 col-12">
                <div class="card dashboard-card table-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fas fa-list-alt me-2 text-secondary"></i>Resume par type de transaction
                            <span class="badge bg-secondary ms-2">{{ $filters['year'] }}</span>
                        </h5>
                        <a href="{{ route('advanced.transaction_types.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-cog me-1"></i>Gerer les types
                        </a>
                    </div>
                    <div class="p-0 card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-end">Montant total</th>
                                        <th class="text-end">Moyenne</th>
                                        <th class="text-center" style="width: 200px;">Repartition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $grandTotal = $transactionsByType->sum('total');
                                    @endphp
                                    @foreach($transactionsByType as $typeData)
                                        @php
                                            $percentage = $grandTotal > 0 ? ($typeData->total / $grandTotal) * 100 : 0;
                                            $average = $typeData->count > 0 ? $typeData->total / $typeData->count : 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-tag me-1"></i>{{ $typeData->type_name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-semibold">{{ number_format($typeData->count) }}</span>
                                            </td>
                                            <td class="text-end fw-semibold">
                                                {{ number_format($typeData->total, 0, ',', ' ') }} FBU
                                            </td>
                                            <td class="text-end text-muted">
                                                {{ number_format($average, 0, ',', ' ') }} FBU
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                             style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                    <span class="ms-2 small text-muted" style="min-width: 45px;">{{ number_format($percentage, 1) }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <td>Total</td>
                                        <td class="text-center">{{ number_format($transactionsByType->sum('count')) }}</td>
                                        <td class="text-end">{{ number_format($grandTotal, 0, ',', ' ') }} FBU</td>
                                        <td class="text-end">-</td>
                                        <td class="text-center">100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Dernières transactions -->
        <div class="row">
            <div class="mb-4 col-12">
                <div class="card dashboard-card table-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fas fa-history me-2 text-info"></i>Dernieres transactions
                            @if($filters['member_id'])
                                @php $selectedMember = $allMembers->find($filters['member_id']); @endphp
                                @if($selectedMember)
                                    <small class="text-muted">- {{ $selectedMember->firstname }} {{ $selectedMember->last_name }}</small>
                                @endif
                            @endif
                            <span class="badge bg-secondary ms-2">{{ $filters['year'] }}</span>
                        </h5>
                        <a href="{{ route('advanced.transactions.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                    <div class="p-0 card-body">
                        @if($latestTransactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px;">#</th>
                                            <th>Date</th>
                                            <th>Membre</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th class="text-end">Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestTransactions as $transaction)
                                            <tr>
                                                <td><span class="text-muted">#{{ $transaction->id }}</span></td>
                                                <td>{{ $transaction->date_transaction?->format('d/m/Y') ?? '-' }}</td>
                                                <td>
                                                    @if($transaction->member)
                                                        <div class="d-flex align-items-center">
                                                            <div class="member-avatar me-2">
                                                                {{ strtoupper(substr($transaction->member->firstname ?? 'N', 0, 1)) }}
                                                            </div>
                                                            <span>{{ $transaction->member->firstname }} {{ $transaction->member->last_name }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($transaction->description ?? '-', 40) }}</td>
                                                <td>
                                                    <span class="badge badge-type bg-secondary">
                                                        {{ $transaction->transactionType?->name ?? 'Non defini' }}
                                                    </span>
                                                </td>
                                                <td class="text-end fw-semibold">
                                                    {{ number_format($transaction->montant, 0, ',', ' ') }} FBU
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucune transaction enregistree</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouveaux membres et Documents -->
        <div class="row">
            <div class="mb-4 col-md-6">
                <div class="card dashboard-card table-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-user-plus me-2 text-primary"></i>Nouveaux membres</h5>
                        <a href="{{ route('advanced.members.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                    <div class="p-0 card-body">
                        @if($newMembers->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Organisation</th>
                                            <th>Fonction</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($newMembers as $member)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="member-avatar me-2">
                                                            {{ strtoupper(substr($member->firstname ?? 'N', 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ $member->firstname }} {{ $member->last_name }}</div>
                                                            @if($member->email)
                                                                <small class="text-muted">{{ $member->email }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $member->organisation?->name ?? '-' }}</td>
                                                <td>{{ $member->title ?? '-' }}</td>
                                                <td>{{ $member->created_at?->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-user-friends"></i>
                                <p>Aucun membre enregistre</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Derniers documents -->
            <div class="mb-4 col-md-6">
                <div class="card dashboard-card table-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-file-alt me-2 text-warning"></i>Derniers documents</h5>
                        <a href="{{ route('advanced.documents.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                    <div class="p-0 card-body">
                        @if($stats['newDocuments']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Ajoute par</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stats['newDocuments'] as $document)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file text-muted me-2"></i>
                                                        <span>{{ Str::limit($document->name, 25) }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $document->document_type ?? 'Autre' }}
                                                    </span>
                                                </td>
                                                <td>{{ $document->user?->name ?? '-' }}</td>
                                                <td>{{ $document->created_at?->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <p>Aucun document enregistre</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifier si Chart.js est chargé
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded!');
                return;
            }

            // Données des transactions par membre
            const transactionsByMember = @json($transactionsByMemberAndMonth);

            // Couleurs pour chaque membre
            const colors = [
                { bg: 'rgba(52, 152, 219, 0.2)', border: 'rgba(52, 152, 219, 1)' },
                { bg: 'rgba(46, 204, 113, 0.2)', border: 'rgba(46, 204, 113, 1)' },
                { bg: 'rgba(155, 89, 182, 0.2)', border: 'rgba(155, 89, 182, 1)' },
                { bg: 'rgba(241, 196, 15, 0.2)', border: 'rgba(241, 196, 15, 1)' },
                { bg: 'rgba(231, 76, 60, 0.2)', border: 'rgba(231, 76, 60, 1)' },
                { bg: 'rgba(26, 188, 156, 0.2)', border: 'rgba(26, 188, 156, 1)' },
                { bg: 'rgba(230, 126, 34, 0.2)', border: 'rgba(230, 126, 34, 1)' },
                { bg: 'rgba(149, 165, 166, 0.2)', border: 'rgba(149, 165, 166, 1)' }
            ];

            // Labels des mois en français
            const monthLabels = ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"];

            // Graphique des transactions par membre
            const transactionsCanvas = document.getElementById('transactionsChart');
            if (transactionsCanvas && Object.keys(transactionsByMember).length > 0) {
                const datasets = [];
                let colorIndex = 0;

                for (const [memberId, memberTransactions] of Object.entries(transactionsByMember)) {
                    const monthlyData = Array(12).fill(0);

                    memberTransactions.forEach(transaction => {
                        const monthIndex = transaction.month - 1;
                        monthlyData[monthIndex] = transaction.total;
                    });

                    const memberName = memberTransactions[0]?.member_name || 'Membre inconnu';
                    const color = colors[colorIndex % colors.length];

                    datasets.push({
                        label: memberName,
                        data: monthlyData,
                        backgroundColor: color.bg,
                        borderColor: color.border,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    });

                    colorIndex++;
                }

                new Chart(transactionsCanvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: monthLabels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 15,
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        if (context.parsed.y !== null) {
                                            label += context.parsed.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' FBU';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000) {
                                            return (value / 1000000).toFixed(1) + 'M';
                                        } else if (value >= 1000) {
                                            return (value / 1000).toFixed(0) + 'K';
                                        }
                                        return value;
                                    }
                                },
                                grid: { color: 'rgba(0, 0, 0, 0.05)' }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // Graphique de répartition des membres
            const membersCanvas = document.getElementById('membersPieChart');
            const memberLabels = {!! $membersByOrganisation->pluck('organisation.name')->filter()->toJson() !!};
            const memberCounts = {!! $membersByOrganisation->pluck('count')->toJson() !!};

            if (membersCanvas && memberLabels.length > 0) {
                new Chart(membersCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: memberLabels,
                        datasets: [{
                            data: memberCounts,
                            backgroundColor: [
                                'rgba(52, 152, 219, 0.85)',
                                'rgba(46, 204, 113, 0.85)',
                                'rgba(155, 89, 182, 0.85)',
                                'rgba(241, 196, 15, 0.85)',
                                'rgba(231, 76, 60, 0.85)',
                                'rgba(26, 188, 156, 0.85)',
                                'rgba(230, 126, 34, 0.85)'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                                        return `${context.label}: ${context.parsed} membres (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
            }

            // Graphique des transactions par type (Pie)
            const transactionTypePieCanvas = document.getElementById('transactionTypePieChart');
            const transactionsByType = @json($transactionsByType);

            if (transactionTypePieCanvas && transactionsByType.length > 0) {
                const typeLabels = transactionsByType.map(t => t.type_name);
                const typeTotals = transactionsByType.map(t => t.total);

                new Chart(transactionTypePieCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: typeLabels,
                        datasets: [{
                            data: typeTotals,
                            backgroundColor: [
                                'rgba(52, 152, 219, 0.85)',
                                'rgba(46, 204, 113, 0.85)',
                                'rgba(155, 89, 182, 0.85)',
                                'rgba(241, 196, 15, 0.85)',
                                'rgba(231, 76, 60, 0.85)',
                                'rgba(26, 188, 156, 0.85)',
                                'rgba(230, 126, 34, 0.85)',
                                'rgba(149, 165, 166, 0.85)'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                                        const value = context.parsed.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                                        return `${context.label}: ${value} FBU (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
            }

            // Graphique d'evolution des transactions par type (Bar)
            const transactionsByTypeChart = document.getElementById('transactionsByTypeChart');
            const transactionsByTypeAndMonth = @json($transactionsByTypeAndMonth);

            if (transactionsByTypeChart && Object.keys(transactionsByTypeAndMonth).length > 0) {
                const typeDatasets = [];
                let typeColorIndex = 0;

                const typeColors = [
                    { bg: 'rgba(52, 152, 219, 0.7)', border: 'rgba(52, 152, 219, 1)' },
                    { bg: 'rgba(46, 204, 113, 0.7)', border: 'rgba(46, 204, 113, 1)' },
                    { bg: 'rgba(155, 89, 182, 0.7)', border: 'rgba(155, 89, 182, 1)' },
                    { bg: 'rgba(241, 196, 15, 0.7)', border: 'rgba(241, 196, 15, 1)' },
                    { bg: 'rgba(231, 76, 60, 0.7)', border: 'rgba(231, 76, 60, 1)' },
                    { bg: 'rgba(26, 188, 156, 0.7)', border: 'rgba(26, 188, 156, 1)' },
                    { bg: 'rgba(230, 126, 34, 0.7)', border: 'rgba(230, 126, 34, 1)' },
                    { bg: 'rgba(149, 165, 166, 0.7)', border: 'rgba(149, 165, 166, 1)' }
                ];

                for (const [typeId, typeTransactions] of Object.entries(transactionsByTypeAndMonth)) {
                    const monthlyData = Array(12).fill(0);

                    typeTransactions.forEach(transaction => {
                        const monthIndex = transaction.month - 1;
                        monthlyData[monthIndex] = transaction.total;
                    });

                    const typeName = typeTransactions[0]?.type_name || 'Type inconnu';
                    const color = typeColors[typeColorIndex % typeColors.length];

                    typeDatasets.push({
                        label: typeName,
                        data: monthlyData,
                        backgroundColor: color.bg,
                        borderColor: color.border,
                        borderWidth: 1,
                        borderRadius: 4
                    });

                    typeColorIndex++;
                }

                new Chart(transactionsByTypeChart.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: typeDatasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 15,
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        if (context.parsed.y !== null) {
                                            label += context.parsed.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' FBU';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                stacked: false,
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000) {
                                            return (value / 1000000).toFixed(1) + 'M';
                                        } else if (value >= 1000) {
                                            return (value / 1000).toFixed(0) + 'K';
                                        }
                                        return value;
                                    }
                                },
                                grid: { color: 'rgba(0, 0, 0, 0.05)' }
                            },
                            x: {
                                stacked: false,
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // Auto-submit on filter change (optional enhancement)
            const filterSelects = document.querySelectorAll('#filterForm select');
            filterSelects.forEach(select => {
                select.addEventListener('change', function() {
                    // Visual feedback
                    this.classList.add('border-primary');
                });
            });
        });
    </script>
    @endpush
@endsection
