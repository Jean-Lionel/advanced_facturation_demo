<div class="app-stack">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Retour des marchandises</h2>
            <div class="app-toolbar-actions">
                <div class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Numéro de facture"
                        wire:model="factureNumber"
                        wire:keyup.enter="searchFacture"
                    >
                </div>
                <button type="button" class="btn btn-primary btn-sm" wire:click="searchFacture">
                    Rechercher
                </button>
            </div>
        </header>

        <div class="app-card-body">
            @if ($order)
                <div class="app-meta mb-3">
                    Facture n° <b>{{ $order->id }}</b>
                </div>

                <div class="app-table-wrap">
                    <table class="table table-sm app-table">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Quantité à retourner</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listProducts as $key => $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>{{ $item['quantite'] }}</td>
                                    <td>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            wire:model="listQuantite.{{ $key }}"
                                            value="{{ $item['quantite'] }}"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            wire:model="description.{{ $key }}"
                                            placeholder="Description"
                                        >
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm"
                                            wire:click="saveQuantite({{ $key }}, {{ collect($item) }})"
                                        >
                                            Retour
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mb-0 text-muted">
                    Saisissez un numéro de facture puis cliquez sur Rechercher.
                </p>
            @endif
        </div>
    </div>
</div>
