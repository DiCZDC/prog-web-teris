<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'team_id',
        'estado',
        'repositorio_url',
        'demo_url',
        'documentacion_url',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relación con el equipo
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    // Relación con el evento a través del equipo
    public function evento()
    {
        return $this->hasOneThrough(
            Event::class, 
            Team::class, 
            'id', // Foreign key on Team table
            'id', // Foreign key on Event table
            'team_id', // Local key on Project table
            'evento_id' // Local key on Team table
        );
    }

    // Relación con el creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relación con el actualizador
    public function actualizador()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relación con evaluaciones
    public function evaluaciones()
    {
        return $this->hasMany(Evaluation::class, 'project_id'); 
    }

    // Obtener promedio de evaluaciones
    public function promedioEvaluaciones()
    {
        return $this->evaluaciones()->avg('promedio');
    }

    // Obtener cantidad de evaluaciones
    public function cantidadEvaluaciones()
    {
        return $this->evaluaciones()->count();
    }

    // Verificar si el proyecto tiene evaluaciones
    public function tieneEvaluaciones()
    {
        return $this->evaluaciones()->exists();
    }

    // Obtener evaluaciones por juez específico
    public function evaluacionPorJuez($juezId)
    {
        return $this->evaluaciones()->where('juez_id', $juezId)->first();
    }

    // Scope para proyectos activos
    public function scopeActivos($query)
    {
        return $query->where('estado', true);
    }

    // Scope para proyectos por equipo
    public function scopePorEquipo($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }

    // Scope para proyectos por evento
    public function scopePorEvento($query, $eventoId)
    {
        return $query->whereHas('team', function($q) use ($eventoId) {
            $q->where('evento_id', $eventoId);
        });
    }
}