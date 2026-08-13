@extends('layouts.app')

@section('content')

<div class="app-page">
	@include('entreprises.header')
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Log de Synchronisation</h2>
        </header>
        <div class="app-card-body--flush">
            <table class="table table-sm app-table app-table--obr-history" id="fiche_stock" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Signature</th>
                        <th>Message</th>
                        <th>Resultat</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($logs as $item)
                    <tr @if($item->status == 0) class="bg-danger text-dark" @endif>
                        <td>{{ $item->order_id }}</td>
                        <td class="app-table-cell-signature">
                            <span class="app-table-signature-text">{{ $item->invoice_signature }}</span>
                        </td>
                        <td>
                            {{ $item->msg }}
                            <br>
                            <span><b>Date : </b><small>{{ $item->created_at }}</small></span>
                        </td>
                        <td>
                            @if ($item->result)
                                @php
                                    $result = json_decode($item->result);
                                @endphp
                                <ol class="mb-0 pl-3">
                                    <li>invoice_number : {{ $result->invoice_number ?? "" }}</li>
                                    <li>invoice_registered_number : {{ $result->invoice_registered_number ?? "" }}</li>
                                    <li>invoice_registered_date : {{ $result->invoice_registered_date ?? "" }}</li>
                                </ol>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            scrollX: false,
            autoWidth: false,
            aaSorting: [],
            columnDefs: [
                {
                    targets: 1,
                    width: '36%',
                    className: 'app-table-cell-signature'
                }
            ]
        });
    });
</script>

@stop
