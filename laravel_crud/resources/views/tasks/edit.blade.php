@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Editar tarefa</p>
                    <h1 class="h3 mb-0">{{ $task->title }}</h1>
                </div>
            </div>

            <form method="POST" action="{{ route('tasks.update', $task) }}" novalidate>
                @csrf
                @method('PUT')

                <x-input
                    name="title"
                    label="Título da tarefa"
                    type="text"
                    required="true"
                    :value="old('title', $task->title)"
                />

                <x-select
                    name="discipline_id"
                    label="Disciplina"
                    required="true"
                    placeholder="Selecione uma disciplina"
                    :options="$disciplines->mapWithKeys(fn($d) => [
                        $d->id => $d->title . ' — ' . ($d->academicYear->title ?? 'Sem ano')
                    ])->toArray()"
                    :selected="old('discipline_id', $task->discipline_id)"
                />

                <div class="row">
                    <div class="col-md-6">
                        <x-input
                            name="due_date_day"
                            label="Data de entrega"
                            type="date"
                            required="true"
                            :value="old('due_date_day', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '')"
                            min="{{ now()->format('Y-m-d') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-input
                            name="due_date_time"
                            label="Hora de entrega"
                            type="time"
                            required="true"
                            :value="old('due_date_time', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('H:i') : '')"
                        />
                    </div>
                    <div class="col-12">
                        <small class="form-text text-muted mb-3 d-block mt-n2">
                            Escolha um momento futuro para a entrega.
                        </small>
                    </div>
                </div>

                <x-textarea
                    name="description"
                    label="Observações"
                    :rows="4"
                    :value="old('description', $task->description)"
                />

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Atualizar tarefa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection