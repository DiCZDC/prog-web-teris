<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Solo administradores pueden ver todos los proyectos
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para ver todos los proyectos.');
        }
        
        $projects = Project::with(['team', 'creador'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('projects.index', compact('projects'));
    }

    /**
     * Mostrar proyectos del usuario actual
     */
    public function myProjects()
    {
        $user = Auth::user();
        
        // Obtener proyectos de los equipos del usuario
        $teamIds = $user->todosLosEquipos()->pluck('id');
        $projects = Project::whereIn('team_id', $teamIds)
            ->with(['team', 'evento'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('projects.my-projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $teamId = $request->query('team_id');
        $team = null;
        
        if ($teamId) {
            $team = Team::with('evento')->findOrFail($teamId);
            
            // Verificar que el usuario pertenece al equipo y es el líder
            if (!$team->esLider(Auth::id())) {
                return redirect()->route('teams.show', $team)
                    ->with('error', 'Solo el líder del equipo puede subir proyectos.');
            }
            
            // Verificar si ya tiene proyecto
            if ($team->tieneProyecto()) {
                return redirect()->route('teams.show', $team)
                    ->with('error', 'Este equipo ya tiene un proyecto registrado.');
            }
            
            // Verificar que el equipo está en un evento activo
            if (!$team->evento || $team->evento->estado !== 'Activo') {
                return redirect()->route('teams.show', $team)
                    ->with('error', 'El equipo debe estar en un evento activo para subir proyectos.');
            }
        }
        
        // Obtener equipos del usuario que son líder y no tienen proyecto
        $misEquipos = Auth::user()->equiposComoLider()
            ->whereDoesntHave('proyecto')
            ->with('evento')
            ->get()
            ->filter(function($equipo) {
                return $equipo->evento && $equipo->evento->estado === 'Activo';
            });
        
        return view('projects.create', [
            'team' => $team,
            'misEquipos' => $misEquipos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url' => 'required|url|max:500',
            'repositorio_url' => 'nullable|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'documentacion_url' => 'nullable|url|max:500',
            'team_id' => 'required|exists:teams,id',
        ]);
        
        $team = Team::with('evento')->findOrFail($request->team_id);
        
        // Verificar permisos
        if (!$team->esLider(Auth::id())) {
            return redirect()->back()
                ->with('error', 'Solo el líder del equipo puede subir proyectos.')
                ->withInput();
        }
        
        // Verificar si ya tiene proyecto
        if ($team->tieneProyecto()) {
            return redirect()->route('teams.show', $team)
                ->with('error', 'Este equipo ya tiene un proyecto registrado.');
        }
        
        // Verificar que el equipo está en un evento activo
        if (!$team->evento || $team->evento->estado !== 'Activo') {
            return redirect()->back()
                ->with('error', 'El equipo debe estar en un evento activo para subir proyectos.')
                ->withInput();
        }
        
        try {
            // Crear proyecto
            $project = Project::create([
                'nombre' => $request->titulo,
                'descripcion' => $request->descripcion,
                'url' => $request->url,
                'repositorio_url' => $request->repositorio_url,
                'demo_url' => $request->demo_url,
                'documentacion_url' => $request->documentacion_url,
                'team_id' => $team->id,
                'estado' => true,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
            
            return redirect()->route('teams.show', $team)
                ->with('success', '¡Proyecto subido exitosamente! Los jueces podrán evaluarlo.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el proyecto: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['team', 'team.evento', 'creador', 'evaluaciones', 'evaluaciones.judge']);
        
        // Verificar que el usuario tiene permiso para ver este proyecto
        $user = Auth::user();
        $canView = $user->hasRole('admin') || 
                   $user->hasRole('juez') ||
                   $project->team->esMiembro($user->id);
        
        if (!$canView) {
            abort(403, 'No tienes permiso para ver este proyecto.');
        }
        
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Verificar que el usuario es líder del equipo
        if (!$project->team->esLider(Auth::id()) && !Auth::user()->hasRole('admin')) {
            abort(403, 'Solo el líder del equipo o un administrador puede editar el proyecto.');
        }
        
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Verificar permisos
        if (!$project->team->esLider(Auth::id()) && !Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para editar este proyecto.');
        }
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url' => 'required|url|max:500',
            'repositorio_url' => 'nullable|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'documentacion_url' => 'nullable|url|max:500',
        ]);
        
        try {
            $project->update([
                'nombre' => $request->titulo,
                'descripcion' => $request->descripcion,
                'url' => $request->url,
                'repositorio_url' => $request->repositorio_url,
                'demo_url' => $request->demo_url,
                'documentacion_url' => $request->documentacion_url,
                'updated_by' => Auth::id(),
            ]);
            
            return redirect()->route('projects.show', $project)
                ->with('success', 'Proyecto actualizado exitosamente.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el proyecto: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Verificar permisos
        if (!$project->team->esLider(Auth::id()) && !Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para eliminar este proyecto.');
        }
        
        try {
            $teamId = $project->team_id;
            $project->delete();
            
            return redirect()->route('teams.show', $teamId)
                ->with('success', 'Proyecto eliminado exitosamente.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Proyectos por equipo
     */
    public function byTeam(Team $team)
    {
        $project = $team->proyecto;
        
        if (!$project) {
            return redirect()->route('teams.show', $team)
                ->with('info', 'Este equipo aún no ha subido un proyecto.');
        }
        
        return redirect()->route('projects.show', $project);
    }

    /**
     * Mostrar proyecto de un equipo específico
     */
    public function showForTeam(Team $team)
    {
        $project = $team->proyecto;
        
        if (!$project) {
            abort(404, 'Este equipo no tiene proyecto registrado.');
        }
        
        return $this->show($project);
    }
} 