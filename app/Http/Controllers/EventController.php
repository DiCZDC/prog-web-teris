<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Display a listing of popular events
     */
    public function index()
    {
        $events = Event::populares()
            ->orderBy('inicio_evento', 'desc')
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event
     */
   public function create()
{
    // Solo admins pueden crear eventos
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403, 'No tienes permiso para crear eventos');
    }
    
    // Obtener todos los usuarios con rol de juez
    $judges = User::role('juez')->get();
    
    return view('events.create', compact('judges'));
}

    /**
     * Store a newly created event in storage
     */
    public function store(Request $request)
{
    // Solo admins pueden crear eventos
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403, 'No tienes permiso para crear eventos');
    }

    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|min:10',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'inicio_evento' => 'required|date|after:now',
        'fin_evento' => 'required|date|after:inicio_evento',
        'estado' => ['required', Rule::in(['Activo', 'Inactivo'])],
        'modalidad' => ['required', Rule::in(['Presencial', 'Virtual', 'Híbrido'])],
        'ubicacion' => 'nullable|string|max:255',
        'reglas' => 'required|string',
        'premios' => 'required|string',
        'popular' => 'boolean',
        'judges' => 'nullable|array', // ⭐ NUEVO: Validar array de jueces
        'judges.*' => 'exists:users,id', // ⭐ NUEVO: Cada juez debe existir
    ], [
        // ... tus mensajes existentes ...
        'judges.array' => 'Los jueces deben ser un array válido',
        'judges.*.exists' => 'Uno o más jueces seleccionados no existen',
    ]);

    // Guardar la imagen
    if ($request->hasFile('imagen')) {
        $imagePath = $request->file('imagen')->store('eventos', 'public');
        $validated['imagen'] = 'storage/' . $imagePath;
    }

    // Establecer valor por defecto para popular si no viene
    $validated['popular'] = $request->has('popular') ? true : false;

    // Crear el evento
    $event = Event::create($validated);

    // ⭐ NUEVO: Asignar jueces al evento
    if ($request->has('judges') && is_array($request->judges)) {
        $event->judges()->attach($request->judges);
    }

    return redirect()
        ->route('events.show', $event->id)
        ->with('success', '¡Evento creado exitosamente!');
}
    /**
     * Display the specified event
     */
   public function show($id)
{
    // ⭐ Agregar 'judges' al with() para cargar los jueces
    $event = Event::with([
        'teams.lider', 
        'teams.disenador', 
        'teams.frontprog', 
        'teams.backprog',
        'judges'  // ⭐ AGREGAR ESTA LÍNEA
    ])->findOrFail($id);
    
    return view('events.show', compact('event'));
}

    /**
     * Show the form for editing the specified event
     */
    public function edit($id)
{
    $event = Event::with('judges')->findOrFail($id);
    
    // Solo admins pueden editar eventos
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403, 'No tienes permiso para editar eventos');
    }
    
    // Obtener todos los usuarios con rol de juez
    $judges = User::role('juez')->get();
    
    return view('events.edit', compact('event', 'judges'));
}

    /**
     * Update the specified event in storage
     */
    public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);
    
    // Solo admins pueden actualizar eventos
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403, 'No tienes permiso para actualizar eventos');
    }

    $validated = $request->validate([
        // ... tu validación existente ...
        'judges' => 'nullable|array', // ⭐ NUEVO
        'judges.*' => 'exists:users,id', // ⭐ NUEVO
    ]);

    // Manejar la nueva imagen si se subió una
    if ($request->hasFile('imagen')) {
        // ... tu código existente ...
    }

    // Actualizar popular
    $validated['popular'] = $request->has('popular') ? true : false;

    // Actualizar el evento
    $event->update($validated);

    // ⭐ NUEVO: Sincronizar jueces (elimina los anteriores y agrega los nuevos)
    if ($request->has('judges')) {
        $event->judges()->sync($request->judges);
    } else {
        // Si no se enviaron jueces, eliminar todos
        $event->judges()->detach();
    }

    return redirect()
        ->route('events.show', $event->id)
        ->with('success', '¡Evento actualizado exitosamente!');
}

    /**
     * Remove the specified event from storage
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        // Solo admins pueden eliminar eventos
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para eliminar eventos');
        }

        // Verificar si tiene equipos registrados
        if ($event->teams()->count() > 0) {
            return redirect()
                ->route('events.index')
                ->with('error', 'No se puede eliminar un evento que tiene equipos registrados');
        }

        // Eliminar imagen si existe
        if ($event->imagen && str_starts_with($event->imagen, 'storage/')) {
            $imagePath = str_replace('storage/', '', $event->imagen);
            Storage::disk('public')->delete($imagePath);
        }

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento eliminado exitosamente');
    }

    /**
     * Search events
     */
    public function search(Request $request)
    {
        // Validar y sanitizar el input
        $validated = $request->validate([
            'q' => 'required|string|min:1|max:255',
        ]);

        $query = $validated['q'];
        
        // Buscar eventos activos que coincidan con la búsqueda
        $eventos = Event::activos()
            ->where(function($q) use ($query) {
                $q->where('nombre', 'like', "%{$query}%")
                  ->orWhere('descripcion', 'like', "%{$query}%")
                  ->orWhere('ubicacion', 'like', "%{$query}%");
            })
            ->orderBy('inicio_evento', 'desc')
            ->paginate(12);
        
        return view('events.search', compact('eventos', 'query'));
    }

    /**
     * Display the teams associated with a specific event
     */
    public function teams($id)
    {
        $event = Event::findOrFail($id);
        
        $teams = Team::where('evento_id', $id)
            ->where('estado', true)
            ->with(['lider', 'disenador', 'frontprog', 'backprog'])
            ->orderBy('nombre')
            ->paginate(12);
        
        return view('events.teams.index', compact('teams', 'event'));
    }

    /**
     * Get the count of teams for a specific event
     */
    public function num_teams($id)
    {
        $teamsCount = Team::where('evento_id', $id)
            ->where('estado', true)
            ->count();
        
        return response()->json([
            'count' => $teamsCount
        ]);
    }

    /**
     * Toggle popular status
     */
    public function togglePopular($id)
    {
        $event = Event::findOrFail($id);
        
        // Solo admins pueden cambiar el estado popular
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        $event->popular = !$event->popular;
        $event->save();

        return redirect()
            ->back()
            ->with('success', $event->popular ? 'Evento marcado como popular' : 'Evento desmarcado como popular');
    }

    /**
     * Toggle event status
     */
    public function toggleStatus($id)
    {
        $event = Event::findOrFail($id);
        
        // Solo admins pueden cambiar el estado
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        $event->estado = $event->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $event->save();

        return redirect()
            ->back()
            ->with('success', 'Estado del evento actualizado');
    }

/**
 * Ver jueces asignados a un evento
 */
public function showJudges($id)
{
    $event = Event::with('judges')->findOrFail($id);
    
    return response()->json([
        'event' => $event->nombre,
        'judges_count' => $event->judges->count(),
        'judges' => $event->judges->map(function($judge) {
            return [
                'id' => $judge->id,
                'name' => $judge->name,
                'email' => $judge->email,
            ];
        })
    ]);
}



}