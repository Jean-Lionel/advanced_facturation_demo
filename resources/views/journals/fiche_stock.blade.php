@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Fiche de stock</h2>
        </header>

        <div class="app-card-body--flush">
            <div class="info"></div>
            <div class="app-table-wrap">
                <table id="fiche_stock" class="table table-sm app-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Article</th>
                            <th>Unité</th>
                            <th>St.Initial</th>
                            <th>Action</th>
                            <th>Qte</th>
                            <th>St.Théoriq.</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($follow_products as $product)
                            @php
                                $article = json_decode($product->details);
                                $total = ($product->action == "VENTE")
                                    ? $article->quantite + $product->quantite
                                    : $article->quantite - $product->quantite;
                            @endphp
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $article->name }}</td>
                                <td>{{ $article->unite_mesure }}</td>
                                <td>{{ $article->quantite }}</td>
                                <td>{{ $product->action }}</td>
                                <td>{{ $product->quantite }}</td>
                                <td>{{ $total }}</td>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                        @endforeach
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
        });
    });
</script>
@stop
