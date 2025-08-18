<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 text-gray-800 h3">
                <i class="fas fa-chart-bar me-2"></i>Rapport de Boutique
            </h1>

            <!-- Messages de notification -->
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Statistiques -->
            <div class="mb-4 row">
                <div class="mb-4 col-xl-3 col-md-6">
                    <div class="py-2 shadow card border-left-primary h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="mr-2 col">
                                    <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                        Total des Ventes
                                    </div>
                                    <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                        {{ number_format($totalVentes, 0, ',', ' ') }} F
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="text-gray-300 fas fa-dollar-sign fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 col-xl-3 col-md-6">
                    <div class="py-2 shadow card border-left-success h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="mr-2 col">
                                    <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                        Quantité Vendue
                                    </div>
                                    <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                        {{ number_format($totalQuantiteVendue, 2) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="text-gray-300 fas fa-shopping-cart fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 col-xl-3 col-md-6">
                    <div class="py-2 shadow card border-left-info h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="mr-2 col">
                                    <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">
                                        Nombre de Contrôles
                                    </div>
                                    <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                        {{ $nombreControles }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="text-gray-300 fas fa-clipboard-list fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 col-xl-3 col-md-6">
                    <div class="py-2 shadow card border-left-warning h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="mr-2 col">
                                    <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">
                                        Vente Moyenne
                                    </div>
                                    <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                        {{ $nombreControles > 0 ? number_format($totalVentes / $nombreControles, 0, ',', ' ') : 0 }} F
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="text-gray-300 fas fa-calculator fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mb-4 card">
                <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtres de Recherche</h6>
                    <button wire:click="resetFilters" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Réinitialiser
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Période -->
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Date de début</label>
                            <input type="date"
                                   wire:model.live="dateFrom"
                                   class="form-control">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Date de fin</label>
                            <input type="date"
                                   wire:model.live="dateTo"
                                   class="form-control">
                        </div>

                        <!-- Recherche -->
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Rechercher</label>
                            <input type="text"
                                   wire:model.live="search"
                                   wire:keypress.enter="$refresh"
                                   class="form-control"
                                   placeholder="Nom ou code produit...">
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Catégorie</label>
                            <select wire:model.live="selectedCategory"
                                    class="form-select">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Actions d'export -->
                    <div class="row">
                        <div class="col-12">
                            <div class="flex-wrap gap-2 d-flex">
                                <button wire:click="exportExcel" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Exporter Excel
                                </button>
                                <button wire:click="exportPDF" class="btn btn-danger">
                                    <i class="fas fa-file-pdf me-1"></i> Exporter PDF
                                </button>
                                <div class="ms-auto">
                                    <select wire:model.live="perPage" class="form-select form-select-sm" style="width: auto;">
                                        <option value="10">10 par page</option>
                                        <option value="25">25 par page</option>
                                        <option value="50">50 par page</option>
                                        <option value="100">100 par page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des contrôles -->
            <div class="card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Historique des Contrôles de Stock
                    </h6>
                </div>
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Produit</th>
                                    <th>Catégorie</th>
                                    <th>Stock Ancien</th>
                                    <th>Nouveau Stock</th>
                                    <th>Quantité Vendue</th>
                                    <th>Prix Unitaire</th>
                                    <th>Total Vente</th>
                                    <th>Utilisateur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ventes as $vente)
                                    <tr>
                                        <td>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($vente->created_at)->format('d/m/Y H:i') }}
                                            </small>
                                        </td>
                                        <td>
                                            <strong>{{ $vente->product->name ?? 'Produit supprimé' }}</strong>
                                            @if($vente->product && $vente->product->code_product)
                                                <br><small class="text-muted">{{ $vente->product->code_product }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $vente->product->category->title ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ number_format($vente->old_quantity, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ number_format($vente->new_quantity, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $vente->sold_quantity > 0 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ number_format($vente->sold_quantity, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ number_format($vente->price, 0, ',', ' ') }} F
                                        </td>
                                        <td>
                                            <strong class="text-success">
                                                {{ number_format($vente->total, 0, ',', ' ') }} F
                                            </strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $vente->user->name }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-4 text-center text-muted">
                                            <i class="mb-2 fas fa-inbox fa-2x"></i>
                                            <br>
                                            Aucun contrôle trouvé pour cette période
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $ventes->links() }}
                </div>
            </div>

            <!-- Résumé de la page -->
            <div class="mt-4 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Période : {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}
                            </small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Dernière mise à jour : {{ now()->format('d/m/Y H:i:s') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
