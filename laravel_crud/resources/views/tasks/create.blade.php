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
                    :value="old('title')"
                />

                <x-select
                    name="discipline_id"
                    label="Disciplina"
                    required="true"
                    placeholder="Selecione uma disciplina"
                    :options="$disciplines->mapWithKeys(fn($d) => [
                        $d->id => $d->title . ' — ' . ($d->academicYear->title ?? 'Sem ano')
                    ])->toArray()"
                />

                <div class="row">
                    <div class="col-md-6">
                        <x-input
                            name="due_date_date"
                            label="Data de entrega"
                            type="date"
                            required="true"
                            :value="old('due_date_date')"
                            min="{{ now()->format('Y-m-d') }}"
                            hint="Escolha hoje ou uma data futura."
                        />
                    </div>
                    <div class="col-md-6">
                        <x-input
                            name="due_date_time"
                            label="Hora de entrega"
                            type="time"
                            required="true"
                            :value="old('due_date_time')"
                            hint="Informe o horário limite para a entrega."
                        />
                    </div>
                </div>

                <x-textarea
                    name="description"
                    label="Observações"
                    :rows="4"
                    :value="old('description')"
                />

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Salvar tarefa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection