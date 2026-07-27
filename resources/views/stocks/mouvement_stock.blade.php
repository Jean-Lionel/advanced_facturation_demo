@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Mouvement de stock</h2>
            <form action="" method="GET" class="app-toolbar-actions">
                <input
                    type="date"
                    name="start_at"
                    class="form-control form-control-sm app-toolbar-select"
                    value="{{ \Request::get('start_at') }}"
                    title="Du"
                >
                <input
                    type="date"
                    name="end_at"
                    class="form-control form-control-sm app-toolbar-select"
                    value="{{ \Request::get('end_at') }}"
                    title="Au"
                >
                <select name="mouvement" class="form-control form-control-sm app-toolbar-select">
                    <option value="">Mouvement</option>
                    @foreach (MOUVEMENT_STOCK as $key => $item)
                        <option value="{{ $key }}" @if(\Request::get('mouvement') == $key) selected @endif>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Ok</button>
            </form>
        </header>

        <div class="app-card-body--flush">
            <div class="info"></div>
            <div class="app-table-wrap">
                <table id="fiche_stock" class="table table-sm app-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODE DU PRODUIT</th>
                            <th>DESIGNATION</th>
                            <th>Qté</th>
                            <th>Unité</th>
                            <th>Prix U</th>
                            <th>Mouvement type</th>
                            <th>Déscription</th>
                            <th>Date</th>
                            <th>Envoyé à OBR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mouvements as $item)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $item->item_code }}</td>
                                <td>{{ $item->item_designation }}</td>
                                <td>{{ $item->item_quantity }}</td>
                                <td>{{ $item->item_measurement_unit }}</td>
                                <td>{{ $item->item_purchase_or_sale_price }}</td>
                                <td>{{ getMouvement($item->item_movement_type) }}</td>
                                <td>{{ $item->item_movement_description }}</td>
                                <td>{{ $item->item_movement_date }}</td>
                                <td class="{{ $item->is_send_to_obr ? 'text-success' : 'text-danger' }}">
                                    {{ $item->is_send_to_obr ? 'Oui' : 'Non' }}
                                </td>
                                <td>
                                    <form action="{{ route('obr_mouvement.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button>
                                    </form>
                                </td>
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
