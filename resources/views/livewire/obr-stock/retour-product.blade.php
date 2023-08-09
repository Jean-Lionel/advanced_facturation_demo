<div>
    {{-- The whole world belongs to you. --}}
    <div class="container">
        <div class="card">
            <div class="card-header">
                <input type="text" placeholder="Numéro du facture" wire:model='factureNumber'
                wire:keyup.enter='searchFacture'
                />
                <button wire:click='searchFacture'>Rechercher</button>
            </div>
            <div class="card-body">
                <h5 class="card-title">Title</h5>
                <p class="card-text">Content</p>
            </div>
        </div>
    </div>
</div>
