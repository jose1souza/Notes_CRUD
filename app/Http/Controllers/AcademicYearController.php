<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
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

        return redirect()->route('dashboard')
            ->with('success', 'Ano letivo criado.');
    }
}
