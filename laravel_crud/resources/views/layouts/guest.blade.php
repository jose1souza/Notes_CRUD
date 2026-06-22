<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $title ?? config('app.name', 'Creative Organization') }}
    </title>

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js'
    ])
</head>

<body class="hold-transition login-page">

<div class="login-box" style="width: 420px;">

    <div class="card card-outline card-primary shadow">

        <div class="card-header text-center">

            <a href="{{ route('login') }}"
               class="h3 text-decoration-none">

                <b>{{ config('app.name') }}</b>

            </a>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>