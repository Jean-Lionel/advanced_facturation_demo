@extends('layouts.app')

@section('content')

@include('products._header_product')

<div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('historique_entre_sortie') }}" method="GET" class="form-inline">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" class="form-control" id="start_date" name="start_date"
                           value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="end_date" name="end_date"
                           value="{{ request('end_date', now()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Filtrer
                    </button>
                    @if(request()->has('start_date') || request()->has('end_date'))
                        <a href="{{ route('historique_entre_sortie') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-times me-1"></i> Réinitialiser
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="table-responsive">
        <table  id="fiche_stock" class="display compact" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Code Article</th>
                    <th>Désignation</th>
                    <th>Total Entrées</th>
                    <th>Total Sorties</th>
                    <th>Stock Actuel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $mouvement)
                    @php
                        $stockActuel = $mouvement['total_entre'] - $mouvement['total_sortie'];
                    @endphp
                    <tr>
                        <td>{{ $mouvement['item_code'] }}

                        </td>
                        <td>{{ $mouvement['product'] }}</td>
                        <td class="text-success">{{ $mouvement['total_entre'] }}</td>
                        <td class="text-danger">{{ $mouvement['total_sortie'] }}</td>
                        <td class="font-weight-bold">{{ $stockActuel }}</td>
                        <td>
                        <a href="{{ route('movement_stock', $mouvement['item_code']) }}"> Afficher</a>
                        </td>
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
