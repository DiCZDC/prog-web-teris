<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCriteria extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'evaluation_criteria';

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'max_score',
        'weight',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'max_score' => 'integer',
        'weight' => 'integer',
    ];

    /**
     * Relación: Un criterio pertenece a un evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relación: Un criterio tiene muchas calificaciones
     */
    public function scores()
    {
        return $this->hasMany(TeamScore::class, 'evaluation_criteria_id');
    }

    /**
     * Criterios por defecto para eventos de programación
     */
    public static function getDefaultCriteria(): array
    {
        return [
            [
                'name' => 'Innovación y Creatividad',
                'description' => 'Originalidad de la solución y enfoque creativo del problema',
                'max_score' => 10,
                'weight' => 3,
                'is_default' => true,
            ],
            [
                'name' => 'Funcionalidad',
                'description' => 'El proyecto cumple con los requisitos y funciona correctamente',
                'max_score' => 10,
                'weight' => 4,
                'is_default' => true,
            ],
            [
                'name' => 'Calidad del Código',
                'description' => 'Código limpio, bien estructurado y documentado',
                'max_score' => 10,
                'weight' => 3,
                'is_default' => true,
            ],
            [
                'name' => 'Diseño y UX',
                'description' => 'Interfaz de usuario intuitiva y diseño atractivo',
                'max_score' => 10,
                'weight' => 2,
                'is_default' => true,
            ],
            [
                'name' => 'Presentación',
                'description' => 'Claridad en la explicación del proyecto y demostración',
                'max_score' => 10,
                'weight' => 2,
                'is_default' => true,
            ],
            [
                'name' => 'Impacto y Utilidad',
                'description' => 'Relevancia del proyecto y su potencial de impacto',
                'max_score' => 10,
                'weight' => 2,
                'is_default' => true,
            ],
        ];
    }

    /**
     * Scope: Criterios activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope: Criterios por evento
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Obtener la puntuación máxima ponderada
     */
    public function getWeightedMaxScore()
    {
        return $this->max_score * $this->weight;
    }
}