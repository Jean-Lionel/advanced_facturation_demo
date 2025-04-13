<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Advanced IT - Backend')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .navbar {
            background-color: #003366; /* Couleur foncée du logo */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: #ffffff !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #66ccff; /* bleu clair */
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background-color: #66ccff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-toggler {
            border: none;
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                Advanced IT
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('advanced.organisations.index') }}"><i class="fas fa-building me-2"></i>Organisations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('advanced.members.index') }}"><i class="fas fa-users me-2"></i>Membres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-exchange-alt me-2"></i>Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-list-alt me-2"></i>Types de transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-file-upload me-2"></i>Fichiers</a>
                    </li>
                </ul>

                <!-- Dropdown User -->
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-white"
                       href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="d-none d-lg-block">
                            <div class="fw-medium">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                            <div class="small text-muted">Admin</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
