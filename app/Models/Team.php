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

    // Relaciones
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

    // Método para verificar si un usuario es miembro del equipo
    public function esMiembro($userId)
    {
        return $this->lider_id == $userId || 
               $this->disenador_id == $userId || 
               $this->frontprog_id == $userId || 
               $this->backprog_id == $userId;
    }

    // Método para obtener todos los miembros del equipo
    public function miembros()
    {
        $miembros = [];
        if ($this->lider) $miembros['GERENTE'] = $this->lider;
        if ($this->disenador) $miembros['DISEÑADOR'] = $this->disenador;
        if ($this->frontprog) $miembros['PROGRAMADOR FRONT'] = $this->frontprog;
        if ($this->backprog) $miembros['PROGRAMADOR BACK'] = $this->backprog;
        return $miembros;
    }

    // Verificar posiciones disponibles
    public function posicionesDisponibles()
    {
        $disponibles = [];
        if (!$this->disenador_id) $disponibles[] = 'DISEÑADOR';
        if (!$this->frontprog_id) $disponibles[] = 'PROGRAMADOR FRONT';
        if (!$this->backprog_id) $disponibles[] = 'PROGRAMADOR BACK';
        return $disponibles;
    }

    // Verificar si el equipo está completo
    public function estaCompleto()
    {
        return $this->lider_id && 
               $this->disenador_id && 
               $this->frontprog_id && 
               $this->backprog_id;
    }
}