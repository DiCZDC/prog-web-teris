<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    /**
     * Dashboard de pruebas - Vista general del sistema
     */
    public function index()
    {
        $stats = [
            'roles' => Role::count(),
            'usuarios' => User::count(),
            'eventos' => Event::count(),
            'equipos' => Team::count(),
            'proyectos' => Project::count(),
            'calificaciones' => DB::table('team_scores')->count(),
            'criterios' => DB::table('evaluation_criteria')->count(),
        ];

        $usuarios_por_rol = [
            'administradores' => User::role(['administrador', 'admin'])->count(),
            'jueces' => User::role(['juez', 'judge'])->count(),
            'participantes' => User::role(['participante', 'user'])->count(),
        ];

        return view('test.index', compact('stats', 'usuarios_por_rol'));
    }

    /**
     * Probar sistema de roles y permisos
     */
    public function testRoles()
    {
        $roles = Role::with('permissions')->get();
        
        $usuarios_ejemplo = [
            'admin' => User::where('email', 'admin@teris.com')->first(),
            'juez' => User::where('email', 'juez1@teris.com')->first(),
            'participante' => User::where('email', 'participante1@teris.com')->first(),
        ];

        return view('test.roles', compact('roles', 'usuarios_ejemplo'));
    }

    /**
     * Probar eventos con jueces
     */
    public function testEventos()
    {
        $eventos = Event::with(['judges', 'criteria', 'teams'])->get();
        
        $evento_ejemplo = Event::where('nombre', 'LIKE', '%Hackathon%')->first();
        
        $stats_evento = null;
        if ($evento_ejemplo) {
            $stats_evento = [
                'nombre' => $evento_ejemplo->nombre,
                'jueces' => $evento_ejemplo->judges->count(),
                'equipos' => $evento_ejemplo->teams->count(),
                'criterios' => $evento_ejemplo->criteria->count(),
                'calificaciones' => $evento_ejemplo->scores->count(),
                'progreso' => $evento_ejemplo->getEvaluationProgress(),
            ];
        }

        return view('test.eventos', compact('eventos', 'stats_evento'));
    }

    /**
     * Probar equipos y sus calificaciones
     */
    public function testEquipos()
    {
        $equipos_completos = Team::whereNotNull('lider_id')
            ->whereNotNull('disenador_id')
            ->whereNotNull('frontprog_id')
            ->whereNotNull('backprog_id')
            ->with(['evento', 'lider', 'scores'])
            ->get();

        $equipo_ejemplo = $equipos_completos->first();
        
        $detalles_equipo = null;
        if ($equipo_ejemplo && $equipo_ejemplo->evento) {
            $detalles_equipo = [
                'nombre' => $equipo_ejemplo->nombre,
                'evento' => $equipo_ejemplo->evento->nombre,
                'miembros' => $equipo_ejemplo->miembros(),
                'calificaciones' => $equipo_ejemplo->scores()->count(),
                'promedio' => $equipo_ejemplo->getAverageScore($equipo_ejemplo->evento_id),
                'completamente_evaluado' => $equipo_ejemplo->isFullyEvaluated($equipo_ejemplo->evento_id),
            ];
        }

        return view('test.equipos', compact('equipos_completos', 'detalles_equipo'));
    }

    /**
     * Probar sistema de calificaciones
     */
    public function testCalificaciones()
    {
        $evento = Event::with(['criteria', 'teams', 'judges'])->where('nombre', 'LIKE', '%Hackathon%')->first();
        
        if (!$evento) {
            return view('test.calificaciones', ['error' => 'No se encontró el evento Hackathon']);
        }

        $ranking = $evento->getTeamsRanking();
        $progreso = $evento->getEvaluationProgress();
        
        $calificaciones = DB::table('team_scores')
            ->join('teams', 'team_scores.team_id', '=', 'teams.id')
            ->join('users', 'team_scores.user_id', '=', 'users.id')
            ->join('evaluation_criteria', 'team_scores.evaluation_criteria_id', '=', 'evaluation_criteria.id')
            ->where('team_scores.event_id', $evento->id)
            ->select(
                'teams.nombre as equipo',
                'users.name as juez',
                'evaluation_criteria.name as criterio',
                'team_scores.score',
                'team_scores.comments'
            )
            ->get();

        return view('test.calificaciones', compact('evento', 'ranking', 'progreso', 'calificaciones'));
    }

    /**
     * Probar jueces y sus asignaciones
     */
    public function testJueces()
    {
        $jueces = User::role(['juez', 'judge'])->with(['eventsAsJudge', 'scoresGiven'])->get();
        
        $juez_ejemplo = $jueces->first();
        
        $stats_juez = null;
        if ($juez_ejemplo) {
            $stats_juez = [
                'nombre' => $juez_ejemplo->name,
                'email' => $juez_ejemplo->email,
                'eventos_asignados' => $juez_ejemplo->eventsAsJudge->count(),
                'calificaciones_dadas' => $juez_ejemplo->scoresGiven->count(),
                'equipos_evaluados' => $juez_ejemplo->getTotalEvaluatedTeams(),
                'estadisticas' => $juez_ejemplo->getJudgeStats(),
            ];
        }

        return view('test.jueces', compact('jueces', 'stats_juez'));
    }

    /**
     * Probar proyectos
     */
    public function testProyectos()
    {
        $proyectos = Project::with(['team.evento'])->get();
        
        $stats_proyectos = [
            'total' => Project::count(),
            'pendientes' => Project::where('etapa_validacion', 'Pendiente')->count(),
            'en_revision' => Project::where('etapa_validacion', 'En Revisión')->count(),
            'aprobados' => Project::where('etapa_validacion', 'Aprobado')->count(),
        ];

        return view('test.proyectos', compact('proyectos', 'stats_proyectos'));
    }

    /**
     * Simular una calificación
     */
    public function simularCalificacion()
    {
        $juez = User::role(['juez', 'judge'])->first();
        $evento = Event::where('nombre', 'LIKE', '%Hackathon%')->first();
        
        if (!$juez || !$evento) {
            return redirect()->back()->with('error', 'No se encontraron jueces o eventos');
        }

        $equipo = $evento->teams()->whereNotNull('lider_id')->first();
        $criterio = $evento->criteria()->first();
        
        if (!$equipo || !$criterio) {
            return redirect()->back()->with('error', 'No se encontraron equipos o criterios');
        }

        // Verificar si ya existe la calificación
        $existe = DB::table('team_scores')
            ->where('team_id', $equipo->id)
            ->where('user_id', $juez->id)
            ->where('evaluation_criteria_id', $criterio->id)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('info', 'Esta calificación ya existe');
        }

        // Crear calificación
        DB::table('team_scores')->insert([
            'team_id' => $equipo->id,
            'event_id' => $evento->id,
            'user_id' => $juez->id,
            'evaluation_criteria_id' => $criterio->id,
            'score' => rand(70, 100) / 10,
            'comments' => 'Calificación de prueba creada automáticamente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', "✅ Calificación creada: {$juez->name} evaluó a {$equipo->nombre} en {$criterio->name}");
    }

    /**
     * Limpiar todas las calificaciones
     */
    public function limpiarCalificaciones()
    {
        $count = DB::table('team_scores')->count();
        DB::table('team_scores')->truncate();
        
        return redirect()->back()->with('success', "✅ Se eliminaron {$count} calificaciones");
    }

    /**
     * Resetear base de datos completa
     */
    public function resetDatabase()
    {
        
        
        return redirect()->route('test.index')->with('success', '✅ Base de datos reseteada completamente');
    }
}