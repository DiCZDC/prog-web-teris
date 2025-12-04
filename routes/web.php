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
use App\Http\Controllers\EventosController;
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



// Rutas públicas de equipos
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');

// Rutas protegidas de equipos (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    
    // Rutas para unirse a equipos
    Route::get('/teams/join/form', [TeamController::class, 'join'])->name('teams.join');
    Route::post('/teams/join/process', [TeamController::class, 'joinTeam'])->name('teams.join.process');
    Route::post('/teams/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');
});