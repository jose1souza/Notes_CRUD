<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        return view('tasks.create', [
            'disciplines' => $request->user()->disciplines()->with('academicYear')->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'due_date' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after:now',
                function ($attribute, $value, $fail) {
                    $dueDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $value);
                    if ($dueDate <= \Carbon\Carbon::now()) {
                        $fail('Data e hora devem ser no futuro.');
                    }
                },
            ],
            'note' => ['nullable', 'string', 'max:1000'],
        ], [
            'title.required' => 'Dê um título à tarefa.',
            'title.max' => 'Título muito longo.',
            'discipline_id.required' => 'Escolha uma disciplina.',
            'discipline_id.exists' => 'Disciplina inválida.',
            'due_date.required' => 'Informe a data de entrega.',
            'due_date.date_format' => 'Data/hora no formato incorreto.',
            'due_date.after' => 'Data e hora devem ser no futuro.',
            'note.max' => 'Observações muito longas.',
        ]);

        $request->user()->tasks()->create(array_merge($data, ['completed' => false]));

        return redirect()->route('dashboard')
            ->with('success', 'Tarefa criada.');
    }

    public function toggle(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->update(['completed' => !$task->completed]);

        return back()->with('success', $task->completed ? 'Tarefa concluída.' : 'Tarefa reabertar.');
    }

    public function destroy(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->delete();

        return back()->with('success', 'Tarefa removida.');
    }
}
