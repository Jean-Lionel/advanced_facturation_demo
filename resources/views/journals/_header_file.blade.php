@if (env('APP_USE_ABONEMENT', false))
<nav class="app-tabs noprint" aria-label="Navigation rapports">
    <a href="{{ route('rapport_detail') }}" class="{{ setActiveRoute('rapport_detail') }}">
        <span class="fas fa-file-invoice"></span> Rapport détail
    </a>
    <a href="{{ route('partage_interet') }}" class="{{ setActiveRoute('partage_interet') }}">
        <span class="fas fa-bezier-curve"></span> Partage des intérêts
    </a>
    <a href="{{ route('rapport_revenue') }}" class="{{ setActiveRoute('rapport_revenue') }}">
        <span class="fas fa-file-invoice"></span> Revenus journaliers
    </a>
</nav>
@endif
