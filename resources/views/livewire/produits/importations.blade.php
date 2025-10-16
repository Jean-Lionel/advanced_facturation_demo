<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

   <div>
    <input type="text" wire:model="searchItem" wire:keyup="searchProducts">
   </div>
   <div class="flex-wrap gap-3 d-flex flex-justify-content-between">
    @if ($products)
        @foreach ($products as $product)
            <p class="mr-4">     {{ ++$loop->index }}    {{ $product->name }} <button wire:click="addSelectedItem({{$product}})">
                Ajouter
            </button></p>
        @endforeach
    @endif
   </div>

   <div>

   <h2>Produits selectionnés</h2>

    @if ($selectedItems)


    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
        @endforeach
    </ul>

    <table class="table table-sm table-bordered table-responsive">
        <thead>
            <tr>
                <th>CODE PRODUIT</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>PRIX A </th>
                <th>Devise</th>
                <th>Description</th>
                <th>Reference DMC</th>
                <th>Rubrique Tarifaire</th>
                <th>Numero Paquet</th>
                <th>Nombre par paquet</th>
                <th>Description Paquet</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($selectedItems as $key => $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td >
                        <input class="form-control form-control-sm" type="number" wire:model="selectedItems.{{ $key }}.item_quantity">
                    </td>
                    <td width="10%">
                        <input class="form-control form-control-sm" type="number" wire:model="selectedItems.{{ $key }}.item_cost_price">
                    </td>

                    <td>
                        <select class="form-control form-control-sm" name="" id="" wire:model="selectedItems.{{ $key }}.item_cost_price_currency">
                            <option value="">-Select-</option>
                            <option value="BIF">BIF</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </td>

                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.item_movement_description">
                    </td>

                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.reference_dmc">
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.rubrique_tarifaire">
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.numero_paquet">
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.nombre_par_paquet">
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" wire:model="selectedItems.{{ $key }}.description_paquet">
                    </td>
                    <td>
                        <button wire:click="removeSelectedItem({{$key}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button wire:click="saveItem" class="btn btn-primary">Valider</button>
    @endif
   </div>
</div>
