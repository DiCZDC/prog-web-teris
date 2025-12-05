<?php

namespace App\Http\Controllers;

use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::populares()->paginate(30);
        // $events = Event::populares()->get();

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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:Activo,Inactivo',
            'modalidad' => 'required|in:Presencial,Virtual,Híbrido',
            'ubicacion' => 'nullable|string',
            'detalles_adicionales' => 'nullable|string',
            'popular' => 'boolean'
        ]);

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('eventos', 'public');
        }

        // Crear el evento
        Event::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
            'inicio_evento' => $request->inicio_evento,
            'fin_evento' => $request->fin_evento,
            'estado' => $request->estado,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'reglas' => $request->reglas,
            'popular' => $request->has('popular')
        ]);

        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q');
        $eventos = Event::activos()
            ->where('nombre', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();
        
        return view('events.search', compact('eventos', 'query'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events)
    {
        //
    }
}
