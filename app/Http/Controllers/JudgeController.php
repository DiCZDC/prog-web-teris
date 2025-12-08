<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudgeController extends Controller
{
    /**
     * Dashboard principal del juez
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Eventos donde es juez (activos y próximos)
        $eventos = $user->eventosComoJuez()
            ->withCount(['teams', 'teams as teams_con_proyecto' => function($query) {
                $query->whereHas('proyecto');
            }])
            ->where('fin_evento', '>=', now()->subDays(7)) // Eventos recientes o futuros
            ->orderBy('inicio_evento', 'desc')
            ->take(6)
            ->get();
        
        // Equipos pendientes por calificar
        $pendientesPorCalificar = Team::whereHas('evento', function($query) use ($user) {
                $query->whereHas('jueces', function($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
            })
            ->whereHas('proyecto')
            ->with(['evento', 'lider', 'proyecto' => function($query) use ($user) {
                $query->with(['evaluaciones' => function($q) use ($user) {
                    $q->where('judge_id', $user->id);
                }]);
            }])
            ->get()
            ->filter(function($equipo) {
                // Solo equipos con proyecto
                return $equipo->proyecto !== null;
            })
            ->filter(function($equipo) {
                // Que no haya sido evaluado por este juez
                return $equipo->proyecto->evaluaciones->isEmpty();
            })
            ->take(5);
        
        // Estadísticas del juez
        $stats = [
            'total_eventos' => $user->eventosComoJuez()->count(),
            'total_evaluaciones' => Evaluation::where('judge_id', $user->id)->count(),
            'pendientes_por_calificar' => $pendientesPorCalificar->count(),
            'promedio_calificaciones' => Evaluation::where('judge_id', $user->id)->avg('total_score') ?? 0,
        ];
        
        // Últimas evaluaciones realizadas
        $ultimasEvaluaciones = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('judge.dashboard', compact('eventos', 'pendientesPorCalificar', 'stats', 'ultimasEvaluaciones'));
    }
    
    /**
     * Lista de eventos asignados al juez
     */
    public function misEventos()
    {
        $user = Auth::user();
        
        $eventos = $user->eventosComoJuez()
            ->withCount(['teams', 'teams as teams_con_proyecto' => function($query) {
                $query->whereHas('proyecto');
            }])
            ->orderBy('inicio_evento', 'desc')
            ->paginate(12);
        
        return view('judge.eventos.index', compact('eventos'));
    }
    
    /**
     * Ver equipos de un evento específico
     */
    public function equiposEvento($eventoId)
    {
        $user = Auth::user();
        $evento = Event::findOrFail($eventoId);
        
        // Verificar que el juez está asignado a este evento
        if (!$user->esJuezDe($eventoId) && !$user->hasRole('admin')) {
            abort(403, 'No tienes permisos para ver los equipos de este evento');
        }
        
        $equipos = Team::where('evento_id', $eventoId)
            ->with(['lider', 'proyecto' => function($query) use ($user) {
                $query->with(['evaluaciones' => function($q) use ($user) {
                    $q->where('judge_id', $user->id);
                }]);
            }])
            ->paginate(20);
        
        return view('judge.eventos.equipos', compact('evento', 'equipos'));
    }
    
    /**
     * Ver detalles de un equipo específico
     */
    public function verEquipo($eventoId, $equipoId)
    {
        $user = Auth::user();
        
        // Verificar permisos
        if (!$user->esJuezDe($eventoId) && !$user->hasRole('admin')) {
            abort(403, 'No tienes permisos para ver este equipo');
        }
        
        $equipo = Team::with([
            'lider', 
            'disenador', 
            'frontprog', 
            'backprog', 
            'evento',
            'proyecto' => function($query) use ($user) {
                $query->with(['evaluaciones' => function($q) use ($user) {
                    $q->where('judge_id', $user->id);
                }]);
            }
        ])->findOrFail($equipoId);
        
        // Verificar que el equipo pertenece al evento
        if ($equipo->evento_id != $eventoId) {
            abort(404, 'El equipo no pertenece a este evento');
        }
        
        return view('judge.eventos.equipo', compact('equipo'));
    }
    
    /**
     * Formulario para evaluar un proyecto
     */
    public function evaluarProyecto($proyectoId)
    {
        $user = Auth::user();
        $proyecto = Project::with(['team', 'team.evento'])->findOrFail($proyectoId);
        
        // Verificar que el juez puede evaluar este proyecto
        if (!$user->esJuezDe($proyecto->team->evento_id) && !$user->hasRole('admin')) {
            abort(403, 'No puedes evaluar este proyecto');
        }
        
        // Verificar si ya existe una evaluación
        $evaluacionExistente = Evaluation::where('judge_id', $user->id)
            ->where('project_id', $proyectoId)
            ->first();
        
        return view('judge.proyectos.evaluar', compact('proyecto', 'evaluacionExistente'));
    }
    
    /**
     * Guardar evaluación de un proyecto
     */
    public function calificarProyecto(Request $request, $proyectoId)
    {
        $user = Auth::user();
        $proyecto = Project::findOrFail($proyectoId);
        
        // Verificar permisos
        if (!$user->esJuezDe($proyecto->team->evento_id) && !$user->hasRole('admin')) {
            abort(403, 'No puedes evaluar este proyecto');
        }
        
        $validated = $request->validate([
            'score_innovacion' => 'required|integer|min:1|max:10',
            'score_funcionalidad' => 'required|integer|min:1|max:10',
            'score_diseno' => 'required|integer|min:1|max:10',
            'score_presentacion' => 'required|integer|min:1|max:10',
            'comments' => 'nullable|string|max:1000',
        ]);
        
        // Calcular puntaje total (promedio de las 4 categorías)
        $totalScore = (
            $validated['score_innovacion'] +
            $validated['score_funcionalidad'] +
            $validated['score_diseno'] +
            $validated['score_presentacion']
        ) / 4;
        
        // Crear o actualizar evaluación
        Evaluation::updateOrCreate(
            [
                'judge_id' => $user->id,
                'project_id' => $proyectoId,
            ],
            [
                'score_innovacion' => $validated['score_innovacion'],
                'score_funcionalidad' => $validated['score_funcionalidad'],
                'score_diseno' => $validated['score_diseno'],
                'score_presentacion' => $validated['score_presentacion'],
                'total_score' => round($totalScore, 2),
                'comments' => $validated['comments'] ?? null,
            ]
        );
        
        return redirect()->route('judge.eventos.equipos', $proyecto->team->evento_id)
            ->with('success', 'Proyecto calificado exitosamente');
    }
    
    /**
     * Historial de evaluaciones del juez
     */
    public function historialEvaluaciones()
    {
        $user = Auth::user();
        
        $evaluaciones = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $estadisticas = [
            'total_evaluaciones' => $evaluaciones->total(),
            'promedio_general' => Evaluation::where('judge_id', $user->id)->avg('total_score') ?? 0,
            'mejor_calificacion' => Evaluation::where('judge_id', $user->id)->max('total_score') ?? 0,
            'peor_calificacion' => Evaluation::where('judge_id', $user->id)->min('total_score') ?? 0,
        ];
        
        return view('judge.historial.index', compact('evaluaciones', 'estadisticas'));
    }
    
    /**
     * Ver detalles de una evaluación específica
     */
    public function verEvaluacion($evaluacionId)
    {
        $user = Auth::user();
        
        $evaluacion = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento', 'project.team.lider'])
            ->findOrFail($evaluacionId);
        
        return view('judge.historial.show', compact('evaluacion'));
    }
    
    /**
     * Estadísticas del juez
     */
    public function estadisticas()
    {
        $user = Auth::user();
        
        // Estadísticas generales
        $stats = [
            'total_eventos' => $user->eventosComoJuez()->count(),
            'total_equipos_evaluados' => Evaluation::where('judge_id', $user->id)
                ->distinct('project_id')
                ->count('project_id'),
            'total_evaluaciones' => Evaluation::where('judge_id', $user->id)->count(),
            'promedio_general' => Evaluation::where('judge_id', $user->id)->avg('total_score') ?? 0,
        ];
        
        // Distribución de calificaciones
        $distribucionCalificaciones = [
            'excelente' => Evaluation::where('judge_id', $user->id)->where('total_score', '>=', 9)->count(),
            'bueno' => Evaluation::where('judge_id', $user->id)->whereBetween('total_score', [7, 8.99])->count(),
            'regular' => Evaluation::where('judge_id', $user->id)->whereBetween('total_score', [5, 6.99])->count(),
            'deficiente' => Evaluation::where('judge_id', $user->id)->where('total_score', '<', 5)->count(),
        ];
        
        // Eventos con más evaluaciones
        $eventosActivos = $user->eventosComoJuez()
            ->where('fin_evento', '>=', now()->subDays(30))
            ->withCount(['evaluaciones' => function($query) use ($user) {
                $query->where('judge_id', $user->id);
            }])
            ->orderBy('evaluaciones_count', 'desc')
            ->take(5)
            ->get();
        
        // Últimas evaluaciones
        $ultimasEvaluaciones = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('judge.estadisticas.index', compact('stats', 'distribucionCalificaciones', 'eventosActivos', 'ultimasEvaluaciones'));
    }
    
    /**
     * Ver perfil del juez
     */
    public function perfil()
    {
        $user = Auth::user();
        
        $estadisticas = [
            'total_eventos' => $user->eventosComoJuez()->count(),
            'total_evaluaciones' => Evaluation::where('judge_id', $user->id)->count(),
            'fecha_registro' => $user->created_at->format('d/m/Y'),
            'ultima_evaluacion' => Evaluation::where('judge_id', $user->id)
                ->latest()
                ->first()
                ->created_at->diffForHumans() ?? 'Nunca',
        ];
        
        return view('judge.perfil.index', compact('user', 'estadisticas'));
    }
    
    /**
     * Actualizar perfil del juez
     */
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'biografia' => 'nullable|string|max:500',
            'especialidad' => 'nullable|string|max:255',
        ]);
        
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'biografia' => $validated['biografia'] ?? null,
            'especialidad' => $validated['especialidad'] ?? null,
        ]);
        
        return redirect()->route('judge.perfil')
            ->with('success', 'Perfil actualizado correctamente');
    }
    
    /**
     * Cambiar contraseña del juez
     */
    public function cambiarPassword(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user->update([
            'password' => bcrypt($validated['password']),
        ]);
        
        return redirect()->route('judge.perfil')
            ->with('success', 'Contraseña cambiada correctamente');
    }
}