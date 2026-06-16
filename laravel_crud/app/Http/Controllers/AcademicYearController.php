<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $academicYears = $request->user()->academicYears()->latest()->paginate(10);

        return view('academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('academic-years.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'title.required' => 'Informe o título do ano letivo.',
            'title.max' => 'Título muito longo.',
            'description.max' => 'Descrição muito longa.',
        ]);

        $request->user()->academicYears()->create($data);

        return redirect()->route('academic-years.index')
            ->with('success', 'Ano letivo criado com sucesso.');
    }

    public function show(AcademicYear $academicYear)
    {
    if ($academicYear->user_id !== auth()->id()) {
        abort(403, 'Você não tem permissão para visualizar este ano letivo.');
    }

    return view('academic-years.show', compact('academicYear'));
    }

    public function edit(AcademicYear $academicYear)
    {
        if ($academicYear->user_id !== auth()->id()) {
        abort(403, 'Você não tem permissão para visualizar este ano letivo.');
    }

        return view('academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        if ($academicYear->user_id !== auth()->id()) {
        abort(403, 'Você não tem permissão para visualizar este ano letivo.');
    }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $academicYear->update($data);

        return redirect()->route('academic-years.index')
            ->with('success', 'Ano letivo atualizado com sucesso.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        if ($academicYear->user_id !== auth()->id()) {
        abort(403, 'Você não tem permissão para visualizar este ano letivo.');
    }

        $academicYear->delete();

        return redirect()->route('academic-years.index')
            ->with('success', 'Ano letivo removido com sucesso.');
    }
}
