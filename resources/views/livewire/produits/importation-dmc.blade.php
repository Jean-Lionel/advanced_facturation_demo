<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div>
        <div>
            <label for="">DMC Number</label>
            <input type="text" wire:model="dmc_number">
            <button wire:click="searchValue" wire:loading.attr="disabled">
                <span wire:loading.remove>Search</span>
                <span wire:loading><i class="fa fa-spinner fa-spin"></i> Chargement...</span>
            </button>
        </div>
        @if($isLoading)
        <h1>Chargment en cours...</h1>
        @endif

        <div>
            Message : {{ $message }}
            Reference DMC : {{ $reference_dmc }}
        </div>
    </div>
    @if($selectedItems)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de declaration</th>
                    <th>Nom commercial</th>
                    <th>Quantité</th>
                    <th>Prix</th>
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
                    <td>{{$key + 1 }}</td>
                    <td>
                        {{ $item['item_designation']  }}
                    </td>
                    <td>
                        @if(isset($selectedItems[$key]["product_name"]))
                        <b> {{ $selectedItems[$key]["product_name"] }}</b>
                        <button wire:click="removeProductName({{ $key }})" wire:loading.attr="disabled">
                            <span wire:loading.remove><i class="fa fa-trash"></i></span>
                            <span wire:loading><i class="fa fa-spinner fa-spin"></i></span>
                        </button>
                        @else
                        <div class="gap-2 d-flex">
                            <input type="text" wire:model="selectedItems.{{ $key }}.item_name"
                                class="form-control form-control-sm">
                            <button wire:click="searchProduct({{ $key }})" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="fa fa-search"></i></span>
                                <span wire:loading><i class="fa fa-spinner fa-spin"></i></span>
                            </button>
                        </div>
                        @endif
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="number"
                            wire:model="selectedItems.{{ $key }}.item_quantity">
                    </td>
                    <td width="10%">
                        <input class="form-control form-control-sm" type="number"
                            wire:model="selectedItems.{{ $key }}.item_cost_price">
                    </td>

                    <td>
                        <select class="form-control form-control-sm" name="" id=""
                            wire:model="selectedItems.{{ $key }}.item_cost_price_currency">
                            <option value="">-Select-</option>
                            <option value="BIF">BIF</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                        @error('selectedItems.{{ $key }}.item_cost_price_currency') <span
                            class="text-danger">{{ $message }}</span> @enderror
                    </td>

                    <td>
                        <input class="form-control form-control-sm" type="text"
                            wire:model="selectedItems.{{ $key }}.item_movement_description">
                        @error('selectedItems.{{ $key }}.item_movement_description') <span
                            class="text-danger">{{ $message }}</span> @enderror
                    </td>

                    <td>
                        <input class="form-control form-control-sm" type="text"
                            wire:model="selectedItems.{{ $key }}.rubrique_tarifaire" disabled>
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text"
                            wire:model="selectedItems.{{ $key }}.numero_paquet">
                        @error('selectedItems.{{ $key }}.numero_paquet') <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text"
                            wire:model="selectedItems.{{ $key }}.nombre_par_paquet">
                        @error('selectedItems.{{ $key }}.nombre_par_paquet') <span
                            class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text"
                            wire:model="selectedItems.{{ $key }}.description_paquet" disabled>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <button wire:click="saveItem" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Enregistrer</span>
                <span wire:loading><i class="fa fa-spinner fa-spin"></i> Enregistrement...</span>
            </button>
        </div>
    </div>
    @endif

</div>