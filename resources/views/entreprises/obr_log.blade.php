@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	<div>
        <table class="table table-stripped" id="fiche_stock" >
            <thead>
                <tr>
                    
                    <th>Numero de la Facture</th>
                    {{--  <th>Date</th>  --}}
                    <th>Signature</th>
                    <th>Message</th>
                    <th>Resultat</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($logs as $item)
                <tr @if($item->status == 0) class="bg-danger text-white" @endif>
                    <td>{{ $item->order_id }}
                    </td>
                    
                    <td>{{ $item->invoice_signature }}
                       
                    </td>

                    <td>{{ $item->msg }}
                        <br> <span> <b>Date : </b> <small> {{ $item->created_at  }} </small> <span>
                    </td>
                    <td>

                        @if ( $item->result)
                        @php
                            $item = json_decode($item->result)
                        @endphp
                        <ol>
                            <li>invoice_number :   {{ $item->invoice_number ?? "" }}</li>
                            <li>invoice_registered_number : {{ $item->invoice_registered_number ?? "" }}</li>
                            <li>invoice_registered_date : {{ $item->invoice_registered_date  ?? ""}}</li>
                        </ol>
                        @endif


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
			scrollX: false,
            "aaSorting": []
	});


} );
</script>

@stop
