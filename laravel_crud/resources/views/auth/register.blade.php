@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar conta</h1>
            <p class="text-muted mb-4">Registre-se para organizar disciplinas, cadernos e tarefas.</p>
            <form method="POST" action="{{ route('register.post') }}" novalidate>
                @csrf
                <x-input
                    name="name"
                    label="Nome completo"
                    type="text"
                    required="true"
                />
                <x-input
                    name="email"
                    label="E-mail"
                    type="email"
                    required="true"
                />
                <x-input
                    name="password"
                    label="Senha"
                    type="password"
                    required="true"
                    hint="Mínimo de 8 caracteres."
                />
                <x-input
                    name="password_confirmation"
                    label="Confirmar senha"
                    type="password"
                    required="true"
                />
                <button type="submit" class="btn btn-brand w-100">Criar conta</button>
                <p class="text-center text-muted small mt-3">Já tem uma conta? <a href="{{ route('login') }}">Entrar aqui</a>.</p>
            </form>
        </div>
    </div>
</div>
@endsection
