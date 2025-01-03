<div class="d-flex justify-content-around noprint">
    <div>
    <a href="{{ route('products.create') }}" class="{{ setActiveRoute('products.create') }}"><span class="fa fa-seedling"></span> Entré</a>
    </div>
    <div>
    <a href="{{ route('retour_produit') }}" class="{{ setActiveRoute('retour_produit') }}"><span class="fa fa-undo"></span> Retour des marchandises</a>
    </div>
    <div><a href="{{ route('categories.index') }}" class="{{ setActiveRoute('categories.*') }}"><span class="fa fa-paper-plane"></span> Category</a></div>

    <div>
        <a href="{{ route('fiche_stock') }}" class="{{ setActiveRoute('fiche_stock') }}">
            <span class="fa fa-file-alt"></span>
            <span>Fiche de Stock</span>
        </a>
    </div>

    <div>
        <a href="{{ route('journal_history') }}" class="{{ setActiveRoute('journal_history') }}">
            <span class="fa fa-file-archive"></span>
            <span>Historique des Entres en stock</span>
        </a>
    </div>

    <div>
        <a href="{{ route('mouvement_stock') }}" class="{{ setActiveRoute('mouvement_stock') }}">
            <span class="fa fa-file-archive"></span>
            <span>Mouvement de stock</span>
        </a>
    </div>
{{--
    <div>
        <a href="{{ route('stockes.index') }}" class="{{ setActiveRoute('stockes.*') }}">
            <span class="fas fa fa-bookmark"></span>
            <span>Liste des stocks</span>
        </a>
    </div>
    <div>
        <a href="{{ route('product_stock.index') }}" class="{{ setActiveRoute('product_stock.*') }}">
            <span class="fas fa fa-exchange-alt"></span>
            <span>Liste des stocks</span>
        </a>
    </div>  --}}
    <div>
        <a href="{{ route('bar_code') }}" class="{{ setActiveRoute('bar_code') }}">
            <span class="fa fa-barcode "></span>
            <span>Bar Code</span>
        </a>
    </div>
    <div>
        <a href="{{ route('bon_commande') }}" class="{{ setActiveRoute('bon_commande') }}">
            <span class="fas fa-file-invoice"></span>
            <span>Bon de Commande</span>
        </a>
    </div>
</div>
<hr>
