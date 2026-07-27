<nav class="app-tabs noprint" aria-label="Navigation entreprise">
    <a href="{{ route('entreprises.index') }}" class="{{ setActiveRoute('entreprises.*') }}">
        <span class="fa fa-comments-dollar"></span> Entreprise
    </a>
    <a href="{{ route('obr_declarations.index') }}" class="{{ setActiveRoute('obr_declarations.*') }}">
        <span class="fa fa-file-invoice"></span> Déclaration OBR
    </a>
    <a href="{{ route('obr_declarations_hostory') }}" class="{{ setActiveRoute('obr_declarations_hostory') }}">
        <span class="fa fa-history"></span> Historique OBR
    </a>
    <a href="{{ route('obr_log') }}" class="{{ setActiveRoute('obr_log') }}">
        <span class="fa fa-quidditch"></span> Réponses OBR
    </a>
    <a href="{{ route('backup_database') }}">
        <span class="fas fa-archive"></span> Backup
    </a>
</nav>
