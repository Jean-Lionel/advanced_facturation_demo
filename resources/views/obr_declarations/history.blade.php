@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	<h5>Historique des factures envoyées a OBR</h5>

    <form action="">
        <input type="text" name="order_id" value="{{$order_id}}">
        <button>Rechercher</button>
    </form>
	<table class="table table-bordered tab-content table-sm">
		<thead>
			<tr>
				<th>#</th>
				<th>Signature de la facture</th>
				<th>Client</th>
				<th>Montant</th>
				<th>Tax</th>
				<td>Date</td>
                <td>Status</td>

				<th>
					Action
				</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($orders as $order)
			{{-- expr --}}
			<tr>
				<td>{{$order->id}}</td>
				<td>{{$order->invoice_signature}}</td>
				<td>{{ $order->client->name }}</td>
				<td>{{ $order->amount }}</td>
				<td>{{ $order->tax }}</td>
				<td>{{ $order->created_at }}</td>
                <td
                    @if($order->is_cancelled)
                        class="bg-danger"
                        @endif>
                        @if($order->is_cancelled)
                        Annulée
                    @endif

                    @if(!$order->is_cancelled)
                       <b class="bg-success "> Envoyé à OBR</b>
                    @endif
                </td>

				<td>
					@if (!$order->is_cancelled)
					{{-- expr --}}
					<div id="order_{{$order->id}}">
						<button onclick="cancelIncome('{{$order->invoice_signature}}',{{$order->id}} )">Annuler</button>
					</div>
					@endif
                    <a href="{{route('orders.show', $order->id )}}">Afficher</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
    {{$orders->links()}}
</div>
@stop

@section('javascript')

<script>

function getMotif(){
    let motif = prompt("Quel est le motif d'annulation de cet Facture ? ")
        if(motif == null) return;
        if(motif.trim() == ""){
            alert("La facture n  a pas ete anuler ajouter le motif");
            return  getMotif();
        }
    return motif;
}

	function cancelIncome(invoice_signature, order_id){
        let motif = getMotif();
        let cancel_amount = 0;

        if(motif){
            cancel_amount = confirm('Voulez aussi faire le retour des Marchandises en Stock');
        }

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$("#order_"+order_id).html(`<div class="progress">
			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
			</div>`)
		$.ajax({
			url: 'cancelInvoice',
			type: 'post',
			data: {
				invoice_signature :invoice_signature,
				_token: CSRF_TOKEN,
				order_id: order_id,
                motif : motif,
                cancel_amount : cancel_amount
			},
			success: function (data) {
				console.log(data);
				$("#order_"+order_id).html(`
					<span class="bg-warning">${data.msg} </span>
					`)
			}
		});
	}
</script>

@stop
