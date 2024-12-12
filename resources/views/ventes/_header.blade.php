<div>
    <div class="row">
        <div class="col-md-4 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('ventes.create') ? 'active' : '' }}">
                <a href="{{ route('ventes.create') }}">Facturation des Services</a>
            </h4>
        </div>
        <div class="col-md-4 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('facture.avoir') ? 'active' : '' }}">
                <a href="{{ route('facture.avoir') }}">Facture d'Avoir</a>
            </h4>
        </div>
        <div class="col-md-4 d-flex justify-content-between">
            <h4 class="text-center {{ request()->routeIs('facture.remboursement_caution') ? 'active' : '' }}">
                <a href="{{ route('facture.remboursement_caution') }}">Facture d'Avoir</a>
            </h4>
        </div>
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