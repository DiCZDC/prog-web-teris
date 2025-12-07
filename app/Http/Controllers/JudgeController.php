<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\TeamScore;
use App\Models\EvaluationCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudgeController extends Controller
{
    
    // Dashboard del juez - ver todos los eventos asignados
    public function index()
    {
        $judge = Auth::user();
        
        // Eventos asignados al juez
        $assignedEvents = $judge->eventsAsJudge()
            ->with(['teams', 'evaluationCriteria']) 
            ->orderBy('inicio_evento', 'desc')
            ->get();
        
        // Estadísticas
        $stats = [
            'total_events' => $assignedEvents->count(),
            'active_events' => $assignedEvents->where('estado', 'activo')->count(), 
            'teams_evaluated' => $this->getEvaluatedTeamsCount($judge->id),
        ];

        return view('judge.index', compact('assignedEvents', 'stats'));
    }

    // Ver detalles de un evento específico
    public function showEvent($eventId)
    {
        $judge = Auth::user();
        
        // Verificar que el juez esté asignado a este evento
        $event = Event::whereHas('judges', function ($query) use ($judge) {
            $query->where('user_id', $judge->id);
        })->with(['teams', 'judges', 'evaluationCriteria'])->findOrFail($eventId); // ✅ Corregido

        // Obtener equipos con su progreso de evaluación
        $teams = $event->teams->map(function ($team) use ($event, $judge) {
            return [
                'team' => $team,
                'evaluated' => $event->hasJudgeCompletedEvaluation($judge->id, $team->id),
                'average_score' => $event->getTeamAverageScore($team->id),
            ];
        });

        return view('judge.event-details', compact('event', 'teams'));
    }

    // Ver equipo específico y sus calificaciones
    public function showTeam($eventId, $teamId)
    {
        $judge = Auth::user();
        
        $event = Event::whereHas('judges', function ($query) use ($judge) {
            $query->where('user_id', $judge->id);
        })->findOrFail($eventId);

        $team = Team::findOrFail($teamId);

        // Obtener criterios del evento
        $criteria = $event->evaluationCriteria; // ✅ Corregido

        // Obtener calificaciones existentes del juez para este equipo
        $existingScores = TeamScore::where([
            'team_id' => $teamId,
            'event_id' => $eventId,
            'user_id' => $judge->id,
        ])->with('criteria')->get()->keyBy('evaluation_criteria_id');

        // Calificaciones de todos los jueces
        $allScores = $event->getTeamScoresByJudge($teamId);

        // Promedio general del equipo
        $averageScore = $event->getTeamAverageScore($teamId);

        return view('judge.evaluate-team', compact(
            'event',
            'team',
            'criteria',
            'existingScores',
            'allScores',
            'averageScore'
        ));
    }

    // Guardar o actualizar calificación
    public function storeScore(Request $request, $eventId, $teamId)
    {
        $judge = Auth::user();

        // Validar que el juez esté asignado al evento
        $event = Event::whereHas('judges', function ($query) use ($judge) {
            $query->where('user_id', $judge->id);
        })->findOrFail($eventId);

        $request->validate([
            'evaluation_criteria_id' => 'required|exists:evaluation_criteria,id',
            'score' => 'required|numeric|min:0',
            'comments' => 'nullable|string|max:1000',
        ]);

        // Validar que el score no exceda el max_score del criterio
        $criteria = EvaluationCriteria::findOrFail($request->evaluation_criteria_id);
        
        if ($request->score > $criteria->max_score) {
            return back()->withErrors([
                'score' => "La calificación no puede ser mayor a {$criteria->max_score}"
            ]);
        }

        // Crear o actualizar la calificación
        TeamScore::updateOrCreate(
            [
                'team_id' => $teamId,
                'event_id' => $eventId,
                'user_id' => $judge->id,
                'evaluation_criteria_id' => $request->evaluation_criteria_id,
            ],
            [
                'score' => $request->score,
                'comments' => $request->comments,
            ]
        );

        return back()->with('success', 'Calificación guardada exitosamente');
    }

    // Ver equipos que ya ha evaluado
    public function evaluatedTeams()
    {
        $judge = Auth::user();

        // Obtener todos los equipos que el juez ha evaluado
        $evaluatedTeams = TeamScore::where('user_id', $judge->id)
            ->with(['team', 'event', 'criteria'])
            ->get()
            ->groupBy('team_id')
            ->map(function ($scores) {
                $team = $scores->first()->team;
                $event = $scores->first()->event;
                
                return [
                    'team' => $team,
                    'event' => $event,
                    'scores_count' => $scores->count(),
                    'completed' => $event->hasJudgeCompletedEvaluation(Auth::id(), $team->id),
                    'average' => $event->getTeamAverageScore($team->id),
                ];
            });

        return view('judge.evaluated-teams', compact('evaluatedTeams'));
    }

    // Agregar criterio personalizado a un evento
    public function addCriteria(Request $request, $eventId)
    {
        $judge = Auth::user();

        // Verificar que el juez esté asignado al evento
        $event = Event::whereHas('judges', function ($query) use ($judge) {
            $query->where('user_id', $judge->id);
        })->findOrFail($eventId);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'max_score' => 'required|integer|min:1|max:100',
            'weight' => 'required|integer|min:1|max:10',
        ]);

        $event->evaluationCriteria()->create([ // ✅ Corregido
            'name' => $request->name,
            'description' => $request->description,
            'max_score' => $request->max_score,
            'weight' => $request->weight,
            'is_default' => false,
        ]);

        return back()->with('success', 'Criterio agregado exitosamente');
    }

    // Método auxiliar para contar equipos evaluados
    private function getEvaluatedTeamsCount($judgeId)
    {
        return TeamScore::where('user_id', $judgeId)
            ->distinct('team_id')
            ->count('team_id');
    }
}