@if(session('success'))
    <div class="alert alert-success alert-card" role="status">
        {{ session('success') }}
    </div>
@endif

@if(session('login_error'))
    <div class="alert alert-danger alert-card" role="alert">
        {{ session('login_error') }}
    </div>
@endif

@if($errors->any() && !session('login_error'))
    <div class="alert alert-danger alert-card" role="alert">
        <strong>Verifique os campos:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-card" role="alert">
        {{ session('warning') }}
    </div>
@endif
