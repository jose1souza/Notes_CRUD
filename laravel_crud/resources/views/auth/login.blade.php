@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Entrar</h1>
            <p class="text-muted mb-4">Acesse sua produtividade acadêmica e organize disciplinas, tarefas e cadernos.</p>
            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>
                    <a href="{{ route('register') }}" class="small">Ainda não tem conta?</a>
                </div>
                <button type="submit" class="btn btn-brand w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
