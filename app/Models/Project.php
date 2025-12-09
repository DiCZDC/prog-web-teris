<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

<<<<<<< Updated upstream
=======
    /**
     * Nombre de la tabla
     */
    protected $table = 'projects';

    /**
     * Campos asignables en masa
     */
>>>>>>> Stashed changes
    protected $fillable = [
        'nombre',
        'descripcion',
        'team_id',
<<<<<<< Updated upstream
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
=======
        'url_repositorio',
        'etapa_validacion',
    ];

    /**
     * Casts para los atributos
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un proyecto pertenece a un equipo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Obtener el evento del proyecto a través del equipo
     */
    public function event()
    {
        return $this->hasOneThrough(
            Event::class,
            Team::class,
            'id',        // Foreign key en teams
            'id',        // Foreign key en events
            'team_id',   // Local key en projects
            'evento_id'  // Local key en teams
        );
    }

    /**
     * Scope: Filtrar por etapa de validación
     */
    public function scopeByEtapa($query, $etapa)
    {
        return $query->where('etapa_validacion', $etapa);
    }

    /**
     * Scope: Proyectos pendientes
     */
    public function scopePendientes($query)
    {
        return $query->where('etapa_validacion', 'Pendiente');
    }

    /**
     * Scope: Proyectos aprobados
     */
    public function scopeAprobados($query)
    {
        return $query->where('etapa_validacion', 'Aprobado');
    }

    /**
     * Scope: Proyectos en revisión
     */
    public function scopeEnRevision($query)
    {
        return $query->where('etapa_validacion', 'En Revisión');
    }

    /**
     * Verificar si el proyecto está aprobado
     */
    public function isAprobado(): bool
    {
        return $this->etapa_validacion === 'Aprobado';
    }

    /**
     * Verificar si el proyecto está pendiente
     */
    public function isPendiente(): bool
    {
        return $this->etapa_validacion === 'Pendiente';
    }

    /**
     * Obtener el nombre del equipo
     */
    public function getTeamNameAttribute(): ?string
    {
        return $this->team?->nombre;
    }

    /**
     * Obtener la URL del repositorio formateada
     */
    public function getRepositoryLinkAttribute(): ?string
    {
        if (!$this->url_repositorio) {
            return null;
        }

        return '<a href="' . $this->url_repositorio . '" target="_blank" class="text-blue-600 hover:underline">' 
               . $this->url_repositorio . '</a>';
>>>>>>> Stashed changes
    }
}