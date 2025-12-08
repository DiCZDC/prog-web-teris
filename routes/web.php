<?php

use App\Http\Controllers\{
    EventController,
    ProfileController,
    UserController,
    ProjectController,
    TeamController,
    mailController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Página principal muestra los eventos
Route::get('/', [EventController::class, 'index'])->name('home');

// dashboard para usuarios autenticados
// Rutas de autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
});

// Route::get('/mailPdf', function(){
//     $mailController = new MailController();
//     $team = \App\Models\Team::find(1);
//     $user = \App\Models\User::find(54);
//     $event = \App\Models\Event::find(1);
//     $date = now();
//     return $mailController->sendPdfEmail($team, $user, $event, $date);
// });
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});
Route::middleware('auth')->group(function () {
    // Rutas CRUD de eventos
    // Rutas CRUD de equipos
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
// Ruta de logout (requiere estar autenticado)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas de eventos (accesibles para todos, autenticados o no)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/teams/{id}', [EventController::class, 'teams'])->name('events.teams.index');


Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class);

// Ruta temporal para password reset
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('error', 'Función en desarrollo');
})->name('password.request');

// Rutas públicas de equipos
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
// Route::get('/teams/event/{id}', [TeamController::class, 'indexEvent'])->name('teams.indexEvent');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');

// Rutas protegidas de equipos (requieren autenticación)
Route::middleware('auth')->group(function () {
     // ==================== RUTAS DEL PERFIL ====================
    // Ruta principal para ver el perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Rutas para editar perfil (si usas Laravel Breeze ya deberían existir)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para cambiar contraseña
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

