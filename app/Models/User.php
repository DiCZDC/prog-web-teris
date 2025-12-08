<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Agregar estas relaciones al modelo User

    // Relación con equipos (tabla pivote)
    public function equipos()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withPivot('rol')
            ->withTimestamps();
    }

    // Equipos donde es líder
    public function equiposComolider()
    {
        return $this->hasMany(Team::class, 'lider_id');
    }

    // Todos los equipos donde participa (cualquier rol)
    public function todosLosEquipos()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->get();
    }

    // Invitaciones
    public function invitacionesRecibidas()
    {
        return $this->hasMany(TeamInvitation::class, 'user_id');
    }

    public function invitacionesPendientes()
    {
        return $this->hasMany(TeamInvitation::class, 'user_id')
            ->where('status', 'pendiente')
            ->with(['team', 'invitador']);
    }

    public function invitacionesEnviadas()
    {
        return $this->hasMany(TeamInvitation::class, 'invited_by');
    }
}