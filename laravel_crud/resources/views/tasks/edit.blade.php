@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-5">
            <h1 class="h3 fw-bold mb-4">Editar tarefa</h1>

            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $task->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
    <label for="due_date" class="form-label">Data e Hora de entrega</label>
    <input type="datetime-local" name="due_date" id="due_date"
           class="form-control @error('due_date') is-invalid @enderror"
           value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}"
           min="{{ now()->format('Y-m-d\TH:i') }}" required>
    @error('due_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="due_date_date" class="form-label">Data de entrega</label>
                        <input type="date" name="due_date_date" id="due_date_date"
                               class="form-control @error('due_date_date') is-invalid @enderror"
                               value="{{ old('due_date_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                               min="{{ now()->format('Y-m-d') }}" required>
                        @error('due_date_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="due_date_time" class="form-label">Hora de entrega</label>
                        <input type="time" name="due_date_time" id="due_date_time"
                               class="form-control @error('due_date_time') is-invalid @enderror"
                               value="{{ old('due_date_time', $task->due_date ? $task->due_date->format('H:i') : '') }}" required>
                        @error('due_date_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 mt-3">
                    <label for="description" class="form-label">Anotações</label>
                    <textarea name="description" id="description" rows="6"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Adicione detalhes ou observações sobre a tarefa...">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Voltar para lista</a>
                    <button type="submit" class="btn btn-brand">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection