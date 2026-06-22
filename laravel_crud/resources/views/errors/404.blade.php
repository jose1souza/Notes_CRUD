@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-primary shadow-sm p-5 text-center">
            <div class="mb-4">
                <span class="d-inline-flex align-items-center justify-content-center"
                      style="width:4rem; height:4rem; border-radius:2rem; background:#e0f2fe; color:#0369a1; font-size:2rem;">
                    <i class="fas fa-search"></i>
                </span>
            </div>
            <h1 class="h3 mb-2">Página não encontrada</h1>
            <p class="text-muted mb-4">
                O recurso que você procura não existe ou foi removido.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-brand">
                <i class="fas fa-home me-1"></i> Voltar ao painel
            </a>
        </div>
    </div>
</div>
@endsection
