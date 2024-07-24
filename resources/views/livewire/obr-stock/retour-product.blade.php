<div>
    {{-- The whole world belongs to you. --}}
    <div class="container">
        <div class="card">
            <div class="card-header">
                 <h4 class="text-center">Retour des Marchandises vendus dans le stock</h4>
                <input type="text" placeholder="Numéro du facture" wire:model='factureNumber'
                wire:keyup.enter='searchFacture'
                />
                <button wire:click='searchFacture'>Rechercher</button>
            </div>
            <div class="card-body">
                @if($order)
                <table class="table table-sm">
                    <thead>
                        <th>Désignation</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Quantité retourner</th>
                        <th> Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($listProducts  as $key =>  $item )
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['quantite'] }}</td>
                            <td>
                                <input type="text" wire:model="listQuantite.{{ $key }}" value="{{ $item['quantite'] }}">
                            </td>
                            <td>
                                <input type="text" wire:model="description.{{ $key }}" placeholder="Description">

                            </td>
                            <td>
                                <button wire:click="saveQuantite({{ $key }}, {{ collect($item)  }})">Retour</button>
                                {{--  @if(!in_array($item['id'], $produitsRetournes->toArray(), true))
                              
                                @endif  --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
