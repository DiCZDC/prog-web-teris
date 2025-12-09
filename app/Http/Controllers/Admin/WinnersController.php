<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventWinner;
use App\Models\Team;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WinnersController extends Controller
{
    public function index($eventId)
    {
        $evento = Event::with(['winners.team.lider', 'winners.team.proyecto'])
                       ->findOrFail($eventId);
        
        // Obtener todos los equipos con proyectos y calcular sus promedios
        $equipos = Team::where('evento_id', $eventId)
            ->whereHas('proyecto')
            ->with(['lider', 'proyecto.evaluaciones'])
            ->get()
            ->map(function($equipo) {
                $evaluaciones = $equipo->proyecto->evaluaciones;
                $promedio = $evaluaciones->avg('total_score') ?? 0;
                $totalEvaluaciones = $evaluaciones->count();
                
                $equipo->promedio_evaluaciones = round($promedio, 2);
                $equipo->total_evaluaciones = $totalEvaluaciones;
                
                return $equipo;
            })
            ->sortByDesc('promedio_evaluaciones')
            ->values();
        
        // Obtener ganadores actuales
        $ganadores = EventWinner::where('event_id', $eventId)
                                ->with('team.lider')
                                ->orderBy('position')
                                ->get();
        
        return view('admin.winners.index', compact('evento', 'equipos', 'ganadores'));
    }

    public function assignAutomatic($eventId)
    {
        $evento = Event::findOrFail($eventId);
        
        // Obtener equipos y calcular promedios
        $equiposConEvaluaciones = Team::where('evento_id', $eventId)
            ->whereHas('proyecto.evaluaciones')
            ->with(['proyecto.evaluaciones'])
            ->get()
            ->map(function($equipo) {
                $promedio = $equipo->proyecto->evaluaciones->avg('total_score') ?? 0;
                $equipo->promedio_final = round($promedio, 2);
                return $equipo;
            })
            ->sortByDesc('promedio_final')
            ->values();
        
        if ($equiposConEvaluaciones->count() < 3) {
            return redirect()->back()->with('error', 'No hay suficientes equipos evaluados. Se necesitan al menos 3 equipos con evaluaciones.');
        }
        
        DB::beginTransaction();
        try {
            // Eliminar ganadores anteriores
            EventWinner::where('event_id', $eventId)->delete();
            
            // Asignar Top 3
            $posiciones = ['1', '2', '3'];
            foreach ($posiciones as $index => $posicion) {
                if (isset($equiposConEvaluaciones[$index])) {
                    EventWinner::create([
                        'event_id' => $eventId,
                        'team_id' => $equiposConEvaluaciones[$index]->id,
                        'position' => $posicion,
                        'final_score' => $equiposConEvaluaciones[$index]->promedio_final,
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.events.winners.index', $eventId)
                           ->with('success', '✅ Ganadores asignados automáticamente basándose en las evaluaciones.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al asignar ganadores: ' . $e->getMessage());
        }
    }

    public function assignManual(Request $request, $eventId)
    {
        $validated = $request->validate([
            'first_place' => 'required|exists:teams,id',
            'second_place' => 'required|exists:teams,id|different:first_place',
            'third_place' => 'required|exists:teams,id|different:first_place|different:second_place',
            'first_place_score' => 'required|numeric|min:0|max:10',
            'second_place_score' => 'required|numeric|min:0|max:10',
            'third_place_score' => 'required|numeric|min:0|max:10',
            'first_place_recognition' => 'nullable|string|max:500',
            'second_place_recognition' => 'nullable|string|max:500',
            'third_place_recognition' => 'nullable|string|max:500',
        ]);
        
        DB::beginTransaction();
        try {
            // Eliminar ganadores anteriores
            EventWinner::where('event_id', $eventId)->delete();
            
            // Crear los 3 ganadores
            EventWinner::create([
                'event_id' => $eventId,
                'team_id' => $validated['first_place'],
                'position' => '1',
                'final_score' => $validated['first_place_score'],
                'recognition' => $validated['first_place_recognition'] ?? null,
            ]);
            
            EventWinner::create([
                'event_id' => $eventId,
                'team_id' => $validated['second_place'],
                'position' => '2',
                'final_score' => $validated['second_place_score'],
                'recognition' => $validated['second_place_recognition'] ?? null,
            ]);
            
            EventWinner::create([
                'event_id' => $eventId,
                'team_id' => $validated['third_place'],
                'position' => '3',
                'final_score' => $validated['third_place_score'],
                'recognition' => $validated['third_place_recognition'] ?? null,
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.events.winners.index', $eventId)
                           ->with('success', '✅ Ganadores asignados correctamente de forma manual.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al asignar ganadores: ' . $e->getMessage());
        }
    }

    public function publish($eventId)
    {
        $evento = Event::findOrFail($eventId);
        
        $ganadores = EventWinner::where('event_id', $eventId)->count();
        
        if ($ganadores < 3) {
            return redirect()->back()->with('error', '⚠️ Debes asignar los 3 lugares antes de publicar los ganadores.');
        }
        
        $evento->update([
            'winners_published' => true,
            'winners_announced_at' => now(),
        ]);
        
        return redirect()->back()->with('success', '🎉 ¡Ganadores publicados! Ahora son visibles públicamente.');
    }

    public function unpublish($eventId)
    {
        $evento = Event::findOrFail($eventId);
        
        $evento->update([
            'winners_published' => false,
        ]);
        
        return redirect()->back()->with('success', '👁️ Ganadores ocultados. Ya no son visibles públicamente.');
    }

    public function removeWinner($eventId, $winnerId)
    {
        $winner = EventWinner::where('event_id', $eventId)
                            ->where('id', $winnerId)
                            ->firstOrFail();
        
        $position = $winner->position_name;
        $winner->delete();
        
        return redirect()->back()->with('success', "🗑️ Ganador de {$position} eliminado.");
    }

    public function updateRecognition(Request $request, $eventId, $winnerId)
    {
        $validated = $request->validate([
            'recognition' => 'nullable|string|max:500',
        ]);
        
        $winner = EventWinner::where('event_id', $eventId)
                            ->where('id', $winnerId)
                            ->firstOrFail();
        
        $winner->update([
            'recognition' => $validated['recognition'],
        ]);
        
        return redirect()->back()->with('success', '✅ Reconocimiento actualizado.');
    }
}