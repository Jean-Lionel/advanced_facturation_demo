<link rel="stylesheet" href="{{ asset('css/ventes.css') }}">

<nav class="vente-tabs noprint" aria-label="Navigation vente">
    <a href="{{ route('ventes.index') }}"
       class="vente-tab {{ request()->routeIs('ventes.index') ? 'is-active' : '' }}">
        <i class="fas fa-box-open"></i>
        <span>Vente produits</span>
    </a>
    <a href="{{ route('ventes.create') }}"
       class="vente-tab {{ request()->routeIs('ventes.create') ? 'is-active' : '' }}">
        <i class="fas fa-file-invoice"></i>
        <span>Services</span>
    </a>
    <a href="{{ route('facture.avoir') }}"
       class="vente-tab {{ request()->routeIs('facture.avoir') ? 'is-active' : '' }}">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Facture d'avoir</span>
    </a>
    <a href="{{ route('facture.remboursement_caution') }}"
       class="vente-tab {{ request()->routeIs('facture.remboursement_caution') ? 'is-active' : '' }}">
        <i class="fas fa-hand-holding-usd"></i>
        <span>Caution</span>
    </a>
    <a href="{{ route('panier.index') }}"
       class="vente-tab {{ request()->routeIs('panier.*') ? 'is-active' : '' }}">
        <i class="fas fa-shopping-cart"></i>
        <span>Panier</span>
    </a>
</nav>
