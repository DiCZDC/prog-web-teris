<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Event;
use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
     * Display teams by event (TU MÉTODO - SE MANTIENE)
     */
    public function indexEvent($id)
    {
        $teams = Team::where('evento_id', $id)
            ->with(['lider', 'disenador', 'frontprog', 'backprog', 'evento'])
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
        $team->load(['lider', 'disenador', 'frontprog', 'backprog', 'evento', 'proyecto']);
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
        // Ya no verificamos si está en un equipo, puede estar en múltiples
        return view('teams.join');
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

        // Verificar si el usuario YA está en ESTE equipo específico
        if ($team->esMiembro($user->id)) {
            return back()->with('error', 'Ya eres miembro de este equipo');
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

    // ==================== MÉTODOS NUEVOS DE INVITACIONES ====================

    /**
     * Ver MIS equipos (donde soy miembro)
     */
    public function myTeams()
    {
        $user = Auth::user();
        
        // Obtener todos los equipos donde el usuario participa
        $misEquipos = Team::where('lider_id', $user->id)
            ->orWhere('disenador_id', $user->id)
            ->orWhere('frontprog_id', $user->id)
            ->orWhere('backprog_id', $user->id)
            ->with(['lider', 'disenador', 'frontprog', 'backprog', 'evento'])
            ->get();

        return view('teams.my-teams', compact('misEquipos'));
    }

    /**
     * Mostrar formulario para invitar miembros (SOLO LÍDER)
     */
    public function invite(Team $team)
    {
        // Verificar que el usuario sea el líder
        if ($team->lider_id !== Auth::id()) {
            return redirect()->route('teams.show', $team)
                ->with('error', 'Solo el líder puede invitar miembros');
        }

        // Obtener invitaciones pendientes de este equipo
        $invitacionesPendientes = $team->invitacionesPendientes()
            ->with('invitado')
            ->get();

        return view('teams.invite', compact('team', 'invitacionesPendientes'));
    }

    /**
     * Enviar invitación
     */
    public function sendInvitation(Request $request, Team $team)
    {
        // Verificar que el usuario sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede invitar miembros');
        }

        $validated = $request->validate([
            'user_identifier' => 'required|string',
            'rol' => 'required|in:DISEÑADOR,PROGRAMADOR FRONT,PROGRAMADOR BACK',
            'mensaje' => 'nullable|string|max:500'
        ]);

        // Buscar usuario por nombre o email
        $usuario = User::where('name', $validated['user_identifier'])
            ->orWhere('email', $validated['user_identifier'])
            ->first();

        if (!$usuario) {
            return back()
                ->withInput()
                ->withErrors(['user_identifier' => 'No se encontró ningún usuario con ese nombre o email']);
        }

        // Verificar que no sea el mismo líder
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No puedes invitarte a ti mismo');
        }

        // Verificar que el usuario no esté ya en un equipo
        $usuarioYaTieneEquipo = Team::where(function($query) use ($usuario) {
            $query->where('lider_id', $usuario->id)
                  ->orWhere('disenador_id', $usuario->id)
                  ->orWhere('frontprog_id', $usuario->id)
                  ->orWhere('backprog_id', $usuario->id);
        })->exists();

        if ($usuarioYaTieneEquipo) {
            return back()->with('error', 'Este usuario ya pertenece a un equipo');
        }

        // Verificar que el rol esté disponible
        $rolDisponible = false;
        switch ($validated['rol']) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            return back()->with('error', 'Este rol ya está ocupado en el equipo');
        }

        // Verificar que no exista una invitación pendiente para este usuario y rol
        $invitacionExistente = TeamInvitation::where('team_id', $team->id)
            ->where('user_id', $usuario->id)
            ->where('status', 'pendiente')
            ->exists();

        if ($invitacionExistente) {
            return back()->with('error', 'Ya existe una invitación pendiente para este usuario');
        }

        // Crear la invitación
        TeamInvitation::create([
            'team_id' => $team->id,
            'invited_by' => Auth::id(),
            'user_id' => $usuario->id,
            'tipo' => 'invitacion', // Líder invita a usuario
            'rol' => $validated['rol'],
            'mensaje' => $validated['mensaje'],
            'status' => 'pendiente'
        ]);

        // Enviar correo de invitación
        $mailController = new MailController();
        $mailController->sendTeamInvitationEmail($usuario, $team);

        return back()->with('success', '¡Invitación enviada exitosamente!');
    }

    /**
     * Enviar solicitud para unirse a un equipo (USUARIO solicita al LÍDER)
     */
    public function sendRequest(Request $request, Team $team)
    {
        $validated = $request->validate([
            'rol' => 'required|in:DISEÑADOR,PROGRAMADOR FRONT,PROGRAMADOR BACK',
            'mensaje' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();

        // Verificar que el usuario no esté ya en este equipo
        if ($team->esMiembro($user->id)) {
            return back()->with('error', 'Ya eres miembro de este equipo');
        }

        // Verificar que el rol esté disponible
        $rolDisponible = false;
        switch ($validated['rol']) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            return back()->with('error', 'Este rol ya está ocupado en el equipo');
        }

        // Verificar que no exista una solicitud pendiente
        $solicitudExistente = TeamInvitation::where('team_id', $team->id)
            ->where('user_id', $user->id)
            ->where('tipo', 'solicitud')
            ->where('status', 'pendiente')
            ->exists();

        if ($solicitudExistente) {
            return back()->with('error', 'Ya tienes una solicitud pendiente para este equipo');
        }

        // Crear la solicitud
        TeamInvitation::create([
            'team_id' => $team->id,
            'invited_by' => $user->id, // Usuario que solicita
            'user_id' => $user->id, // El mismo usuario
            'tipo' => 'solicitud', // Usuario solicita unirse
            'rol' => $validated['rol'],
            'mensaje' => $validated['mensaje'],
            'status' => 'pendiente'
        ]);

        return back()->with('success', '¡Solicitud enviada al líder del equipo!');
    }

    /**
     * Ver solicitudes pendientes para mis equipos (LÍDER)
     */
    public function mySolicitudes()
    {
        $user = Auth::user();
        
        // Obtener equipos donde soy líder
        $misEquiposComoLider = Team::where('lider_id', $user->id)->pluck('id');

        // Obtener solicitudes pendientes para esos equipos
        $solicitudesPendientes = TeamInvitation::whereIn('team_id', $misEquiposComoLider)
            ->where('tipo', 'solicitud')
            ->where('status', 'pendiente')
            ->with(['team', 'invitador'])
            ->orderBy('created_at', 'desc')
            ->get();

        $solicitudesRespondidas = TeamInvitation::whereIn('team_id', $misEquiposComoLider)
            ->where('tipo', 'solicitud')
            ->whereIn('status', ['aceptada', 'rechazada'])
            ->with(['team', 'invitador'])
            ->orderBy('responded_at', 'desc')
            ->limit(10)
            ->get();

        return view('teams.my-solicitudes', compact('solicitudesPendientes', 'solicitudesRespondidas'));
    }

    /**
     * Aceptar solicitud (LÍDER acepta al USUARIO)
     */
    public function acceptRequest(TeamInvitation $invitation)
    {
        $team = $invitation->team;

        // Verificar que el usuario sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede aceptar solicitudes');
        }

        // Verificar que sea una solicitud
        if (!$invitation->isSolicitud()) {
            return back()->with('error', 'Esta no es una solicitud válida');
        }

        // Verificar que esté pendiente
        if (!$invitation->isPendiente()) {
            return back()->with('error', 'Esta solicitud ya fue respondida');
        }

        // Verificar que el rol siga disponible
        $rolDisponible = false;
        switch ($invitation->rol) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            $invitation->rechazar();
            return back()->with('error', 'El rol ya fue ocupado');
        }

        // Aceptar la solicitud
        $invitation->aceptar();

        return back()->with('success', 'Solicitud aceptada. El usuario se ha unido al equipo.');
    }

    /**
     * Rechazar solicitud (LÍDER rechaza al USUARIO)
     */
    public function rejectRequest(TeamInvitation $invitation)
    {
        $team = $invitation->team;

        // Verificar que el usuario sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede rechazar solicitudes');
        }

        // Verificar que sea una solicitud
        if (!$invitation->isSolicitud()) {
            return back()->with('error', 'Esta no es una solicitud válida');
        }

        // Verificar que esté pendiente
        if (!$invitation->isPendiente()) {
            return back()->with('error', 'Esta solicitud ya fue respondida');
        }

        $invitation->rechazar();

        return back()->with('success', 'Solicitud rechazada');
    }

    /**
     * Ver mis invitaciones
     */
    public function myInvitations()
{
    $user = Auth::user();

    // INVITACIONES RECIBIDAS (cuando un líder invita al usuario)
    $invitacionesPendientes = TeamInvitation::where('user_id', $user->id)
        ->where('tipo', 'invitacion')
        ->where('status', 'pendiente')
        ->get();

    $invitacionesRespondidas = TeamInvitation::where('user_id', $user->id)
        ->where('tipo', 'invitacion')
        ->whereIn('status', ['aceptada', 'rechazada'])
        ->get();


    // SOLICITUDES (cuando otros usuarios piden unirse a un equipo del líder)
    $solicitudesPendientes = TeamInvitation::where('tipo', 'solicitud')
        ->where('status', 'pendiente')
        ->whereHas('team', function ($q) use ($user) {
            $q->where('lider_id', $user->id);
        })
        ->get();

    $solicitudesRespondidas = TeamInvitation::where('tipo', 'solicitud')
        ->whereIn('status', ['aceptada', 'rechazada'])
        ->whereHas('team', function ($q) use ($user) {
            $q->where('lider_id', $user->id);
        })
        ->get();


    return view('teams.my-invitations', compact(
        'invitacionesPendientes',
        'solicitudesPendientes',
        'invitacionesRespondidas',
        'solicitudesRespondidas'
    ));
}


    /**
     * Aceptar invitación
     */
    public function acceptInvitation(TeamInvitation $invitation)
    {
        // Verificar que la invitación sea para el usuario autenticado
        if ($invitation->user_id !== Auth::id()) {
            return back()->with('error', 'Esta invitación no es para ti');
        }

        // Verificar que la invitación esté pendiente
        if (!$invitation->isPendiente()) {
            return back()->with('error', 'Esta invitación ya fue respondida');
        }

        // Verificar que el usuario no esté ya en ESTE equipo específico
        $team = $invitation->team;
        if ($team->esMiembro(Auth::id())) {
            $invitation->rechazar();
            return back()->with('error', 'Ya eres miembro de este equipo');
        }

        // Verificar que el rol siga disponible
        $rolDisponible = false;
        
        switch ($invitation->rol) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            $invitation->rechazar();
            return back()->with('error', 'El rol ya fue ocupado por otro usuario');
        }

        // Aceptar la invitación
        $invitation->aceptar();
        app(\App\Http\Controllers\MailController::class)->sendTeamAnswerEmail(
            $invitation->invitador,
            Auth::user(),
            $team,
            'aceptada'
        );
        return redirect()->route('teams.show', $team)
            ->with('success', '¡Te has unido al equipo exitosamente como ' . $invitation->rol . '!');
    }

    /**
     * Rechazar invitación
     */
    public function rejectInvitation(TeamInvitation $invitation)
    {
        // Verificar que la invitación sea para el usuario autenticado
        if ($invitation->user_id !== Auth::id()) {
            return back()->with('error', 'Esta invitación no es para ti');
        }

        // Verificar que la invitación esté pendiente
        if (!$invitation->isPendiente()) {
            return back()->with('error', 'Esta invitación ya fue respondida');
        }

        $invitation->rechazar();
        app(\App\Http\Controllers\MailController::class)->sendTeamAnswerEmail(
            $invitation->invitador,
            Auth::user(),
            $invitation->team,
            'rechazada'
        );
        return back()->with('success', 'Has rechazado la invitación');
    }

    /**
     * Cancelar invitación (SOLO LÍDER)
     */
    public function cancelInvitation(TeamInvitation $invitation)
    {
        $team = $invitation->team;

        // Verificar que el usuario sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede cancelar invitaciones');
        }

        // Verificar que la invitación esté pendiente
        if (!$invitation->isPendiente()) {
            return back()->with('error', 'Esta invitación ya fue respondida');
        }

        $invitation->delete();

        return back()->with('success', 'Invitación cancelada');
    }

    // ==================== MÉTODOS NUEVOS: SOLICITUDES ====================

    /**
     * Usuario envía solicitud para unirse a un equipo
     */
    public function enviarSolicitud(Request $request, Team $team)
    {
        $validated = $request->validate([
            'rol' => 'required|in:DISEÑADOR,PROGRAMADOR FRONT,PROGRAMADOR BACK',
            'mensaje' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();

        // Verificar que el usuario no esté ya en este equipo
        if ($team->esMiembro($user->id)) {
            return back()->with('error', 'Ya eres miembro de este equipo');
        }

        // Verificar que el rol esté disponible
        $rolDisponible = false;
        switch ($validated['rol']) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            return back()->with('error', 'Este rol ya está ocupado');
        }

        // Verificar que no exista una solicitud pendiente
        $solicitudExistente = TeamInvitation::where('team_id', $team->id)
            ->where('user_id', $user->id)
            ->where('tipo', 'solicitud')
            ->where('status', 'pendiente')
            ->exists();

        if ($solicitudExistente) {
            return back()->with('error', 'Ya tienes una solicitud pendiente para este equipo');
        }

        // Crear la solicitud
        TeamInvitation::create([
            'team_id' => $team->id,
            'invited_by' => $user->id, // Usuario que solicita
            'user_id' => $user->id, // El mismo usuario
            'tipo' => 'solicitud', // Es una solicitud, no invitación
            'rol' => $validated['rol'],
            'mensaje' => $validated['mensaje'],
            'status' => 'pendiente'
        ]);

        return redirect()->route('teams.show', $team)
            ->with('success', '¡Solicitud enviada! El líder la revisará pronto.');
    }

    /**
     * Líder ve solicitudes pendientes para sus equipos
     */
    public function verSolicitudes()
    {
        $user = Auth::user();
        
        // Equipos donde soy líder
        $misEquiposIds = Team::where('lider_id', $user->id)->pluck('id');

        // Solicitudes pendientes
        $solicitudesPendientes = TeamInvitation::whereIn('team_id', $misEquiposIds)
            ->where('tipo', 'solicitud')
            ->where('status', 'pendiente')
            ->with(['team', 'invitador']) // invitador = el usuario que solicita
            ->orderBy('created_at', 'desc')
            ->get();

        // Solicitudes respondidas (últimas 10)
        $solicitudesRespondidas = TeamInvitation::whereIn('team_id', $misEquiposIds)
            ->where('tipo', 'solicitud')
            ->whereIn('status', ['aceptada', 'rechazada'])
            ->with(['team', 'invitador'])
            ->orderBy('responded_at', 'desc')
            ->limit(10)
            ->get();

        return view('teams.my-solicitudes', compact('solicitudesPendientes', 'solicitudesRespondidas'));
    }

    /**
     * Líder acepta solicitud de usuario
     */
    public function aceptarSolicitud(TeamInvitation $solicitud)
    {
        $team = $solicitud->team;

        // Verificar que sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede aceptar solicitudes');
        }

        // Verificar que sea una solicitud
        if (!$solicitud->esSolicitud()) {
            return back()->with('error', 'Esto no es una solicitud válida');
        }

        // Verificar que esté pendiente
        if (!$solicitud->isPendiente()) {
            return back()->with('error', 'Esta solicitud ya fue respondida');
        }

        // Verificar que el rol siga disponible
        $rolDisponible = false;
        switch ($solicitud->rol) {
            case 'DISEÑADOR':
                $rolDisponible = is_null($team->disenador_id);
                break;
            case 'PROGRAMADOR FRONT':
                $rolDisponible = is_null($team->frontprog_id);
                break;
            case 'PROGRAMADOR BACK':
                $rolDisponible = is_null($team->backprog_id);
                break;
        }

        if (!$rolDisponible) {
            $solicitud->rechazar();
            return back()->with('error', 'El rol ya fue ocupado por otro usuario');
        }

        // Aceptar la solicitud (asigna al usuario al equipo)
        $solicitud->aceptar();
        $mailController = new MailController();
        $mailController->sendApplicationTeamEmailResponse($user,$team,'aceptada');
        return back()->with('success', '✅ Solicitud aceptada. El usuario se ha unido al equipo.');
    }

    /**
     * Líder rechaza solicitud de usuario
     */
    public function rechazarSolicitud(TeamInvitation $solicitud)
    {
        $team = $solicitud->team;

        // Verificar que sea el líder
        if ($team->lider_id !== Auth::id()) {
            return back()->with('error', 'Solo el líder puede rechazar solicitudes');
        }

        // Verificar que sea una solicitud
        if (!$solicitud->esSolicitud()) {
            return back()->with('error', 'Esto no es una solicitud válida');
        }

        // Verificar que esté pendiente
        if (!$solicitud->isPendiente()) {
            return back()->with('error', 'Esta solicitud ya fue respondida');
        }

        $solicitud->rechazar();
        $mailController = new MailController();
        $mailController->sendApplicationTeamEmailResponse($user,$team,'rechazada');
        return back()->with('success', 'Solicitud rechazada');
    }
    public function sendJoinRequest(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'rol' => 'required'
        ]);

        $team = Team::where('codigo', $request->codigo)->first();

        if (!$team) {
            return back()->with('error', 'El equipo no existe.');
        }

        // Validar que el rol está disponible
        if (!$team->rolDisponible($request->rol)) {
            return back()->with('error', 'Ese rol ya está ocupado en este equipo.');
        }

        // Validar que no tenga ya una solicitud pendiente
        $existe = TeamInvitation::where('team_id', $team->id)
            ->where('user_id', Auth::id())
            ->where('tipo', 'solicitud')
            ->where('status', 'pendiente')
            ->first();

        if ($existe) {
            return back()->with('error', 'Ya tienes una solicitud pendiente para este equipo.');
        }

        // ✔ Crear solicitud al líder
        TeamInvitation::create([
            'team_id' => $team->id,
            'user_id' => Auth::id(),
            'invited_by' => $team->lider_id, // líder recibe la solicitud
            'tipo' => 'solicitud',
            'rol' => $request->rol,
            'status' => 'pendiente',
            'mensaje' => "Solicitud para unirse al equipo como $request->rol"
        ]);
        
        $mailController = new MailController();
        $mailController->sendSolitudeTeamEmail($team, Auth::user(), $team->lider,Auth::user());
        
        return redirect()->route('teams.join')->with('success', 'Solicitud enviada al líder. Espera su aprobación.');
    }

}