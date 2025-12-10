<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->withCount([
                'teams',
                'teams as teams_con_proyecto' => function($query) {
                    $query->whereHas('proyecto');
                }
            ])
            ->where('fin_evento', '>=', now()->subDays(7))
            ->orderBy('inicio_evento', 'desc')
            ->take(6)
            ->get();
        
        // Equipos pendientes por calificar (top 5 más urgentes)
        $pendientesPorCalificar = Team::whereHas('evento', function($query) use ($user) {
                $query->whereHas('jueces', function($q) use ($user) {
                    $q->where('users.id', $user->id);
                })
                ->where('fin_evento', '>=', now());
            })
            ->whereHas('proyecto')
            ->whereDoesntHave('proyecto.evaluaciones', function($query) use ($user) {
                $query->where('judge_id', $user->id);
            })
            ->with(['evento', 'lider', 'proyecto'])
            ->orderBy('created_at', 'asc')
            ->take(5)
            ->get();
        
        // Estadísticas del juez
        $totalEvaluaciones = Evaluation::where('judge_id', $user->id)->count();
        $promedioGeneral = Evaluation::where('judge_id', $user->id)->avg('total_score') ?? 0;
        
        $stats = [
            'total_eventos' => $user->eventosComoJuez()->count(),
            'total_evaluaciones' => $totalEvaluaciones,
            'pendientes_por_calificar' => $pendientesPorCalificar->count(),
            'promedio_calificaciones' => round($promedioGeneral, 2),
        ];
        
        // Últimas evaluaciones realizadas
        $ultimasEvaluaciones = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento', 'project.team.lider'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('judge.dashboard', compact(
            'eventos', 
            'pendientesPorCalificar', 
            'stats', 
            'ultimasEvaluaciones'
        ));
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
            ->paginate(12)
            ->through(function($evento) use ($user) {
                // Agregar estadísticas de evaluación para cada evento
                $evento->mis_evaluaciones = Evaluation::where('judge_id', $user->id)
                    ->whereHas('project.team', function($query) use ($evento) {
                        $query->where('evento_id', $evento->id);
                    })
                    ->count();
                
                return $evento;
            });
        
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
        
        // Obtener equipos con sus proyectos y evaluaciones del juez actual
        $equipos = Team::where('evento_id', $eventoId)
            ->with([
                'lider', 
                'proyecto' => function($query) use ($user) {
                    $query->with(['evaluaciones' => function($q) use ($user) {
                        $q->where('judge_id', $user->id);
                    }]);
                }
            ])
            ->orderBy('nombre')
            ->paginate(20);
        
        // Estadísticas del evento para este juez
        $estadisticasEvento = [
            'total_equipos' => Team::where('evento_id', $eventoId)->count(),
            'con_proyecto' => Team::where('evento_id', $eventoId)->whereHas('proyecto')->count(),
            'evaluados_por_mi' => Evaluation::where('judge_id', $user->id)
                ->whereHas('project.team', function($query) use ($eventoId) {
                    $query->where('evento_id', $eventoId);
                })
                ->count(),
            'pendientes' => Team::where('evento_id', $eventoId)
                ->whereHas('proyecto')
                ->whereDoesntHave('proyecto.evaluaciones', function($query) use ($user) {
                    $query->where('judge_id', $user->id);
                })
                ->count(),
        ];
        
        return view('judge.eventos.equipos', compact('evento', 'equipos', 'estadisticasEvento'));
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
                $query->with([
                    'evaluaciones' => function($q) use ($user) {
                        $q->where('judge_id', $user->id);
                    },
                    'evaluaciones as todas_evaluaciones'
                ]);
            }
        ])->findOrFail($equipoId);
        
        // Verificar que el equipo pertenece al evento
        if ($equipo->evento_id != $eventoId) {
            abort(404, 'El equipo no pertenece a este evento');
        }
        
        // Obtener estadísticas del proyecto si existe
        $estadisticasProyecto = null;
        if ($equipo->proyecto) {
            $estadisticasProyecto = [
                'total_evaluaciones' => $equipo->proyecto->evaluaciones->count(),
                'promedio_general' => $equipo->proyecto->evaluaciones->avg('total_score') ?? 0,
                'evaluado_por_mi' => $equipo->proyecto->evaluaciones->where('judge_id', $user->id)->isNotEmpty(),
                'mi_calificacion' => $equipo->proyecto->evaluaciones->where('judge_id', $user->id)->first()?->total_score ?? null,
            ];
        }
        
        return view('judge.eventos.equipo', compact('equipo', 'estadisticasProyecto'));
    }
    
    /**
     * Formulario para evaluar un proyecto
     */
    public function evaluarProyecto($proyectoId)
    {
        $user = Auth::user();
        $proyecto = Project::with(['team.evento', 'team.lider'])->findOrFail($proyectoId);
        
        // Verificar que el juez puede evaluar este proyecto
        if (!$user->esJuezDe($proyecto->team->evento_id) && !$user->hasRole('admin')) {
            abort(403, 'No puedes evaluar este proyecto');
        }
        
        // Verificar si ya existe una evaluación
        $evaluacionExistente = Evaluation::where('judge_id', $user->id)
            ->where('project_id', $proyectoId)
            ->first();
        
        // Obtener otras evaluaciones del proyecto (para referencia)
        $otrasEvaluaciones = Evaluation::where('project_id', $proyectoId)
            ->where('judge_id', '!=', $user->id)
            ->with('judge:id,name')
            ->get();
        
        return view('judge.proyectos.evaluar', compact('proyecto', 'evaluacionExistente', 'otrasEvaluaciones'));
    }
    
    /**
     * Guardar evaluación de un proyecto
     */
    public function calificarProyecto(Request $request, $proyectoId)
    {
        $user = Auth::user();
        $proyecto = Project::with('team.evento')->findOrFail($proyectoId);
        
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
        ], [
            'score_innovacion.required' => 'La calificación de innovación es obligatoria',
            'score_innovacion.min' => 'La calificación mínima es 1',
            'score_innovacion.max' => 'La calificación máxima es 10',
            'score_funcionalidad.required' => 'La calificación de funcionalidad es obligatoria',
            'score_diseno.required' => 'La calificación de diseño es obligatoria',
            'score_presentacion.required' => 'La calificación de presentación es obligatoria',
            'comments.max' => 'Los comentarios no pueden exceder 1000 caracteres',
        ]);
        
        // Calcular puntaje total (promedio de las 4 categorías)
        $totalScore = (
            $validated['score_innovacion'] +
            $validated['score_funcionalidad'] +
            $validated['score_diseno'] +
            $validated['score_presentacion']
        ) / 4;
        
        // Crear o actualizar evaluación
        $evaluacion = Evaluation::updateOrCreate(
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
        
        $mensaje = $evaluacion->wasRecentlyCreated 
            ? 'Proyecto calificado exitosamente' 
            : 'Evaluación actualizada correctamente';
        
        return redirect()->route('judge.eventos.equipos', $proyecto->team->evento_id)
            ->with('success', $mensaje);
    }
    
    /**
     * Historial de evaluaciones del juez
     */
    public function historialEvaluaciones(Request $request)
    {
        $user = Auth::user();
        
        $query = Evaluation::where('judge_id', $user->id)
            ->with(['project.team.evento', 'project.team.lider']);
        
        // Filtros opcionales
        if ($request->filled('evento_id')) {
            $query->whereHas('project.team', function($q) use ($request) {
                $q->where('evento_id', $request->evento_id);
            });
        }
        
        if ($request->filled('score_range')) {
            $range = explode('-', $request->score_range);
            if (count($range) == 2) {
                $query->whereBetween('total_score', [(float)$range[0], (float)$range[1]]);
            }
        }
        
        $evaluaciones = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $estadisticas = [
            'total_evaluaciones' => Evaluation::where('judge_id', $user->id)->count(),
            'promedio_general' => Evaluation::where('judge_id', $user->id)->avg('total_score') ?? 0,
            'mejor_calificacion' => Evaluation::where('judge_id', $user->id)->max('total_score') ?? 0,
            'peor_calificacion' => Evaluation::where('judge_id', $user->id)->min('total_score') ?? 0,
        ];
        
        // Obtener lista de eventos para el filtro
        $eventosConEvaluaciones = Event::whereHas('teams.proyecto.evaluaciones', function($query) use ($user) {
            $query->where('judge_id', $user->id);
        })->pluck('nombre', 'id');
        
        return view('judge.historial.index', compact('evaluaciones', 'estadisticas', 'eventosConEvaluaciones'));
    }
    
    /**
     * Ver detalles de una evaluación específica
     */
    public function verEvaluacion($evaluacionId)
    {
        $user = Auth::user();
        
        $evaluacion = Evaluation::where('judge_id', $user->id)
            ->with([
                'project.team.evento', 
                'project.team.lider',
                'project.team.miembros',
                juez
            ])
            ->findOrFail($evaluacionId);
        
        // Obtener otras evaluaciones del mismo proyecto (para comparación)
        $otrasEvaluaciones = Evaluation::where('project_id', $evaluacion->project_id)
            ->where('judge_id', '!=', $user->id)
            ->with('judge:id,name')
            ->get();
        
        // Calcular promedio del proyecto
        $promedioProyecto = Evaluation::where('project_id', $evaluacion->project_id)
            ->avg('total_score') ?? 0;
        
        return view('judge.historial.show', compact('evaluacion', 'otrasEvaluaciones', 'promedioProyecto'));
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
            'promedio_innovacion' => Evaluation::where('judge_id', $user->id)->avg('score_innovacion') ?? 0,
            'promedio_funcionalidad' => Evaluation::where('judge_id', $user->id)->avg('score_funcionalidad') ?? 0,
            'promedio_diseno' => Evaluation::where('judge_id', $user->id)->avg('score_diseno') ?? 0,
            'promedio_presentacion' => Evaluation::where('judge_id', $user->id)->avg('score_presentacion') ?? 0,
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
            ->withCount(['teams as evaluaciones_count' => function($query) use ($user) {
                $query->whereHas('proyecto.evaluaciones', function($q) use ($user) {
                    $q->where('judge_id', $user->id);
                });
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
        
        // Actividad por mes (últimos 6 meses)
        $actividadMensual = Evaluation::where('judge_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                DB::raw('COUNT(*) as total'),
                DB::raw('AVG(total_score) as promedio')
            )
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->get();
        
        return view('judge.estadisticas.index', compact(
            'stats', 
            'distribucionCalificaciones', 
            'eventosActivos', 
            'ultimasEvaluaciones',
            'actividadMensual'
        ));
    }
}