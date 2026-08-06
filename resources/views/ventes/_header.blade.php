<link rel="stylesheet" href="{{ asset('css/ventes.css') }}">

<nav class="app-tabs noprint" aria-label="Navigation vente">
    <a href="{{ route('ventes.index') }}"
       class="{{ request()->routeIs(['ventes.index', 'home']) ? 'is-active' : '' }}">
        <span class="fas fa-box-open"></span> Vente produits
    </a>
    <a href="{{ route('ventes.create') }}"
       class="{{ request()->routeIs('ventes.create') ? 'is-active' : '' }}">
        <span class="fas fa-file-invoice"></span> Services
    </a>
    <a href="{{ route('facture.avoir') }}"
       class="{{ request()->routeIs('facture.avoir') ? 'is-active' : '' }}">
        <span class="fas fa-file-invoice-dollar"></span> Facture d'avoir
    </a>
    <a href="{{ route('facture.remboursement_caution') }}"
       class="{{ request()->routeIs('facture.remboursement_caution') ? 'is-active' : '' }}">
        <span class="fas fa-hand-holding-usd"></span> Caution
    </a>
    <a href="{{ route('panier.index') }}"
       class="{{ request()->routeIs('panier.*') ? 'is-active' : '' }}">
        <span class="fas fa-shopping-cart"></span> Panier
    </a>
</nav>
