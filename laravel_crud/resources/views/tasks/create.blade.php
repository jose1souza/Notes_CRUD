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
                <x-input
                    name="title"
                    label="Título da tarefa"
                    type="text"
                    required="true"
                />
                <x-select
                    name="discipline_id"
                    label="Disciplina"
                    required="true"
                    placeholder="Selecione uma disciplina"
                    :options="$disciplines->mapWithKeys(fn($d) => [$d->id => $d->title . ' — ' . ($d->academicYear->title ?? 'Sem ano')])->toArray()"
                />
                <x-input
                    name="due_date"
                    label="Data de entrega"
                    type="datetime-local"
                    required="true"
                    validation="datetime-future"
                    hint="Data e hora devem ser no futuro."
                />
                <x-textarea
                    name="note"
                    label="Observações"
                    :rows="4"
                />
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Salvar tarefa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
