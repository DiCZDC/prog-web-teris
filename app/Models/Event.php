<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
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
    public function scopePopulares($query)
    {
        return $query->where('popular', true)->where('estado', 'Activo');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'Activo');
    }
    // Relaciones
    public function teams()
    {
        return $this->hasMany(Team::class, 'evento_id');
    }
}