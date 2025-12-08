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

    // Relaciones con Users (tabla pivote)
    public function miembros()
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withPivot('rol')
            ->withTimestamps();
    }

    // Relaciones individuales (mantener compatibilidad)
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

    public function invitacionesPendientes()
    {
        return $this->hasMany(TeamInvitation::class)->where('status', 'pendiente');
    }

    // Métodos auxiliares
    public function esMiembro($userId)
    {
        return $this->lider_id == $userId || 
               $this->disenador_id == $userId || 
               $this->frontprog_id == $userId || 
               $this->backprog_id == $userId;
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

    public function posicionesDisponibles()
    {
        $disponibles = [];
        if (!$this->disenador_id) $disponibles[] = 'DISEÑADOR';
        if (!$this->frontprog_id) $disponibles[] = 'PROGRAMADOR FRONT';
        if (!$this->backprog_id) $disponibles[] = 'PROGRAMADOR BACK';
        return $disponibles;
    }

    public function estaCompleto()
    {
        return $this->lider_id && 
               $this->disenador_id && 
               $this->frontprog_id && 
               $this->backprog_id;
    }

    public function getTodosMiembros()
    {
        $miembros = [];
        if ($this->lider) $miembros['LIDER'] = $this->lider;
        if ($this->disenador) $miembros['DISEÑADOR'] = $this->disenador;
        if ($this->frontprog) $miembros['PROGRAMADOR FRONT'] = $this->frontprog;
        if ($this->backprog) $miembros['PROGRAMADOR BACK'] = $this->backprog;
        return $miembros;
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
}