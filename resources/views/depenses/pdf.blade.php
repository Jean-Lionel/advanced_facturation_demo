<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport des dépenses</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0 0 5px;
        }
        .meta {
            margin-bottom: 15px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-table th,
        .report-table td {
            border: 1px solid #ccc;
            padding: 6px 8px;
        }
        .report-table th {
            background: #4472C4;
            color: #fff;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $entreprise->tp_name ?? 'Rapport des dépenses' }}</h2>
        <p>Liste des dépenses par période</p>
    </div>

    <div class="meta">
        <strong>Période :</strong>
        du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
        au {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
        <br>
        <strong>Date d'édition :</strong> {{ now()->format('d/m/Y H:i') }}
        <br>
        <strong>Nombre de dépenses :</strong> {{ $depenses->count() }}
    </div>

    @include('depenses._report_table')
</body>
</html>