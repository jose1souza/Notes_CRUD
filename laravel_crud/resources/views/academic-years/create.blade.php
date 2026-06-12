@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar novo ano letivo</h1>
            <p class="text-muted mb-4">Defina o período acadêmico para organizar disciplinas e notas.</p>
            <form method="POST" action="{{ route('academic-years.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título do ano letivo</label>
                    <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea id="description" name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-brand">Salvar ano letivo</button>
            </form>
        </div>
    </div>
</div>
@endsection
