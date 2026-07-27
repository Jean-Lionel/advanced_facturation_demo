<nav class="app-tabs noprint" aria-label="Navigation location">
    <a href="{{ route('payment-location-mensuel.index') }}" class="{{ setActiveRoute('payment-location-mensuel.*') }}">
        Paiement de Location Mensuel
    </a>
    <a href="{{ route('historique-paiement.index') }}" class="{{ setActiveRoute('historique-paiement.*') }}">
        Historique de paiement
    </a>
    <a href="{{ route('clients_non_paye_loyers_all') }}" class="{{ setActiveRoute('clients_non_paye_loyers_all') }}">
        Les non payées par periode
    </a>
    <a href="{{ route('clients_half_paid') }}" class="{{ setActiveRoute('clients_half_paid') }}">
        Paiement partielle
    </a>
    <a href="{{ route('document_maison') }}" class="{{ setActiveRoute('document_maison') }}">
        Document Administrative
    </a>
</nav>
