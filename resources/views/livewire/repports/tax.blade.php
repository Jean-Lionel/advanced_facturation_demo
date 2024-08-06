<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
<div class="row">
    <div wire:loading>
        @livewire('loading.checkout')
      </div>
</div>

   <div class="d-flex gap-3">
    <span>DU</span>
    <input type="date" class="form-control  form-control-sm" wire:model="startDate">
    <span>Au</span>
    <input type="date" class="form-control form-control-sm" wire:model="endDate">
    <button class="btn btn-info btn-sm">
        Ok
    </button>
   </div>

   <div class="card">
    <p>Total du TVA Collect dans la periode {{ $startDate  }} Au {{ $endDate }}</p>
    <h2>{{ getPrice($amountTax ) }} #FBU</h2>

    <p class="d-flex justify-content-between gap-3">
        <span> Nombre Total des Factures</span>
        <span><b>{{ $totalFacture }}</b></span>
    </p>
   </div>
</div>
