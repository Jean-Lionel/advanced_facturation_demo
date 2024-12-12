<div>
    <div class="row">
        <div class="col-md-4 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('ventes.create') ? 'active' : '' }}">
           
                <a href="{{ route('ventes.create') }}">
                <i class="fas fa-file-invoice"></i> 
                    Facturation des Services</a>
            </h4>
        </div>
        <div class="col-md-6 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('facture.avoir') ? 'active' : '' }}">
                <a href="{{ route('facture.avoir') }}">
                <i class="fas fa-money-bill"></i>  Facture d'Avoir et Remboursement Caution</a>
            </h4>
        </div>
        <!-- <div class="col-md-4 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('facture.remboursement_caution') ? 'active' : '' }}">
                <a href="{{ route('facture.remboursement_caution') }}">Remboursement Caution</a>
            </h4>
        </div> -->
    </div>
</div>

{{-- Ajoutez ce CSS dans votre fichier de style --}}
<style>
    .active {
        font-weight: bold;
        color: #007bff;
    }
    .active a {
        color: inherit;
    }
</style>