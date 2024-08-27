<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

        <div class="row">
            <div class="mb-3 col-5">
                <label for="" class="form-label">Name</label>
                <input
                    type="text"
                    wire:model="name"
                    value="{{  $maisonLocation->name }}"
                    class="form-control"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('name')
                <small id="helpId" class="text-muted text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <div class="mb-3 col-5">
                <label for="" class="form-label">Montant</label>
                <input
                    type="number"
                    wire:model="montant"
                    value="{{  $maisonLocation->montant }}"
                    class="form-control"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('montant')
                <small id="helpId" class="text-muted text-danger">{{ $message }}</small>
                @enderror
                
            </div>
            <div class="mb-3 col-5">
                <label for="" class="form-label">TVA</label>
                <select  wire:model="tax" id="" class="form-control">
                    @foreach (TAUX_TVA as $taux)
                    <option value="{{  $taux }}" @if ($maisonLocation->tax == $taux)
                        selected
                    @endif>{{ $taux }}</option>
                    @endforeach
                </select>
                </select>
            </div>
            <div class="col-5">
                <label for="">  Déscription</label>
                <textarea  wire:model="description" class="form-control" id="">{{  $maisonLocation->description }}</textarea>
            </div>
        </div>
    
        <div>
            <button wire:click="savePriceClick"  class="btn btn-primary">Modifier</button>
        </div>
        
    
</div>
