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
        'popular'
    ];

    protected $casts = [
        'inicio_evento' => 'datetime',
        'fin_evento' => 'datetime',
        'popular' => 'boolean'
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
        return $this->belongsToMany(User::class, 'event_judge', 'event_id', 'user_id')
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
}