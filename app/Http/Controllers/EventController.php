<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::populares()->paginate(12);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación corregida según el formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url|max:500', // Ahora es URL, no archivo
            'inicio_evento' => 'required|date',
            'fin_evento' => 'required|date|after_or_equal:inicio_evento',
            'modalidad' => 'required|in:Presencial,Virtual,Híbrido',
            'ubicacion' => 'nullable|string|max:255',
            'reglas' => 'nullable|string',
            'premios' => 'nullable|string',
            'popular' => 'sometimes|boolean' // Cambiado a sometimes
        ]);

        // Crear el evento con la URL de la imagen
        $event = Event::create([
            'nombre' => $validated['name'],
            'descripcion' => $validated['description'],
            'imagen' => $validated['image_url'], // Guardar la URL directamente
            'inicio_evento' => $validated['inicio_evento'],
            'fin_evento' => $validated['fin_evento'],
            'estado' => 'Activo', // Estado por defecto
            'modalidad' => $validated['modalidad'],
            'ubicacion' => $validated['ubicacion'] ?? null,
            'reglas' => $validated['reglas'] ?? null,
            'premios' => $validated['premios'] ?? null,
            'popular' => $request->has('popular') // Solo si está marcado
        ]);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Evento creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Display the teams associated with a specific event.
     */
    public function teams($id)
    {
        $event = Event::findOrFail($id);
        $teams = Team::where('evento_id', $id)
            ->with(['lider', 'disenador', 'frontprog', 'backprog', 'evento'])
            ->paginate(12);
        
        return view('events.teams.index', compact('teams', 'event'));
    }

    /**
     * Count teams for an event.
     */
    public function num_teams($id)
    {
        $teamsCount = Team::where('evento_id', $id)->count();
        return $teamsCount;
    }

    /**
     * Search for events.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $eventos = Event::activos()
            ->where(function($q) use ($query) {
                $q->where('nombre', 'like', "%{$query}%")
                  ->orWhere('descripcion', 'like', "%{$query}%")
                  ->orWhere('ubicacion', 'like', "%{$query}%");
            })
            ->paginate(12);
        
        return view('events.search', compact('eventos', 'query'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url|max:500',
            'inicio_evento' => 'required|date',
            'fin_evento' => 'required|date|after_or_equal:inicio_evento',
            'estado' => 'required|in:Activo,Inactivo',
            'modalidad' => 'required|in:Presencial,Virtual,Híbrido',
            'ubicacion' => 'nullable|string|max:255',
            'reglas' => 'nullable|string',
            'premios' => 'nullable|string',
            'popular' => 'sometimes|boolean'
        ]);

        $event->update([
            'nombre' => $validated['name'],
            'descripcion' => $validated['description'],
            'imagen' => $validated['image_url'],
            'inicio_evento' => $validated['inicio_evento'],
            'fin_evento' => $validated['fin_evento'],
            'estado' => $validated['estado'],
            'modalidad' => $validated['modalidad'],
            'ubicacion' => $validated['ubicacion'] ?? null,
            'reglas' => $validated['reglas'] ?? null,
            'premios' => $validated['premios'] ?? null,
            'popular' => $request->has('popular')
        ]);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Evento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado exitosamente');
    }
}