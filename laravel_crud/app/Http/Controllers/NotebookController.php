<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function index(Request $request)
    {
        // Lista todos os cadernos do usuário autenticado
        $notebooks = $request->user()
            ->notebooks()
            ->with('discipline')
            ->latest()
            ->paginate(10);

        return view('notebooks.index', compact('notebooks'));
    }

    public function create(Request $request)
    {
        return view('notebooks.create', [
            'disciplines' => $request->user()->disciplines()->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'content' => ['nullable', 'string'],
        ]);

        $notebook = $request->user()->notebooks()->create($data);

        return redirect()->route('notebooks.index', $notebook)
            ->with('success', 'Caderno criado. Comece a escrever!');
    }

    public function show(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        return view('notebooks.show', compact('notebook'));
    }

    public function edit(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        return view('notebooks.edit', [
            'notebook' => $notebook,
            'disciplines' => $request->user()->disciplines()->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'content' => ['nullable', 'string'],
        ]);

        $notebook->update($data);

        return redirect()->route('notebooks.index', $notebook)
            ->with('success', 'Caderno atualizado com sucesso.');
    }

    public function destroy(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        $notebook->delete();

        return redirect()->route('notebooks.index')
            ->with('success', 'Caderno removido.');
    }
}
