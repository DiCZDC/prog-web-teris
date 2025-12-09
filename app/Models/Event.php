<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EvaluationCriteria;
use App\Models\TeamScore;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'inicio_evento',
        'fin_evento',
        'estado',
        'modalidad',
        'ubicacion',
        'reglas',
        'premios',
        'popular'
    ];

    protected $casts = [
        'inicio_evento' => 'datetime',
        'fin_evento' => 'datetime',
        'popular' => 'boolean'
    ];

    // ================= SCOPES ======================
    public function scopePopulares($query)
    {
        return $query->where('popular', true)->where('estado', 'Activo');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'Activo');
    }

    // ================= RELACIONES ======================
    public function teams()
    {
        return $this->hasMany(Team::class, 'evento_id');
    }

    // Jueces asignados
    public function judges()
    {
        return $this->belongsToMany(User::class, 'event_judge')->withTimestamps();
    }

    public function criteria()
    {
        return $this->hasMany(EvaluationCriteria::class, 'event_id');
    }

    public function scores()
    {
        return $this->hasMany(TeamScore::class, 'event_id');
    }

    // ============ GESTIÓN DE JUECES ====================
    public function assignJudge(User $user)
    {
        if ($user->hasRole('juez')) {
            $this->judges()->syncWithoutDetaching($user->id);
            return true;
        }
        return false;
    }

    public function removeJudge(User $user)
    {
        return $this->judges()->detach($user->id);
    }

    public function hasJudge($userId)
    {
        return $this->judges()->where('user_id', $userId)->exists();
    }

    // ============ CRITERIOS ====================
    public function createDefaultCriteria()
    {
        $defaultCriteria = EvaluationCriteria::getDefaultCriteria();
        foreach ($defaultCriteria as $criteria) {
            $this->criteria()->create($criteria);
        }
        return $this;
    }

    // ============ CALIFICACIONES ====================
    public function getTeamAverageScore($teamId)
    {
        $scores = $this->scores()
            ->where('team_id', $teamId)
            ->with('criteria')
            ->get();

        if ($scores->isEmpty()) {
            return 0;
        }

        $judgeScores = $scores->groupBy('user_id');
        $judgeAverages = [];

        foreach ($judgeScores as $judgeScore) {
            $totalWeighted = 0;
            $totalWeight = 0;

            foreach ($judgeScore as $score) {
                $normalized = ($score->score / $score->criteria->max_score);
                $totalWeighted += $normalized * $score->criteria->weight;
                $totalWeight += $score->criteria->weight;
            }

            $judgeAverages[] = ($totalWeighted / $totalWeight) * 10;
        }

        return round(array_sum($judgeAverages) / count($judgeAverages), 2);
    }
}
