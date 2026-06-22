<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'due_date_day' => ['required', 'date'],
            'due_date_time' => ['required'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $dueDate = Carbon::parse($request->due_date_day . ' ' . $request->due_date_time);

        if ($dueDate->isPast()) {
            return back()->withErrors(['due_date_day' => 'A data e hora de entrega deve ser um momento futuro.'])->withInput();
        }

        $request->user()->tasks()->create([
            'title' => $request->title,
            'discipline_id' => $request->discipline_id,
            'due_date' => $dueDate,
            'description' => $request->description ?? null,
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

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discipline_id' => ['required', 'exists:disciplines,id'],
            'due_date_day' => ['required', 'date'],
            'due_date_time' => ['required'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $dueDate = Carbon::parse($request->due_date_day . ' ' . $request->due_date_time);

        if ($dueDate->isPast()) {
            return back()->withErrors(['due_date_day' => 'A data e hora de entrega deve ser um momento futuro.'])->withInput();
        }

        $task->update([
            'title' => $request->title,
            'discipline_id' => $request->discipline_id,
            'due_date' => $dueDate,
            'description' => $request->description ?? null,
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