<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function create(Request $request)
    {
        return view('disciplines.create', [
            'academicYears' => $request->user()->academicYears()->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'color' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $discipline = $request->user()->disciplines()->create($data);

        return redirect()->route('disciplines.show', $discipline)
            ->with('success', 'Disciplina criada com sucesso.');
    }

    public function show(Request $request, Discipline $discipline)
    {
        abort_if($discipline->user_id !== $request->user()->id, 403);

        $discipline->load(['academicYear', 'notebooks', 'tasks']);

        return view('disciplines.show', [
            'discipline' => $discipline,
        ]);
    }

    public function destroy(Request $request, Discipline $discipline)
    {
        abort_if($discipline->user_id !== $request->user()->id, 403);

        $discipline->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Disciplina removida com sucesso.');
    }
}
