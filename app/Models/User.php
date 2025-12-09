<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

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

<<<<<<< Updated upstream
    // Agregar estas relaciones al modelo User

    // Relación con equipos (tabla pivote)
    public function equipos()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withPivot('rol')
            ->withTimestamps();
    }

    // ============================================
    // RELACIONES PARA JUECES
    // ============================================
    
    /**
     * Eventos donde este usuario es juez
     */
    public function eventosComoJuez()
    {
        return $this->belongsToMany(Event::class, 'event_judge', 'user_id', 'event_id')
                    ->withTimestamps()
                    ->withPivot('assigned_at');
    }

    // ============================================
    // MÉTODOS DE VERIFICACIÓN DE ROLES
    // ============================================
    
    /**
     * Verificar si el usuario es administrador
     */
    public function esAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Verificar si el usuario es juez
     */
    public function esJuez()
    {
        return $this->hasRole('juez');
    }

    /**
     * Verificar si es juez de un evento específico
     */
    public function esJuezDe($eventoId)
    {
        return $this->eventosComoJuez()->where('event_id', $eventoId)->exists();
    }

    // ============================================
    // RELACIONES DE EQUIPOS
    // ============================================
    
    /**
     * Equipos donde es líder
     */
    public function equiposComoLider()
=======
    // ============= RELACIONES CON EQUIPOS =============
    
    /**
     * Equipos donde el usuario es líder
     */
    public function teamsAsLeader()
>>>>>>> Stashed changes
    {
        return $this->hasMany(Team::class, 'lider_id');
    }

    /**
<<<<<<< Updated upstream
     * Equipos donde es diseñador
     */
    public function equiposComoDisenador()
=======
     * Equipos donde el usuario es diseñador
     */
    public function teamsAsDesigner()
>>>>>>> Stashed changes
    {
        return $this->hasMany(Team::class, 'disenador_id');
    }

    /**
<<<<<<< Updated upstream
     * Equipos donde es programador front
     */
    public function equiposComoFront()
=======
     * Equipos donde el usuario es programador frontend
     */
    public function teamsAsFrontend()
>>>>>>> Stashed changes
    {
        return $this->hasMany(Team::class, 'frontprog_id');
    }

    /**
<<<<<<< Updated upstream
     * Equipos donde es programador back
     */
    public function equiposComoBack()
=======
     * Equipos donde el usuario es programador backend
     */
    public function teamsAsBackend()
>>>>>>> Stashed changes
    {
        return $this->hasMany(Team::class, 'backprog_id');
    }

    /**
<<<<<<< Updated upstream
     * Obtener todos los equipos del usuario (en cualquier rol)
     */
    public function todosLosEquipos()
=======
     * Todos los equipos del usuario (en cualquier rol)
     */
    public function teams()
>>>>>>> Stashed changes
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->get();
    }

<<<<<<< Updated upstream
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

    /**
     * Verificar si el usuario está en algún equipo
     */
    public function tieneEquipo()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
=======
    // ============= RELACIONES CON EVENTOS (JUECES) =============
    
    /**
     * Relación con eventos como juez
     */
    public function eventsAsJudge()
    {
        return $this->belongsToMany(Event::class, 'event_judge', 'user_id', 'event_id')
                    ->withTimestamps();
    }

    /**
     * Calificaciones dadas por el juez
     */
    public function scoresGiven()
    {
        return $this->hasMany(TeamScore::class, 'user_id');
    }

    // ============= MÉTODOS DE VERIFICACIÓN DE ROLES =============
    
    /**
     * Verificar si es juez
     */
    public function isJudge(): bool
    {
        return $this->hasRole('juez');
    }

    /**
     * Verificar si es administrador
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('administrador');
    }

    /**
     * Verificar si es participante
     */
    public function isParticipant(): bool
    {
        return $this->hasRole('participante');
    }

    // ============= MÉTODOS PARA JUECES =============
    
    /**
     * Obtener eventos asignados al juez
     */
    public function getAssignedEvents()
    {
        if (!$this->isJudge()) {
            return collect();
        }
        
        return $this->eventsAsJudge()->with(['teams', 'judges'])->get();
    }

    /**
     * Verificar si el juez ya calificó a un equipo en un criterio específico
     */
    public function hasEvaluatedTeam($teamId, $eventId, $criteriaId): bool
    {
        return $this->scoresGiven()
            ->where('team_id', $teamId)
            ->where('event_id', $eventId)
            ->where('evaluation_criteria_id', $criteriaId)
>>>>>>> Stashed changes
            ->exists();
    }

    /**
<<<<<<< Updated upstream
     * Obtener el equipo actual del usuario
     */
    public function equipoActual()
    {
        return Team::where('lider_id', $this->id)
            ->orWhere('disenador_id', $this->id)
            ->orWhere('frontprog_id', $this->id)
            ->orWhere('backprog_id', $this->id)
            ->first();
    }
}
=======
     * Obtener total de equipos evaluados por el juez
     */
    public function getTotalEvaluatedTeams(): int
    {
        return $this->scoresGiven()
            ->distinct('team_id')
            ->count('team_id');
    }

    /**
     * Obtener estadísticas del juez
     */
    public function getJudgeStats(): array
    {
        if (!$this->isJudge()) {
            return [];
        }

        return [
            'total_events' => $this->eventsAsJudge()->count(),
            'active_events' => $this->eventsAsJudge()->where('estado', 'Activo')->count(),
            'total_scores' => $this->scoresGiven()->count(),
            'teams_evaluated' => $this->getTotalEvaluatedTeams(),
        ];
    }

    // ============= MÉTODOS AUXILIARES =============

    /**
     * Verificar si el usuario pertenece a un equipo específico
     */
    public function belongsToTeam($teamId): bool
    {
        return Team::where('id', $teamId)
            ->where(function ($query) {
                $query->where('lider_id', $this->id)
                      ->orWhere('disenador_id', $this->id)
                      ->orWhere('frontprog_id', $this->id)
                      ->orWhere('backprog_id', $this->id);
            })
            ->exists();
    }

    /**
     * Obtener rol del usuario en un equipo específico
     */
    public function getRoleInTeam($teamId): ?string
    {
        $team = Team::find($teamId);
        
        if (!$team) {
            return null;
        }

        if ($team->lider_id === $this->id) return 'Líder';
        if ($team->disenador_id === $this->id) return 'Diseñador';
        if ($team->frontprog_id === $this->id) return 'Programador Frontend';
        if ($team->backprog_id === $this->id) return 'Programador Backend';

        return null;
    }




}
>>>>>>> Stashed changes
