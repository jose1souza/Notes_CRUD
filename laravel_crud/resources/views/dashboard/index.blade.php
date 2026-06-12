@extends('layouts.app')

@section('content')
<div class="page-header mb-4">
    <div>
        <p class="text-uppercase text-primary small mb-2">Painel inicial</p>
        <h1 class="h2 mb-1">Bem-vindo, {{ auth()->user()->name }}.</h1>
        <p class="text-muted mb-0">Organize seus anos letivos, disciplinas, cadernos e tarefas em um só lugar.</p>
    </div>
    <a href="{{ route('academic-years.create') }}" class="btn btn-brand btn-lg">Novo ano letivo</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="surface-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="icon-badge">📚</span>
                <span class="small-note">Anos letivos</span>
            </div>
            <h3 class="h1 mb-1">{{ $academicYears->count() }}</h3>
            <p class="text-muted mb-0">Anos letivos criados até o momento.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="surface-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="icon-badge">🧠</span>
                <span class="small-note">Disciplinas</span>
            </div>
            <h3 class="h1 mb-1">{{ $disciplines->count() }}</h3>
            <p class="text-muted mb-0">Disciplinas cadastradas na sua conta.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="surface-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="icon-badge">📝</span>
                <span class="small-note">Tarefas pendentes</span>
            </div>
            <h3 class="h1 mb-1">{{ $pendingTasks->count() }}</h3>
            <p class="text-muted mb-0">Tarefas que ainda não foram concluídas.</p>
        </div>
    </div>
</div>

@if($academicYears->isEmpty())
    <div class="surface-card p-5 mb-4 text-center">
        <p class="text-uppercase text-primary mb-2">Sem anos letivos</p>
        <h2 class="h4 mb-3">Vamos começar pelo período acadêmico.</h2>
        <p class="text-muted mb-3">Crie seu primeiro ano letivo para poder cadastrar disciplinas e tarefas.</p>
        <a href="{{ route('academic-years.create') }}" class="btn btn-brand">Criar ano letivo</a>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-7">
        <div class="surface-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="h5 mb-1">Disciplinas recentes</h2>
                    <p class="text-muted mb-0">Disciplinas criadas mais recentemente.</p>
                </div>
                <a href="{{ route('disciplines.create') }}" class="btn btn-outline-primary btn-sm">Nova disciplina</a>
            </div>

            @if($disciplines->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted mb-3">Nenhuma disciplina criada ainda.</p>
                    <a href="{{ route('disciplines.create') }}" class="btn btn-brand">Começar disciplina</a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($disciplines as $discipline)
                        <div class="col">
                            <a href="{{ route('disciplines.show', $discipline) }}" class="text-decoration-none text-reset">
                                <div class="card card-compact p-3 h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <span class="badge text-bg-secondary">{{ $discipline->academicYear->title ?? 'Sem ano' }}</span>
                                        <span class="small text-muted">{{ $discipline->notebooks_count }} cadernos</span>
                                    </div>
                                    <h3 class="h6 mb-2">{{ $discipline->title }}</h3>
                                    <p class="text-muted mb-2">{{ $discipline->description ?: 'Sem descrição' }}</p>
                                    <div class="d-flex gap-2">
                                        <span class="status-pill {{ $discipline->tasks_count ? 'completed' : 'pending' }}">{{ $discipline->tasks_count }} tarefas</span>
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
            <p class="text-muted mb-4">Tarefas com aviso de atraso aparecem aqui.</p>
            @if($pendingTasks->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">Nenhuma tarefa pendente. Ótimo trabalho!</p>
                </div>
            @else
                <div class="list-group">
                    @foreach($pendingTasks as $task)
                        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <strong>{{ $task->title }}</strong>
                                <div class="small text-muted">{{ $task->discipline->title }} • {{ $task->due_date->format('d/m/Y H:i') }}</div>
                                @if(!$task->completed)
                                    <div class="small mt-1 text-warning">Essa tarefa não foi concluída.</div>
                                @endif
                            </div>
                            <div class="text-end">
                                <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Marcar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="surface-card p-4">
            <h2 class="h5 mb-3">Ações rápidas</h2>
            <ul class="list-unstyled mb-0">
                <li class="mb-3">🔹 Criar novo ano letivo</li>
                <li class="mb-3">🔹 Adicionar disciplina</li>
                <li class="mb-3">🔹 Criar caderno de anotações</li>
                <li class="mb-3">🔹 Planejar próxima tarefa</li>
            </ul>
        </div>
    </div>
</div>
@endsection
