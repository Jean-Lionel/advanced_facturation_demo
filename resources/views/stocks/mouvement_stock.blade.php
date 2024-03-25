@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')


<div>
    <div>
        <h4 class="text-center">Mouvement de stock</h4>
    </div>
    <div>
        <form action="">
            <div class="row">
                <div class="col-2">
                    du
                    <input type="date" name="start_at" value="{{ \Request::get('start_at') }}">
                </div>
                <div class="col-2">
                     du
                    <input type="date" name="end_at" value="{{ \Request::get('end_at') }}">
                </div>
                <div class="col-3">
                    Mouvement
                    <select name="mouvement" id="">
                        <option value=""></option>
                        @foreach (MOUVEMENT_STOCK as $key => $item )
                        <option value="{{ $key }}"

                        @if(\Request::get('mouvement') == $key)
                        selected
                        @endif

                        >{{ $item  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit">Ok</button>
                </div>
            </div>
        </form>

    </div>
    <div class="info"></div>
    <table id="fiche_stock" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th> CODE DU PRODUIT</th>
                <th>DESIGNATION</th>

                <th>Qté</th>
                <th>Unité</th>
                <th>Prix U</th>
                <th>Mouvement type</th>
                <th>Déscription</th>
                <th>Date</th>
                <th>Envoyé à OBR</>
                </tr>
            </thead>

            <tbody>

                @foreach ($mouvements as $item)
                {{-- expr --}}

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
                    <td class="{{ $item->is_send_to_obr ? 'text-success' : 'text-danger' }}">{{ $item->is_send_to_obr ? 'Oui' : 'Non' }}</td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>

    @stop

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
            });


        } );
    </script>

    @stop
