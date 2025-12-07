<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamScore extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'team_scores';

    protected $fillable = [
        'team_id',
        'event_id',
        'user_id', // ID del juez
        'evaluation_criteria_id',
        'score',
        'comments',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    /**
     * Relación: Una calificación pertenece a un equipo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Relación: Una calificación pertenece a un evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relación: Una calificación pertenece a un juez (usuario)
     */
    public function judge()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Una calificación pertenece a un criterio de evaluación
     */
    public function criteria()
    {
        return $this->belongsTo(EvaluationCriteria::class, 'evaluation_criteria_id');
    }

    /**
     * Calcular el puntaje ponderado
     */
    public function getWeightedScore(): float
    {
        $criteria = $this->criteria;
        if (!$criteria) {
            return 0;
        }
        return ($this->score / $criteria->max_score) * $criteria->weight * 10;
    }

    /**
     * Verificar si la puntuación está dentro del rango válido
     */
    public function isValidScore(): bool
    {
        $criteria = $this->criteria;
        if (!$criteria) {
            return false;
        }
        return $this->score >= 0 && $this->score <= $criteria->max_score;
    }

    /**
     * Scope: Calificaciones por equipo
     */
    public function scopeForTeam($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }

    /**
     * Scope: Calificaciones por juez
     */
    public function scopeByJudge($query, $judgeId)
    {
        return $query->where('user_id', $judgeId);
    }

    /**
     * Scope: Calificaciones por evento
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }
}