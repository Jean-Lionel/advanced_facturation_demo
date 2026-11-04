@include('partials._subnav_style')
<nav class="app-subnav d-flex align-items-center flex-wrap noprint" aria-label="Menu stock">
    <span class="app-subnav-title"><i class="fas fa-boxes"></i> Stock</span>
    <ul class="nav">
        {{-- Entrées --}}
        <li class="nav-item"><a href="{{ route('products.create') }}" class="nav-link {{ setActiveRoute('products.create') }}"><i class="fas fa-plus-circle"></i>Entrée</a></li>
        <li class="nav-item"><a href="{{ route('products.imports') }}" class="nav-link {{ setActiveRoute('products.imports') }}"><i class="fas fa-truck-loading"></i>Importation</a></li>
        <li class="nav-item"><a href="{{ route('retour_produit') }}" class="nav-link {{ setActiveRoute('retour_produit') }}"><i class="fas fa-undo"></i>Retours</a></li>
        <li class="app-subnav-sep" aria-hidden="true"></li>

        {{-- Suivi --}}
        <li class="nav-item"><a href="{{ route('fiche_stock') }}" class="nav-link {{ setActiveRoute('fiche_stock') }}"><i class="fas fa-clipboard-list"></i>Fiche de stock</a></li>
        <li class="nav-item"><a href="{{ route('historique_entre_sortie') }}" class="nav-link {{ setActiveRoute('historique_entre_sortie') }}"><i class="fas fa-exchange-alt"></i>Entrées / Sorties</a></li>
        <li class="nav-item"><a href="{{ route('journal_history') }}" class="nav-link {{ setActiveRoute('journal_history') }}"><i class="fas fa-history"></i>Historique des entrées</a></li>
        <li class="nav-item"><a href="{{ route('mouvement_stock') }}" class="nav-link {{ setActiveRoute('mouvement_stock') }}"><i class="fas fa-random"></i>Mouvements</a></li>
        @if(env('APP_CAN_USE_MULTI_STOCK', false))
            @can('is-admin')
                <li class="nav-item"><a href="{{ route('stockes.index') }}" class="nav-link {{ setActiveRoute(['stockes.index', 'stockes.create', 'stockes.edit', 'stockes.show']) }}"><i class="fas fa-warehouse"></i>Liste des stocks</a></li>
            @endcan
        @endif
        <li class="app-subnav-sep" aria-hidden="true"></li>

        {{-- Catalogue & outils --}}
        <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link {{ setActiveRoute('categories.*') }}"><i class="fas fa-tags"></i>Catégories</a></li>
        <li class="nav-item"><a href="{{ route('bar_code') }}" class="nav-link {{ setActiveRoute('bar_code') }}"><i class="fas fa-barcode"></i>Codes-barres</a></li>
        <li class="nav-item"><a href="{{ route('bon_commande') }}" class="nav-link {{ setActiveRoute('bon_commande') }}"><i class="fas fa-file-invoice"></i>Bon de commande</a></li>
        <li class="nav-item"><a href="{{ route('import_data_show') }}" class="nav-link {{ setActiveRoute('import_data_show') }}"><i class="fas fa-file-excel"></i>Import Excel</a></li>
    </ul>
</nav>
