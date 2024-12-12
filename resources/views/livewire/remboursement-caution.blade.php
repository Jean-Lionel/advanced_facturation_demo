<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Remboursement de Caution</h3>
        </div>
        
        <div class="card-body">
            <!-- Loading Overlay -->

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Recherche de facture -->
            <div class="form-group">
                <label>Rechercher une facture de caution</label>
                <input type="text" 
                       class="form-control" 
                       wire:model="search" 
                       placeholder="Numéro de facture ou nom du client">
                
                @if(!empty($search))
                    <div class="mt-2 list-group">
                        @if($factures->isEmpty())
                            <div class="list-group-item text-muted">
                                Aucune caution à rembourser trouvée
                            </div>
                        @else
                            @foreach($factures as $facture)
                                <button type="button" 
                                        class="list-group-item list-group-item-action"
                                        wire:click="selectFacture({{ $facture->id }})">
                                    Caution: {{ $facture->invoice_signature }} - 
                                    Client: {{ $facture->client->name }} - 
                                    Montant: {{ number_format($facture->amount, 2) }}
                                </button>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>

            @if($selectedFacture)
                <div class="mt-4">
                    <div class="alert alert-info">
                        <strong>Client:</strong> {{ $originalFacture->client->name ?? "" }}<br>
                        <strong>Facture originale:</strong> {{ $originalFacture->invoice_signature }}<br>
                        <strong>Date:</strong> {{ $originalFacture->created_at->format('d/m/Y') }}<br>
                        <strong>Montant total:</strong> {{ number_format($originalFacture->amount, 2) }}
                    </div>

                    <h4>Détails de la caution originale</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total HT</th>
                                    <th>TVA</th>
                                    <th>Total TTC</th>
                                    <th>Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product['name'] ?? "" }}</td>
                                        <td class="text-right">{{ number_format($product['quantite'] ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($product['price'] ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($product['item_price_nvat'] ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($product['vat'] ?? 0, 2) }}</td>
                                        <td class="text-right">{{ number_format($product['item_price_wvat'] ?? 0, 2) }}</td>
                                        <td class="text-center">
                                            <input type="checkbox" 
                                                   wire:model="selectedProducts" 
                                                   value="{{ $product['id'] }}"
                                                   class="form-check-input">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Totaux:</strong></td>
                                    <td class="text-right"><strong>{{ number_format(collect($products)->sum('item_price_nvat'), 2) }}</strong></td>
                                    <td class="text-right"><strong>{{ number_format(collect($products)->sum('vat'), 2) }}</strong></td>
                                    <td class="text-right"><strong>{{ number_format(collect($products)->sum('item_price_wvat'), 2) }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if(!empty($choosedProducts))
                        <h4 class="mt-5">Détails du remboursement</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th width="200">Quantité à rembourser</th>
                                        <th width="200">Prix unitaire</th>
                                        <th>Total HT</th>
                                        <th>TVA</th>
                                        <th>Total TTC</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($choosedProducts as $product)
                                        <tr>
                                            <td>{{ $product['name'] }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number"
                                                           class="form-control @error('productsQuantities.'.$product['id']) is-invalid @enderror"
                                                           wire:model.debounce.500ms="productsQuantities.{{$product['id']}}"
                                                           min="0.01"
                                                           max="{{ $product['quantite'] }}"
                                                           step="0.01">
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
                                                    <input type="number"
                                                           class="form-control @error('productsProductsPrices.'.$product['id']) is-invalid @enderror"
                                                           wire:model.debounce.500ms="productsProductsPrices.{{$product['id']}}"
                                                           min="0.01"
                                                           step="0.01">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ $originalFacture->invoice_currency ?? 'BIF' }}</span>
                                                    </div>
                                                </div>
                                                @error('productsProductsPrices.'.$product['id'])
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']], 2) }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format(($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']]) * 0.18, 2) }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format(($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']]) * 1.18, 2) }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        wire:click="$set('selectedProducts', {{ json_encode(array_values(array_diff($selectedProducts, [$product['id']]))) }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-secondary">
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Totaux du remboursement:</strong></td>
                                        <td class="text-right">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                return $productsQuantities[$p['id']] * $productsProductsPrices[$p['id']];
                                            }), 2) }}</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 0.18;
                                            }), 2) }}</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 1.18;
                                            }), 2) }}</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-4 form-group">
                            <label>Motif du remboursement</label>
                            <textarea class="form-control @error('motifRemboursement') is-invalid @enderror" 
                                     wire:model="motifRemboursement"
                                     rows="3"
                                     maxlength="255"
                                     placeholder="Veuillez saisir le motif du remboursement..."></textarea>
                            <small class="text-muted">
                                Caractères restants: {{ 255 - strlen($motifRemboursement) }}
                            </small>
                            @error('motifRemboursement') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 card bg-light">
                            <div class="card-body">
                                <h5>Résumé du remboursement</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="text-center card-body">
                                                <h6>Total HT</h6>
                                                <h4>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                    return $productsQuantities[$p['id']] * $productsProductsPrices[$p['id']];
                                                }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="text-center card-body">
                                                <h6>TVA (18%)</h6>
                                                <h4>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                    return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 0.18;
                                                }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-white card bg-primary">
                                            <div class="text-center card-body">
                                                <h6>Total TTC</h6>
                                                <h4>{{ number_format(collect($choosedProducts)->sum(function($p) { 
                                                    return ($productsQuantities[$p['id']] * $productsProductsPrices[$p['id']]) * 1.18;
                                                }), 2) }} {{ $originalFacture->invoice_currency ?? 'BIF' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <button type="button" 
                                    class="btn btn-secondary"
                                    wire:click="$set('selectedFacture', null)">
                                <i class="mr-1 fas fa-times"></i> Annuler
                            </button>
                            
                            <button class="btn btn-primary" 
                                    wire:click="$emit('confirmRemboursement')"
                                    wire:loading.attr="disabled">
                                <i class="mr-1 fas fa-save"></i>
                                <span wire:loading wire:target="createRemboursement">
                                    <i class="mr-1 fas fa-spinner fa-spin"></i> Traitement en cours...
                                </span>
                                <span wire:loading.remove>
                                    Effectuer le remboursement
                                </span>
                            </button>
                        </div>
                    @endif
                </div>
            @else
                <div class="mt-3 alert alert-info">
                    <i class="mr-2 fas fa-info-circle"></i>
                    Veuillez rechercher une facture de caution pour commencer le processus de remboursement.
                </div>
            @endif
        </div>
    </div>


    @push('scripts')
    <script>
        window.addEventListener('livewire:load', function () {
            // Confirmation avant remboursement
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

            // Notification de succès
            Livewire.on('remboursementSuccess', (message) => {
                Swal.fire({
                    title: 'Succès!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });

            // Notification d'erreur
            Livewire.on('remboursementError', (message) => {
                Swal.fire({
                    title: 'Erreur!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });

            // Confirmation avant suppression d'un produit
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

            // Validation des quantités
            const validateQuantity = (input, max) => {
                const value = parseFloat(input.value);
                if (value <= 0) {
                    input.value = 0.01;
                } else if (value > max) {
                    input.value = max;
                }
            };

            // Validation des prix
            const validatePrice = (input) => {
                const value = parseFloat(input.value);
                if (value <= 0) {
                    input.value = 0.01;
                }
            };

            // Format des nombres
            const formatNumber = (number) => {
                return new Intl.NumberFormat('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(number);
            };

            // Mise à jour automatique des totaux
            document.addEventListener('input', function(e) {
                if (e.target.matches('[wire\\:model*="productsQuantities"], [wire\\:model*="productsProductsPrices"]')) {
                    // Petite pause pour laisser Livewire mettre à jour les données
                    setTimeout(() => {
                        if (e.target.matches('[wire\\:model*="productsQuantities"]')) {
                            validateQuantity(e.target, parseFloat(e.target.getAttribute('max')));
                        } else {
                            validatePrice(e.target);
                        }
                    }, 300);
                }
            });

            // Activer les tooltips Bootstrap
            $('[data-toggle="tooltip"]').tooltip();

            // Gestion du chargement
            Livewire.hook('message.sent', () => {
                // Ajouter une classe pendant le chargement
                document.body.classList.add('loading');
            });

            Livewire.hook('message.processed', () => {
                // Retirer la classe après le chargement
                document.body.classList.remove('loading');
                // Réinitialiser les tooltips
                $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
            });
        });

        // Fonction pour empêcher la soumission du formulaire lors de l'appui sur Entrée
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea') {
                e.preventDefault();
            }
        });

        // Fonction pour formater les montants en temps réel
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