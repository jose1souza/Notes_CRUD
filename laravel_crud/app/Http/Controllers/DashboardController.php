<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('dashboard.index', [
            'academicYears' => $user->academicYears()->withCount('disciplines')->latest()->get(),
            'disciplines' => $user->disciplines()->withCount(['tasks', 'notebooks'])->latest()->limit(6)->get(),
            'pendingTasks' => $user->tasks()->where('completed', false)->orderBy('due_date')->get(),
        ]);
    }

    public function noPermission()
    {
        return response()->view('errors.403', [], 403);
    }

    public function offline()
    {
        return view('states.loading', ['title' => 'Sem conexão', 'message' => 'Parece que você está offline. Verifique sua conexão e tente novamente.']);
    }
}
