@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-5">
            <h1 class="h3 fw-bold mb-4">Editar disciplina</h1>

            <form method="POST" action="{{ route('disciplines.update', $discipline) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $discipline->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea name="description" id="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="3">{{ old('description', $discipline->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="academic_year_id" class="form-label">Ano letivo</label>
                    <select name="academic_year_id" id="academic_year_id"
                            class="form-select @error('academic_year_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}"
                                {{ old('academic_year_id', $discipline->academic_year_id) == $year->id ? 'selected' : '' }}>
                                {{ $year->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('academic_year_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Cor do cartão</label>
                    <input type="color" name="color" id="color"
                           class="form-control form-control-color"
                           value="{{ old('color', $discipline->color ?? '#2d6cdf') }}">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('disciplines.index') }}" class="btn btn-outline-secondary">Voltar</a>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-brand">Salvar alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
