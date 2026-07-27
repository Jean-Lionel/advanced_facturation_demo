<nav class="app-tabs noprint" aria-label="Navigation journal">
    @if (env('APP_USE_VERSEMENT', false))
        <a href="{{ route('rapport.resultats') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-list"></i> Resultats des ventes
        </a>
        <a href="{{ route('rapport_boutique') }}" class="{{ setActiveRoute('rapport_boutique') }}">
            <span class="fa fa-box"></span> Rapport Boutique
        </a>
    @endif
    <a href="{{ route('stocks.controls') }}" class="{{ setActiveRoute('stocks.controls') }}">
        <span class="fa fa-box"></span> Control des stocks
    </a>
    <a href="{{ route('facture.credit') }}" class="{{ setActiveRoute('facture.credit') }}">
        <span class="fa fa-file"></span> Facture à Crédit
    </a>
    <a href="{{ route('impression_multiple') }}" class="{{ setActiveRoute('impression_multiple') }}">
        <span class="fa fa-file"></span> Impression multiple
    </a>
    <a href="{{ route('journal_sort_history') }}" class="{{ setActiveRoute('journal_sort_history') }}">
        <span class="fa fa-file-archive"></span> Historique facture
    </a>
    <a href="{{ route('proformats.index') }}" class="{{ setActiveRoute('proformats') }}">
        <span class="fa fa-briefcase"></span> Proformat
    </a>
    <a href="{{ route('facture.search') }}" class="{{ setActiveRoute('facture.search') }}">
        <span class="fa fa-search"></span> Recherche factures
    </a>
    <button type="button" class="app-tab noprint" onclick="window.print()">
        <i class="fa fa-print"></i> Imprimer
    </button>
</nav>
