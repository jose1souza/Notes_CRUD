@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="surface-card p-5 text-center">
            <span class="d-inline-flex align-items-center justify-content-center mb-4" style="width:4rem; height:4rem; border-radius:2rem; background:#ffe4e6; color:#9d174d; font-size:2rem;">🚫</span>
            <h1 class="h3 mb-2">Sem permissão</h1>
            <p class="text-muted mb-4">Você não tem autorização para acessar esta página ou recurso.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-brand">Voltar ao painel</a>
        </div>
    </div>
</div>
@endsection
