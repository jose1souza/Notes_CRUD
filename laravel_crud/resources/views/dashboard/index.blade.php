@extends('layouts.app')

@section('content')
<div class="page-header mb-5">
    <div>
        <h1 class="fw-bold mb-2">Bem-vindo, {{ auth()->user()->name }}</h1>
        <p class="text-muted">Organize seus anos letivos, disciplinas, cadernos e tarefas em um só lugar.</p>
    </div>
    <a href="{{ route('academic-years.create') }}" class="btn btn-brand">Novo ano letivo</a>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <a href="{{ route('academic-years.index') }}" class="text-decoration-none text-reset">
            <div class="surface-card p-4 h-100">
                <h2 class="h5 mb-2">Anos letivos</h2>
                <p class="display-6 fw-bold">{{ $academicYears->count() }}</p>
                <p class="text-muted">Criados até o momento</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('disciplines.index') }}" class="text-decoration-none text-reset">
            <div class="surface-card p-4 h-100">
                <h2 class="h5 mb-2">Disciplinas</h2>
                <p class="display-6 fw-bold">{{ $disciplines->count() }}</p>
                <p class="text-muted">Cadastradas na sua conta</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('tasks.index') }}" class="text-decoration-none text-reset">
            <div class="surface-card p-4 h-100">
                <h2 class="h5 mb-2">Tarefas pendentes</h2>
                <p class="display-6 fw-bold">{{ $pendingTasks->count() }}</p>
                <p class="text-muted">Ainda não concluídas</p>
            </div>
        </a>
    </div>
</div>

@if($academicYears->isEmpty())
    <div class="surface-card p-5 text-center mb-5">
        <h2 class="h4 mb-3">Nenhum ano letivo</h2>
        <p class="text-muted mb-4">Crie seu primeiro período acadêmico para cadastrar disciplinas e tarefas.</p>
        <a href="{{ route('academic-years.create') }}" class="btn btn-brand">Criar ano letivo</a>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-7">
        <div class="surface-card p-4 mb-4">
            <h2 class="h5 mb-3">Disciplinas recentes</h2>
            @if($disciplines->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted mb-3">Nenhuma disciplina criada ainda.</p>
                    <a href="{{ route('disciplines.create') }}" class="btn btn-brand">Nova disciplina</a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($disciplines as $discipline)
                        <div class="col">
                            <a href="{{ route('disciplines.show', $discipline) }}" class="text-decoration-none text-reset">
                                <div class="card card-compact p-3 h-100">
                                    <h3 class="h6 fw-bold mb-1">{{ $discipline->title }}</h3>
                                    <p class="text-muted mb-2">{{ $discipline->description ?: 'Sem descrição' }}</p>
                                    <span class="badge bg-light text-dark">{{ $discipline->academicYear->title ?? 'Sem ano' }}</span>
                                    <span class="small text-muted">{{ $discipline->notebooks_count }} cadernos</span>
                                    <div class="mt-2">
                                        <span class="status-pill {{ $discipline->tasks_count ? 'completed' : 'pending' }}">
                                            {{ $discipline->tasks_count }} tarefas
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-5">
        <div class="surface-card p-4 mb-4">
            <h2 class="h5 mb-3">Tarefas pendentes</h2>
            @if($pendingTasks->isEmpty())
                <p class="text-muted text-center py-5">Nenhuma tarefa pendente. Ótimo trabalho!</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($pendingTasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none text-reset fw-bold">
                                    {{ $task->title }}
                                </a>
                                <div class="small text-muted">{{ $task->discipline->title }} • {{ $task->due_date->format('d/m/Y H:i') }}</div>
                            </div>
                            <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">Marcar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
