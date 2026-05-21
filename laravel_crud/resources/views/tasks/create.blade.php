@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Nova tarefa</p>
                    <h1 class="h3 mb-0">Planejar entrega</h1>
                </div>
            </div>
            <form method="POST" action="{{ route('tasks.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título da tarefa</label>
                    <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="discipline_id" class="form-label">Disciplina</label>
                    <select id="discipline_id" name="discipline_id" class="form-select" required>
                        <option value="">Selecione uma disciplina</option>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}" {{ old('discipline_id') == $discipline->id ? 'selected' : '' }}>{{ $discipline->title }} — {{ $discipline->academicYear->title ?? 'Sem ano' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Data de entrega</label>
                    <input id="due_date" name="due_date" type="datetime-local" value="{{ old('due_date') }}" class="form-control" required>
                    <div class="form-text">Datas anteriores ao momento da criação não são válidas.</div>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Observações</label>
                    <textarea id="note" name="note" rows="4" class="form-control">{{ old('note') }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Salvar tarefa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
