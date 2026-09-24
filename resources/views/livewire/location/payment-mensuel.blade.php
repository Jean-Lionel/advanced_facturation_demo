<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div wire:loading>
          @livewire('loading.checkout')
        </div>
    </div>
    <div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($cancelMaisonId && $cancelPeriodeId)
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                <span>
                    Annuler un paiement
                    @if (count($cancelPayments))
                        — {{ $cancelPayments->first()->maisonlocation->name ?? '' }}
                        ({{ getMonthName($cancelPayments->first()->periode->month ?? '') }} {{ $cancelPayments->first()->periode->year ?? '' }})
                    @endif
                </span>
                <button type="button" wire:click="closeCancelPayments" class="btn btn-sm btn-light">Fermer</button>
            </div>
            <div class="card-body">
                @if (count($cancelPayments))
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Facture</th>
                                <th>Description</th>
                                <th>Par</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancelPayments as $payment)
                            <tr>
                                <td>{{ optional($payment->date_paiement)->format('d/m/Y') }}</td>
                                <td>{{ getPrice($payment->montant) }}</td>
                                <td>
                                    @if ($payment->order)
                                        <a href="{{ url('orders/' . $payment->order->id) }}" target="_blank">N° {{ $payment->order->id }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $payment->description }}</td>
                                <td>{{ $payment->user->name ?? '' }}</td>
                                <td class="text-right">
                                    @if ($cancelPaymentId === $payment->id)
                                        <span class="badge badge-warning">Sélectionné</span>
                                    @else
                                        <button type="button" wire:click="selectPaymentToCancel({{ $payment->id }})" class="btn btn-outline-danger btn-sm">Annuler ce paiement</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($cancelPaymentId)
                <div class="mt-3">
                    <div class="form-group">
                        <label for="motifAnnulation">Motif d'annulation</label>
                        <textarea id="motifAnnulation" wire:model.defer="motifAnnulation" class="form-control @error('motifAnnulation') is-invalid @enderror" rows="2"></textarea>
                        @error('motifAnnulation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">La facture liée sera également annulée (et l'annulation envoyée à l'OBR).</small>
                    </div>
                    <button
                        type="button"
                        wire:click="cancelPayment"
                        class="btn btn-danger btn-sm"
                        onclick="confirm('Confirmer l\'annulation de ce paiement et de sa facture ?') || event.stopImmediatePropagation()"
                    >Confirmer l'annulation</button>
                    <button type="button" wire:click="$set('cancelPaymentId', null)" class="btn btn-secondary btn-sm">Retour</button>
                </div>
                @endif
                @else
                <p class="text-muted mb-0">Aucun paiement pour cette période.</p>
                @endif
            </div>
        </div>
        @endif

        <div class="col-md-12 mb-3">
            <p class="mb-1 font-weight-bold">Maisons à payer</p>
            <input type="text" placeholder="Rechercher par nom ou description" wire:model.debounce.300ms="houseNumber" class="form-control">
        </div>
        @if (count($maisonLocations))
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Maison</th>
                        <th>Montant Mensuel (HTVA)</th>
                        <th>TVA</th>
                        <th>Montant Mensuel (TTC)</th>
                        <th>Client</th>
                        @foreach ($periodes as $periode)
                        <th>{{ getMonthName($periode->month) }} {{ $periode->year }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maisonLocations as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ getPrice($item->montant) }}</td>
                        <td>{{ getPrice($item->tax) }}</td>
                        <td>{{ $item->priceTTC }}</td>
                        <td>
                            <ol class="mb-0 pl-3">
                                @foreach ($item->clients as $el)
                                <li>{{ $el->name }} — {{ $el->telephone }}</li>
                                @endforeach
                            </ol>
                        </td>
                        @foreach ($periodes as $periode)
                        <td>
                            @if ($this->isPeriodePaid($item->id, $periode->id, $item->montant))
                                <span class="badge badge-success">Payé</span>
                            @else
                                <a
                                    href="{{ route('payment-location-mensuel.payer', ['maisonLocation' => $item->id, 'periode' => $periode->id, 'return' => 'payment-location-mensuel']) }}"
                                    class="btn btn-primary btn-sm"
                                >Payer</a>
                            @endif
                            @if ($this->hasPayments($item->id, $periode->id))
                                <button
                                    type="button"
                                    wire:click="showCancelPayments({{ $item->id }}, {{ $periode->id }})"
                                    class="btn btn-outline-danger btn-sm"
                                    title="Annuler un paiement"
                                >Annuler</button>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">Aucune maison avec locataire trouvée.</p>
        @endif
    </div>
</div>
