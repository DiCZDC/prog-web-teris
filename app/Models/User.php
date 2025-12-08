<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================================
    // RELACIONES PARA JUECES
    // ============================================
    
    /**
     * Eventos donde este usuario es juez
     */
    public function eventosComoJuez()
    {
        return $this->belongsToMany(Event::class, 'event_judge', 'user_id', 'event_id')
                    ->withTimestamps()
                    ->withPivot('assigned_at');
    }

    // ============================================
    // MÉTODOS DE VERIFICACIÓN DE ROLES
    // ============================================
    
    /**
     * Verificar si el usuario es administrador
     */
    public function esAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Verificar si el usuario es juez
     */
    public function esJuez()
    {
        return $this->hasRole('juez');
    }

    /**
     * Verificar si es juez de un evento específico
     */
    public function esJuezDe($eventoId)
    {
        return $this->eventosComoJuez()->where('event_id', $eventoId)->exists();
    }

    // ============================================
    // RELACIONES DE EQUIPOS
    // ============================================
    
    /**
     * Equipos donde es líder
     */
    public function equiposLiderados()
    {
        return $this->hasMany(Team::class, 'lider_id');
    }

    /**
     * Equipos donde es diseñador
     */
    public function equiposComoDisenador()
    {
        return $this->hasMany(Team::class, 'disenador_id');
    }

    /**
     * Equipos donde es programador front
     */
    public function equiposComoFront()
    {
        return $this->hasMany(Team::class, 'frontprog_id');
    }

    /**
     * Equipos donde es programador back
     */
    public function equiposComoBack()
    {
        return $this->hasMany(Team::class, 'backprog_id');
    }

    /**
     * Obtener todos los equipos del usuario (en cualquier rol)
     */
    public function todosLosEquipos()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->get();
    }

    /**
     * Verificar si el usuario está en algún equipo
     */
    public function tieneEquipo()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->exists();
    }

    /**
     * Obtener el equipo actual del usuario
     */
    public function equipoActual()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->first();
    }
}