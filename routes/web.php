<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\TaskWebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/trashed', [TaskWebController::class, 'trashed'])->name('tasks.trashed');
    Route::get('/tasks/create', [TaskWebController::class, 'create'])->name('tasks.create');
    Route::get('/tasks', [TaskWebController::class, 'index'])->name('tasks.index');

    Route::post('/tasks', [TaskWebController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskWebController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit', [TaskWebController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskWebController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskWebController::class, 'destroy'])->name('tasks.destroy');

});


