@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')
@include('products._header_product')

<style>

.numbers {
    white-space: nowrap;
}

</style>

<div class="row">

	<div class="col-md-12">
		@include('journals.header')
        <div class="row">
            <form action="" class="col-4">
                <div class="row">
                    <div class="col-6">
                        <span>DU</span>
                        <input type="date" class="form-control form-control-sm" name="startDate"
                        value="{{ $startDate }}"
                        >
                    </div>
                    <div class="col-6">
                        <span>Au</span>
                        <input type="date" class="form-control form-control-sm" name="endDate"
                        value="{{ $endDate }}"
                        >
                    </div>
                    <div class="col-6 noprint">
                        <button type="submit" class="btn btn-info btn-sm">
                            Ok
                        </button>
                    </div>

                </div>
            </form>

            <div class="col-4">
                <div class="gap-3 d-flex">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>DATE</th>
                            <th>
                                DU {{ $startDate  }} AU {{ $endDate }}
                            </th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL DE FACTURE</th>
                            <th>{{ getPrice($total_facture) }}</th>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-4">
                <div class="gap-3 d-flex">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>MONTANT TOTAL DES FACTURE TVAC</th>
                            <th class="numbers">
                            {{ getPrice($total_amount) }}
                            </th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  TVA</th>
                            <th class="numbers">{{ getPrice($total_tva) }}</th>
                        </tr>
                        <tr>
                            <th>NOMBRE TOTAL POUR  HTVA</th>
                            <th class="numbers">{{ getPrice($total_amount_tax) }}</th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

		<table class="table table-sm">
			<thead class="table-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">PRODUITS</th>
					<th scope="col">@sortablelink('montant','MONTANT')</th>
					<th scope="col" class="noprint">
						@sortablelink('type_paiement', 'MODE DE PAIMENT')
					</th>
					<th scope="col" class="noprint">
                    TYPE DE FACTURE
					</th>
                    <th>
                        TVA
                    </th>
					<th scope="col" class="noprint">Action</th>
				</tr>
			</thead>
			<tbody>


				@foreach($orders as $key => $order)
                @php
                    $typePaiement = $order->type_paiement;
                    if ($typePaiement === 'DETTE') {
                        $typePaiement = 3;
                    } elseif ($typePaiement === 'CACHE') {
                        $typePaiement = 1;
                    }
                    $typePaiement = is_numeric($typePaiement) ? (int) $typePaiement : $typePaiement;
                    $dette = $order->dette;
                    $montantTotalDette = $dette ? (float) $dette->montant : (float) $order->amount;
                    $montantRestant = $dette ? max(0, (float) $dette->montant_restant) : (float) $order->amount;
                    $montantDejaPaye = max(0, $montantTotalDette - $montantRestant);
                    if ($montantRestant > 0 && $dette) {
                        $typePaiement = 3;
                    }
                @endphp

				<tr>
					<th scope="row">{{ $order->id }}</th>

					<td class="">
						<ul class="">
							@foreach($order->products as $product)
							<li>{{ $product['name'] }} | Qte : {{ $product['quantite'] }} |
							PRIX : {{ getPrice($product['price'] )}}</li>
							@endforeach

							<li class="text-center list-unstyled">{{ $order->created_at }}</li>

							<li class="">
                               Client :  <b>{{ $order->client->name ?? "" }}</b> &nbsp; &nbsp; &nbsp; Vendu par : <b>{{ $order->user->name ?? "" }}</b
                            </li>


						</ul>

					</td>
					<td class="numbers">{{ getPrice($order->amount )}}</td>
					<td class="noprint">
                        {{ $typePaiement ? (TYPE_PAYMENT[$typePaiement] ?? $order->type_paiement): ""}}
                        @if ($typePaiement === 3)
                            <div>
                                <small class="{{ $montantRestant > 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $montantRestant > 0 ? 'Reste : ' . getPrice($montantRestant) : 'Tout est payé' }}
                                </small>
                            </div>
                        @endif
                    </td>
					<td class="noprint">{{ $order->invoice_type ?? ""}}</td>
                    <td class="numbers">
                        {{ getPrice($order->tax ) }}
                    </td>
					<td class="d-flex flex-wrap noprint" >


						<a href="{{ route('orders.show', $order) }}" class="mr-2 btn btn-sm btn-success" title="imprimer"> <i class="fa fa-print" ></i></a>
                        @if ($typePaiement === 3)
                            @if ($montantRestant > 0)
                            <button type="button"
                                    class="btn btn-sm btn-warning"
                                    title="Valider le paiement"
                                    data-toggle="modal"
                                    data-target="#paymentModal{{ $order->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 17l-5-5m5 0l5 5L22 7m-10 5l5-5"/>
                                </svg>
                            </button>
                            @else
                            <span class="badge badge-success align-self-center">Tout payé</span>
                            @endif

                        @endif


					</td>

				</tr>

				@endforeach

			</tbody>
		</table>

        @foreach($orders as $order)
            @php
                $typePaiement = $order->type_paiement;
                if ($typePaiement === 'DETTE') {
                    $typePaiement = 3;
                } elseif ($typePaiement === 'CACHE') {
                    $typePaiement = 1;
                }
                $typePaiement = is_numeric($typePaiement) ? (int) $typePaiement : $typePaiement;
                $dette = $order->dette;
                $montantTotalDette = $dette ? (float) $dette->montant : (float) $order->amount;
                $montantRestant = $dette ? max(0, (float) $dette->montant_restant) : (float) $order->amount;
                $montantDejaPaye = max(0, $montantTotalDette - $montantRestant);
                if ($montantRestant > 0 && $dette) {
                    $typePaiement = 3;
                }
            @endphp

            @if ($typePaiement === 3 && $montantRestant > 0)
            <div class="modal fade noprint" id="paymentModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('facture.payer', $order) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel{{ $order->id }}">Valider le paiement de la facture #{{ $order->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <p class="mb-1">Client : <b>{{ $order->client->name ?? "" }}</b></p>
                                <p class="mb-1">Montant total : <b>{{ getPrice($montantTotalDette) }}</b></p>
                                <p class="mb-1">Déjà payé : <b>{{ getPrice($montantDejaPaye) }}</b></p>
                                <p class="mb-0">Reste à payer : <b class="text-danger">{{ getPrice($montantRestant) }}</b></p>
                            </div>
                            <div class="form-group">
                                <label for="montant_paye_{{ $order->id }}">Montant payé</label>
                                <input type="number"
                                       min="0.01"
                                       max="{{ $montantRestant }}"
                                       step="0.01"
                                       name="montant_paye"
                                       id="montant_paye_{{ $order->id }}"
                                       value="{{ $montantRestant }}"
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" name="payer_tout" value="1" class="btn btn-success">Payer tout</button>
                            <button type="submit" class="btn btn-warning">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endforeach


	</div>

</div>



@stop
