@extends('layouts.advanced')

@section('content')
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #3498db;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }

        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .kpi-card {
            border-left: 4px solid;
            min-height: 110px;
        }

        .kpi-card.members {
            border-left-color: var(--primary-color);
        }

        .kpi-card.finance {
            border-left-color: var(--success-color);
        }

        .kpi-card.documents {
            border-left-color: var(--warning-color);
        }

        .kpi-card.tasks {
            border-left-color: var(--danger-color);
        }

        .kpi-card .card-icon {
            font-size: 2.5rem;
            opacity: 0.15;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .kpi-card .card-value {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .kpi-card .card-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .filters-section {
                flex-direction: column;
            }
        }
    </style>

    <div class="py-4 container-fluid">
        <!-- Filters -->
        <div class="mb-4 filters-section">
            <div class="row">
                <div class="mb-3 col-md-3 mb-md-0">
                    <select class="form-select" id="periodFilter">
                        <option value="day">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month" selected>Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3 mb-md-0">
                    <select class="form-select" id="departmentFilter">
                        <option value="all" selected>Tous les départements</option>
                        @foreach($organisations as $organisation)
                            <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-3 mb-md-0">
                    <select class="form-select" id="userFilter">
                        <option value="all" selected>Tous les utilisateurs</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100" id="applyFilters">Appliquer les filtres</button>
                </div>
            </div>
        </div>

        <!-- KPIs -->
        <div class="mb-4 row">
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card members">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Membres actifs</h6>
                        <div class="card-value">{{ $stats['activeMembers'] }}</div>
                        <div class="mt-2 text-success">
                            <i class="fas fa-arrow-up"></i> +5 ce mois
                        </div>
                        <i class="fas fa-users card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card finance">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Bilan financier</h6>
                        <div class="card-value">+{{ number_format($stats['totalRevenue'], 2, ',', ' ') }} €</div>
                        <div class="mt-2 text-success">
                            <i class="fas fa-arrow-up"></i> +15% vs mois dernier
                        </div>
                        <i class="fas fa-money-bill-alt card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card documents">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Nouveaux documents</h6>
                        <div class="card-value">{{ $stats['newDocuments']->count() }}</div>
                        <div class="mt-2 text-warning">
                            <i class="fas fa-equals"></i> Stable vs mois dernier
                        </div>
                        <i class="fas fa-file-alt card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card kpi-card tasks">
                    <div class="card-body position-relative">
                        <h6 class="card-title">Tâches actives</h6>
                        <div class="card-value">{{ $stats['activeTasks'] }}</div>
                        <div class="mt-2 text-danger">
                            <i class="fas fa-arrow-up"></i> +8 vs semaine dernière
                        </div>
                        <i class="fas fa-tasks card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="mb-4 col-lg-8">
                <div class="card dashboard-card">
                    <div class="bg-white card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title">Évolution des transactions</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary active">Revenus</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Dépenses</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Tous</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="transactionsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-4">
                <div class="card dashboard-card">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 card-title">Répartition des membres</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="membersPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières transactions -->
        <div class="row">
            <div class="mb-4 col-12">
                <div class="card dashboard-card">
                    <div class="bg-white card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title">Dernières transactions</h5>
                        <a href="{{ route('advanced.transactions.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="p-0 card-body">
                        <div class="data-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->date_transaction }}</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ $transaction->transactionType?->name ?? 'N/A' }}</td>
                                            <td class="{{ $transaction->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                                {{ $transaction->type === 'credit' ? '+' : '-' }} {{ number_format($transaction->montant, 2, ',', ' ') }} €
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $transaction->status === 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouveaux membres -->
        <div class="row">
            <div class="mb-4 col-md-6">
                <div class="card dashboard-card">
                    <div class="bg-white card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title">Nouveaux membres</h5>
                        <a href="{{ route('advanced.members.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="p-0 card-body">
                        <div class="data-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Département</th>
                                        <th>Rôle</th>
                                        <th>Date d'ajout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($newMembers as $member)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $member->avatar_url ?? 'https://via.placeholder.com/30' }}" class="rounded-circle me-2" alt="{{ $member->name }}">
                                                    <div>{{ $member->name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $member->organisation->name }}</td>
                                            <td>{{ $member->role }}</td>
                                            <td>{{ $member->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Derniers documents -->
            <div class="mb-4 col-md-6">
                <div class="card dashboard-card">
                    <div class="bg-white card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title">Derniers documents</h5>
                        <a href="{{ route('advanced.documents.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="p-0 card-body">
                        <div class="data-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Type</th>
                                        <th>Ajouté par</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats['newDocuments'] as $document)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-{{ $document->file_extension }} text-{{ $document->type_color }} me-2"></i>
                                                    <div>{{ $document->name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $document->file_extension }}</td>
                                            <td>{{ $document->user->name }}</td>
                                            <td>{{ $document->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts pour les graphiques -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Graphique des transactions
                const transactionsCtx = document.getElementById('transactionsChart').getContext('2d');
                const transactionsChart = new Chart(transactionsCtx, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [
                            {
                                label: 'Revenus',
                                data: [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200],
                                backgroundColor: 'rgba(46, 204, 113, 0.2)',
                                borderColor: 'rgba(46, 204, 113, 1)',
                                borderWidth: 2,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' €';
                                    }
                                }
                            }
                        }
                    }
                });

                // Graphique de répartition des membres
                const membersCtx = document.getElementById('membersPieChart').getContext('2d');
                const membersChart = new Chart(membersCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {{ $membersByOrganisation->pluck('organisation.name')->toJson() }},
                        datasets: [
                            {
                                data: {{ $membersByOrganisation->pluck('count')->toJson() }},
                                backgroundColor: [
                                    'rgba(46, 204, 113, 0.8)',
                                    'rgba(231, 76, 60, 0.8)',
                                    'rgba(52, 152, 219, 0.8)',
                                    'rgba(241, 196, 15, 0.8)',
                                    'rgba(155, 89, 182, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(46, 204, 113, 1)',
                                    'rgba(231, 76, 60, 1)',
                                    'rgba(52, 152, 219, 1)',
                                    'rgba(241, 196, 15, 1)',
                                    'rgba(155, 89, 182, 1)'
                                ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
    </div>

@endsection