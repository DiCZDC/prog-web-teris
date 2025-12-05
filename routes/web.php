<?php

use App\Http\Controllers\{
    // EventosController,
    EventController,
    ProfileController,
    UserController,
    ProjectController,
    TeamController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Página principal muestra los eventos
Route::get('/', [EventController::class, 'index'])->name('home');

// dashboard para usuarios autenticados
Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard')->middleware('auth');
// Rutas de autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Ruta de logout (requiere estar autenticado)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas de eventos (accesibles para todos, autenticados o no)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::resource('events', EventController::class);

Route::resource('teams', TeamController::class);
Route::resource('users', UserController::class);

// Rutas solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/events/crear', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});

// Ruta temporal para password reset
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('error', 'Función en desarrollo');
})->name('password.request');