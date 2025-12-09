<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'icono',
        'estado',
        'evento_id',
        'lider_id',
        'disenador_id',
        'frontprog_id',
        'backprog_id'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

<<<<<<< Updated upstream
    // Relaciones con Users (tabla pivote)
    public function miembros()
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withPivot('rol')
            ->withTimestamps();
    }

    // Relaciones individuales (mantener compatibilidad)
=======
    // ============= RELACIONES EXISTENTES =============
    
>>>>>>> Stashed changes
    public function evento()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }

    public function lider()
    {
        return $this->belongsTo(User::class, 'lider_id');
    }

    public function disenador()
    {
        return $this->belongsTo(User::class, 'disenador_id');
    }

    public function frontprog()
    {
        return $this->belongsTo(User::class, 'frontprog_id');
    }

    public function backprog()
    {
        return $this->belongsTo(User::class, 'backprog_id');
    }
    // Relación con invitaciones
    public function invitaciones()
    {
        return $this->hasMany(TeamInvitation::class);
    }

<<<<<<< Updated upstream
    public function invitacionesPendientes()
    {
        return $this->hasMany(TeamInvitation::class)->where('status', 'pendiente');
    }

    // Métodos auxiliares
=======
    // ============= NUEVA RELACIÓN: CALIFICACIONES =============
    
    /**
     * Relación: Un equipo tiene muchas calificaciones
     */
    public function scores()
    {
        return $this->hasMany(TeamScore::class, 'team_id');
    }

    // ============= MÉTODOS EXISTENTES =============
    
    /**
     * Método para verificar si un usuario es miembro del equipo
     */
>>>>>>> Stashed changes
    public function esMiembro($userId)
    {
        return $this->lider_id == $userId || 
               $this->disenador_id == $userId || 
               $this->frontprog_id == $userId || 
               $this->backprog_id == $userId;
    }
<<<<<<< Updated upstream
    public function contarMiembros()
=======

    /**
     * Método para obtener todos los miembros del equipo
     */
    public function miembros()
>>>>>>> Stashed changes
    {
        $count = 0;
        if ($this->lider_id) $count++;
        if ($this->disenador_id) $count++;
        if ($this->frontprog_id) $count++;
        if ($this->backprog_id) $count++;
        return $count;
    }
    public function esLider($userId)
    {
        return $this->lider_id == $userId;
    }

    public function getRolDelUsuario($userId)
    {
        if ($this->lider_id == $userId) return 'LIDER';
        if ($this->disenador_id == $userId) return 'DISEÑADOR';
        if ($this->frontprog_id == $userId) return 'PROGRAMADOR FRONT';
        if ($this->backprog_id == $userId) return 'PROGRAMADOR BACK';
        return null;
    }

<<<<<<< Updated upstream
=======
    /**
     * Verificar posiciones disponibles
     */
>>>>>>> Stashed changes
    public function posicionesDisponibles()
    {
        $disponibles = [];
        if (!$this->disenador_id) $disponibles[] = 'DISEÑADOR';
        if (!$this->frontprog_id) $disponibles[] = 'PROGRAMADOR FRONT';
        if (!$this->backprog_id) $disponibles[] = 'PROGRAMADOR BACK';
        return $disponibles;
    }

<<<<<<< Updated upstream
=======
    /**
     * Verificar si el equipo está completo
     */
>>>>>>> Stashed changes
    public function estaCompleto()
    {
        return $this->lider_id && 
               $this->disenador_id && 
               $this->frontprog_id && 
               $this->backprog_id;
    }

<<<<<<< Updated upstream
    public function getTodosMiembros()
    {
        $miembros = [];
        if ($this->lider) $miembros['LIDER'] = $this->lider;
        if ($this->disenador) $miembros['DISEÑADOR'] = $this->disenador;
        if ($this->frontprog) $miembros['PROGRAMADOR FRONT'] = $this->frontprog;
        if ($this->backprog) $miembros['PROGRAMADOR BACK'] = $this->backprog;
        return $miembros;
    }
        /**
     * Proyecto del equipo
     */
    public function proyecto()
    {
        return $this->hasOne(Project::class, 'team_id');
    }

    /**
     * Verificar si tiene proyecto
     */
    public function tieneProyecto()
    {
        return $this->proyecto()->exists();
    }
    public function rolDisponible($rol)
    {
        return !$this->miembros()
            ->wherePivot('rol', strtoupper($rol))
            ->exists();
    }


