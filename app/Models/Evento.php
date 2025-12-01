<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'fecha_inicio',
        'fecha_finalizacion',
        'estado',
        'modalidad',
        'ubicacion',
        'detalles_adicionales',
        'popular'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_finalizacion' => 'date',
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
}