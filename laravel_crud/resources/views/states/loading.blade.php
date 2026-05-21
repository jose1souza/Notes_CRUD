@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="surface-card p-5 text-center">
            <div class="spinner-border text-primary mb-4" role="status" aria-hidden="true"></div>
            <h1 class="h3 mb-3">Carregando...</h1>
            <p class="text-muted mb-4">{{ $message ?? 'Aguarde enquanto preparamos seus dados.' }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Voltar ao painel</a>
        </div>
    </div>
</div>
@endsection
