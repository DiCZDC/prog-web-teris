<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /** Mostrar la lista de eventos */
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->hasRole('juez')) {
            $events = $user->eventsAsJudge()
                ->orderBy('inicio_evento', 'desc')
                ->paginate(30);
        } else {
            $events = Event::populares()->paginate(30);
        }

        return view('events.index', compact('events'));
    }


    /** Mostrar formulario de creación */
    public function create()
    {
        $judges = User::role('juez')->get();
        return view('events.create', compact('judges'));
    }


    /** Guardar evento */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'inicio_evento' => 'required|date',
            'fin_evento' => 'required|date|after_or_equal:inicio_evento',
            'modalidad' => 'required|in:Presencial,Virtual,Híbrido',
            'ubicacion' => 'nullable|string',
            'reglas' => 'nullable|string',
            'premios' => 'nullable|string',
            'judges' => 'array',
            'judges.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {

            $imagenPath = $request->file('imagen')->store('eventos', 'public');

            $event = Event::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $imagenPath,
                'inicio_evento' => $request->inicio_evento,
                'fin_evento' => $request->fin_evento,
                'modalidad' => $request->modalidad,
                'ubicacion' => $request->ubicacion,
                'reglas' => $request->reglas,
                'premios' => $request->premios,
                'popular' => $request->has('popular')
            ]);

            if ($request->has('judges')) {
                foreach ($request->judges as $judgeId) {
                    $judge = User::find($judgeId);
                    if ($judge && $judge->hasRole('juez')) {
                        $event->judges()->attach($judgeId);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('events.show', $event->id)
                ->with('success', 'Evento creado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            Storage::disk('public')->delete($imagenPath);
            return back()->withErrors(['error' => 'Error: '.$e->getMessage()]);
        }
    }


    /** Mostrar un evento */
    public function show($id)
    {
        $event = Event::with(['teams', 'judges'])->findOrFail($id);

        return view('events.show', compact('event'));
    }


    /** Mostrar equipos de un evento */
    public function teams($id)
    {
        $event = Event::findOrFail($id);
        $teams = Team::where('evento_id', $id)
            ->with(['lider', 'disenador', 'frontprog', 'backprog', 'evento'])
            ->paginate(12);

        return view('events.teams.index', compact('teams', 'event'));
    }


    /** Editar evento */
    public function edit($id)
    {
        $event = Event::with('judges')->findOrFail($id);
        $judges = User::role('juez')->get();

        return view('events.edit', compact('event', 'judges'));
    }


    /** Actualizar evento */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'inicio_evento' => 'required|date',
            'fin_evento' => 'required|date|after_or_equal:inicio_evento',
            'estado' => 'required|in:Activo,Inactivo,Completado,Cancelado',
            'modalidad' => 'required|in:Presencial,Virtual,Híbrido',
            'ubicacion' => 'nullable|string',
            'reglas' => 'nullable|string',
            'premios' => 'nullable|string',
            'judges' => 'array',
            'judges.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            $imagenPath = $event->imagen;

            if ($request->hasFile('imagen')) {
                Storage::disk('public')->delete($imagenPath);
                $imagenPath = $request->file('imagen')->store('eventos', 'public');
            }

            $event->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $imagenPath,
                'inicio_evento' => $request->inicio_evento,
                'fin_evento' => $request->fin_evento,
                'estado' => $request->estado,
                'modalidad' => $request->modalidad,
                'ubicacion' => $request->ubicacion,
                'reglas' => $request->reglas,
                'premios' => $request->premios,
                'popular' => $request->has('popular')
            ]);

            if ($request->has('judges')) {
                $validJudges = User::role('juez')
                    ->whereIn('id', $request->judges)
                    ->pluck('id')
                    ->toArray();

                $event->judges()->sync($validJudges);
            } else {
                $event->judges()->detach();
            }

            DB::commit();

            return redirect()
                ->route('events.show', $event->id)
                ->with('success', 'Evento actualizado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error: '.$e->getMessage()]);
        }
    }


    /** Eliminar evento */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->imagen) {
            Storage::disk('public')->delete($event->imagen);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado exitosamente');
    }
}
