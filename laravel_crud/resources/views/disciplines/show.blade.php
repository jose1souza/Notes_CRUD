@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="surface-card p-4">
            <div class="d-flex align-items-start justify-content-between mb-4 gap-3">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Disciplina</p>
                    <h1 class="h3 mb-1">{{ $discipline->title }}</h1>
                    <p class="text-muted mb-0">{{ $discipline->academicYear->title ?? 'Ano Letivo não definido' }}</p>
                </div>
                <span class="status-pill {{ $discipline->tasks->where('completed', false)->count() ? 'pending' : 'completed' }}">{{ $discipline->tasks->where('completed', false)->count() }} pendentes</span>
            </div>
            <div class="mb-4">
                <p>{{ $discipline->description ?: 'Descrição não informada.' }}</p>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card card-compact p-3 h-100">
                        <h3 class="h6">Cadernos</h3>
                        <p class="text-muted mb-3">{{ $discipline->notebooks->count() }} cadernos criados.</p>
                        <a href="{{ route('notebooks.create') }}" class="btn btn-outline-primary btn-sm">Adicionar caderno</a>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-compact p-3 h-100">
                        <h3 class="h6">Tarefas</h3>
                        <p class="text-muted mb-3">{{ $discipline->tasks->count() }} tarefas registradas.</p>
                        <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary btn-sm">Adicionar tarefa</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="surface-card p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h5 mb-0">Tarefas da disciplina</h2>
                <span class="small text-muted">Arraste pelo cronograma mental</span>
            </div>
            @if($discipline->tasks->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">Nenhuma tarefa cadastrada nesta disciplina.</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-brand">Criar tarefa</a>
                </div>
            @else
                <div class="list-group">
                    @foreach($discipline->tasks as $task)
                        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <strong>{{ $task->title }}</strong>
                                <div class="small text-muted">Entrega em {{ $task->due_date->format('d/m/Y H:i') }}</div>
                                <div class="small mt-1 text-{{ $task->completed ? 'success' : 'warning' }}">
                                    {{ $task->completed ? 'Concluída' : 'Essa tarefa não foi concluída' }}
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Alterar</button>
                                </form>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Deseja mesmo excluir esta tarefa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="surface-card p-4">
            <h2 class="h6 mb-3">Detalhes rápidos</h2>
            <p class="text-muted">Cor do cartão: <strong>{{ $discipline->color ?: ' Padrão' }}</strong></p>
            <div class="mb-3">
                <span class="badge text-bg-light" style="color: {{ $discipline->color ?: '#2d6cdf' }}; border: 1px solid {{ $discipline->color ?: '#2d6cdf' }};">Visualizar cor</span>
            </div>
            <div class="d-grid gap-2">
                <a href="{{ route('disciplines.create') }}" class="btn btn-outline-primary w-100 mb-2">Editar disciplina</a>
                <form method="POST" action="{{ route('disciplines.destroy', $discipline) }}" onsubmit="return confirm('Deseja mesmo excluir esta disciplina?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Excluir disciplina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
