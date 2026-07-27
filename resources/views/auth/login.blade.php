<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#5c3fd8">
    <title>{{ RAISON_ENTREPRISE_HEADER }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="{{ asset('login_folder/style.css') }}">
</head>
<body>
    <div class="login-page">
        <div class="login-bg" aria-hidden="true"></div>

        <main class="login-main">
            <header class="login-brand">
                <p class="login-brand-name">{{ RAISON_ENTREPRISE_HEADER }}</p>
                <p class="login-brand-tagline">Connectez-vous pour continuer</p>
            </header>

            <form class="login-card" method="POST" action="{{ route('login') }}" autocomplete="on">
                @csrf

                <div class="login-field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="votre@email.com"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="login-field">
                    <label for="password">Mot de passe</label>
                    <div class="login-password-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <button
                            type="button"
                            class="login-password-toggle"
                            id="toggle-password"
                            aria-label="Afficher le mot de passe"
                            aria-pressed="false"
                        >
                            <svg class="icon-show" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="icon-hide" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                                <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                <label class="login-remember">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Se souvenir de moi</span>
                </label>

            <button class="login-submit" type="submit">Se connecter</button>
            </form>
        </main>

        <footer class="login-footer">
            <i class="login-footer-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"></path>
                    <path d="M5 21V7l7-4 7 4v14"></path>
                    <path d="M9 21v-6h6v6"></path>
                    <path d="M9 10h.01M15 10h.01"></path>
                </svg>
            </i>
            <span class="login-footer-name">{{ curentEntrpiseName()->tp_name ?? '—' }}</span>
        </footer>
    </div>
    <script>
        (function () {
            var input = document.getElementById('password');
            var toggle = document.getElementById('toggle-password');
            if (!input || !toggle) return;

            toggle.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                toggle.classList.toggle('is-shown', show);
                toggle.setAttribute('aria-pressed', show ? 'true' : 'false');
                toggle.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
            });
        })();
    </script>
</body>
</html>
