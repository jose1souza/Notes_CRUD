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
            'due_date' => ['required', 'date', 'after:now'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->user()->tasks()->create(array_merge($data, ['completed' => false]));

        return redirect()->route('dashboard')
            ->with('success', 'Tarefa criada com sucesso. Ela ficará pendente até ser concluída.');
    }

    public function toggle(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->update(['completed' => !$task->completed]);

        return back()->with('success', $task->completed ? 'Tarefa marcada como concluída.' : 'Tarefa retornou para pendente.');
    }

    public function destroy(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->delete();

        return back()->with('success', 'Tarefa removida com sucesso.');
    }
}
