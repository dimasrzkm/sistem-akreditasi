<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Lpppm\AssignmentController;
use App\Http\Controllers\Prodi\EvaluationController;
use App\Http\Controllers\Reviewer\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'prefix' => 'reviewer',
        'as' => 'reviewer.'
    ], function() {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::group([
        'prefix' => 'lpppm',
        'as' => 'lpppm.'
    ], function() {
        Route::get('assignments', [AssignmentController::class, 'index'])->name('assignment.index');
        Route::get('assignments/create', [AssignmentController::class, 'create'])->name('assignment.create');
        Route::post('assignments', [AssignmentController::class, 'store'])->name('assignment.store');
        Route::get('assignments/{user}/edit/{id}', [AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::put('assignments/{user}', [AssignmentController::class, 'update'])->name('assignment.update');
        Route::delete('assignments/{user}/{id}', [AssignmentController::class, 'destroy'])->name('assignment.destroy');
    });
    Route::group(([
        'prefix' => 'prodi',
        'as' => 'prodi.'
    ]), function() {
        Route::get('evaluation', [EvaluationController::class, 'index'])->name('evaluation.index');
        Route::get('evaluation/download', [EvaluationController::class, 'download'])->name('evaluation.download');
        Route::get('assignments/create', [EvaluationController::class, 'create'])->name('evaluation.create');
        Route::post('evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
        // Route::get('assignments/{user}/edit/{id}', [AssignmentController::class, 'edit'])->name('assignment.edit');
        // Route::put('assignments/{user}', [AssignmentController::class, 'update'])->name('assignment.update');
        // Route::delete('assignments/{user}/{id}', [AssignmentController::class, 'destroy'])->name('assignment.destroy');
    });
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});