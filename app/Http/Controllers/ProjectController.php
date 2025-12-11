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
        $projects = Project::with(['team', 'team.evento'])->paginate(10);
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
        // Obtener el team_id de la query string
        $teamId = $request->query('team_id');

        if (!$teamId) {
            return redirect()->route('teams.index')->with('error', 'Debes especificar un equipo.');
        }

        $team = Team::findOrFail($teamId);

        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.show', $team)->with('error', 'Solo el líder del equipo puede enviar el proyecto.');
        }

        // Verificar si el equipo ya tiene un proyecto
        if ($team->proyecto) {
            return redirect()->route('projects.edit', $team->proyecto)->with('info', 'Este equipo ya tiene un proyecto. Puedes editarlo aquí.');
        }

        return view('projects.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'repositorio_url' => 'required|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'documentacion_url' => 'nullable|url|max:500',
        ], [
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'descripcion.required' => 'La descripción del proyecto es obligatoria.',
            'repositorio_url.required' => 'La URL del repositorio de GitHub es obligatoria.',
            'repositorio_url.url' => 'La URL del repositorio debe ser una URL válida.',
            'demo_url.url' => 'La URL de demo debe ser una URL válida.',
            'documentacion_url.url' => 'La URL de documentación debe ser una URL válida.',
        ]);

        $team = Team::findOrFail($validated['team_id']);

        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder del equipo puede enviar el proyecto.');
        }

        // Verificar si el equipo ya tiene un proyecto
        if ($team->proyecto) {
            return redirect()->route('projects.edit', $team->proyecto)->with('error', 'Este equipo ya tiene un proyecto. Puedes editarlo en lugar de crear uno nuevo.');
        }

        // Crear el proyecto
        $project = Project::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'team_id' => $team->id,
            'estado' => true, // Activo por defecto
            'repositorio_url' => $validated['repositorio_url'],
            'demo_url' => $validated['demo_url'] ?? null,
            'documentacion_url' => $validated['documentacion_url'] ?? null,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('teams.show', $team)->with('success', '¡Proyecto enviado exitosamente! Los jueces podrán revisarlo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['team', 'team.evento', 'evaluaciones']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $team = $project->team;

        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.show', $team)->with('error', 'Solo el líder del equipo puede editar el proyecto.');
        }

        return view('projects.create', compact('team', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'repositorio_url' => 'required|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'documentacion_url' => 'nullable|url|max:500',
        ], [
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'descripcion.required' => 'La descripción del proyecto es obligatoria.',
            'repositorio_url.required' => 'La URL del repositorio de GitHub es obligatoria.',
            'repositorio_url.url' => 'La URL del repositorio debe ser una URL válida.',
            'demo_url.url' => 'La URL de demo debe ser una URL válida.',
            'documentacion_url.url' => 'La URL de documentación debe ser una URL válida.',
        ]);

        $team = $project->team;

        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder del equipo puede editar el proyecto.');
        }

        // Actualizar el proyecto
        $project->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'repositorio_url' => $validated['repositorio_url'],
            'demo_url' => $validated['demo_url'] ?? null,
            'documentacion_url' => $validated['documentacion_url'] ?? null,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('teams.show', $team)->with('success', '¡Proyecto actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $team = $project->team;

        // Verificar que el usuario sea el líder del equipo o admin
        if ($team->lider_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            return back()->with('error', 'No tienes permisos para eliminar este proyecto.');
        }

        $project->delete();

        return redirect()->route('teams.show', $team)->with('success', 'Proyecto eliminado exitosamente.');
    }
} 