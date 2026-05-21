@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar conta</h1>
            <p class="text-muted mb-4">Registre-se e comece a planejar seus estudos com uma solução única para disciplinas, cadernos e tarefas.</p>
            <form method="POST" action="{{ route('register.post') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome completo</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                    <div class="form-text">Mínimo de 8 caracteres.</div>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmar senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-brand w-100">Criar conta</button>
                <p class="text-center text-muted small mt-3">Já tem uma conta? <a href="{{ route('login') }}">Faça login</a>.</p>
            </form>
        </div>
    </div>
</div>
@endsection
