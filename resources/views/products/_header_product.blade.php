<div class="d-flex justify-content-around noprint">
    <div>
    <a href="{{ route('products.create') }}"><span class="fa fa-seedling"></span> Entre</a>
    </div>
    <div>
    <a href="{{ route('retour_produit') }}"><span class="fa fa-undo"></span> Retour des marchandises</a>
    </div>
    <div><a href="{{ route('categories.index') }}"><span class="fa fa-paper-plane"></span> Category</a></div>

    <div>
        <a href="{{ route('fiche_stock') }}">
            <span class="fa fa-file-alt"></span>
            <span>Fiche de Stock</span>
        </a>
    </div>

    <div>
        <a href="{{ route('journal_history') }}">
            <span class="fa fa-file-archive"></span>
            <span>Historique des Entres en stock</span>
        </a>
    </div>

    <div>
        <a href="{{ route('mouvement_stock') }}">
            <span class="fa fa-file-archive"></span>
            <span>Mouvement de stock</span>
        </a>
    </div>

    <div>
        <a href="{{ route('bar_code') }}">
            <span class="fa fa-barcode "></span>
            <span>Bar Code</span>
        </a>
    </div>
</div>
<hr>
