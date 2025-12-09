<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'team_id',
        'position',
        'final_score',
        'recognition',
    ];

    protected $casts = [
        'final_score' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un ganador pertenece a un evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relación: Un ganador pertenece a un equipo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Obtener el nombre de la posición en texto
     */
    public function getPositionNameAttribute()
    {
        return match($this->position) {
            '1' => '1er Lugar',
            '2' => '2do Lugar',
            '3' => '3er Lugar',
            default => 'Posición desconocida'
        };
    }

    /**
     * Obtener el emoji de la medalla según la posición
     */
    public function getPositionEmojiAttribute()
    {
        return match($this->position) {
            '1' => '🥇',
            '2' => '🥈',
            '3' => '🥉',
            default => '🏆'
        };
    }

    /**
     * Obtener el color para mostrar en la UI
     */
    public function getPositionColorAttribute()
    {
        return match($this->position) {
            '1' => 'yellow',  // Dorado
            '2' => 'gray',    // Plateado
            '3' => 'orange',  // Bronce
            default => 'blue'
        };
    }
}