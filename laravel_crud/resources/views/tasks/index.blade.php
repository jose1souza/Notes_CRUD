@extends('layouts.app')

@section('content')
<div class="page-header mb-5">
    <div>
        <h1 class="fw-bold mb-2">Tarefas</h1>
        <p class="text-muted">Gerencie suas tarefas vinculadas às disciplinas.</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-brand">Nova tarefa</a>
</div>

@if($tasks->isEmpty())
    <div class="surface-card p-5 text-center mb-5">
        <h2 class="h4 mb-3">Nenhuma tarefa encontrada</h2>
        <p class="text-muted mb-4">Crie sua primeira tarefa para organizar seus estudos.</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-brand">Criar tarefa</a>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($tasks as $task)
            <div class="col">
                <div class="card card-compact p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none text-reset">
                            <h2 class="h5 fw-bold mb-0">{{ $task->title }}</h2>
                        </a>
                        <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $task->completed ? 'Concluída' : 'Pendente' }}
                        </span>
                    </div>
                    <p class="text-muted mb-2">Disciplina: {{ $task->discipline->title }}</p>
                    <p class="small text-muted mb-3">
                        Entrega em {{ $task->due_date ? $task->due_date->format('d/m/Y H:i') : 'Sem prazo definido' }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <!-- Botão abre modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal{{ $task->id }}">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de exclusão -->
            <div class="modal fade" id="deleteTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteTaskLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content surface-card">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold" id="deleteTaskLabel{{ $task->id }}">Confirmar exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted mb-0">
                                Tem certeza que deseja excluir a tarefa <strong>{{ $task->title }}</strong>?  
                                Essa ação não poderá ser desfeita.
                            </p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
@endif
@endsection
