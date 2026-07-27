<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Contrôle des stocks</h2>
            <div class="app-toolbar-actions">
                <div class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input
                        type="search"
                        placeholder="Rechercher un produit..."
                        wire:model.live.debounce.300ms="search"
                        autocomplete="off"
                    >
                </div>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Désignation</th>
                            <th>Marque</th>
                            <th>Catégorie</th>
                            <th>Unité</th>
                            <th>P.U</th>
                            <th>Stock actuel</th>
                            <th style="min-width: 120px;">Nouveau stock</th>
                            <th class="app-table-cell-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->code_product ?? '—' }}</td>
                                <td><b>{{ $product->name }}</b></td>
                                <td>{{ $product->marque ?? '—' }}</td>
                                <td>
                                    <span class="badge badge-light border">
                                        {{ optional($product->category)->title ?? '—' }}
                                    </span>
                                </td>
                                <td>{{ $product->unite_mesure ?? '—' }}</td>
                                <td>{{ getPrice($product->prix_vente ?? $product->price ?? 0) }}</td>
                                <td>
                                    <span class="badge {{ $product->quantite > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ number_format($product->quantite, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        wire:model="quantities.{{ $product->id }}"
                                        step="0.01"
                                        min="0"
                                        class="form-control form-control-sm"
                                        style="min-width: 110px;"
                                    >
                                </td>
                                <td class="app-table-cell-actions text-nowrap">
                                    <button
                                        type="button"
                                        wire:click="updateSingleProduct({{ $product->id }})"
                                        class="btn btn-outline-primary btn-sm text-nowrap"
                                    >
                                        <i class="fas fa-check"></i> Valider
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Aucun produit trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            <span class="app-meta">Total des produits : <b>{{ count($products) }}</b></span>
        </div>
    </div>
</div>
