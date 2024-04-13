<div class="card">
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
            <a href="{{ route('clear_cache') }}" class=" {{ request()->routeIs('clear_cache') ? 'active' : '' }} ">clear Cache</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('syncronize_customer') }}" class=" {{ request()->routeIs('syncronize_customer') ? 'active' : '' }} ">clear Storage</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('import_data') }}" class=" {{ request()->routeIs('import_data') ? 'active' : '' }} ">Importation des données</a>
        </li>
    </ul>

    @if (session('succes_message'))
    <div id="error-msg" class=" mx-auto alert alert-danger text-danger fw-bold">
        {{ session('succes_message') }}
    </div>
    @endif

</div>
