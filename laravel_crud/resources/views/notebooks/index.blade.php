@extends('layouts.app')

@section('content')
<div class="page-header mb-5">
    <div>
        <h1 class="fw-bold mb-2">Cadernos</h1>
        <p class="text-muted">Gerencie seus cadernos vinculados às disciplinas.</p>
    </div>
    <a href="{{ route('notebooks.create') }}" class="btn btn-brand">Novo caderno</a>
</div>

@if($notebooks->isEmpty())
    <div class="surface-card p-5 text-center mb-5">
        <h2 class="h4 mb-3">Nenhum caderno encontrado</h2>
        <p class="text-muted mb-4">Crie seu primeiro caderno para organizar suas anotações.</p>
        <a href="{{ route('notebooks.create') }}" class="btn btn-brand">Criar caderno</a>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($notebooks as $notebook)
            <div class="col">
                <div class="card card-compact p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('notebooks.show', $notebook) }}" class="text-decoration-none text-reset">
                            <h2 class="h5 fw-bold mb-0">{{ $notebook->title }}</h2>
                        </a>
                        <span class="badge bg-light text-dark">
                            {{ $notebook->updated_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-muted mb-2">Disciplina: {{ $notebook->discipline->title }}</p>
                    <p class="small text-muted mb-3">
                        {{ Str::limit($notebook->content, 100, '...') ?: 'Sem anotações' }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('notebooks.edit', $notebook) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <!-- Botão abre modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteNotebookModal{{ $notebook->id }}">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de exclusão -->
            <div class="modal fade" id="deleteNotebookModal{{ $notebook->id }}" tabindex="-1" aria-labelledby="deleteNotebookLabel{{ $notebook->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content surface-card">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold" id="deleteNotebookLabel{{ $notebook->id }}">Confirmar exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted mb-0">
                                Tem certeza que deseja excluir o caderno <strong>{{ $notebook->title }}</strong>?  
                                Essa ação não poderá ser desfeita.
                            </p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="{{ route('notebooks.destroy', $notebook) }}">
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
        {{ $notebooks->links() }}
    </div>
@endif
@endsection
