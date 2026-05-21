<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('academic-years/create', [AcademicYearController::class, 'create'])->name('academic-years.create');
    Route::post('academic-years', [AcademicYearController::class, 'store'])->name('academic-years.store');
    Route::get('disciplines/create', [DisciplineController::class, 'create'])->name('disciplines.create');
    Route::post('disciplines', [DisciplineController::class, 'store'])->name('disciplines.store');
    Route::get('disciplines/{discipline}', [DisciplineController::class, 'show'])->name('disciplines.show');
    Route::delete('disciplines/{discipline}', [DisciplineController::class, 'destroy'])->name('disciplines.destroy');
    Route::get('notebooks/create', [NotebookController::class, 'create'])->name('notebooks.create');
    Route::post('notebooks', [NotebookController::class, 'store'])->name('notebooks.store');
    Route::get('notebooks/{notebook}', [NotebookController::class, 'show'])->name('notebooks.show');
    Route::post('notebooks/{notebook}', [NotebookController::class, 'update'])->name('notebooks.update');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

Route::get('no-permission', [DashboardController::class, 'noPermission'])->name('no-permission');
Route::get('offline', [DashboardController::class, 'offline'])->name('offline');
Route::get('loading', function () {
    return view('states.loading', ['message' => 'Carregando nova página...']);
})->name('loading');
