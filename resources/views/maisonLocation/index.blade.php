@extends('layouts.app')
@section('content')
<div class="app-page">
    @include('maisonLocation._header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste biens ou service à Louer</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('maison-location.index') }}" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici" value="{{ $search }}">
                </form>
                <a href="{{ route('maison-location.create') }}" class="btn btn-primary btn-sm">Nouveau</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table" style="width: 100%;" id="maisonLocationTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Description</th>
                            <th scope="col">Client</th>
                            <th scope="col">Tax (%)</th>
                            <th scope="col">Avance</th>
                            <th scope="col">Date de création</th>
                            @foreach ($periodes as $periode)
                            <th scope="col">{{ getMonthName($periode->month) }} {{ $periode->year }}</th>
                            @endforeach
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maisonLocations as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->montant }}</td>
                            <td>{{ $value->description }}</td>
                            <td>
                                <ol>
                                    @foreach ($value->clients as $item)
                                        <li>{{ $item->name }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <th scope="col">{{ $value->tax }}</th>
                            <th scope="col">{{ $value->avance }}</th>
                            <td>{{ $value->created_at }}</td>
                            @foreach ($periodes as $periode)
                            @php
                                $paymentKey = $value->id . '-' . $periode->id;
                                $totalPaid = optional($paymentSums->get($paymentKey))->total_paid ?? 0;
                                $isPaid = $totalPaid >= $value->montant;
                            @endphp
                            <td>
                                @if ($isPaid)
                                    <span class="badge badge-success">Payé</span>
                                @elseif ($value->clients_count > 0)
                                    <a
                                        href="{{ route('payment-location-mensuel.payer', ['maisonLocation' => $value->id, 'periode' => $periode->id, 'return' => 'maison-location']) }}"
                                        class="btn btn-primary btn-sm"
                                    >Payer</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            @endforeach
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('maison-location.show', $value) }}" class="mr-2 btn btn-outline-info btn-sm">Locataire</a>
                                <a href="{{ route('maison-location.edit', $value->id) }}" class="mr-2 btn btn-outline-info btn-sm no-print">Modifier</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#maisonLocationTable').DataTable(
                {
                    "pageLength": 10,
                    "lengthMenu": [10, 20, 50, 100],
                    "order": [],
                    "dom": 'Bfrtip',
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                }
            );
        });
    </script>
@endsection
