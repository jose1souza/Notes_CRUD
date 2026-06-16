@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-5">
            <h1 class="h3 fw-bold mb-4">Editar caderno</h1>

            <form method="POST" action="{{ route('notebooks.update', $notebook) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $notebook->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discipline_id" class="form-label">Disciplina vinculada</label>
                    <select name="discipline_id" id="discipline_id"
                            class="form-select @error('discipline_id') is-invalid @enderror" required>
                        <option value="">Selecione...</option>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}"
                                {{ old('discipline_id', $notebook->discipline_id) == $discipline->id ? 'selected' : '' }}>
                                {{ $discipline->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('discipline_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label">Anotações</label>
                    <textarea name="content" id="content" rows="6"
                              class="form-control @error('content') is-invalid @enderror"
                              placeholder="Adicione ou edite suas anotações...">{{ old('content', $notebook->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('notebooks.index') }}" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
