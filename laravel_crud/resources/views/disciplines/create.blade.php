@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Nova disciplina</p>
                    <h1 class="h3 mb-0">Adicionar disciplina</h1>
                </div>
                <span class="badge bg-secondary">Campos obrigatórios</span>
            </div>
            <form method="POST" action="{{ route('disciplines.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Nome da disciplina</label>
                    <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="academic_year_id" class="form-label">Ano letivo</label>
                    <select id="academic_year_id" name="academic_year_id" class="form-select" required>
                        <option value="">Selecione um ano</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>{{ $year->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Cor do cartão</label>
                    <input id="color" name="color" value="{{ old('color', '#2d6cdf') }}" type="color" class="form-control form-control-color" title="Escolher cor">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea id="description" name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Criar disciplina</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
