<?php

use App\Http\Controllers\{
    EventController,
    ProfileController,
    UserController,
    ProjectController,
    TeamController
};
use Illuminate\Support\Facades\Route;

// Página principal muestra los eventos
Route::get('/', [EventosController::class, 'index'])->name('home');

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
Route::get('/eventos', [EventosController::class, 'index'])->name('eventos.index');
Route::get('/eventos/buscar', [EventosController::class, 'buscar'])->name('eventos.buscar');
Route::get('/eventos/{id}', [EventosController::class, 'show'])->name('eventos.show');

Route::resource('teams', TeamController::class);
Route::resource('events', EventController::class);
Route::resource('users', UserController::class);

// Rutas solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/eventos/crear', [EventosController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventosController::class, 'store'])->name('eventos.store');
});

// Ruta temporal para password reset
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('error', 'Función en desarrollo');
})->name('password.request');