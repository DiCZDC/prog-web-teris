<x-app-layout>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        min-height: 100vh;
        color: white;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        margin-bottom: 20px;
        font-size: 16px;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: white;
    }

    h1 {
        text-align: center;
        font-size: 48px;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 4px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .subtitle {
        text-align: center;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 40px;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .alert-success {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid rgba(76, 175, 80, 0.5);
    }

    .section {
        margin-bottom: 50px;
    }

    /* ===== NUEVO COLOR ===== */
    .section-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #a855f7; /* antes #ffd700 */
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .count-badge {
        background: rgba(168, 85, 247, 0.3); /* antes naranja */
        border: 1px solid #a855f7;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 16px;
        color: #a855f7;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
        gap: 25px;
    }

    .notification-card {
        background: rgba(0, 0, 0, 0.4);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s;
        border-left: 5px solid transparent;
    }

    .notification-card.invitacion {
        border-left-color: #a855f7; /* antes #ffd700 */
    }

    .notification-card.solicitud {
        border-left-color: #2196F3;
    }

    .notification-card.mi-solicitud {
        border-left-color: #9C27B0;
    }

    .notification-card:hover {
        transform: translateY(-5px);
    }

    .card-type {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .type-invitacion {
        background: rgba(168, 85, 247, 0.3); /* antes rgba amarillo */
        border: 1px solid #a855f7;
        color: #a855f7;
    }

    .type-solicitud {
        background: rgba(33, 150, 243, 0.3);
        border: 1px solid #2196F3;
        color: #2196F3;
    }

    .type-mi-solicitud {
        background: rgba(156, 39, 176, 0.3);
        border: 1px solid #9C27B0;
        color: #9C27B0;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-size: 22px;
        font-weight: bold;
        color: #a855f7; /* antes amarillo */
        margin-bottom: 5px;
    }

    .user-email {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }

    .rol-badge {
        background: rgba(168, 85, 247, 0.3);
        border: 1px solid #a855f7;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        color: #a855f7;
        font-weight: bold;
    }

    .card-body {
        margin-bottom: 20px;
    }

    .team-info {
        background: rgba(33, 150, 243, 0.2);
        border: 1px solid #2196F3;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .team-name {
        font-size: 16px;
        color: white;
        font-weight: bold;
    }

    .team-code {
        background: rgba(0, 0, 0, 0.3);
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.8);
    }

    .mensaje-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid rgba(255, 255, 255, 0.3);
    }

    .mensaje-label {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 5px;
    }

    .mensaje-text {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.5;
    }

    .fecha {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        flex: 1;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s;
        cursor: pointer;
        border: 2px solid;
        text-align: center;
    }

    .btn-accept {
        background: rgba(76, 175, 80, 0.3);
        border-color: #4CAF50;
        color: #4CAF50;
    }

    .btn-accept:hover {
        background: rgba(76, 175, 80, 0.5);
        transform: translateY(-2px);
    }

    .btn-reject {
        background: rgba(244, 67, 54, 0.3);
        border-color: #f44336;
        color: #f44336;
    }

    .btn-reject:hover {
        background: rgba(244, 67, 54, 0.5);
        transform: translateY(-2px);
    }

    .btn-cancel {
        background: rgba(158, 158, 158, 0.3);
        border-color: #9E9E9E;
        color: #9E9E9E;
    }

    .btn-cancel:hover {
        background: rgba(158, 158, 158, 0.5);
        transform: translateY(-2px);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: bold;
        display: inline-block;
    }

    .status-aceptada {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid #4CAF50;
        color: #4CAF50;
    }

    .status-rechazada {
        background: rgba(244, 67, 54, 0.3);
        border: 1px solid #f44336;
        color: #f44336;
    }

    .status-pendiente {
        background: rgba(168, 85, 247, 0.3); /* antes naranja */
        border: 1px solid #a855f7;
        color: #a855f7;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 20px;
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: rgba(255, 255, 255, 0.7);
    }

    .divider {
        height: 2px;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.3), transparent);
        margin: 40px 0;
    }

    @media (max-width: 768px) {
        .cards-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

    <div class="container">
        <!-- Botón Regresar -->
        <a href="{{ route('teams.index') }}" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                style="vertical-align: middle; margin-right: 6px; display: inline-block;">
                <path d="M15 18l-6-6 6-6" 
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Regresar
        </a>
        </div>

        <h1>Mis Notificaciones</h1>
        <p class="subtitle">Invitaciones y solicitudes de equipos</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="background: rgba(244, 67, 54, 0.3); border: 1px solid rgba(244, 67, 54, 0.5);">
                {{ session('error') }}
            </div>
        @endif

        <!-- ========== SECCIÓN 1: INVITACIONES RECIBIDAS ========== -->
        <div class="section">
            <h2 class="section-title">
                Invitaciones Recibidas
                @if($invitacionesPendientes->count() > 0)
                    <span class="count-badge">{{ $invitacionesPendientes->count() }}</span>
                @endif
            </h2>

            @if($invitacionesPendientes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon" style="display: flex; justify-content: center; align-items: center;">
                        <!-- INBOX VACÍO -->
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none">
                            <path d="M4 4h16l2 10h-6l-2 3h-4l-2-3H2L4 4z"
                                  stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 4v4"
                                  stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h3>No tienes invitaciones pendientes</h3>
                    <p>Cuando un líder te invite a su equipo, aparecerán aquí</p>
                </div>

            @else
                <div class="cards-grid">

                    @foreach($invitacionesPendientes as $invitacion)
                        <div class="notification-card invitacion">

                            <!-- ICONO INVITACIÓN -->
                            <span class="card-type type-invitacion">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4h16v16H4V4z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M4 8l8 5 8-5" stroke="currentColor" stroke-width="2" fill="none"/>
                                </svg>
                                INVITACIÓN
                            </span>

                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-name">{{ $invitacion->invitador->name }}</div>
                                    <div class="user-email">te invita a unirte</div>
                                </div>
                                <div class="rol-badge">{{ $invitacion->rol }}</div>
                            </div>

                            <div class="card-body">
                                <div class="team-info">
                                    <span class="team-name">{{ $invitacion->team->nombre }}</span>
                                    <span class="team-code">{{ $invitacion->team->codigo }}</span>
                                </div>

                                @if($invitacion->mensaje)
                                    <div class="mensaje-box">
                                        <div class="mensaje-label">
                                            <!-- ICONO MENSAJE -->
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                 style="vertical-align: middle; margin-right: 6px;">
                                                <path d="M4 4h16v12H5.17L4 17.17V4z"
                                                      stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                            Mensaje del líder:
                                        </div>
                                        <div class="mensaje-text">{{ $invitacion->mensaje }}</div>
                                    </div>
                                @endif

                                <div class="fecha">
                                    <!-- ICONO RELOJ -->
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         style="vertical-align: middle; margin-right: 6px;">
                                        <circle cx="12" cy="12" r="9"
                                                stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 7v5l3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    Recibida hace {{ $invitacion->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <form action="{{ route('invitations.accept', $invitacion) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-accept">
                                        ✓ Aceptar
                                    </button>
                                </form>

                                <form action="{{ route('invitations.reject', $invitacion) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">
                                        ✕ Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>

        <div class="divider"></div>

        <!-- ========== SECCIÓN 2: SOLICITUDES RECIBIDAS ========== -->
        <div class="section">
            <h2 class="section-title">
                Solicitudes para Mis Equipos
                @if($solicitudesPendientes->count() > 0)
                    <span class="count-badge">{{ $solicitudesPendientes->count() }}</span>
                @endif
            </h2>

            @if($solicitudesPendientes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon" style="display: flex; justify-content: center;">
                        <!-- ICONO CAJA VACÍA -->
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none">
                            <path d="M3 7l9-4 9 4v10l-9 4-9-4V7z"
                                  stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>No hay solicitudes pendientes</h3>
                    <p>Cuando alguien solicite unirse a tus equipos, aparecerán aquí</p>
                </div>

            @else
                <div class="cards-grid">

                    @foreach($solicitudesPendientes as $solicitud)
                        <div class="notification-card solicitud">

                            <!-- ICONO SOLICITUD -->
                            <span class="card-type type-solicitud">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4h16v12H4z"
                                          stroke="currentColor" stroke-width="2"/>
                                    <path d="M12 16v4m0 0l-3-3m3 3l3-3"
                                          stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                SOLICITUD
                            </span>

                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-name">{{ $solicitud->invitador->name }}</div>
                                    <div class="user-email">{{ $solicitud->invitador->email }}</div>
                                </div>
                                <div class="rol-badge">{{ $solicitud->rol }}</div>
                            </div>

                            <div class="card-body">
                                <div class="team-info">
                                    <span class="team-name">{{ $solicitud->team->nombre }}</span>
                                    <span class="team-code">{{ $solicitud->team->codigo }}</span>
                                </div>

                                @if($solicitud->mensaje)
                                    <div class="mensaje-box">
                                        <div class="mensaje-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                 style="vertical-align: middle; margin-right: 6px;">
                                                <path d="M4 4h16v12H5.17L4 17.17V4z"
                                                      stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                            Mensaje del usuario:
                                        </div>
                                        <div class="mensaje-text">{{ $solicitud->mensaje }}</div>
                                    </div>
                                @endif

                                <div class="fecha">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         style="vertical-align: middle; margin-right: 6px;">
                                        <circle cx="12" cy="12" r="9"
                                                stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 7v5l3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Recibida hace {{ $solicitud->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <form action="{{ route('solicitudes.accept', $solicitud) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-accept">
                                        ✓ Aceptar
                                    </button>
                                </form>

                                <form action="{{ route('solicitudes.reject', $solicitud) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">
                                        ✕ Rechazar
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                </div>
            @endif
        </div>

        <div class="divider"></div>

        <!-- ========== SECCIÓN 3: MIS SOLICITUDES ENVIADAS ========== -->
        <div class="section">
            <h2 class="section-title">
                Mis Solicitudes Enviadas
                @if($misSolicitudesPendientes->count() > 0)
                    <span class="count-badge">{{ $misSolicitudesPendientes->count() }}</span>
                @endif
            </h2>

            @if($misSolicitudesPendientes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon" style="display: flex; justify-content: center;">
                        <!-- ICONO CAJA ABIERTA -->
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none">
                            <path d="M3 7l9-4 9 4v10l-9 4-9-4V7z"
                                  stroke="currentColor" stroke-width="2"/>
                            <path d="M12 12l3 3m-3-3l-3 3"
                                  stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h3>No has enviado solicitudes</h3>
                    <p>Las solicitudes que envíes a otros equipos aparecerán aquí</p>
                </div>

            @else
                <div class="cards-grid">

                    @foreach($misSolicitudesPendientes as $solicitud)
                        <div class="notification-card mi-solicitud">

                            <span class="card-type type-mi-solicitud">
                                <!-- ICONO CAJA CON FLECHA SALIENDO -->
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4h16v12H4z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M12 20v-4m0 0l3 3m-3-3l-3 3"
                                          stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                MI SOLICITUD
                            </span>

                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-name">Solicitaste unirte</div>
                                    <div class="user-email">Esperando respuesta del líder</div>
                                </div>
                                <div class="rol-badge">{{ $solicitud->rol }}</div>
                            </div>

                            <div class="card-body">

                                <div class="team-info">
                                    <span class="team-name">{{ $solicitud->team->nombre }}</span>
                                    <span class="team-code">{{ $solicitud->team->codigo }}</span>
                                </div>

                                <div class="mensaje-box">
                                    <div class="mensaje-label">
                                        <!-- ÍCONO USUARIO -->
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                             style="vertical-align: middle; margin-right: 6px;">
                                            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2"/>
                                            <path d="M4 20c0-4 4-6 8-6s8 2 8 6"
                                                  stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Líder del equipo:
                                    </div>
                                    <div class="mensaje-text">{{ $solicitud->team->lider->name }}</div>
                                </div>

                                @if($solicitud->mensaje)
                                    <div class="mensaje-box">
                                        <div class="mensaje-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                 style="vertical-align: middle; margin-right: 6px;">
                                                <path d="M4 4h16v12H5.17L4 17.17V4z"
                                                      stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                            Tu mensaje:
                                        </div>
                                        <div class="mensaje-text">{{ $solicitud->mensaje }}</div>
                                    </div>
                                @endif

                                <div class="fecha">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         style="vertical-align: middle; margin-right: 6px;">
                                        <circle cx="12" cy="12" r="9"
                                                stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 7v5l3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Enviada hace {{ $solicitud->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <div class="status-badge status-pendiente" style="text-align: center; width: 100%;">
                                    ⏳ Esperando respuesta...
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>

        <div class="divider"></div>

        <!-- ========== SECCIÓN 4: HISTORIAL ========== -->
        <div class="section">
            <h2 class="section-title">Historial Reciente</h2>

            @if($invitacionesRespondidas->isEmpty() && $solicitudesRespondidas->isEmpty() && $misSolicitudesRespondidas->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <!-- ICONO DOCUMENTO -->
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none">
                            <path d="M6 2h9l5 5v15H6V2z"
                                  stroke="currentColor" stroke-width="2"/>
                            <path d="M14 2v6h6"
                                  stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3>Sin historial</h3>
                    <p>Las notificaciones respondidas aparecerán aquí</p>
                </div>

            @else
                <div class="cards-grid">
                    @php
                        $historial = collect()
                            ->merge($invitacionesRespondidas)
                            ->merge($solicitudesRespondidas)
                            ->merge($misSolicitudesRespondidas)
                            ->sortByDesc('responded_at');
                    @endphp

                    @foreach($historial as $notificacion)
                        <div class="notification-card {{ $notificacion->tipo }}" style="opacity: 0.7;">

                            <!-- TIPO DE NOTIFICACIÓN -->
                            @if($notificacion->tipo === 'invitacion')

                                <span class="card-type type-invitacion">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4h16v16H4V4z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M4 8l8 5 8-5" stroke="currentColor" stroke-width="2" fill="none"/>
                                    </svg>
                                    INVITACIÓN
                                </span>

                            @elseif($notificacion->user_id === Auth::id() && $notificacion->tipo === 'solicitud')

                                <span class="card-type type-mi-solicitud">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4h16v12H4z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 20v-4m0 0l3 3m-3-3l-3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    MI SOLICITUD
                                </span>

                            @else

                                <span class="card-type type-solicitud">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4h16v12H4z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 16v4m0 0l-3-3m3 3l3-3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    SOLICITUD
                                </span>

                            @endif

                            <div class="card-header">
                                <div class="user-info">

                                    @if($notificacion->tipo === 'invitacion')
                                        <div class="user-name">{{ $notificacion->invitador->name }}</div>
                                        <div class="user-email">Te invitó a unirte</div>

                                    @elseif($notificacion->user_id === Auth::id())
                                        <div class="user-name">Tu solicitud</div>
                                        <div class="user-email">Para unirte al equipo</div>

                                    @else
                                        <div class="user-name">{{ $notificacion->invitador->name }}</div>
                                        <div class="user-email">Solicitó unirse</div>
                                    @endif

                                </div>

                                <div>
                                    <div class="rol-badge" style="margin-bottom: 8px;">{{ $notificacion->rol }}</div>

                                    <div class="status-badge status-{{ $notificacion->status }}">
                                        @if($notificacion->status === 'aceptada')
                                            ✓ Aceptada
                                        @else
                                            ✕ Rechazada
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="team-info">
                                    <span class="team-name">{{ $notificacion->team->nombre }}</span>
                                    <span class="team-code">{{ $notificacion->team->codigo }}</span>
                                </div>

                                <div class="fecha">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         style="vertical-align: middle; margin-right: 6px;">
                                        <circle cx="12" cy="12" r="9"
                                                stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 7v5l3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Respondida hace {{ $notificacion->responded_at->diffForHumans() }}
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
