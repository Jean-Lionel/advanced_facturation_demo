@include('partials._subnav_style')
<nav class="app-subnav d-flex align-items-center flex-wrap noprint" aria-label="Menu ventes">
    <span class="app-subnav-title"><i class="fas fa-receipt"></i> Ventes</span>
    <ul class="nav flex-grow-1">
        <li class="nav-item"><a href="{{ route('stockes.journal') }}" class="nav-link {{ setActiveRoute('stockes.journal') }}"><i class="fas fa-book"></i>Journal</a></li>
        <li class="nav-item"><a href="{{ route('facture.search') }}" class="nav-link {{ setActiveRoute('facture.search') }}"><i class="fas fa-search"></i>Rechercher une facture</a></li>
        <li class="nav-item"><a href="{{ route('journal_sort_history') }}" class="nav-link {{ setActiveRoute('journal_sort_history') }}"><i class="fas fa-history"></i>Historique des factures</a></li>
        <li class="nav-item"><a href="{{ route('facture.credit') }}" class="nav-link {{ setActiveRoute('facture.credit') }}"><i class="fas fa-hand-holding-usd"></i>Factures à crédit</a></li>
        <li class="nav-item"><a href="{{ route('canceledInvoince') }}" class="nav-link {{ setActiveRoute('canceledInvoince') }}"><i class="fas fa-ban"></i>Factures annulées</a></li>
        <li class="nav-item"><a href="{{ route('impression_multiple') }}" class="nav-link {{ setActiveRoute('impression_multiple') }}"><i class="fas fa-copy"></i>Impression multiple</a></li>
        <li class="nav-item"><a href="{{ route('proformats.index') }}" class="nav-link {{ setActiveRoute('proformats.*') }}"><i class="fas fa-file-signature"></i>Proformas</a></li>
        <li class="app-subnav-sep" aria-hidden="true"></li>
        <li class="nav-item"><a href="{{ route('stocks.controls') }}" class="nav-link {{ setActiveRoute('stocks.controls') }}"><i class="fas fa-tasks"></i>Contrôle des stocks</a></li>
        @if (env('APP_USE_VERSEMENT', false))
            <li class="nav-item"><a href="{{ route('rapport.resultats') }}" class="nav-link {{ setActiveRoute('rapport.resultats') }}"><i class="fas fa-chart-line"></i>Résultats des ventes</a></li>
            <li class="nav-item"><a href="{{ route('rapport_boutique') }}" class="nav-link {{ setActiveRoute('rapport_boutique') }}"><i class="fas fa-store"></i>Rapport boutique</a></li>
        @endif
    </ul>
    <button type="button" class="btn btn-outline-secondary btn-sm ml-auto my-1" onclick="window.print()">
        <i class="fas fa-print" aria-hidden="true"></i> Imprimer
    </button>
</nav>
