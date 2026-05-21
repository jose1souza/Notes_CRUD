<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
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

        return redirect()->route('notebooks.show', $notebook)
            ->with('success', 'Caderno criado com sucesso. Você já pode começar a escrever.');
    }

    public function show(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        return view('notebooks.show', [
            'notebook' => $notebook,
        ]);
    }

    public function update(Request $request, Notebook $notebook)
    {
        abort_if($notebook->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'content' => ['nullable', 'string'],
        ]);

        $notebook->update($data);

        return back()->with('success', 'Anotações salvas. Use Control + Z para desfazer alterações enquanto escreve.');
    }
}
