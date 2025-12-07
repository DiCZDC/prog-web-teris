<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // ==========================================
    // RELACIONES ORIGINALES (Tu estructura)
    // ==========================================

    /**
     * Relación con el evento al que pertenece el equipo
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }

    /**
     * Relación con el líder del equipo (Gerente)
     */
    public function lider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lider_id');
    }

    /**
     * Relación con el diseñador del equipo
     */
    public function disenador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disenador_id');
    }

    /**
     * Relación con el programador frontend
     */
    public function frontprog(): BelongsTo
    {
        return $this->belongsTo(User::class, 'frontprog_id');
    }

    /**
     * Relación con el programador backend
     */
    public function backprog(): BelongsTo
    {
        return $this->belongsTo(User::class, 'backprog_id');
    }

    /**
     * Relación con las calificaciones recibidas
     */
    public function teamScores(): HasMany
    {
        return $this->hasMany(TeamScore::class);
    }

    // ==========================================
    // MÉTODOS DE GESTIÓN DE EQUIPO
    // ==========================================

    /**
     * Verificar si un usuario es miembro del equipo
     */
    public function esMiembro($userId): bool
    {
        return $this->lider_id == $userId || 
               $this->disenador_id == $userId || 
               $this->frontprog_id == $userId || 
               $this->backprog_id == $userId;
    }

    /**
     * Obtener todos los miembros del equipo con sus roles
     */
    public function miembros(): array
    {
        $miembros = [];
        if ($this->lider) $miembros['GERENTE'] = $this->lider;
        if ($this->disenador) $miembros['DISEÑADOR'] = $this->disenador;
        if ($this->frontprog) $miembros['PROGRAMADOR FRONT'] = $this->frontprog;
        if ($this->backprog) $miembros['PROGRAMADOR BACK'] = $this->backprog;
        return $miembros;
    }

    /**
     * Obtener colección de todos los miembros (útil para relaciones)
     */
    public function getAllMembers()
    {
        return collect([
            $this->lider,
            $this->disenador,
            $this->frontprog,
            $this->backprog
        ])->filter();
    }

    /**
     * Verificar posiciones disponibles en el equipo
     */
    public function posicionesDisponibles(): array
    {
        $disponibles = [];
        if (!$this->disenador_id) $disponibles[] = 'DISEÑADOR';
        if (!$this->frontprog_id) $disponibles[] = 'PROGRAMADOR FRONT';
        if (!$this->backprog_id) $disponibles[] = 'PROGRAMADOR BACK';
        return $disponibles;
    }

    /**
     * Verificar si el equipo está completo
     */
    public function estaCompleto(): bool
    {
        return $this->lider_id && 
               $this->disenador_id && 
               $this->frontprog_id && 
               $this->backprog_id;
    }

    /**
     * Obtener el total de integrantes actuales
     */
    public function getMembersCount(): int
    {
        $count = 0;
        if ($this->lider_id) $count++;
        if ($this->disenador_id) $count++;
        if ($this->frontprog_id) $count++;
        if ($this->backprog_id) $count++;
        return $count;
    }

    /**
     * Obtener el rol de un usuario en el equipo
     */
    public function getRolUsuario($userId): ?string
    {
        if ($this->lider_id == $userId) return 'GERENTE';
        if ($this->disenador_id == $userId) return 'DISEÑADOR';
        if ($this->frontprog_id == $userId) return 'PROGRAMADOR FRONT';
        if ($this->backprog_id == $userId) return 'PROGRAMADOR BACK';
        return null;
    }

    // ==========================================
    // MÉTODOS DE EVALUACIÓN
    // ==========================================

    /**
     * Obtener el promedio general del equipo en su evento
     */
    public function getAverageScore(): float
    {
        if (!$this->evento_id) {
            return 0.0;
        }

        return $this->getAverageScoreInEvent($this->evento_id);
    }

    /**
     * Obtener el promedio del equipo en un evento específico
     */
    public function getAverageScoreInEvent(int $eventId): float
    {
        $event = Event::find($eventId);
        
        if (!$event) {
            return 0.0;
        }
        
        return $event->getTeamAverageScore($this->id);
    }

    /**
     * Obtener todas las calificaciones del equipo en un evento
     */
    public function getScoresInEvent(int $eventId)
    {
        return $this->teamScores()
            ->where('event_id', $eventId)
            ->with(['judge', 'criteria'])
            ->get();
    }

    /**
     * Verificar si el equipo ha sido completamente evaluado en un evento
     */
    public function isFullyEvaluatedInEvent(int $eventId): bool
    {
        $event = Event::find($eventId);
        
        if (!$event) {
            return false;
        }
        
        $totalJudges = $event->judges()->count();
        $totalCriteria = $event->evaluationCriteria()->count();
        $expectedScores = $totalJudges * $totalCriteria;
        
        if ($expectedScores === 0) {
            return false;
        }
        
        $actualScores = $this->teamScores()
            ->where('event_id', $eventId)
            ->count();
        
        return $actualScores === $expectedScores;
    }

    /**
     * Verificar si el equipo está completamente evaluado en su evento actual
     */
    public function isFullyEvaluated(): bool
    {
        if (!$this->evento_id) {
            return false;
        }

        return $this->isFullyEvaluatedInEvent($this->evento_id);
    }

    /**
     * Obtener el ranking del equipo en un evento
     */
    public function getRankingInEvent(int $eventId): int
    {
        $event = Event::find($eventId);
        
        if (!$event) {
            return 0;
        }
        
        $ranking = $event->getTeamRanking();
        
        foreach ($ranking as $index => $item) {
            if ($item['team']->id === $this->id) {
                return $index + 1;
            }
        }
        
        return 0;
    }

    /**
     * Obtener el ranking del equipo en su evento actual
     */
    public function getRanking(): int
    {
        if (!$this->evento_id) {
            return 0;
        }

        return $this->getRankingInEvent($this->evento_id);
    }

    /**
     * Obtener todas las calificaciones agrupadas por juez
     */
    public function getScoresByJudge()
    {
        if (!$this->evento_id) {
            return collect();
        }

        return $this->teamScores()
            ->where('event_id', $this->evento_id)
            ->with(['judge', 'criteria'])
            ->get()
            ->groupBy('user_id');
    }

    /**
     * Obtener el progreso de evaluación (porcentaje)
     */
    public function getEvaluationProgress(): float
    {
        if (!$this->evento_id) {
            return 0.0;
        }

        $event = Event::find($this->evento_id);
        
        if (!$event) {
            return 0.0;
        }

        $totalJudges = $event->judges()->count();
        $totalCriteria = $event->evaluationCriteria()->count();
        $expectedScores = $totalJudges * $totalCriteria;
        
        if ($expectedScores === 0) {
            return 0.0;
        }

        $actualScores = $this->teamScores()
            ->where('event_id', $this->evento_id)
            ->count();
        
        return round(($actualScores / $expectedScores) * 100, 2);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    /**
     * Scope para equipos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', true);
    }

    /**
     * Scope para equipos completos
     */
    public function scopeCompletos($query)
    {
        return $query->whereNotNull('lider_id')
            ->whereNotNull('disenador_id')
            ->whereNotNull('frontprog_id')
            ->whereNotNull('backprog_id');
    }

    /**
     * Scope para equipos de un evento específico
     */
    public function scopeDeEvento($query, $eventoId)
    {
        return $query->where('evento_id', $eventoId);
    }

    // ==========================================
    // ACCESORES Y MUTADORES
    // ==========================================

    /**
     * Accessor para obtener el conteo de miembros
     */
    public function getUsersAttribute()
    {
        return $this->getAllMembers();
    }
}