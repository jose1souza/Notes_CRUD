@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-start justify-content-between mb-4 gap-3">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Caderno</p>
                    <h1 class="h3 mb-1">{{ $notebook->title }}</h1>
                    <p class="text-muted mb-0">Disciplina: {{ $notebook->discipline->title }}</p>
                </div>
                <span class="badge bg-info text-dark">{{ $notebook->updated_at->diffForHumans() }}</span>
            </div>
            <form method="POST" action="{{ route('notebooks.update', $notebook) }}">
                @csrf
                <div class="mb-4">
                    <label for="content" class="form-label">Escrever anotações</label>
                    <textarea id="content" name="content" rows="12" class="form-control" placeholder="Use Control + Z para desfazer alterações enquanto escreve.">{{ old('content', $notebook->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-brand">Salvar anotações</button>
                <span class="text-muted small ms-3">Suas anotações serão salvas e mantidas no caderno.</span>
            </form>
        </div>
    </div>
</div>
@endsection
