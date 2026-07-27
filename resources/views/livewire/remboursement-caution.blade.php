<div>
<section class="vente-card">
    <header class="vente-card-header">
        <h2 class="vente-card-heading">Remboursement de Caution</h2>
    </header>

    <div class="vente-card-body">
        @if (session()->has('message'))
            <div class="alert alert-success app-alert">{{ session('message') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger app-alert">{{ session('error') }}</div>
        @endif

        <div class="vente-field">
            <label>Rechercher une facture de caution</label>
            <input
                type="text"
                class="form-control"
                wire:model="search"
                placeholder="Numéro de facture ou nom du client"
            >

            @if (!empty($search))
                <div class="vente-search-results">
                    @if ($factures->isEmpty())
                        <div class="list-group-item text-muted">Aucune caution à rembourser trouvée</div>
                    @else
                        @foreach ($factures as $facture)
                            <button type="button" wire:click="selectFacture({{ $facture->id }})">
                                Caution: {{ $facture->invoice_signature }} —
                                Client: {{ $facture->client->name }} —
                                Montant: {{ number_format($facture->amount, 2) }}
                            </button>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>

        @if ($selectedFacture)
            <div class="mt-4 vente-stack">
                <div class="vente-info-box">
                    <strong>Client:</strong> {{ $originalFacture->client->name ?? '' }}<br>
                    <strong>Facture originale:</strong> {{ $originalFacture->invoice_signature }}<br>
                    <strong>Date:</strong> {{ $originalFacture->created_at->format('d/m/Y') }}<br>
                    <strong>Montant total:</strong> {{ number_format($originalFacture->amount, 2) }}
                </div>

                <div>
                    <h3 class="vente-section-title">Détails de la caution originale</h3>
                    <div class="vente-table-card">
                        <table class="vente-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th class="col-num">Quantité</th>
                                    <th class="col-num">Prix unitaire</th>
                                    <th class="col-num">Total HT</th>
                                    <th class="col-num">TVA</th>
                                    <th class="col-num">Total TTC</th>
                                    <th class="col-center">Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['name'] ?? '' }}</td>
                                        <td class="col-num">{{ number_format($product['quantite'] ?? 0, 2) }}</td>
                                        <td class="col-num">{{ number_format($product['price'] ?? 0, 2) }}</td>
                                        <td class="col-num">{{ number_format($product['item_price_nvat'] ?? 0, 2) }}</td>
                                        <td class="col-num">{{ number_format($product['vat'] ?? 0, 2) }}</td>
                                        <td class="col-num">{{ number_format($product['item_price_wvat'] ?? 0, 2) }}</td>
                                        <td class="col-center">
                                            <input
                                                type="checkbox"
                                                wire:model="selectedProducts"
                                                value="{{ $product['id'] }}"
                                                class="form-check-input"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="col-num"><strong>Totaux:</strong></td>
                                    <td class="col-num"><strong>{{ number_format(collect($products)->sum('item_price_nvat'), 2) }}</strong></td>
                                    <td class="col-num"><strong>{{ number_format(collect($products)->sum('vat'), 2) }}</strong></td>
                                    <td class="col-num"><strong>{{ number_format(collect($products)->sum('item_price_wvat'), 2) }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                @if (!empty($choosedProducts))
                    <div>
                        <h3 class="vente-section-title">Détails du remboursement</h3>
                        <div class="vente-table-card">
                            <table class="vente-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantité à rembourser</th>
                                        <th>Prix unitaire</th>
                                        <th class="col-num">Total HT</th>
                                        <th class="col-num">TVA</th>
                                        <th class="col-num">Total TTC</th>
                                        <th class="col-action">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($choosedProducts as $product)
                                        <tr>
                                            <td>{{ $product['name'] }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input
                                                        type="number"
                                                        class="form-control @error('productsQuantities.'.$product['id']) is-invalid @enderror"
                                                        wire:model.debounce.500ms="productsQuantities.{{ $product['id'] }}"
                                                        min="0.01"
                                                        max="{{ $product['quantite'] }}"
                                                        step="0.01"
                                                    >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ $product['unite'] ?? 'Unité' }}</span>
                                                    </div>
                                                </div>
                                                @error('productsQuantities.'.$product['id'])
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input
                                                        type="number"
                                                        class="form-control @error('productsProductsPrices.'.$product['id']) is-invalid @enderror"
                                                        wire:model.debounce.500ms="productsProductsPrices.{{ $product['id'] }}"
                                                        min="0.01"
                                                        step="0.01"
                                                    >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ $originalFacture->invoice_currency ?? 'BIF' }}</span>
                                                    </div>
                                                </div>
                                                @error('productsProductsPrices.'.$product['id'])
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="col-num">
                                                {{ number_format($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']], 2) }}
                                            </td>
                                            <td class="col-num">
                                                {{ number_format(($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']]) * 0.18, 2) }}
                                            </td>
                                            <td class="col-num">
                                                {{ number_format(($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']]) * 1.18, 2) }}
                                            </td>
                                            <td class="col-action">
                                                <button
                                                    type="button"
                                                    class="btn vente-btn vente-btn-danger"
                                                    wire:click="$set('selectedProducts', {{ json_encode(array_values(array_diff($selectedProducts, [$product['id']]))) }})"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="col-num"><strong>Totaux du remboursement:</strong></td>
                                        <td class="col-num">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) {
                                                return $productsQuantities[$p['id']] * $productsProductsPrices[$p['id']];
                                            }), 2) }}</strong>
                                        </td>
                                        <td class="col-num">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) {
                                                return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 0.18;
                                            }), 2) }}</strong>
                                        </td>
                                        <td class="col-num">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) {
                                                return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 1.18;
                                            }), 2) }}</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="vente-field">
                        <label>Motif du remboursement</label>
                        <textarea
                            class="form-control @error('motifRemboursement') is-invalid @enderror"
                            wire:model="motifRemboursement"
                            rows="3"
                            maxlength="255"
                            placeholder="Veuillez saisir le motif du remboursement..."
                        ></textarea>
                        <small class="text-muted">Caractères restants: {{ 255 - strlen($motifRemboursement) }}</small>
                        @error('motifRemboursement')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <h3 class="vente-section-title">Résumé du remboursement</h3>
                        <div class="vente-summary-grid">
                            <div class="vente-summary-item">
                                <h6>Total HT</h6>
                                <h4>
                                    {{ number_format(collect($choosedProducts)->sum(function($p) {
                                        return $productsQuantities[$p['id']] * $productsProductsPrices[$p['id']];
                                    }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}
                                </h4>
                            </div>
                            <div class="vente-summary-item">
                                <h6>TVA (18%)</h6>
                                <h4>
                                    {{ number_format(collect($choosedProducts)->sum(function($p) {
                                        return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 0.18;
                                    }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}
                                </h4>
                            </div>
                            <div class="vente-summary-item is-primary">
                                <h6>Total TTC</h6>
                                <h4>
                                    {{ number_format(collect($choosedProducts)->sum(function($p) {
                                        return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 1.18;
                                    }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="vente-actions justify-content-between">
                        <button type="button" class="btn vente-btn vente-btn-ghost" wire:click="$set('selectedFacture', null)">
                            <i class="fas fa-times"></i> Annuler
                        </button>

                        <button
                            type="button"
                            class="btn vente-btn vente-btn-accent"
                            wire:click="$emit('confirmRemboursement')"
                            wire:loading.attr="disabled"
                        >
                            <i class="fas fa-save"></i>
                            <span wire:loading wire:target="createRemboursement">
                                <i class="fas fa-spinner fa-spin"></i> Traitement en cours...
                            </span>
                            <span wire:loading.remove>Effectuer le remboursement</span>
                        </button>
                    </div>
                @endif
            </div>
        @else
            <div class="mt-3 vente-info-box">
                <i class="fas fa-info-circle"></i>
                Veuillez rechercher une facture de caution pour commencer le processus de remboursement.
            </div>
        @endif
    </div>
</section>

    @push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            Livewire.on('confirmRemboursement', () => {
                Swal.fire({
                    title: 'Confirmation de remboursement',
                    text: 'Êtes-vous sûr de vouloir effectuer ce remboursement de caution ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, effectuer le remboursement',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.createRemboursement();
                    }
                });
            });

            Livewire.on('remboursementSuccess', (message) => {
                Swal.fire({
                    title: 'Succès!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });

            Livewire.on('remboursementError', (message) => {
                Swal.fire({
                    title: 'Erreur!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });

            window.confirmDeleteProduct = function(productId) {
                Swal.fire({
                    title: 'Supprimer ce produit?',
                    text: 'Voulez-vous vraiment retirer ce produit du remboursement?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.removeProduct(productId);
                    }
                });
            };

            const validateQuantity = (input, max) => {
                const value = parseFloat(input.value);
                if (value <= 0) {
                    input.value = 0.01;
                } else if (value > max) {
                    input.value = max;
                }
            };

            const validatePrice = (input) => {
                const value = parseFloat(input.value);
                if (value <= 0) {
                    input.value = 0.01;
                }
            };

            const formatNumber = (number) => {
                return new Intl.NumberFormat('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(number);
            };

            document.addEventListener('input', function(e) {
                if (e.target.matches('[wire\\:model*="productsQuantities"], [wire\\:model*="productsProductsPrices"]')) {
                    setTimeout(() => {
                        if (e.target.matches('[wire\\:model*="productsQuantities"]')) {
                            validateQuantity(e.target, parseFloat(e.target.getAttribute('max')));
                        } else {
                            validatePrice(e.target);
                        }
                    }, 300);
                }
            });

            $('[data-toggle="tooltip"]').tooltip();

            Livewire.hook('message.sent', () => {
                document.body.classList.add('loading');
            });

            Livewire.hook('message.processed', () => {
                document.body.classList.remove('loading');
                $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea') {
                e.preventDefault();
            }
        });

        function formatMontant(input) {
            let value = input.value.replace(/[^\d.-]/g, '');
            if (value) {
                value = parseFloat(value).toFixed(2);
                input.value = formatNumber(value);
            }
        }
    </script>
    @endpush
</div>
