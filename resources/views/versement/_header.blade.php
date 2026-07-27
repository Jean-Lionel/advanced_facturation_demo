<nav class="app-tabs noprint" aria-label="Navigation versement">
    <a href="{{ route('versementType.index') }}">Types des versements</a>
    <a href="{{ route('versement.create') }}" class="{{ setActiveRoute('versement.create') }}">Nouveau versement</a>
    <a href="{{ route('versement.index') }}" class="{{ setActiveRoute('versement.index') }}">Liste des versements</a>
    <a href="{{ route('typeEmbalage.index') }}">Types d'embalages</a>
    <a href="{{ route('embalage.index') }}">Embalages</a>
    <a href="{{ route('embalage-mouvement.index') }}">Mouvements d'embalages</a>
    <a href="{{ route('rapport.resultats') }}">Resultats des ventes</a>
</nav>
