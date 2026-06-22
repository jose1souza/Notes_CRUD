    @extends('layouts.app')

    @section('content')
    <div class="page-header mb-5">
        <div>
            <h1 class="fw-bold mb-2">Anos letivos</h1>
            <p class="text-muted">Gerencie os períodos acadêmicos cadastrados.</p>
        </div>
        <a href="{{ route('academic-years.create') }}" class="btn btn-brand">Novo ano letivo</a>
    </div>

    @if($academicYears->isEmpty())
        <div class="surface-card p-5 text-center mb-5">
            <h2 class="h4 mb-3">Nenhum ano letivo encontrado</h2>
            <p class="text-muted mb-4">Crie seu primeiro ano letivo para começar a organizar disciplinas e tarefas.</p>
            <a href="{{ route('academic-years.create') }}" class="btn btn-brand">Criar ano letivo</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($academicYears as $academicYear)
                <div class="col">
                    <a href="{{ route('academic-years.show', $academicYear) }}" class="text-decoration-none text-reset">
                        <div class="card card-compact p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h5 fw-bold mb-0">{{ $academicYear->title }}</h2>
                                <span class="badge bg-light text-dark">
                                    {{ $academicYear->disciplines()->count() }} disciplinas
                                </span>
                            </div>
                            <p class="text-muted mb-3">{{ $academicYear->description ?: 'Sem descrição' }}</p>
                            <div class="small text-muted">
                                Criado em {{ $academicYear->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $academicYears->links() }}
        </div>
    @endif
    @endsection
