<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with(['lider', 'disenador', 'frontprog', 'backprog', 'evento'])
            ->where('estado', true)
            ->paginate(12);
        
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eventos = Event::where('estado', 'activo')->get();
        return view('teams.create', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'evento_id' => 'nullable|exists:events,id',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Generar código único
        $validated['codigo'] = $this->generarCodigoUnico();
        $validated['lider_id'] = Auth::id();
        $validated['estado'] = true;

        // Manejar el icono
        if ($request->hasFile('icono')) {
            $validated['icono'] = $request->file('icono')->store('team_icons', 'public');
        }

        $team = Team::create($validated);

        return redirect()->route('teams.show', $team)
            ->with('success', '¡Equipo creado exitosamente! Código: ' . $team->codigo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->load(['lider', 'disenador', 'frontprog', 'backprog', 'evento']);
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.index')
                ->with('error', 'No tienes permiso para editar este equipo');
        }

        $eventos = Event::where('estado', 'activo')->get();
        return view('teams.edit', compact('team', 'eventos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.index')
                ->with('error', 'No tienes permiso para editar este equipo');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'evento_id' => 'nullable|exists:events,id',
            'estado' => 'boolean',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Manejar el icono
        if ($request->hasFile('icono')) {
            // Eliminar el icono anterior si existe
            if ($team->icono) {
                Storage::disk('public')->delete($team->icono);
            }
            $validated['icono'] = $request->file('icono')->store('team_icons', 'public');
        }

        $team->update($validated);

        return redirect()->route('teams.show', $team)
            ->with('success', 'Equipo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Verificar que el usuario sea el líder del equipo
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.index')
                ->with('error', 'No tienes permiso para eliminar este equipo');
        }

        // Eliminar el icono si existe
        if ($team->icono) {
            Storage::disk('public')->delete($team->icono);
        }

        $team->delete();

        return redirect()->route('teams.index')
            ->with('success', 'Equipo eliminado exitosamente');
    }

    /**
     * Mostrar formulario para unirse a un equipo
     */
    public function join()
    {
        $user = Auth::user();
        
        // Verificar si el usuario ya está en un equipo
        $equipoActual = Team::where('lider_id', $user->id)
            ->orWhere('disenador_id', $user->id)
            ->orWhere('frontprog_id', $user->id)
            ->orWhere('backprog_id', $user->id)
            ->first();

        return view('teams.join', compact('equipoActual'));
    }

    /**
     * Procesar la unión a un equipo
     */
    public function joinTeam(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|exists:teams,codigo',
            'rol' => 'required|in:DISEÑADOR,PROGRAMADOR FRONT,PROGRAMADOR BACK'
        ]);

        $user = Auth::user();
        $team = Team::where('codigo', $validated['codigo'])->first();

        // Verificar si el usuario ya está en un equipo
        $equipoActual = Team::where('lider_id', $user->id)
            ->orWhere('disenador_id', $user->id)
            ->orWhere('frontprog_id', $user->id)
            ->orWhere('backprog_id', $user->id)
            ->first();

        if ($equipoActual) {
            return back()->with('error', 'Ya eres miembro de un equipo');
        }

        // Asignar rol según la selección
        $rolAsignado = false;
        switch ($validated['rol']) {
            case 'DISEÑADOR':
                if (!$team->disenador_id) {
                    $team->disenador_id = $user->id;
                    $rolAsignado = true;
                }
                break;
            case 'PROGRAMADOR FRONT':
                if (!$team->frontprog_id) {
                    $team->frontprog_id = $user->id;
                    $rolAsignado = true;
                }
                break;
            case 'PROGRAMADOR BACK':
                if (!$team->backprog_id) {
                    $team->backprog_id = $user->id;
                    $rolAsignado = true;
                }
                break;
        }

        if ($rolAsignado) {
            $team->save();
            return redirect()->route('teams.show', $team)
                ->with('success', '¡Te has unido al equipo exitosamente como ' . $validated['rol'] . '!');
        }

        return back()->with('error', 'La posición seleccionada ya está ocupada');
    }

    /**
     * Generar código único para el equipo
     */
    private function generarCodigoUnico()
    {
        do {
            // Generar código de 6 caracteres alfanuméricos
            $codigo = strtoupper(Str::random(6));
        } while (Team::where('codigo', $codigo)->exists());

        return $codigo;
    }

    /**
     * Salir del equipo
     */
    public function leave(Team $team)
    {
        $user = Auth::user();

        // No permitir que el líder salga del equipo
        if ($team->lider_id == $user->id) {
            return back()->with('error', 'El líder no puede abandonar el equipo. Debes eliminarlo o transferir el liderazgo.');
        }

        // Remover al usuario del equipo
        if ($team->disenador_id == $user->id) {
            $team->disenador_id = null;
        } elseif ($team->frontprog_id == $user->id) {
            $team->frontprog_id = null;
        } elseif ($team->backprog_id == $user->id) {
            $team->backprog_id = null;
        } else {
            return back()->with('error', 'No eres miembro de este equipo');
        }

        $team->save();

        return redirect()->route('teams.index')
            ->with('success', 'Has salido del equipo exitosamente');
    }
}
