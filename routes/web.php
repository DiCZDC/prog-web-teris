<?php

use App\Http\Controllers\{
    AuthController,
    EventController,
    ProfileController,
    UserController,
    ProjectController,
    TeamController,
    AdminController,
    JudgeController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Sin autenticación)
|--------------------------------------------------------------------------
*/

// Home - Lista de eventos públicos
Route::get('/', [EventController::class, 'index'])->name('home');

// Eventos públicos (solo lectura)
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/search', [EventController::class, 'search'])->name('search');
    Route::get('/{id}', [EventController::class, 'show'])->name('show');
    Route::get('/{id}/teams', [EventController::class, 'teams'])->name('teams.index');
});

// Equipos públicos (solo lectura)
Route::prefix('teams')->name('teams.')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('index');
    Route::get('/{team}', [TeamController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/password/reset', function () {
    return redirect()->route('login')->with('error', 'Función en desarrollo');
})->name('password.request');

/*
|--------------------------------------------------------------------------
| RUTAS AUTENTICADAS (Usuarios normales)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Perfil
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('edit-password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
    
    // Equipos (usuarios autenticados)
    Route::prefix('teams')->name('teams.')->group(function () {
        Route::get('/create', [TeamController::class, 'create'])->name('create');
        Route::post('/', [TeamController::class, 'store'])->name('store');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit');
        Route::put('/{team}', [TeamController::class, 'update'])->name('update');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
        Route::get('/join/form', [TeamController::class, 'join'])->name('join');
        Route::post('/join/process', [TeamController::class, 'joinTeam'])->name('join.process');
        Route::post('/{team}/leave', [TeamController::class, 'leave'])->name('leave');
    });
    
    // Proyectos
    Route::resource('projects', ProjectController::class);
});

/*
|--------------------------------------------------------------------------
| ADMINISTRADOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/estadisticas', [AdminController::class, 'estadisticas'])->name('estadisticas');
    
    // Gestión de Eventos (ADMIN)
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy');
        
        // Asignar jueces
        Route::get('/{id}/jueces', [AdminController::class, 'asignarJuecesForm'])->name('asignar-jueces');
        Route::post('/{id}/jueces', [AdminController::class, 'asignarJueces'])->name('asignar-jueces.store');
        Route::delete('/{id}/jueces/{juezId}', [AdminController::class, 'removerJuez'])->name('remover-juez');
    });
    
    // Gestión de Jueces
    Route::prefix('jueces')->name('jueces.')->group(function () {
        Route::get('/', [AdminController::class, 'jueces'])->name('index');
    });
    
    // Gestión de Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [AdminController::class, 'usuarios'])->name('index');
        Route::get('/{id}', [AdminController::class, 'mostrarUsuario'])->name('show');
        
        // ELIMINA ESTA LÍNEA COMENTADA Y DEJA SOLO UNA:
        Route::post('/cambiar-rol', [AdminController::class, 'cambiarRol'])->name('cambiar-rol');
        // O si prefieres PUT en lugar de POST:
        // Route::put('/cambiar-rol', [AdminController::class, 'cambiarRol'])->name('cambiar-rol');
        
        Route::delete('/{id}/banear', [AdminController::class, 'banearUsuario'])->name('banear');
        Route::post('/{id}/restaurar', [AdminController::class, 'restaurarUsuario'])->name('restaurar');
    });
    
    // Gestión de Equipos
    Route::prefix('equipos')->name('equipos.')->group(function () {
        Route::get('/', [AdminController::class, 'equipos'])->name('index');
        Route::get('/{id}', [AdminController::class, 'mostrarEquipo'])->name('show');
        Route::put('/{id}/banear', [AdminController::class, 'banearEquipo'])->name('banear');
        Route::put('/{id}/desbanear', [AdminController::class, 'desbanearEquipo'])->name('desbanear');
    });
    
    // Users resource
    Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
});

/*
|--------------------------------------------------------------------------
| JUEZ
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\CheckJudge::class])
    ->prefix('judge')
    ->name('judge.')
    ->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [JudgeController::class, 'dashboard'])->name('dashboard');
    Route::get('/estadisticas', [JudgeController::class, 'estadisticas'])->name('estadisticas');
    
    // Perfil del juez
    Route::prefix('perfil')->name('perfil.')->group(function () {
        Route::get('/', [JudgeController::class, 'perfil'])->name('index');
        Route::put('/', [JudgeController::class, 'actualizarPerfil'])->name('update');
        Route::put('/password', [JudgeController::class, 'cambiarPassword'])->name('password');
    });
    
    // Eventos asignados
    Route::prefix('eventos')->name('eventos.')->group(function () {
        Route::get('/', [JudgeController::class, 'misEventos'])->name('index');
        Route::get('/{evento}/equipos', [JudgeController::class, 'equiposEvento'])->name('equipos');
        Route::get('/{evento}/equipo/{equipo}', [JudgeController::class, 'verEquipo'])->name('equipo.show');
    });
    
    // Evaluar proyectos
    Route::prefix('proyectos')->name('proyectos.')->group(function () {
        Route::get('/{proyecto}/evaluar', [JudgeController::class, 'evaluarProyecto'])->name('evaluar');
        Route::post('/{proyecto}/calificar', [JudgeController::class, 'calificarProyecto'])->name('calificar');
    });
    
    // Historial
    Route::prefix('historial')->name('historial.')->group(function () {
        Route::get('/', [JudgeController::class, 'historialEvaluaciones'])->name('index');
        Route::get('/evaluacion/{id}', [JudgeController::class, 'verEvaluacion'])->name('show');
    });
});

/*
|--------------------------------------------------------------------------
| RUTAS DE PRUEBA (Solo en desarrollo)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    Route::get('/test-admin', function () {
        return 'Eres admin! ✅';
    })->middleware(['auth', \App\Http\Middleware\CheckAdmin::class]);

    Route::get('/test-juez', function () {
        return 'Eres juez! ✅';
    })->middleware(['auth', \App\Http\Middleware\CheckJudge::class]);
}