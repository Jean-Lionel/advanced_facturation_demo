<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression des dépenses</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #222;
            margin: 20px;
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
        .actions {
            margin-bottom: 20px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-table th,
        .report-table td {
            border: 1px solid #ccc;
            padding: 8px;
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
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            background: #5c3fd8;
        }
        .btn-secondary {
            background: #6c757d;
        }
        @media print {
            .actions {
                display: none;
            }
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="actions">
        <button type="button" class="btn" onclick="window.print()">Imprimer</button>
        <a href="{{ route('depenses.index', request()->query()) }}" class="btn btn-secondary">Retour</a>
    </div>

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