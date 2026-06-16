@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-5">
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-2">Editar ano letivo</h1>
                <p class="text-muted">Atualize as informações do período acadêmico.</p>
            </div>

            <form method="POST" action="{{ route('academic-years.update', $academicYear) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Título do ano letivo</label>
                    <input id="title" name="title" 
                           value="{{ old('title', $academicYear->title) }}" 
                           type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           placeholder="Ex.: 2026/1" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Descrição</label>
                    <textarea id="description" name="description" rows="4" 
                              class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Ex.: Primeiro semestre de 2026">{{ old('description', $academicYear->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('academic-years.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-brand">
                        Atualizar ano letivo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
