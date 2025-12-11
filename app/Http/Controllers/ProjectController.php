<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
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
        $team = null;
        
        if ($teamId) {
            $team = Team::with('evento')->findOrFail($teamId);
            
            // Verificar que el usuario pertenece al equipo y es el líder
            if (!$team->esLider(Auth::id())) {
                return redirect()->route('teams.show', $team)
                    ->with('error', 'Solo el líder del equipo puede subir proyectos.');
            }
            
            // VALIDACIÓN CRÍTICA: Verificar si ya tiene proyecto (UNA SOLA OPORTUNIDAD)
            if ($team->tieneProyecto()) {
                return redirect()->route('projects.show', $team->proyecto)
                    ->with('error', 'Este equipo ya tiene un proyecto registrado. No es posible subir otro proyecto.');
            }
            
            // Verificar que el equipo está en un evento activo
            if (!$team->evento || $team->evento->estado !== 'Activo') {
                return redirect()->route('teams.show', $team)
                    ->with('error', 'El equipo debe estar en un evento activo para subir proyectos.');
            }
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
     * MODIFICADO: Implementa validación estricta de una sola oportunidad
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',  // Cambiado de 'titulo' a 'nombre' para coincidir con tu modelo
            'descripcion' => 'nullable|string',
            'url' => 'required|url|max:500',
            'repositorio_url' => 'nullable|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'documentacion_url' => 'nullable|url|max:500',
            'team_id' => 'required|exists:teams,id',
        ], [
            'nombre.required' => 'El título del proyecto es obligatorio.',
            'nombre.max' => 'El título no puede exceder 255 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder 5000 caracteres.',
            'url.required' => 'La URL del proyecto es obligatoria.',
            'url.url' => 'La URL del proyecto debe ser válida.',
            'repositorio_url.url' => 'La URL del repositorio debe ser válida.',
            'demo_url.url' => 'La URL del demo debe ser válida.',
            'documentacion_url.url' => 'La URL de la documentación debe ser válida.',
            'team_id.required' => 'Debes seleccionar un equipo.',
            'team_id.exists' => 'El equipo seleccionado no existe.',
        ]);
        
        $team = Team::with('evento')->findOrFail($request->team_id);
        
        // VALIDACIÓN CRÍTICA #1: Verificar permisos
        if (!$team->esLider(Auth::id())) {
            return redirect()->back()
                ->with('error', 'Solo el líder del equipo puede subir proyectos.')
                ->withInput();
        }
        
        // VALIDACIÓN CRÍTICA #2: Verificar si ya tiene proyecto (UNA SOLA OPORTUNIDAD)
        if ($team->tieneProyecto()) {
            return redirect()->route('projects.show', $team->proyecto)
                ->with('error', 'Este equipo ya tiene un proyecto registrado. Solo se permite una subida por equipo.');
        }
        
        // Verificar que el equipo está en un evento activo
        if (!$team->evento || $team->evento->estado !== 'Activo') {
            return redirect()->back()
                ->with('error', 'El equipo debe estar en un evento activo para subir proyectos.')
                ->withInput();
        }
        
        // Usar transacción para asegurar integridad de datos
        DB::beginTransaction();
        
        try {
            // Crear proyecto
            $project = Project::create([
                'nombre' => $request->nombre,
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
            
            DB::commit();
            
            // MODIFICADO: Redirigir a la vista de confirmación del proyecto
            return redirect()->route('projects.show', $project)
                ->with('success', '¡Tu proyecto ha sido enviado exitosamente! Los jueces ya pueden acceder a él para evaluarlo.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Ocurrió un error al subir el proyecto. Por favor, intenta nuevamente.')
                ->withInput();
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
     * MODIFICADO: Ahora muestra vista de solo lectura después de subir
     */
    public function show(Project $project)
    {
        $project->load(['team', 'team.evento', 'team.lider', 'creador', 'evaluaciones', 'evaluaciones.judge']);
        
        // Verificar que el usuario tiene permiso para ver este proyecto
        $user = Auth::user();
        $canView = $user->hasRole('admin') || 
                   $user->hasRole('judge') ||
                   $project->team->esMiembro($user->id);
        
        if (!$canView) {
            abort(403, 'No tienes permiso para ver este proyecto.');
        }
        
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     * MODIFICADO: Bloquea la edición una vez subido el proyecto
     */
    public function edit(Project $project)
    {
        // BLOQUEO DE EDICIÓN: Una vez subido, no se puede editar
        return redirect()->route('projects.show', $project)
            ->with('error', 'Los proyectos no pueden ser editados una vez subidos. Solo tienes una oportunidad para subirlo correctamente.');
    }

    /**
     * Update the specified resource in storage.
     * MODIFICADO: Bloquea cualquier intento de actualización
     */
    public function update(Request $request, Project $project)
    {
        // BLOQUEO DE ACTUALIZACIÓN: Una vez subido, no se puede modificar
        return redirect()->route('projects.show', $project)
            ->with('error', 'Los proyectos no pueden ser editados una vez subidos. Solo tienes una oportunidad para subirlo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     * MODIFICADO: Bloquea la eliminación (opcional - puedes permitirla si necesitas)
     */
    public function destroy(Project $project)
    {
        // BLOQUEO DE ELIMINACIÓN: Una vez subido, no se puede eliminar
        return redirect()->route('projects.show', $project)
            ->with('error', 'Los proyectos no pueden ser eliminados una vez subidos.');
        
        /* SI QUIERES PERMITIR ELIMINACIÓN SOLO A ADMINS, USA ESTO:
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Solo los administradores pueden eliminar proyectos.');
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
        */
    

        // Verificar que el usuario sea el líder del equipo o admin
        if ($team->lider_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            return back()->with('error', 'No tienes permisos para eliminar este proyecto.');
        }

        $project->delete();

        return redirect()->route('teams.show', $team)->with('success', 'Proyecto eliminado exitosamente.');
    }
}