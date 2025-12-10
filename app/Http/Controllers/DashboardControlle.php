<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard para usuarios normales
     */
    public function userDashboard()
    {
        $user = Auth::user();
        
        // Estadísticas
        $stats = [
            'mis_equipos' => $user->equipos()->count(),
            'eventos_activos' => Event::where('estado', 'Activo')->count(),
            'mis_proyectos' => Project::whereHas('team', function($query) use ($user) {
                $query->where(function($q) use ($user) {
                    $q->where('lider_id', $user->id)
                      ->orWhere('disenador_id', $user->id)
                      ->orWhere('frontprog_id', $user->id)
                      ->orWhere('backprog_id', $user->id);
                });
            })->count(),
        ];
        
        // Mis equipos
        $misEquipos = $user->equipos()
            ->with(['evento', 'lider'])
            ->latest()
            ->take(5)
            ->get();
        
        // Eventos destacados
        $eventosDestacados = Event::where('estado', 'Activo')
            ->where('popular', true)
            ->orWhere('inicio_evento', '>=', now())
            ->orderBy('inicio_evento')
            ->take(5)
            ->get();
        
        return view('dashboard.user', compact('stats', 'misEquipos', 'eventosDestacados'));
    }
    
    /**
     * Redireccionar según rol
     */
    public function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('judge')) {
            return redirect()->route('judge.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}