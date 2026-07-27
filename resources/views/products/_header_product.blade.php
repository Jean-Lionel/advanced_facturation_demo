<nav class="app-tabs noprint" aria-label="Navigation stock">
    <a href="{{ route('products.create') }}" class="{{ setActiveRoute('products.create') }}">
        <span class="fa fa-plus-square"></span> Entré
    </a>
    <a href="{{ route('products.imports') }}" class="{{ setActiveRoute('products.imports') }}">
        <span class="fa fa-file-import"></span> Importation
    </a>
    <a href="{{ route('retour_produit') }}" class="{{ setActiveRoute('retour_produit') }}">
        <span class="fa fa-undo"></span> Retour
    </a>
    <a href="{{ route('categories.index') }}" class="{{ setActiveRoute('categories.*') }}">
        <span class="fa fa-tags"></span> Category
    </a>
    <a href="{{ route('fiche_stock') }}" class="{{ setActiveRoute('fiche_stock') }}">
        <span class="fa fa-clipboard-list"></span> Fiche de Stock
    </a>
    <a href="{{ route('journal_history') }}" class="{{ setActiveRoute('journal_history') }}">
        <span class="fa fa-history"></span> Historique entrées
    </a>
    <a href="{{ route('mouvement_stock') }}" class="{{ setActiveRoute('mouvement_stock') }}">
        <span class="fa fa-exchange-alt"></span> Mouvement
    </a>
    @if(env('APP_CAN_USE_MULTI_STOCK', false))
        @can('is-admin')
            <a href="{{ route('stockes.index') }}" class="{{ setActiveRoute('stockes.*') }}">
                <span class="fa fa-bookmark"></span> Stocks
            </a>
        @endcan
    @endif
    <a href="{{ route('bar_code') }}" class="{{ setActiveRoute('bar_code') }}">
        <span class="fa fa-barcode"></span> Bar Code
    </a>
</nav>
