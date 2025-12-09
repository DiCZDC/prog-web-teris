<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventUser extends Model
{
     use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'event_users';

    /**
     * Campos asignables en masa
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'role',
    ];

/**
     * Relación: Pertenece a un evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Relación: Pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope: Filtrar solo jueces
     */
    public function scopeJudges($query)
    {
        return $query->where('role', 'Juez');
    }

    /**
     * Scope: Filtrar solo organizadores
     */
    public function scopeOrganizers($query)
    {
        return $query->where('role', 'Organizador');
    }

    /**
     * Verificar si es juez
     */
    public function isJudge(): bool
    {
        return $this->role === 'Juez';
    }

    /**
     * Verificar si es organizador
     */
    public function isOrganizer(): bool
    {
        return $this->role === 'Organizador';
    }

}
