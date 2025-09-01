<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 text-gray-800 h3">Contrôle des stocks</h1>

            <!-- Messages de notification -->
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filtres -->
            <div class="mb-4 card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher un produit..."
                                       wire:model.live.debounce.300ms="search">
                                {{-- <select class="form-select" wire:model.live="selectedCategory">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des produits -->
            <div class="card">
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Marque</th>
                                    <th>Catégorie</th>
                                    <th>Unité</th>
                                    <th>P.U</th>
                                    <th>Stock actuel</th>
                                    <th>Nouveau stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <small class="text-muted">{{ $product->code_product ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                        </td>
                                        <td>{{ $product->marque ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $product->category->title ?? '-' }}</span>
                                        </td>
                                        <td>{{ $product->unite_mesure ?? '-' }}</td>
                                        <td>{{ getPrice($product->prix_vente) ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $product->quantite > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ number_format($product->quantite, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <input type="number"
                                                   wire:model="quantities.{{ $product->id }}"
                                                   step="0.01"
                                                   min="0"
                                                   class="form-control form-control-sm"
                                                   style="width: 100px;"
                                                   {{-- wire:keypress.enter="updateSingleProduct({{ $product->id }})" --}}
                                                   >
                                        </td>
                                        <td>
                                            <button wire:click="updateSingleProduct({{ $product->id }})"
                                                    class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-check"></i> Valider
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-4 text-center text-muted">
                                            <i class="mb-2 fas fa-inbox fa-2x"></i>
                                            <br>
                                            Aucun produit trouvé
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Résumé -->
            <div class="mt-4 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-box me-1"></i>
                                Total des produits : <strong>{{ count($products) }}</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
