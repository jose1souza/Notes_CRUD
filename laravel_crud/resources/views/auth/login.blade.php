@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Entrar</h1>
            <p class="text-muted mb-4">Acesse sua conta para organizar disciplinas, tarefas e cadernos.</p>
            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf
                <x-input
                    name="email"
                    label="E-mail"
                    type="email"
                    required="true"
                    autofocus
                />
                <x-input
                    name="password"
                    label="Senha"
                    type="password"
                    required="true"
                />
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>
                    <a href="{{ route('register') }}" class="small">Criar uma conta</a>
                </div>
                <button type="submit" class="btn btn-brand w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
