<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'PraticoSemana'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
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

        .grid-gap {
            gap: 1.5rem;
        }

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

        .text-contrast {
            color: #111827;
        }

        .alert-card {
            border-radius: 1rem;
            padding: 1rem 1.2rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(45, 108, 223, 0.18);
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
            <a class="navbar-brand brand" href="<?php echo e(route('dashboard')); ?>">PraticoSemana</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('academic-years.create')); ?>">Ano Letivo</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('disciplines.create')); ?>">Disciplina</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('notebooks.create')); ?>">Caderno</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('tasks.create')); ?>">Tarefa</a></li>
                        <li class="nav-item">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-outline-light btn-sm ms-2" type="submit">Sair</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Entrar</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Cadastrar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="mt-5 py-4 text-center text-muted small">
        <div class="container">Protótipo acadêmico responsivo com foco em organização de disciplinas, cadernos e tarefas.</div>
    </footer>
</body>
</html>
<?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/layouts/app.blade.php ENDPATH**/ ?>