<div class="app-stack">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Importation DMC</h2>
            <div class="app-toolbar-actions">
                <div class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="text" wire:model="dmc_number" placeholder="DMC Number">
                </div>
                <button type="button" class="btn btn-primary btn-sm" wire:click="searchValue" wire:loading.attr="disabled">
                    <span wire:loading.remove>Search</span>
                    <span wire:loading><i class="fa fa-spinner fa-spin"></i> Chargement...</span>
                </button>
            </div>
        </header>

        <div class="app-card-body">
            @if($isLoading)
                <p class="mb-2 text-muted">Chargement en cours...</p>
            @endif

            <div class="app-meta">
                <span>Message : <b>{{ $message }}</b></span>
                <span class="ml-3">Reference DMC : <b>{{ $reference_dmc }}</b></span>
            </div>
        </div>
    </div>

    @if($selectedItems)
        <div class="app-card">
            <header class="app-card-header">
                <h2 class="app-card-heading">Articles importés</h2>
                <div class="app-toolbar-actions">
                    <button type="button" wire:click="saveItem" class="btn btn-primary btn-sm" wire:loading.attr="disabled">
                        <span wire:loading.remove>Enregistrer</span>
                        <span wire:loading><i class="fa fa-spinner fa-spin"></i> Enregistrement...</span>
                    </button>
                </div>
            </header>

            <div class="">
                @if ($errors->any())
                    <ul class="mb-3 pl-3">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="app-table-wrap">
                    <table class="table table-sm app-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom de declaration</th>
                                <th>Nom commercial</th>
                                <th>Quantité</th>
                                <th style="min-width: 140px;">Prix</th>
                                <th>Devise</th>
                                <th>Description</th>
                                <th>Rubrique Tarifaire</th>
                                <th>Numero Paquet</th>
                                <th>Nombre par paquet</th>
                                <th>Description Paquet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selectedItems as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['item_designation'] }}</td>
                                    <td>
                                        @if(isset($selectedItems[$key]["product_name"]))
                                            <b>{{ $selectedItems[$key]["product_name"] }}</b>
                                            <button type="button" class="btn btn-outline-danger btn-sm ml-1" wire:click="removeProductName({{ $key }})" wire:loading.attr="disabled">
                                                <span wire:loading.remove><i class="fa fa-trash"></i></span>
                                                <span wire:loading><i class="fa fa-spinner fa-spin"></i></span>
                                            </button>
                                        @else
                                            <div class="d-flex align-items-center" style="gap:6px;">
                                                <input type="text" wire:model="selectedItems.{{ $key }}.item_name" class="form-control form-control-sm">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="searchProduct({{ $key }})" wire:loading.attr="disabled">
                                                    <span wire:loading.remove><i class="fa fa-search"></i></span>
                                                    <span wire:loading><i class="fa fa-spinner fa-spin"></i></span>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="number" wire:model="selectedItems.{{ $key }}.item_quantity" style="min-width: 90px;">
                                    </td>
                                    <td style="min-width: 140px;">
                                        <input class="form-control form-control-sm" type="number" step="any" wire:model="selectedItems.{{ $key }}.item_cost_price" style="min-width: 130px;">
                                    </td>
                                    <td style="min-width: 100px;">
                                        <select class="form-control form-control-sm" wire:model="selectedItems.{{ $key }}.item_cost_price_currency" style="min-width: 90px;">
                                            <option value="">-Select-</option>
                                            <option value="BIF">BIF</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                        @error('selectedItems.'.$key.'.item_cost_price_currency')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.item_movement_description">
                                        @error('selectedItems.'.$key.'.item_movement_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.rubrique_tarifaire" disabled>
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.numero_paquet">
                                        @error('selectedItems.'.$key.'.numero_paquet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.nombre_par_paquet">
                                        @error('selectedItems.'.$key.'.nombre_par_paquet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.description_paquet" disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
