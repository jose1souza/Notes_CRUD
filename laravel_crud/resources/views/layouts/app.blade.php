<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #2d6cdf;
            --primary-strong: #1f4cb8;
            --secondary: #5f6e84;
            --surface: #ffffff;
            --surface-strong: #f5f7fb;
            --success: #2f9d56;
            --warning: #ef9b0f;
            --danger: #d64545;
            --info: #3c7ad8;
            --border: #d8e1eb;
            --text: #1f2937;
            --muted: #57606a;
            --radius: 16px;
            --space: 1rem;
            --font-body: 'Nunito', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        body {
            font-family: var(--font-body);
            background: #eff4fb;
            color: var(--text);
            min-height: 100vh;
        }

        .brand {
            font-weight: 700;
            letter-spacing: -.03em;
        }

        .surface-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
        }

        .grid-gap { gap: 1.5rem; }

        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 12px;
            background: rgba(45, 108, 223, 0.12);
            color: var(--primary-strong);
            font-size: 1rem;
        }

        .alert-card {
            border-radius: 1rem;
            padding: 1rem 1.2rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(45, 108, 223, 0.18);
        }

        /* Estados de validação */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--danger);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(1em + 0.375rem) calc(1em + 0.375rem);
            padding-right: calc(1.5em + 0.75rem);
        }

        .form-control.is-valid,
        .form-select.is-valid {
            border-color: var(--success);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(1em + 0.375rem) calc(1em + 0.375rem);
            padding-right: calc(1.5em + 0.75rem);
        }

        .invalid-feedback {
            display: block;
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .btn-brand {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-brand:hover,
        .btn-brand:focus {
            background-color: var(--primary-strong);
            border-color: var(--primary-strong);
        }

        .page-header {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.75rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .status-pill.pending { background: #fff4e6; color: #b45309; }
        .status-pill.completed { background: #dcfce7; color: #166534; }

        .input-group .form-select,
        .input-group .form-control {
            min-height: calc(2.5rem + 2px);
        }

        .card-compact {
            border: 1px solid var(--border);
            border-radius: 1.25rem;
        }

        .small-note {
            color: var(--muted);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('academic-years.index') }}">Ano Letivo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('disciplines.index') }}">Disciplina</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('notebooks.index') }}">Caderno</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Tarefa</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm ms-2" type="submit">Sair</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Cadastrar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @include('partials.alerts')
        @yield('content')
    </main>

    <footer class="mt-5 py-4 text-center text-muted small">
        <div class="container">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</div>
    </footer>
</body>
</html>
