<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Création d'une Facture d'Avoir</h3>
        </div>
        
        <div class="card-body">
        
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Recherche de facture -->
            <div class="form-group">
                <label>Rechercher une facture</label>
                <input type="text" class="form-control" wire:model.debounce.300ms="search" placeholder="Numéro de facture ou nom du client">
                
                @if(!empty($search))
                    <div class="mt-2 list-group">
                        @foreach($factures as $facture)
                            <button type="button" 
                                    class="list-group-item list-group-item-action"
                                    wire:click="selectFacture({{ $facture->id }})">
                                Facture: {{ $facture->invoice_signature }} - 
                                Client: {{ $facture->client->name }} - 
                                Montant: {{ number_format($facture->amount, 2) }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($selectedFacture)
                <div class="mt-4">
                    <div class="form-group">
                        Choisisser le Type de Facture: 
                    <select name="choosedFacture" wire:model="choosedFacture"  class="form-control">
                        @foreach ($typeFactureListe as $key => $v)
                            <option value="{{$key}}">{{$v}}</option>
                        @endforeach
                    </select>
                    @error("choosedFacture")
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                    </div>
                    <h4>Détails de la facture originale</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Total</th>
                                    <th>Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td> {{ $product['name'] ?? ""  }}  </td>
                                        <td> {{ $product['quantite'] ?? "" }} </td>
                                        <td> {{ $product['price'] ?? "" }}</td>
                                        <td> {{ $product['item_price_nvat'] }} </td>
                                        <td>
                                            <input type="checkbox" 
                                                   wire:model="selectedProducts" 
                                                   value="{{ $product['id'] }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4>Modification  de la facture d'Avoir</h4>
                    <div class="table-responsive">
                       <table class="table">
                       <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Total</th>
                                    <th>Sélectionner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($choosedProducts as $product)
                                    <tr>
                                        <td> {{$product['name'] }}  </td>
                                        <td> 
                                        {{ $product['quantite'] ?? "" }} <br>   
                                        <input type="number" wire:model="productsQuantities.{{$product['id']}}"
                                        value="{{ $product['quantite'] }}"
                                         step="0.01"
                                       
                                        >
                                    </td>
                                        <td> {{ $product['price'] ?? "" }}  <br>   
                                        <input type="number" wire:model="productsProductsPrices.{{$product['id']}}"
                                        value="{{ $product['price'] }}"
                                        step="0.01"
                                        >
                                        </td>
                                        <td> {{ getPrice($product['item_price_nvat'] ?? "")  }} <br>
                                        {{getPrice( $productsQuantities[$product['id']] * $productsProductsPrices[$product['id']])  }}

                                        </td>
                                        <td>
                                            <input type="checkbox" 
                                                   wire:model="selectedProducts" 
                                                   value="{{ $product['id'] ?? "" }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                       </table> 
                    </div>

                    <!-- <div class="mt-4 form-group">
                        <label>Montant de l'avoir</label>
                        <input type="number" 
                               class="form-control" 
                               wire:model="montantAvoir"
                               step="0.01"
                               max="{{ $originalFacture->amount }}">
                        @error('montantAvoir') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> -->

                    <div class="form-group">
                        <label>Motif de l'avoir</label>
                        <textarea class="form-control" 
                                 wire:model="motifAvoir"
                                 rows="3"></textarea>
                        @error('motifAvoir') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button class="mt-3 btn btn-primary" 
                            wire:click="createAvoir"
                            wire:loading.attr="disabled">
                        <span wire:loading wire:target="createAvoir">
                            Création en cours...
                        </span>
                        <span wire:loading.remove>
                            Créer la facture d'avoir
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>