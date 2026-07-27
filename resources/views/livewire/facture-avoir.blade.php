<section class="vente-card">
    <header class="vente-card-header">
        <h2 class="vente-card-heading">Création d'une Facture d'Avoir</h2>
    </header>

    <div class="vente-card-body">
        @if (session()->has('message'))
            <div class="alert alert-success app-alert">{{ session('message') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger app-alert">{{ session('error') }}</div>
        @endif

        <div class="vente-field">
            <label>Rechercher une facture</label>
            <input
                type="text"
                class="form-control"
                wire:model.debounce.300ms="search"
                placeholder="Numéro de facture ou nom du client"
            >

            @if (!empty($search))
                <div class="vente-search-results">
                    @forelse ($factures as $facture)
                        <button type="button" wire:click="selectFacture({{ $facture->id }})">
                            Facture: {{ $facture->invoice_signature }} —
                            Client: {{ $facture->client->name }} —
                            Montant: {{ number_format($facture->amount, 2) }}
                        </button>
                    @empty
                        <div class="list-group-item text-muted">Aucune facture trouvée</div>
                    @endforelse
                </div>
            @endif
        </div>

        @if ($selectedFacture)
            <div class="mt-4 vente-stack">
                <div class="vente-form-grid">
                    <div class="vente-field">
                        <label>Type de facture</label>
                        <select name="choosedFacture" wire:model="choosedFacture" class="form-control">
                            @foreach ($typeFactureListe as $key => $v)
                                <option value="{{ $key }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        @error('choosedFacture')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="vente-field">
                        <label for="addTva">&nbsp;</label>
                        <label class="d-flex align-items-center" style="gap:8px; text-transform:none; letter-spacing:0; font-size:0.875rem; color:var(--v-ink);">
                            <input type="checkbox" wire:model="addTva" id="addTva" value="1">
                            Ajouter la TVA
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="vente-section-title">Détails de la facture originale</h3>
                    <div class="vente-table-card">
                        <table class="vente-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th class="col-num">Quantité</th>
                                    <th class="col-num">Prix</th>
                                    <th class="col-num">Total</th>
                                    <th class="col-center">Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['name'] ?? '' }}</td>
                                        <td class="col-num">{{ $product['quantite'] ?? '' }}</td>
                                        <td class="col-num">{{ $product['price'] ?? '' }}</td>
                                        <td class="col-num">{{ $product['item_price_nvat'] }}</td>
                                        <td class="col-center">
                                            <input type="checkbox" wire:model="selectedProducts" value="{{ $product['id'] }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <h3 class="vente-section-title">Modification de la facture d'avoir</h3>
                    <div class="vente-table-card">
                        <table class="vente-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th class="col-num">Total</th>
                                    <th class="col-center">Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($choosedProducts as $product)
                                    <tr>
                                        <td>{{ $product['name'] }}</td>
                                        <td>
                                            {{ $product['quantite'] ?? '' }}
                                            <input
                                                type="number"
                                                wire:model="productsQuantities.{{ $product['id'] }}"
                                                value="{{ $product['quantite'] }}"
                                                step="0.01"
                                            >
                                        </td>
                                        <td>
                                            {{ $product['price'] ?? '' }}
                                            <input
                                                type="number"
                                                wire:model="productsProductsPrices.{{ $product['id'] }}"
                                                value="{{ $product['price'] }}"
                                                step="0.01"
                                            >
                                        </td>
                                        <td class="col-num">
                                            {{ getPrice($product['item_price_nvat'] ?? '') }}
                                            <br>
                                            {{ getPrice($productsQuantities[$product['id']] * $productsProductsPrices[$product['id']]) }}
                                        </td>
                                        <td class="col-center">
                                            <input type="checkbox" wire:model="selectedProducts" value="{{ $product['id'] ?? '' }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="vente-field">
                    <label>Motif de l'avoir</label>
                    <textarea class="form-control" wire:model="motifAvoir" rows="3"></textarea>
                    @error('motifAvoir')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="vente-actions">
                    <button
                        type="button"
                        class="btn vente-btn vente-btn-accent"
                        wire:click="createAvoir"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading wire:target="createAvoir">Création en cours...</span>
                        <span wire:loading.remove>Créer la facture d'avoir</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>
