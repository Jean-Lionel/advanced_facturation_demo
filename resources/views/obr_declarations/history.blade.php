@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('entreprises.header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Historique OBR</h2>
            <div class="app-toolbar-actions">
                <form action="{{ route('obr_declarations_hostory') }}" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="order_id" placeholder="N° facture" value="{{ $order_id ?? '' }}">
                </form>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table app-table--obr-history">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="app-table-cell-signature">Signature de la facture</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Taxe</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th class="app-table-cell-actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td class="app-table-cell-signature">
                                    <span class="app-table-signature-text">{{ $order->invoice_signature }}</span>
                                    @if (isset($order->concelInvoice->motif))
                                        <br>
                                        <small class="text-danger">
                                            Motif d'annulation :
                                            <i>{{ $order->concelInvoice->motif }}</i>
                                        </small>
                                    @endif
                                </td>
                                <td>{{ $order->client->name ?? '' }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @if ($order->is_cancelled)
                                        <span class="badge badge-danger">Annulée</span>
                                    @else
                                        <span class="badge badge-success">Envoyé à OBR</span>
                                    @endif
                                </td>
                                <td class="app-table-cell-actions">
                                    <div class="app-table-actions">
                                        @if (!$order->is_cancelled)
                                            <div id="order_{{ $order->id }}">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="cancelIncome('{{ $order->invoice_signature }}', {{ $order->id }})"
                                                >
                                                    Annuler
                                                </button>
                                            </div>
                                        @endif
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-info btn-sm">
                                            Afficher
                                        </a>
                                    </div>
                                </td>
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

        @if (method_exists($orders, 'links'))
            <div class="app-pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@stop

@section('javascript')
<script>
function getMotif() {
    let motif = prompt("Quel est le motif d'annulation de cette facture ?");
    if (motif == null) return;
    if (motif.trim() == "") {
        alert("La facture n'a pas été annulée. Ajoutez le motif.");
        return getMotif();
    }
    return motif;
}

function cancelIncome(invoice_signature, order_id) {
    let motif = getMotif();
    let cancel_amount = 0;

    if (motif) {
        cancel_amount = confirm('Voulez-vous aussi faire le retour des marchandises en stock ?');
    }

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $("#order_" + order_id).html(`<div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
    </div>`);

    $.ajax({
        url: 'cancelInvoice',
        type: 'post',
        data: {
            invoice_signature: invoice_signature,
            _token: CSRF_TOKEN,
            order_id: order_id,
            motif: motif,
            cancel_amount: cancel_amount
        },
        success: function (data) {
            console.log(data);
            $("#order_" + order_id).html(`<span class="badge badge-warning">${data.msg}</span>`);
        }
    });
}
</script>
@stop
