<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
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
        'popular',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'inicio_evento' => 'datetime',
        'fin_evento' => 'datetime',
        'popular' => 'boolean',
    ];

    /**
     * Scope para eventos populares y activos
     */
    public function scopePopulares($query)
    {
        return $query->where('popular', true)->where('estado', 'Activo');
    }

    /**
     * Scope para eventos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'Activo');
    }

    /**
     * Scope para eventos inactivos
     */
    public function scopeInactivos($query)
    {
        return $query->where('estado', 'Inactivo');
    }

    /**
     * Relación: Un evento tiene muchos equipos
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'evento_id');
    }

    /**
     * Relación: Un evento tiene muchos jueces (users con rol de juez)
     */
    public function judges(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_judge', 'event_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Relación: Un evento tiene muchos criterios de evaluación
     */
    public function evaluationCriteria(): HasMany
    {
        return $this->hasMany(EvaluationCriteria::class);
    }

    /**
     * Relación: Un evento tiene muchas puntuaciones de equipos
     */
    public function teamScores(): HasMany
    {
        return $this->hasMany(TeamScore::class);
    }

    /**
     * Verificar si el evento está activo
     */
    public function isActive(): bool
    {
        return $this->estado === 'Activo';
    }

    /**
     * Verificar si el evento es popular
     */
    public function isPopular(): bool
    {
        return $this->popular === true;
    }

    /**
     * Verificar si el evento ya comenzó
     */
    public function hasStarted(): bool
    {
        return now()->greaterThanOrEqualTo($this->inicio_evento);
    }

    /**
     * Verificar si el evento ya finalizó
     */
    public function hasEnded(): bool
    {
        return now()->greaterThan($this->fin_evento);
    }

    /**
     * Verificar si el evento está en curso
     */
    public function isOngoing(): bool
    {
        return $this->hasStarted() && !$this->hasEnded();
    }

    /**
     * Obtener días restantes hasta el inicio del evento
     */
    public function daysUntilStart(): int
    {
        if ($this->hasStarted()) {
            return 0;
        }
        return now()->diffInDays($this->inicio_evento);
    }

    /**
     * Obtener días restantes hasta el fin del evento
     */
    public function daysUntilEnd(): int
    {
        if ($this->hasEnded()) {
            return 0;
        }
        return now()->diffInDays($this->fin_evento);
    }

    /**
     * Obtener el número total de equipos registrados
     */
    public function getTotalTeamsAttribute(): int
    {
        return $this->teams()->count();
    }

    /**
     * Obtener el número total de participantes (miembros de equipos)
     */
    public function getTotalParticipantsAttribute(): int
    {
        $total = 0;
        foreach ($this->teams as $team) {
            // Contar miembros no nulos
            if ($team->lider_id) $total++;
            if ($team->disenador_id) $total++;
            if ($team->frontprog_id) $total++;
            if ($team->backprog_id) $total++;
        }
        return $total;
    }

    /**
     * Obtener color del badge según el estado
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->estado) {
            'Activo' => 'green',
            'Inactivo' => 'gray',
            default => 'blue',
        };
    }

    /**
     * Obtener color del badge según la modalidad
     */
    public function getModalityColorAttribute(): string
    {
        return match($this->modalidad) {
            'Presencial' => 'blue',
            'Virtual' => 'purple',
            'Híbrido' => 'indigo',
            default => 'gray',
        };
    }

    /**
     * Obtener el estado del evento en texto
     */
    public function getStatusTextAttribute(): string
    {
        if ($this->hasEnded()) {
            return 'Finalizado';
        }
        if ($this->isOngoing()) {
            return 'En Curso';
        }
        if ($this->hasStarted()) {
            return 'Iniciado';
        }
        return 'Próximamente';
    }

    /**
     * Verificar si un usuario es juez de este evento
     */
    public function isJudge(User $user): bool
    {
        return $this->judges()->where('user_id', $user->id)->exists();
    }

    /**
     * Agregar un juez al evento
     */
    public function addJudge(User $user): void
    {
        if (!$this->isJudge($user)) {
            $this->judges()->attach($user->id);
        }
    }

    /**
     * Remover un juez del evento
     */
    public function removeJudge(User $user): void
    {
        $this->judges()->detach($user->id);
    }

    /**
     * Formatear fecha de inicio
     */
    public function getFormattedStartDateAttribute(): string
    {
        return $this->inicio_evento->format('d/m/Y H:i');
    }

    /**
     * Formatear fecha de fin
     */
    public function getFormattedEndDateAttribute(): string
    {
        return $this->fin_evento->format('d/m/Y H:i');
    }

    /**
     * Obtener duración del evento en días
     */
    public function getDurationInDaysAttribute(): int
    {
        return $this->inicio_evento->diffInDays($this->fin_evento);
    }
}