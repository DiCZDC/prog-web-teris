<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventosController;

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

// Rutas de eventos
Route::get('/eventos', [EventosController::class, 'index'])->name('eventos.index');
Route::get('/eventos/buscar', [EventosController::class, 'buscar'])->name('eventos.buscar');
Route::get('/eventos/crear', [EventosController::class, 'create'])->name('eventos.create');
Route::post('/eventos', [EventosController::class, 'store'])->name('eventos.store');
Route::get('/eventos/{id}', [EventosController::class, 'show'])->name('eventos.show');
require __DIR__.'/auth.php';
