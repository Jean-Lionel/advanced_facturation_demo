@extends('layouts.app')
{{-- StockController Rapport --}}
@section('content')
<div class="app-page">
    @include('journals._header_file')

    <div class="app-card mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Rapport</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('rapport') }}" method="GET" class="app-toolbar-filters">
                    <div class="form-group mb-0">
                        <label for="start_date" class="sr-only">Du</label>
                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            class="form-control form-control-sm"
                            value="{{ $start_date }}"
                        >
                    </div>
                    <div class="form-group mb-0">
                        <label for="end_date" class="sr-only">Au</label>
                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            class="form-control form-control-sm"
                            value="{{ $end_date }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                </form>
            </div>
        </header>
    </div>

    <div class="app-stat-grid mb-3">
        <div class="app-card app-stat-card">
            <div class="app-card-body">
                <p class="app-stat-label">Vente du jour</p>
                <p class="app-stat-date">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                <p class="app-stat-value text-primary">{{ getPrice($venteJournaliere) }} <span>FBU</span></p>
            </div>
        </div>

        <div class="app-card app-stat-card">
            <div class="app-card-body">
                <p class="app-stat-label">Ventes sur la période</p>
                <p class="app-stat-date">
                    @if ($start_date || $end_date)
                        @if ($start_date)
                            Du {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}
                        @endif
                        @if ($end_date)
                            au {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
                        @endif
                    @else
                        Toute la période
                    @endif
                </p>
                <div class="app-stat-rows">
                    <div class="app-stat-row">
                        <span>Produit</span>
                        <strong>{{ getPrice($vente_date) }} FBU</strong>
                    </div>
                    <div class="app-stat-row">
                        <span>Service</span>
                        <strong>{{ getPrice($service_Date) }} FBU</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card app-stat-card">
            <div class="app-card-body">
                <p class="app-stat-label">Caisse &amp; dettes</p>
                <p class="app-stat-date">Situation globale</p>
                <div class="app-stat-rows">
                    <div class="app-stat-row">
                        <span>Montant total en caisse</span>
                        <strong class="text-success">{{ getPrice($montant_total) }} FBU</strong>
                    </div>
                    <div class="app-stat-row">
                        <span>Total des dettes</span>
                        <strong class="text-danger">{{ getPrice($totalDette) }} FBU</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="app-card h-100">
                <header class="app-card-header">
                    <h2 class="app-card-heading">Les 10 premiers produits les plus vendus</h2>
                </header>
                <div class="app-card-body">
                    <div class="app-chart-wrap">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="app-card h-100">
                <header class="app-card-header">
                    <h2 class="app-card-heading">Top 10 des quantités</h2>
                </header>
                <div class="app-card-body">
                    <div class="app-chart-wrap">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    const Charts = ['line', 'bar', 'pie', 'pie', 'bar'];
    const random = Math.floor(Math.random() * Charts.length);
    const random2 = Math.floor(Math.random() * Charts.length);

    var ctx = document.getElementById('myChart').getContext('2d');
    var chart2 = document.getElementById('chart2').getContext('2d');
    let labels = '{{ $labels }}';

    var myChart = new Chart(ctx, {
        type: Charts[random],
        data: {
            labels: labels.split(','),
            datasets: [{
                label: "# Nombre d'achats",
                data: [{{ $data['nombre_vendu'] }}],
                backgroundColor: [
                    'rgba(92, 63, 216, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                fill: true,
                borderColor: [
                    'rgba(92, 63, 216, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var myChart2 = new Chart(chart2, {
        type: Charts[random2],
        data: {
            labels: labels.split(','),
            datasets: [{
                label: 'Quantité vendue',
                data: [{{ $data['quantite'] }}],
                backgroundColor: [
                    'rgba(92, 63, 216, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                fill: true,
                borderColor: [
                    'rgba(92, 63, 216, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@stop
