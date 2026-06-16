@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-5">
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-2">{{ $academicYear->title }}</h1>
                <p class="text-muted">{{ $academicYear->description ?: 'Sem descrição disponível.' }}</p>
            </div>

            <div class="mb-4">
                <h2 class="h5 fw-semibold">Informações gerais</h2>
                <ul class="list-unstyled mb-0">
                    <li><strong>Criado em:</strong> {{ $academicYear->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Última atualização:</strong> {{ $academicYear->updated_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Disciplinas vinculadas:</strong> {{ $academicYear->disciplines()->count() }}</li>
                </ul>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('academic-years.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('academic-years.edit', $academicYear) }}" class="btn btn-outline-primary">
                        Editar
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content surface-card">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">Confirmar exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-0">
                    Tem certeza que deseja excluir o ano letivo <strong>{{ $academicYear->title }}</strong>? 
                    Essa ação não poderá ser desfeita.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('academic-years.destroy', $academicYear) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
