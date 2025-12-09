<?php

use App\Http\Controllers\{
    AuthController,
    EventController,
    ProfileController,
    UserController,
    ProjectController,
    TeamController,
<<<<<<< Updated upstream
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
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

=======
    JudgeController,
    UserManagementController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ==================== PÁGINA PRINCIPAL ====================
Route::get('/', [EventController::class, 'index'])->name('home');

// ==================== AUTENTICACIÓN (SOLO INVITADOS) ====================
>>>>>>> Stashed changes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

<<<<<<< Updated upstream
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
// Login POST (con redirección por rol)
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

// Logout

Route::get('/test-email', function () {
    $user = \App\Models\User::find(54);
    $userDestination = \App\Models\User::find(55);
    $team = \App\Models\Team::first();
    $answer = 'aceptada';
    $mailController = new \App\Http\Controllers\MailController();
    return $mailController->sendTeamAnswerEmail($user, $userDestination, $team, $answer);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});

Route::middleware(['auth','role:user'])->group(function () {
    // Rutas CRUD de eventos
    // Rutas para ver mis equipos
    Route::get('/my-teams', [TeamController::class, 'myTeams'])->name('teams.my-teams');
    // Rutas CRUD de equipos
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    
    // Rutas para unirse a equipos
    Route::get('/teams/join/form', [TeamController::class, 'join'])->name('teams.join');
    Route::post('/teams/join/process', [TeamController::class, 'joinTeam'])->name('teams.join.process');
    Route::post('/teams/join/send', [TeamController::class, 'sendJoinRequest'])
    ->name('teams.join.send');
    Route::post('/teams/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');

    //Rutas para invitaciones del lider a nuevos miembros
    Route::get('/teams/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
    Route::post('/teams/{team}/invite', [TeamController::class, 'sendInvitation'])->name('teams.send-invitation');
    Route::get('/my-invitations', [TeamController::class, 'myInvitations'])->name('teams.my-invitations');
    Route::post('/invitations/{invitation}/accept', [TeamController::class, 'acceptInvitation'])->name('invitations.accept');
    Route::post('/invitations/{invitation}/reject', [TeamController::class, 'rejectInvitation'])->name('invitations.reject');
    Route::delete('/invitations/{invitation}/cancel', [TeamController::class, 'cancelInvitation'])->name('invitations.cancel');

    //Rutas para nuevas solicitudes
    Route::post('/teams/{team}/request', [TeamController::class, 'sendRequest'])->name('teams.send-request');
    Route::get('/my-solicitudes', [TeamController::class, 'mySolicitudes'])->name('teams.my-solicitudes');
    Route::post('/solicitudes/{invitation}/accept', [TeamController::class, 'acceptRequest'])->name('solicitudes.accept');
    Route::post('/solicitudes/{invitation}/reject', [TeamController::class, 'rejectRequest'])->name('solicitudes.reject');
});

// Ruta de teams/{team} al final para evitar conflictos
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');

// Ruta de logout (requiere estar autenticado)
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
    // Route::prefix('teams')->name('teams.')->group(function () {
    //     Route::get('/create', [TeamController::class, 'create'])->name('create');
    //     Route::post('/', [TeamController::class, 'store'])->name('store');
    //     Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit');
    //     Route::put('/{team}', [TeamController::class, 'update'])->name('update');
    //     Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
    //     Route::get('/join/form', [TeamController::class, 'join'])->name('join');
    //     Route::post('/join/process', [TeamController::class, 'joinTeam'])->name('join.process');
    //     Route::post('/{team}/leave', [TeamController::class, 'leave'])->name('leave');
    // });
    
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
| API ENDPOINTS
|--------------------------------------------------------------------------
*/

// API para buscar jueces (requiere autenticación de admin)
Route::middleware(['auth', 'role:admin'])->prefix('api')->name('api.')->group(function () {
    Route::get('/judges/search', [JudgeController::class, 'searchJudges'])->name('judges.search');
});

/*
|--------------------------------------------------------------------------
| RUTAS DE PRUEBA (Solo en desarrollo)
|--------------------------------------------------------------------------
*/
=======
// Logout (requiere autenticación)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== RUTAS PÚBLICAS DE EVENTOS ====================
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/search', [EventController::class, 'search'])->name('search');
    Route::get('/{id}', [EventController::class, 'show'])->name('show');
    Route::get('/{id}/teams', [EventController::class, 'teams'])->name('teams.index');
});

// ==================== RUTAS PÚBLICAS DE EQUIPOS ====================
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');

// ==================== RUTAS PROTEGIDAS (REQUIEREN AUTENTICACIÓN) ====================
Route::middleware('auth')->group(function () {
    
    // ==================== PERFIL DE USUARIO ====================
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('edit-password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
    });

    // ==================== GESTIÓN DE EQUIPOS (USUARIOS AUTENTICADOS) ====================
    Route::prefix('teams')->name('teams.')->group(function () {
        Route::get('/create', [TeamController::class, 'create'])->name('create');
        Route::post('/', [TeamController::class, 'store'])->name('store');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit');
        Route::put('/{team}', [TeamController::class, 'update'])->name('update');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
        
        // Unirse/Salir de equipos
        Route::get('/join', [TeamController::class, 'join'])->name('join');
        Route::post('/join', [TeamController::class, 'joinTeam'])->name('join.process');
        Route::post('/{team}/leave', [TeamController::class, 'leave'])->name('leave');
    });

    // ==================== PROYECTOS ====================
    Route::resource('projects', ProjectController::class);
});

// ==================== RUTAS DE ADMINISTRACIÓN (SOLO ADMINISTRADORES) ====================
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    
    // ==================== GESTIÓN DE USUARIOS ====================
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create');
        Route::post('/', [UserManagementController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/change-role', [UserManagementController::class, 'changeRole'])->name('change-role');
    });
    
    // ==================== GESTIÓN DE JUECES ====================
    Route::get('/judges', [UserManagementController::class, 'judges'])->name('judges.index');
    
    // ==================== GESTIÓN DE EVENTOS (ADMINISTRADOR) ====================
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy');
        
        // Asignación de jueces
        Route::post('/{event}/assign-judge', [EventController::class, 'assignJudge'])->name('assign-judge');
        Route::delete('/{event}/judges/{judge}', [EventController::class, 'removeJudge'])->name('remove-judge');
    });
});

// ==================== RUTAS PARA JUECES ====================
Route::middleware(['auth', 'role:juez'])->prefix('judge')->name('judge.')->group(function () {
    Route::get('/', [JudgeController::class, 'index'])->name('dashboard');
    Route::get('/events/{event}', [JudgeController::class, 'showEvent'])->name('events.show');
    Route::get('/events/{event}/teams/{team}', [JudgeController::class, 'showTeam'])->name('evaluate-team');
    Route::post('/events/{event}/teams/{team}/score', [JudgeController::class, 'storeScore'])->name('store-score');
    Route::get('/evaluated-teams', [JudgeController::class, 'evaluatedTeams'])->name('evaluated-teams');
    Route::post('/events/{event}/criteria', [JudgeController::class, 'addCriteria'])->name('add-criteria');
});

// ==================== RUTA TEMPORAL (PASSWORD RESET) ====================
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('error', 'Función en desarrollo');
})->name('password.request');
>>>>>>> Stashed changes
