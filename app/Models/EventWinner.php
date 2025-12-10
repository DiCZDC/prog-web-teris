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
    ];

    // Relaciones
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Accesor para el nombre de la posición
    public function getPositionNameAttribute()
    {
        return match($this->position) {
            '1' => '🥇 Primer Lugar',
            '2' => '🥈 Segundo Lugar',
            '3' => '🥉 Tercer Lugar',
            default => 'Posición ' . $this->position,
        };
    }

    // Accesor para el emoji de la medalla
    public function getMedalEmojiAttribute()
    {
        return match($this->position) {
            '1' => '🥇',
            '2' => '🥈',
            '3' => '🥉',
            default => '🏆',
        };
    }

    // Scope para ordenar por posición
    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }
}   