=======
    // ============= NUEVOS MÉTODOS PARA CALIFICACIONES =============
    
    /**
     * Obtener calificaciones por evento
     */
    public function scoresForEvent($eventId)
    {
        return $this->scores()
            ->where('event_id', $eventId)
            ->with(['judge', 'criteria'])
            ->get();
    }

    /**
     * Obtener promedio de calificaciones para un evento
     */
    public function getAverageScore($eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return 0;
        }
        return $event->getTeamAverageScore($this->id);
    }

    /**
     * Verificar si el equipo ha sido calificado en un evento
     */
    public function hasBeenEvaluated($eventId)
    {
        return $this->scores()
            ->where('event_id', $eventId)
            ->exists();
    }

    /**
     * Obtener todas las calificaciones del equipo agrupadas por juez
     */
    public function getScoresByJudge($eventId)
    {
        return $this->scores()
            ->where('event_id', $eventId)
            ->with(['judge', 'criteria'])
            ->get()
            ->groupBy('user_id');
    }

    /**
     * Obtener el total de calificaciones recibidas
     */
    public function getTotalScoresCount($eventId = null)
    {
        $query = $this->scores();
        
        if ($eventId) {
            $query->where('event_id', $eventId);
        }
        
        return $query->count();
    }

    /**
     * Verificar si el equipo está completamente evaluado en un evento
     */
    public function isFullyEvaluated($eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return false;
        }

        $judgesCount = $event->judges()->count();
        $criteriaCount = $event->criteria()->count();
        $expectedScores = $judgesCount * $criteriaCount;
        $actualScores = $this->scores()
            ->where('event_id', $eventId)
            ->count();

        return $expectedScores > 0 && $actualScores === $expectedScores;
    }

    /**
     * Obtener el ranking del equipo en su evento
     */
    public function getRanking()
    {
        if (!$this->evento_id) {
            return null;
        }

        $ranking = $this->evento->getTeamsRanking();
        
        foreach ($ranking as $position => $data) {
            if ($data['team']->id === $this->id) {
                return [
                    'position' => $position + 1,
                    'total_teams' => count($ranking),
                    'score' => $data['average_score']
                ];
            }
        }

        return null;
    }

    /**
     * Obtener detalles completos de evaluación
     */
    public function getEvaluationDetails($eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return null;
        }

        $scores = $this->scoresForEvent($eventId);
        $scoresByJudge = $scores->groupBy('user_id');
        
        $details = [];
        foreach ($scoresByJudge as $judgeId => $judgeScores) {
            $judge = User::find($judgeId);
            $criteriaScores = [];
            
            foreach ($judgeScores as $score) {
                $criteriaScores[] = [
                    'criteria' => $score->criteria->name,
                    'score' => $score->score,
                    'max_score' => $score->criteria->max_score,
                    'weight' => $score->criteria->weight,
                    'weighted_score' => $score->getWeightedScore(),
                    'comments' => $score->comments
                ];
            }
            
            $details[] = [
                'judge' => $judge,
                'scores' => $criteriaScores,
                'total_weighted_score' => collect($criteriaScores)->sum('weighted_score')
            ];
        }

        return [
            'team' => $this,
            'event' => $event,
            'evaluation_details' => $details,
            'average_score' => $this->getAverageScore($eventId),
            'is_fully_evaluated' => $this->isFullyEvaluated($eventId)
        ];
    }

    /**
     * Scope: Equipos de un evento específico
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('evento_id', $eventId);
    }

    /**
     * Scope: Equipos activos
     */
    public function scopeActive($query)
    {
        return $query->where('estado', true);
    }

    /**
     * Scope: Equipos completos
     */
    public function scopeComplete($query)
    {
        return $query->whereNotNull('lider_id')
                    ->whereNotNull('disenador_id')
                    ->whereNotNull('frontprog_id')
                    ->whereNotNull('backprog_id');
    }
>>>>>>> Stashed changes
}