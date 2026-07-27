@extends('layouts.app')

{{-- StockController journal_sort_history --}}

@section('content')
<div class="app-page">
    @include('journals.header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Historique factures</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('journal_sort_history') }}" method="GET" class="app-toolbar-filters">
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

        <div class="app-card-body--flush">
            <div class="app-meta app-card-toolbar">
                <span>Factures : <b>{{ $products->count() }}</b></span>
                @if ($start_date || $end_date)
                    <span class="ml-3">
                        Période :
                        <b>
                            @if ($start_date)
                                du {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}
                            @endif
                            @if ($end_date)
                                au {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
                            @endif
                        </b>
                    </span>
                @endif
            </div>

            <div class="app-table-wrap">
                <table id="fiche_stock" class="table table-sm app-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>N° facture</th>
                            <th>NIF</th>
                            <th>Nom du client</th>
                            <th>NIF du client</th>
                            <th>MHTVA</th>
                            <th>TVA coll.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->id }}</td>
                                <td>{{ optional($product->company)->tp_TIN }}</td>
                                <td>{{ optional($product->client)->name }}</td>
                                <td>{{ optional($product->client)->customer_TIN }}</td>
                                <td>{{ getPrice($product->amount_tax) }}</td>
                                <td>{{ getPrice($product->tax) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Aucune facture trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $(document).ready(function () {
        $('#fiche_stock').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print',
            ],
            pagingType: 'full_numbers',
            scrollX: true,
            aaSorting: [],
        });
    });
</script>
@stop
