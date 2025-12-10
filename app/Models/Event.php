<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'popular',
        'winners_published', // Agregado
        'winners_announced_at' // Agregado
    ];

    protected $casts = [
        'inicio_evento' => 'datetime',
        'fin_evento' => 'datetime',
        'popular' => 'boolean',
        'winners_published' => 'boolean', // Agregado
        'winners_announced_at' => 'datetime', // Agregado
    ];

    // Scopes
    public function scopePopulares($query)
    {
        return $query->where('popular', true)->where('estado', 'Activo');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'Activo');
    }

    // Relaciones existentes
    public function teams()
    {
        return $this->hasMany(Team::class, 'evento_id');
    }

    // ============================================
    // NUEVAS RELACIONES PARA JUECES
    // ============================================
    
    /**
     * Jueces asignados a este evento
     */
    public function jueces()
    {
        return $this->belongsToMany(User::class, 'event_judge', 'event_id', 'judge_id')
                    ->withTimestamps()
                    ->withPivot('assigned_at');
    }

    /**
     * Verificar si un usuario es juez de este evento
     */
    public function esJuez($userId)
    {
        return $this->jueces()->where('user_id', $userId)->exists();
    }

    /**
     * Asignar un juez al evento
     */
    public function asignarJuez($userId)
    {
        if (!$this->esJuez($userId)) {
            $this->jueces()->attach($userId, ['assigned_at' => now()]);
            return true;
        }
        return false;
    }

    /**
     * Remover un juez del evento
     */
    public function removerJuez($userId)
    {
        return $this->jueces()->detach($userId);
    }

    /**
     * Obtener cantidad de jueces asignados
     */
    public function cantidadJueces()
    {
        return $this->jueces()->count();
    }

    /**
     * Relación: Un evento tiene muchos ganadores (máximo 3)
     */
    public function winners()
    {
        return $this->hasMany(EventWinner::class, 'event_id')
                    ->orderBy('position', 'asc');
    }

    /**
     * Verificar si el evento tiene ganadores publicados
     */
    public function hasPublishedWinners()
    {
        return $this->winners_published && $this->winners()->count() >= 3;
    }

    /**
     * Obtener el primer lugar
     */
    public function firstPlace()
    {
        return $this->winners()->where('position', '1')->first();
    }

    /**
     * Obtener el segundo lugar
     */
    public function secondPlace()
    {
        return $this->winners()->where('position', '2')->first();
    }

    /**
     * Obtener el tercer lugar
     */
    public function thirdPlace()
    {
        return $this->winners()->where('position', '3')->first();
    }

    /**
     * Publicar ganadores (hacerlos visibles públicamente)
     */
    public function publishWinners()
    {
        $this->update([
            'winners_published' => true,
            'winners_announced_at' => now(),
        ]);
    }

    /**
     * Obtener ganador por posición (método nuevo)
     */
    public function getWinnerByPosition($position)
    {
        return $this->winners()->where('position', $position)->first();
    }
}