@extends('layouts.app')

@section('content')

@include('products._header_product')

<div>
    <div class="table-responsive">
        <table  id="fiche_stock" class="display compact" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Code Article</th>
                    <th>Désignation</th>
                    <th>Total Entrées</th>
                    <th>Total Sorties</th>
                    <th>Stock Actuel</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $mouvement)
                    @php
                        $stockActuel = $mouvement['total_entre'] - $mouvement['total_sortie'];
                    @endphp
                    <tr>
                        <td>{{ $mouvement['item_code'] }}</td>
                        <td>{{ $mouvement['product'] }}</td>
                        <td class="text-success">{{ $mouvement['total_entre'] }}</td>
                        <td class="text-danger">{{ $mouvement['total_sortie'] }}</td>
                        <td class="font-weight-bold">{{ $stockActuel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('javascript')

<script>
    $(document).ready( function () {
        $('#fiche_stock').dataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
            ],
            pagingType: "full_numbers",
            scrollX: true,
            pageLength: 20,
        });


    } );
</script>

@stop
