<!doctype html>
<html lang="en">
<head>
    <title>{{ auth()->user()->company()->tp_name ?? "" }}</title>
    <meta charset="utf-8">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#5c3fd8">
    <meta name="theme-color" content="#5c3fd8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/css/all.css')  }}" defer="defer">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-shell.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    @livewireStyles
    @stack('styles')
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto 2cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        @media print {
            .noprint {
                display: none !important;
            }
            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
        .formTableHead {
            overflow-y: auto;
            height: 80vh;

            thead th {
                position: sticky;
                top: 0;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th,
            td {
                border: 1px solid #529432;
            }
            th {
                background: #ABDD93;
            }
        }
    </style>

</head>
<body>

    <div class="wrapper d-flex align-items-stretch app-shell" id="appShell">
        <div class="app-sidebar-overlay noprint" id="sidebarOverlay" aria-hidden="true"></div>

        <nav id="sidebar" class="app-sidebar noprint" aria-label="Menu principal">
            <ul class="mb-0 list-unstyled components app-sidebar-nav">

                {{-- Ventes - Accessible par VENTE et ADMIN --}}
                @canany(['is-vente', 'is-admin'])
                    <li>
                        <a href="{{ route('ventes.index') }}" class="{{ setActiveRoute('ventes.*') }}">
                            <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="nav-label">Vente</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('clients.index') }}" class="{{ setActiveRoute('clients.*') }}">
                            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                            <span class="nav-label">Client</span>
                        </a>
                    </li>
                @endcanany

                {{-- Stock - Accessible par ENTRE_PRODUITS, CONTROLLEUR et ADMIN --}}
                @canany(['is-entre-stock', 'is-controleur', 'is-admin'])
                    <li>
                        <a href="{{ route('products.index') }}" class="{{ setActiveRoute('products.*') }}">
                            <i class="nav-icon fa fa-sticky-note" aria-hidden="true"></i>
                            <span class="nav-label">Stock</span>
                        </a>
                    </li>
                @endcanany

                {{-- Journal - Accessible par CONTROLLEUR, ENTRE_PRODUITS et ADMIN --}}
                @canany(['is-controleur', 'is-entre-stock','is-journal', 'is-admin'])
                    <li>
                        <a href="{{ route('stockes.journal') }}" class="{{ setActiveRoute('stockes.*') }}">
                            <i class="nav-icon fa fa-calendar" aria-hidden="true"></i>
                            <span class="nav-label">Journal</span>
                        </a>
                    </li>
                @endcanany

                {{-- Rapports - Accessible par COMPTABLE, CONTROLLEUR et ADMIN --}}
                @canany(['is-comptable', 'is-controleur', 'is-admin'])
                    <li>
                        <a href="{{ route('rapport') }}" class="{{ setActiveRoute('rapport') }}">
                            <i class="nav-icon fa fa-chart-bar" aria-hidden="true"></i>
                            <span class="nav-label">Rapport</span>
                        </a>
                    </li>
                @endcanany

                {{-- Finances - Accessible par COMPTABLE et ADMIN --}}
                @canany(['is-comptable', 'is-admin'])
                    <li>
                        <a href="{{ route('depenses.index') }}" class="{{ setActiveRoute('depenses.*') }}">
                            <i class="nav-icon fa fa-minus" aria-hidden="true"></i>
                            <span class="nav-label">Depense</span>
                        </a>
                    </li>

                    @if (env('APP_USE_VERSEMENT', false))
                        <li>
                            <a href="{{ route('versement.index') }}" class="{{ setActiveRoute('versement.*') }}">
                                <i class="nav-icon fa fa-money-bill-wave" aria-hidden="true"></i>
                                <span class="nav-label">Versements</span>
                            </a>
                        </li>
                    @endif

                    @if (env('APP_USE_ABONEMENT', false))
                        <li>
                            <a href="{{ route('comptes.index') }}" class="{{ setActiveRoute('comptes.*') }}">
                                <i class="nav-icon fa fa-hand-holding-usd" aria-hidden="true"></i>
                                <span class="nav-label">Abonement</span>
                            </a>
                        </li>
                    @endif
                @endcanany

                {{-- Administration - ADMIN uniquement --}}
                @can('is-admin')
                    {{-- Location menu temporarily hidden
                    @if (env('APP_USE_LOCATION', false))
                        <li>
                            <a href="{{ route('maison-location.index') }}" class="{{ setActiveRoute('maison-location.*') }}">
                                <i class="nav-icon fa fa-cubes" aria-hidden="true"></i>
                                <span class="nav-label">Location</span>
                            </a>
                        </li>
                    @endif
                    --}}

                    <li>
                        <a href="{{ route('entreprises.index') }}" class="{{ setActiveRoute('entreprises.*') }}">
                            <i class="nav-icon fa fa-building" aria-hidden="true"></i>
                            <span class="nav-label">Entreprise</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('users.index') }}" class="{{ setActiveRoute('users.*') }}">
                            <i class="nav-icon fas fa-cogs" aria-hidden="true"></i>
                            <span class="nav-label">Système</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>

        <div id="status" class="app-connection-status noprint"></div>

        <div id="content" class="app-main">
            <header class="app-topbar noprint">
                <div class="app-topbar-left">
                    <button type="button" id="sidebarCollapse" class="app-icon-btn" aria-label="Ouvrir ou fermer le menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="app-topbar-title">
                        <img
                            src="{{ asset('img/'. env('USE_LOGO_NAME', 'logo.jpg')) }}"
                            class="app-topbar-logo"
                            alt="Logo"
                        >
                        <h1 class="text-uppercase">{{ auth()->user()->company()->tp_name ?? "" }}</h1>
                    </div>
                </div>

                <div class="app-topbar-actions">
                    <div class="app-user">
                        <span class="app-user-avatar" aria-hidden="true">
                            <i class="fas fa-user"></i>
                        </span>
                        <p class="app-user-name">{{ Auth::user()->name }}</p>
                    </div>

                    <a href="{{ route('panier.index') }}" class="app-cart-btn" title="Panier">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="app-cart-label">Panier</span>
                        <span class="app-cart-badge">{{ Cart::count() }}</span>
                    </a>

                    <form action="{{ route('logout.clear.cache') }}" method="post" class="mb-0">
                        @csrf
                        <button type="submit" class="app-logout-btn" title="Se déconnecter">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </header>

            <div class="app-content container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show app-alert" role="alert">
                        <strong>Succès</strong> — {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show app-alert" role="alert">
                        <strong>Erreur</strong> — {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="contenu_principal">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.5.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/chart.js.2.9.4_Chart.min.js') }}"></script>
    <script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    @livewireScripts
    <x-livewire-alert::scripts />
    <script>
        (function ($) {
            if (!$.fn.dataTable) return;

            $.extend(true, $.fn.dataTable.Defaults, {
                language: {
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ éléments",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    },
                    zeroRecords: "Aucun résultat",
                    emptyTable: "Aucune donnée disponible"
                }
            });

            if ($.fn.dataTable.Buttons) {
                $.extend(true, $.fn.dataTable.Buttons.defaults, {
                    dom: {
                        container: {
                            className: 'dt-buttons'
                        },
                        button: {
                            tag: 'button',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        collection: {
                            tag: 'div',
                            className: 'dt-button-collection dropdown-menu'
                        }
                    }
                });
            }
        })(jQuery);
    </script>
    @yield('javascript')
    <script>
        const canSyncronize = @json( CAN_SYNCRONISE );
        const timeSyncronisation = @json( TIME_OUT_SYNCRONISATION );
        const cancel_syncronize = "{{ session('cancel_syncronize') }}";
        let lastOnlineStatus = localStorage.getItem("lastOnlineStatus") === null ? null : JSON.parse(localStorage.getItem("lastOnlineStatus"));
        let lastOnlineStatusUpdate = localStorage.getItem("lastOnlineStatusUpdate") === null ? 0 : JSON.parse(localStorage.getItem("lastOnlineStatusUpdate"));
        const checkOnlineStatus = async () => {
            const now = Date.now();
            if (now - lastOnlineStatusUpdate < 300000) {
                return lastOnlineStatus;
            }
            try {
                const online = await fetch("https://jsonplaceholder.typicode.com/todos/1");
                const result = online.status >= 200 && online.status < 300;
                localStorage.setItem("lastOnlineStatus", JSON.stringify(result));
                localStorage.setItem("lastOnlineStatusUpdate", JSON.stringify(now));
                lastOnlineStatus = result;
                lastOnlineStatusUpdate = now;
                return result;
            } catch (err) {
                localStorage.setItem("lastOnlineStatus", JSON.stringify(false));
                localStorage.setItem("lastOnlineStatusUpdate", JSON.stringify(now));
                return false;
            }
        };
        const updateInternetStatus = async () => {
            const result = await checkOnlineStatus();
            const statusDisplay = document.getElementById("status");
            if (!statusDisplay) {
                return result;
            }
            statusDisplay.innerHTML = result
                ? `<span class="status is-online">CONNECTED</span>`
                : `<span class="status">NOT CONNECTED</span>`;
            return result;
        }

        if(canSyncronize && !cancel_syncronize){
            let  limitedInterval =  setInterval(async () => {
                const result = await updateInternetStatus();
                    console.log(result);
                if(result){
                    clearInterval(limitedInterval);
                    $.ajax({
                        url: "{{ url('syncronize_to_obr') }}",
                        type: "GET",
                    }).done(function(data){
                        console.log(data);
                        if(!data.data){
                            clearInterval(limitedInterval);
                            console.log('interval cleared! Pas de donnees recu');
                        }
                    }).fail(function(error){
                        console.log("An error has occurred. => " , error);
                        clearInterval(limitedInterval);
                    }).always(function(){
                        console.log("Complete.");
                    });
                }else{
                    clearInterval(limitedInterval);
                    console.log('interval cleared!');
                }
            }, timeSyncronisation);
        }
    </script>

</body>
</html>
