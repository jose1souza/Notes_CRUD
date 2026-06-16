<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->with('discipline')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

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
            'due_date' => ['required', 'date', 'after:now'], // Garante que a data/hora seja maior que o momento atual
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->user()->tasks()->create([
            'title' => $data['title'],
            'discipline_id' => $data['discipline_id'],
            'due_date' => $data['due_date'],
            'description' => $data['description'] ?? null,
            'completed' => false,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso.');
    }

    public function show(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->load('discipline');

        return view('tasks.show', compact('task'));
    }

    public function edit(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        return view('tasks.edit', [
            'task' => $task,
            'disciplines' => $request->user()->disciplines()->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'due_date' => ['required', 'date', 'after:now'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $task->update([
            'title' => $data['title'],
            'discipline_id' => $data['discipline_id'],
            'due_date' => $data['due_date'],
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function toggle(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->update(['completed' => !$task->completed]);

        return back()->with('success', $task->completed ? 'Tarefa concluída.' : 'Tarefa reaberta.');
    }

    public function destroy(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa removida.');
    }
}