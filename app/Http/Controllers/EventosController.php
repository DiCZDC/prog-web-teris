<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index()
    {
        $eventosPopulares = Event::populares()->get();
        return view('event.index', compact('eventosPopulares'));
    }

    public function show($id)
    {
        $evento = Event::findOrFail($id);
        return view('event.show', compact('evento'));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');
        $eventos = Event::activos()
            ->where('nombre', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();
        
        return view('event.buscar', compact('eventos', 'query'));
    }

    // NUEVO: Mostrar formulario de creación
    public function create()
    {
        return view('eventos.create');
    }

    // NUEVO: Guardar evento con imagen
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
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_finalizacion' => $request->fecha_finalizacion,
            'estado' => $request->estado,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'detalles_adicionales' => $request->detalles_adicionales,
            'popular' => $request->has('popular')
        ]);

        return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente');
    }
}