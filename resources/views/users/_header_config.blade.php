<nav class="app-tabs noprint" aria-label="Configuration système">
    <a href="{{ route('users.index') }}" class="{{ setActiveRoute('users.*') }}">
        <span class="fa fa-users"></span> Utilisateurs
    </a>
    <a href="{{ route('clear_cache') }}" class="{{ request()->routeIs('clear_cache') ? 'is-active' : '' }}">
        <span class="fa fa-sync"></span> Clear Cache
    </a>
    <a href="{{ route('syncronize_customer') }}" class="{{ request()->routeIs('syncronize_customer') ? 'is-active' : '' }}">
        <span class="fa fa-database"></span> Clear Storage
    </a>
    <a href="{{ route('import_data_show') }}" class="{{ request()->routeIs('import_data_show') ? 'is-active' : '' }}">
        <span class="fas fa-file-import"></span> Importation
    </a>
    <a href="{{ route('env_settings.index') }}" class="{{ request()->routeIs('env_settings.*') ? 'is-active' : '' }}">
        <span class="fa fa-cog"></span> Paramètres
    </a>
</nav>

@if (session('succes_message'))
    <div id="error-msg" class="alert alert-danger">
        {{ session('succes_message') }}
    </div>
@endif
