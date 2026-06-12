@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar novo caderno</h1>
            <p class="text-muted mb-4">Associe este caderno a uma disciplina e comece a escrever suas anotações acadêmicas.</p>
            <form method="POST" action="{{ route('notebooks.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título do caderno</label>
                    <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="discipline_id" class="form-label">Disciplina</label>
                    <select id="discipline_id" name="discipline_id" class="form-select" required>
                        <option value="">Selecione uma disciplina</option>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}" {{ old('discipline_id') == $discipline->id ? 'selected' : '' }}>{{ $discipline->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Primeira anotação</label>
                    <textarea id="content" name="content" rows="6" class="form-control" placeholder="Use Control + Z para desfazer enquanto escreve.">{{ old('content') }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Criar caderno</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
