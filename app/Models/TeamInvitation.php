<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'invited_by',
        'user_id',
        'tipo',
        'rol',
        'status',
        'mensaje',
        'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function invitador()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function invitado()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('status', 'pendiente');
    }

    public function scopeAceptadas($query)
    {
        return $query->where('status', 'aceptada');
    }

    public function scopeRechazadas($query)
    {
        return $query->where('status', 'rechazada');
    }

    public function scopeInvitaciones($query)
    {
        return $query->where('tipo', 'invitacion');
    }

    public function scopeSolicitudes($query)
    {
        return $query->where('tipo', 'solicitud');
    }

    // Métodos auxiliares
    public function isPendiente()
    {
        return $this->status === 'pendiente';
    }

    public function isAceptada()
    {
        return $this->status === 'aceptada';
    }

    public function isRechazada()
    {
        return $this->status === 'rechazada';
    }

    // NUEVOS: Métodos para tipo
    public function esInvitacion()
    {
        return $this->tipo === 'invitacion';
    }

    public function esSolicitud()
    {
        return $this->tipo === 'solicitud';
    }

    // NUEVOS: Scopes para tipo
    public function scopeSoloInvitaciones($query)
    {
        return $query->where('tipo', 'invitacion');
    }

    public function scopeSoloSolicitudes($query)
    {
        return $query->where('tipo', 'solicitud');
    }

    public function isInvitacion()
    {
        return $this->tipo === 'invitacion';
    }

    public function isSolicitud()
    {
        return $this->tipo === 'solicitud';
    }

    public function aceptar()
    {
        $this->status = 'aceptada';
        $this->responded_at = now();
        $this->save();
        
        // Asignar el usuario al equipo según el rol
        $team = $this->team;
        
        switch ($this->rol) {
            case 'DISEÑADOR':
                $team->disenador_id = $this->user_id;
                break;
            case 'PROGRAMADOR FRONT':
                $team->frontprog_id = $this->user_id;
                break;
            case 'PROGRAMADOR BACK':
                $team->backprog_id = $this->user_id;
                break;
        }
        
        $team->save();
        
        return true;
    }

    public function rechazar()
    {
        $this->status = 'rechazada';
        $this->responded_at = now();
        return $this->save();
    }
}