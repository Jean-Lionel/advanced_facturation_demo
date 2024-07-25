<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div wire:loading>
          @livewire('loading.checkout')
        </div>
    </div>
    <div>
       
       
        <div class="row">
          
    
            <div class="col-md-8">
                <div class="col-md-12">
                    <p>Maison à Payé </p>
                    <input type="text" placeholder="DISIGNATION" wire:model="houseNumber" class="form-controler">
                </div>
                @if ($maisonLocations)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Maison</th>
                            <th>Montant Mensuel (HTVA)</th>
                            <th>TVA</th>
                            <th>Montant Mensuel (TTC)</th>
                            <th>Client</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maisonLocations as $item)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ getPrice($item->montant) }}</td>
                            <td>{{ getPrice($item->tax) }}</td>
                            <td>{{ $item->priceTTC }}</td>
                            <td>
                                <ol>
                                    @foreach ($item->clients as $el)
                                    <li>{{ $el->name }} &nbsp; &nbsp; PHONE : {{$el->telephone  }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="payMensuel({{ $item->id }})">Payer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="col-4">
                @if ($displayPayment)
                <div>
                    <h4>Paiment de {{ $maison->name  }}</h4>
                    <p>
                        <ul class="d-flex justify-between gap-3 flex-wrap">
                            @foreach ($maison->clients as $el2)
                            <li class="badge-info m-2 p-2">{{ $el2->name }} &nbsp; &nbsp; PHONE : {{$el2->telephone  }}</li>
                            @endforeach
                        </ul>
                    </p>
                </div>
                <div>
                    <div class="mb-3">
                        <label for="" class="form-label">Date de Paiement</label>
                        <input
                        type="date"
                        class="form-control"
                        placeholder=""
                        wire:model="payementDate"
                        aria-describedby="helpId"
                        />
                        @error('payementDate')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                        
                    </div>
                    
                    <div>
                        <label for="" class="form-label">Periode de Paiement</label>
                        
                        <select name="" id="" wire:model="periodePaymentValue" class="form-control">
                            <option value=""></option>
                            @foreach ($periodesPayments as $item)
                            <option value="{{ $item->id }}">{{ $item->month }} / {{ $item->year }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Montant</label>
                        <input
                        type="number"
                        class="form-control"
                        wire:model="montant"
                        aria-describedby="helpId"
                        placeholder=""
                        />
                        @error('montant')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Déscription</label>
                        <textarea wire:model="description"  class="form-control"></textarea>
                        @error('description')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Type de paiment</label>
                        <select wire:model="typePaiement" id="" class="form-control">
                            <option value=""></option>
                            @foreach (TYPE_PAYMENT as $key => $v)
                            <option value="{{ $key }}">{{ $v }}</option> 
                            @endforeach
                        </select>
                        @error('typePaiement')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" wire:click="savePayment">Enregistrer </button>
                    </div>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
