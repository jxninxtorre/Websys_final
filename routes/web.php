<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// PUBLIC pages
Route::get('/', [TaskController::class, 'welcome'])->name('welcome');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::view('/about', 'about')->name('about');
Route::view('/my-profile', 'my-profile')->name('my-profile');

// Breeze redirects here after login
Route::get('/dashboard', fn () => redirect()->route('tasks.index'))
    ->middleware('auth')->name('dashboard');

// PROTECTED: create, edit, update, delete
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);

    // Breeze account settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';