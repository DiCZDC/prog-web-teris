<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Dashboard del administrador
     */
    public function dashboard()
    {
        $stats = [
            'total_eventos' => Event::count(),
            'eventos_activos' => Event::where('estado', 'Activo')->count(),
            'total_usuarios' => User::count(),
            'total_equipos' => Team::count(),
            'total_jueces' => User::role('juez')->count(),
            'total_proyectos' => Project::count(),
        ];

        $eventosRecientes = Event::latest()->take(5)->get();
        $usuariosRecientes = User::latest()->take(5)->get();
        $equiposRecientes = Team::with('evento')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'eventosRecientes', 'usuariosRecientes', 'equiposRecientes'));
    }

    /**
     * Gestión de usuarios
     */
    public function usuarios()
    {
        $usuarios = User::with(['roles' => function($query) {
            $query->select('name');
        }])
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar detalles de un usuario
     */
    public function mostrarUsuario($id)
    {
        $usuario = User::with(['roles', 'equiposLiderados.evento', 'equiposComoDisenador.evento', 
                              'equiposComoFront.evento', 'equiposComoBack.evento'])
            ->findOrFail($id);

        // Combinar todos los equipos del usuario
        $todosLosEquipos = collect()
            ->merge($usuario->equiposLiderados)
            ->merge($usuario->equiposComoDisenador)
            ->merge($usuario->equiposComoFront)
            ->merge($usuario->equiposComoBack)
            ->unique('id');

        // Eventos donde es juez
        $eventosComoJuez = $usuario->eventosComoJuez()->get();

        return view('admin.usuarios.show', compact('usuario', 'todosLosEquipos', 'eventosComoJuez'));
    }

    /**
     * Cambiar rol de usuario
     */
    public function cambiarRol(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'role' => 'required|in:admin,juez,user'
        ]);

        // Remover todos los roles existentes
        $user->roles()->detach();
        
        // Asignar nuevo rol
        $user->assignRole($validated['role']);

        return redirect()->route('admin.usuarios.show', $id)
            ->with('success', 'Rol actualizado correctamente a ' . ucfirst($validated['role']));
    }

    /**
     * Banear usuario (soft delete)
     */
    public function banearUsuario($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes banear tu propia cuenta');
        }

        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario baneado exitosamente');
    }

    /**
     * Restaurar usuario baneado
     */
    public function restaurarUsuario($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        
        if ($user->trashed()) {
            $user->restore();
            return redirect()->route('admin.usuarios.index')
                ->with('success', 'Usuario restaurado exitosamente');
        }

        return back()->with('error', 'El usuario no está baneado');
    }

    /**
     * Crear nuevo usuario (especialmente juez)
     */
    public function crearUsuario(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,juez,user',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar rol
        $user->assignRole($validated['role']);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado exitosamente como ' . ucfirst($validated['role']));
    }

    /**
     * Gestión de equipos
     */
    public function equipos()
    {
        $equipos = Team::with(['lider:id,name,email', 'evento:id,nombre'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    
        return view('admin.equipos.index', compact('equipos'));
    }

    /**
     * Mostrar detalles de un equipo
     */
    public function mostrarEquipo($id)
    {
        $equipo = Team::with(['lider', 'disenador', 'frontprog', 'backprog', 'evento', 'proyecto'])
            ->findOrFail($id);

        return view('admin.equipos.show', compact('equipo'));
    }

    /**
     * Banear equipo
     */
    public function banearEquipo($id)
    {
        $team = Team::findOrFail($id);
        $team->update(['estado' => 'Inactivo']);

        return redirect()->route('admin.equipos.index')
            ->with('success', 'Equipo baneado exitosamente');
    }

    /**
     * Desbanear equipo
     */
    public function desbanearEquipo($id)
    {
        $team = Team::findOrFail($id);
        $team->update(['estado' => 'Activo']);

        return redirect()->route('admin.equipos.index')
            ->with('success', 'Equipo desbaneado exitosamente');
    }

    /**
     * Gestión de jueces
     */
    public function jueces()
    {
        $jueces = User::role('juez')
            ->withCount('eventosComoJuez')
            ->with(['eventosComoJuez' => function($query) {
                $query->select('events.id', 'events.nombre')->latest('events.created_at')->take(3);
            }])
            ->paginate(20);
        
        return view('admin.jueces.index', compact('jueces'));
    }

    /**
     * Mostrar formulario para asignar jueces a un evento
     */
    public function asignarJuecesForm($id)
    {
        $evento = Event::with(['jueces' => function($query) {
            $query->select('users.id', 'users.name', 'users.email');
        }])->findOrFail($id);
        
        $juecesDisponibles = User::role('juez')
            ->whereNotIn('id', $evento->jueces->pluck('id'))
            ->get(['id', 'name', 'email']);

        return view('admin.eventos.asignar-jueces', compact('evento', 'juecesDisponibles'));
    }

    /**
     * Procesar asignación de jueces
     */
    public function asignarJueces(Request $request, $id)
    {
        $evento = Event::findOrFail($id);
        
        $validated = $request->validate([
            'jueces' => 'required|array|min:1',
            'jueces.*' => 'exists:users,id'
        ]);

        $evento->jueces()->sync($validated['jueces']);

        // Notificar a los jueces (opcional)
        foreach ($validated['jueces'] as $juezId) {
            $juez = User::find($juezId);
            // Aquí puedes agregar notificaciones por email
        }

        return redirect()->route('admin.events.asignar-jueces', $id)
            ->with('success', 'Jueces asignados correctamente');
    }

    /**
     * Remover juez de un evento
     */
    public function removerJuez($eventoId, $juezId)
    {
        $evento = Event::findOrFail($eventoId);
        $evento->jueces()->detach($juezId);

        return redirect()->route('admin.events.asignar-jueces', $eventoId)
            ->with('success', 'Juez removido del evento');
    }

    /**
     * Mostrar estadísticas del sistema
     */
    public function estadisticas()
    {
        $stats = [
            'total_eventos' => Event::count(),
            'eventos_activos' => Event::where('estado', 'Activo')->count(),
            'eventos_inactivos' => Event::where('estado', 'Inactivo')->count(),
            'total_usuarios' => User::count(),
            'usuarios_admin' => User::role('admin')->count(),
            'usuarios_juez' => User::role('juez')->count(),
            'usuarios_regular' => User::role('user')->count(),
            'total_equipos' => Team::count(),
            'equipos_activos' => Team::where('estado', 'Activo')->count(),
            'equipos_inactivos' => Team::where('estado', 'Inactivo')->count(),
            'total_proyectos' => Project::count(),
            'proyectos_evaluados' => Project::has('evaluaciones')->count(),
        ];

        // Eventos más populares (con más equipos)
        $eventosPopulares = Event::withCount('teams')
            ->orderBy('teams_count', 'desc')
            ->take(10)
            ->get();

        // Usuarios más activos
        $usuariosActivos = User::withCount(['equiposLiderados', 'equiposComoDisenador', 
                                          'equiposComoFront', 'equiposComoBack'])
            ->get()
            ->map(function($user) {
                $user->total_equipos = $user->equipos_liderados_count + 
                                      $user->equipos_como_disenador_count +
                                      $user->equipos_como_front_count +
                                      $user->equipos_como_back_count;
                return $user;
            })
            ->sortByDesc('total_equipos')
            ->take(10);

        // Mejores proyectos (por calificación)
        $mejoresProyectos = Project::with(['team', 'team.evento'])
            ->withAvg('evaluaciones', 'total_score')
            ->having('evaluaciones_avg_total_score', '>', 0)
            ->orderBy('evaluaciones_avg_total_score', 'desc')
            ->take(10)
            ->get();

        return view('admin.estadisticas', compact('stats', 'eventosPopulares', 'usuariosActivos', 'mejoresProyectos'));
    }

    /**
     * Vista para crear un usuario con rol específico
     */
    public function crearUsuarioForm()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Vista para editar un usuario
     */
    public function editarUsuarioForm($id)
    {
        $usuario = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualizar información de usuario
     */
    public function actualizarUsuario(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,juez,user',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Actualizar rol
        $user->roles()->detach();
        $user->assignRole($validated['role']);

        return redirect()->route('admin.usuarios.show', $id)
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Vista para administrar un evento específico
     */
    public function gestionarEvento($id)
    {
        $evento = Event::with(['teams', 'jueces', 'teams.proyecto'])
            ->findOrFail($id);

        $equiposPorCalificar = $evento->teams()
            ->whereHas('proyecto', function($query) {
                $query->doesntHave('evaluaciones');
            })
            ->count();

        return view('admin.eventos.gestionar', compact('evento', 'equiposPorCalificar'));
    }

    /**
     * Exportar datos del sistema
     */
    public function exportarDatos($tipo)
    {
        switch ($tipo) {
            case 'usuarios':
                $data = User::with('roles')->get();
                $filename = 'usuarios_' . date('Y-m-d') . '.csv';
                break;
                
            case 'eventos':
                $data = Event::withCount('teams')->get();
                $filename = 'eventos_' . date('Y-m-d') . '.csv';
                break;
                
            case 'equipos':
                $data = Team::with(['evento', 'lider'])->get();
                $filename = 'equipos_' . date('Y-m-d') . '.csv';
                break;
                
            default:
                return back()->with('error', 'Tipo de exportación no válido');
        }

        // Aquí implementarías la lógica de exportación CSV/Excel
        // Por ahora solo redireccionamos
        return back()->with('success', 'Función de exportación en desarrollo');
    }
}