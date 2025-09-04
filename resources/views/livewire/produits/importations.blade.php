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

    <table class="table table-sm">
        <thead>
            <tr>
                <th>CODE PRODUIT</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Devise</th>
                <th>Prix </th>
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
                    <td>
                        <input type="number" wire:model="selectedItems.{{ $key }}.item_quantity">
                    </td>

                    <td>
                        <select name="" id="" wire:model="selectedItems.{{ $key }}.item_purchase_or_sale_currency">
                            <option value="">-Select-</option>
                            <option value="BIF">BIF</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" wire:model="selectedItems.{{ $key }}.item_purchase_or_sale_price">
                    </td>

                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.item_movement_description">
                    </td>

                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.reference_dmc">
                    </td>
                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.rubrique_tarifaire">
                    </td>
                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.numero_paquet">
                    </td>
                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.nombre_par_paquet">
                    </td>
                    <td>
                        <input type="text" wire:model="selectedItems.{{ $key }}.description_paquet">
                    </td>
                    <td>
                        <button wire:click="removeSelectedItem({{$key}})">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button wire:click="saveItem">Valider</button>
    @endif
   </div>
</div>
