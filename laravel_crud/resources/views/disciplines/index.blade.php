@extends('layouts.app')

@section('content')
<div class="page-header mb-5">
    <div>
        <h1 class="fw-bold mb-2">Disciplinas</h1>
        <p class="text-muted">Gerencie suas disciplinas vinculadas aos anos letivos.</p>
    </div>
    <a href="{{ route('disciplines.create') }}" class="btn btn-brand">Nova disciplina</a>
</div>

@if($disciplines->isEmpty())
    <div class="surface-card p-5 text-center mb-5">
        <h2 class="h4 mb-3">Nenhuma disciplina encontrada</h2>
        <p class="text-muted mb-4">Crie sua primeira disciplina para começar a organizar cadernos e tarefas.</p>
        <a href="{{ route('disciplines.create') }}" class="btn btn-brand">Criar disciplina</a>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($disciplines as $discipline)
            <div class="col">
                <a href="{{ route('disciplines.show', $discipline) }}" class="text-decoration-none text-reset">
                    <div class="card card-compact p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="h5 fw-bold mb-0">{{ $discipline->title }}</h2>
                            <span class="badge bg-light text-dark">
                                {{ $discipline->tasks()->count() }} tarefas
                            </span>
                        </div>
                        <p class="text-muted mb-2">{{ $discipline->description ?: 'Sem descrição' }}</p>
                        <div class="small text-muted mb-2">
                            Ano letivo: {{ $discipline->academicYear->title ?? 'Não definido' }}
                        </div>
                        <div class="small text-muted">
                            {{ $discipline->notebooks()->count() }} cadernos vinculados
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $disciplines->links() }}
    </div>
@endif
@endsection
