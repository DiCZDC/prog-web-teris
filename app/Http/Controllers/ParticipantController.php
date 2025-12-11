<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    /**
     * Mostrar todos los eventos donde el usuario participa
     */
    public function misEventos()
    {
        $user = Auth::user();
        
        // Obtener equipos donde el usuario es miembro (cualquier rol)
        $equipos = Team::where('lider_id', $user->id)
            ->orWhere('disenador_id', $user->id)
            ->orWhere('frontprog_id', $user->id)
            ->orWhere('backprog_id', $user->id)
            ->with([
                'evento',
                'lider',
                'proyecto.evaluaciones'
            ])
            ->get();
        
        // Agrupar por evento y agregar información adicional
        $eventosConEquipos = $equipos->map(function($equipo) use ($user) {
            $proyecto = $equipo->proyecto;
            $evaluaciones = $proyecto ? $proyecto->evaluaciones : collect();
            
            return [
                'equipo' => $equipo,
                'evento' => $equipo->evento,
                'mi_rol' => $equipo->getRolDelUsuario($user->id),
                'tiene_proyecto' => $proyecto !== null,
                'proyecto' => $proyecto,
                'total_evaluaciones' => $evaluaciones->count(),
                'promedio_calificacion' => $evaluaciones->avg('total_score'),
                'esta_calificado' => $evaluaciones->count() > 0,
            ];
        });
        
        return view('participant.mis-eventos', compact('eventosConEquipos'));
    }
    
    /**
     * Ver detalles de mi equipo en un evento específico
     */
    public function verMiEquipo($eventoId)
    {
        $user = Auth::user();
        
        // Buscar el equipo del usuario en este evento
        $equipo = Team::where('evento_id', $eventoId)
            ->where(function($query) use ($user) {
                $query->where('lider_id', $user->id)
                    ->orWhere('disenador_id', $user->id)
                    ->orWhere('frontprog_id', $user->id)
                    ->orWhere('backprog_id', $user->id);
            })
            ->with([
                'evento',
                'lider',
                'disenador',
                'frontprog',
                'backprog',
                'proyecto.evaluaciones.judge'
            ])
            ->firstOrFail();
        
        $miRol = $equipo->getRolDelUsuario($user->id);
        $esLider = $equipo->lider_id === $user->id;
        
        // Estadísticas del proyecto
        $estadisticasProyecto = null;
        if ($equipo->proyecto) {
            $evaluaciones = $equipo->proyecto->evaluaciones;
            $estadisticasProyecto = [
                'total_evaluaciones' => $evaluaciones->count(),
                'promedio_general' => $evaluaciones->avg('total_score') ?? 0,
                'mejor_calificacion' => $evaluaciones->max('total_score') ?? 0,
                'peor_calificacion' => $evaluaciones->min('total_score') ?? 0,
            ];
        }
        
        return view('participant.mi-equipo', compact(
            'equipo',
            'miRol',
            'esLider',
            'estadisticasProyecto'
        ));
    }
}