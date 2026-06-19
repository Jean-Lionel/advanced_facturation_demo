<div>
    <style>
        .payment-page-header {
            background: linear-gradient(135deg, #5c3fd8 0%, #7c5ce0 100%);
            border-radius: 12px 12px 0 0;
            color: #fff;
            padding: 1.5rem 2rem;
        }
        .payment-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(92, 63, 216, 0.12);
            overflow: hidden;
        }
        .payment-summary-item {
            background: #f8f7fd;
            border-radius: 8px;
            padding: 0.85rem 1rem;
            margin-bottom: 0.75rem;
        }
        .payment-summary-item label {
            color: #6c757d;
            font-size: 0.8rem;
            margin-bottom: 0.15rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .payment-summary-item .value {
            font-size: 1.05rem;
            font-weight: 600;
            color: #2d2a3e;
        }
        .payment-client-badge {
            background: #ede9fc;
            border-radius: 20px;
            color: #5c3fd8;
            display: inline-block;
            font-size: 0.85rem;
            margin: 0.2rem 0.3rem 0.2rem 0;
            padding: 0.35rem 0.85rem;
        }
        .payment-form-section {
            background: #fff;
            padding: 2rem;
        }
        .payment-amount-highlight {
            background: linear-gradient(135deg, #5c3fd8 0%, #7c5ce0 100%);
            border-radius: 10px;
            color: #fff;
            padding: 1.25rem;
            text-align: center;
        }
        .payment-amount-highlight .amount {
            font-size: 1.75rem;
            font-weight: 700;
        }
        .btn-payment-primary {
            background: #5c3fd8;
            border-color: #5c3fd8;
            border-radius: 8px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
        }
        .btn-payment-primary:hover {
            background: #4a32b0;
            border-color: #4a32b0;
        }
        .btn-payment-outline {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
        }
    </style>

    <div wire:loading class="text-center py-3">
        @livewire('loading.checkout')
    </div>

    <div class="card payment-card">
        <div class="payment-page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="mb-1">Paiement du loyer</h4>
                <p class="mb-0 opacity-75">{{ $maison->name }} — {{ getMonthName($periode->month) }} {{ $periode->year }}</p>
            </div>
            <a href="{{ $this->getBackUrl() }}" class="btn btn-light btn-sm mt-2 mt-md-0">
                ← Retour
            </a>
        </div>

        <div class="card-body p-0">
            @if (session()->has('error'))
                <div class="alert alert-danger m-3 mb-0">{{ session('error') }}</div>
            @endif

            @if ($isAlreadyPaid)
                <div class="text-center py-5 px-4">
                    <div class="mb-3" style="font-size: 3rem;">✓</div>
                    <h5 class="text-success">Période déjà payée</h5>
                    <p class="text-muted">Le loyer de {{ getMonthName($periode->month) }} {{ $periode->year }} a été entièrement réglé.</p>
                    <a href="{{ $this->getBackUrl() }}" class="btn btn-payment-primary text-white">Retour à la liste</a>
                </div>
            @else
                <div class="row no-gutters">
                    <div class="col-lg-5 border-right">
                        <div class="p-4">
                            <h6 class="text-uppercase text-muted mb-3" style="letter-spacing: 0.05em; font-size: 0.75rem;">Récapitulatif</h6>

                            <div class="payment-amount-highlight mb-4">
                                <div class="small opacity-75">Montant mensuel (TTC)</div>
                                <div class="amount">{{ getPrice($maison->priceTTC) }}</div>
                            </div>

                            <div class="payment-summary-item">
                                <label>Période</label>
                                <div class="value">{{ getMonthName($periode->month) }} {{ $periode->year }}</div>
                            </div>

                            <div class="payment-summary-item">
                                <label>Montant HTVA</label>
                                <div class="value">{{ getPrice($maison->montant) }}</div>
                            </div>

                            <div class="payment-summary-item">
                                <label>TVA ({{ $maison->tax }}%)</label>
                                <div class="value">{{ getPrice($maison->priceTTC - $maison->montant) }}</div>
                            </div>

                            @if ($totalPaid > 0)
                            <div class="payment-summary-item">
                                <label>Déjà payé</label>
                                <div class="value text-success">{{ getPrice($totalPaid) }}</div>
                            </div>
                            <div class="payment-summary-item">
                                <label>Reste à payer</label>
                                <div class="value text-primary">{{ getPrice($remainingAmount) }}</div>
                            </div>
                            @endif

                            <div class="payment-summary-item">
                                <label>Locataire(s)</label>
                                <div>
                                    @foreach ($maison->clients as $client)
                                        <span class="payment-client-badge">
                                            {{ $client->name }}
                                            @if ($client->telephone)
                                                · {{ $client->telephone }}
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            @if ($maison->description)
                            <div class="payment-summary-item">
                                <label>Description</label>
                                <div class="value" style="font-weight: 400; font-size: 0.95rem;">{{ $maison->description }}</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="payment-form-section">
                            <h6 class="text-uppercase text-muted mb-4" style="letter-spacing: 0.05em; font-size: 0.75rem;">Détails du paiement</h6>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Date de paiement</label>
                                    <input type="date" class="form-control" wire:model="payementDate">
                                    @error('payementDate') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Type de paiement</label>
                                    <select wire:model="typePaiement" class="form-control">
                                        <option value="">Choisir...</option>
                                        @foreach (TYPE_PAYMENT as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('typePaiement') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Montant (HTVA)</label>
                                <input type="number" class="form-control" wire:model="montant" step="0.01">
                                @error('montant') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea wire:model="description" class="form-control" rows="3" placeholder="Notes ou référence du paiement..."></textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="{{ $this->getBackUrl() }}" class="btn btn-outline-secondary btn-payment-outline">Annuler</a>
                                <button class="btn btn-payment-primary text-white" wire:click="savePayment">
                                    Enregistrer le paiement
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>