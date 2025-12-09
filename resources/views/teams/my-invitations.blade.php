<x-app-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4a148c 0%, #6a1b9a 50%, #8e24aa 100%);
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

        .section-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #ffd700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .count-badge {
            background: rgba(255, 152, 0, 0.3);
            border: 1px solid #FF9800;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 16px;
            color: #FF9800;
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
            border-left-color: #ffd700;
        }

        .notification-card.solicitud {
            border-left-color: #2196F3;
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
            background: rgba(255, 215, 0, 0.3);
            border: 1px solid #ffd700;
            color: #ffd700;
        }

        .type-solicitud {
            background: rgba(33, 150, 243, 0.3);
            border: 1px solid #2196F3;
            color: #2196F3;
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
            color: #ffd700;
            margin-bottom: 5px;
        }

        .user-email {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .rol-badge {
            background: rgba(255, 215, 0, 0.3);
            border: 1px solid #ffd700;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            color: #ffd700;
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
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="back-link">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">← Regresar</span>
            </a>
        </div>

        <h1>🔔 Mis Notificaciones</h1>
        <p class="subtitle">Invitaciones y solicitudes de equipos</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- ========== INVITACIONES RECIBIDAS (Me invitaron) ========== -->
        <div class="section">
            <h2 class="section-title">
                📬 Invitaciones Recibidas
                @if($invitacionesPendientes->count() > 0)
                    <span class="count-badge">{{ $invitacionesPendientes->count() }}</span>
                @endif
            </h2>

            @if($invitacionesPendientes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3>No tienes invitaciones pendientes</h3>
                    <p>Cuando un líder te invite a su equipo, aparecerán aquí</p>
                </div>
            @else
                <div class="cards-grid">
                    @foreach($invitacionesPendientes as $invitacion)
                        <div class="notification-card invitacion">
                            <span class="card-type type-invitacion">📬 INVITACIÓN</span>

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
                                        <div class="mensaje-label">💬 Mensaje del líder:</div>
                                        <div class="mensaje-text">{{ $invitacion->mensaje }}</div>
                                    </div>
                                @endif

                                <div class="fecha">
                                    🕐 Recibida hace {{ $invitacion->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <form action="{{ route('invitations.accept', $invitacion) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-accept" onclick="return confirm('¿Aceptar esta invitación?')">
                                        ✓ Aceptar
                                    </button>
                                </form>

                                <form action="{{ route('invitations.reject', $invitacion) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject" onclick="return confirm('¿Rechazar esta invitación?')">
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

        <!-- ========== SOLICITUDES RECIBIDAS (Me solicitaron - solo si soy líder) ========== -->
        @if($solicitudesPendientes->count() > 0 || Auth::user()->equiposComoLider->count() > 0)
            <div class="section">
                <h2 class="section-title">
                    📥 Solicitudes para Mis Equipos
                    @if($solicitudesPendientes->count() > 0)
                        <span class="count-badge">{{ $solicitudesPendientes->count() }}</span>
                    @endif
                </h2>

                @if($solicitudesPendientes->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📫</div>
                        <h3>No hay solicitudes pendientes</h3>
                        <p>Cuando alguien solicite unirse a tus equipos, aparecerán aquí</p>
                    </div>
                @else
                    <div class="cards-grid">
                        @foreach($solicitudesPendientes as $solicitud)
                            <div class="notification-card solicitud">
                                <span class="card-type type-solicitud">📥 SOLICITUD</span>

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
                                            <div class="mensaje-label">💬 Mensaje del usuario:</div>
                                            <div class="mensaje-text">{{ $solicitud->mensaje }}</div>
                                        </div>
                                    @endif

                                    <div class="fecha">
                                        🕐 Recibida hace {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <form action="{{ route('solicitudes.accept', $solicitud) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn btn-accept" onclick="return confirm('¿Aceptar esta solicitud?')">
                                            ✓ Aceptar
                                        </button>
                                    </form>

                                    <form action="{{ route('solicitudes.reject', $solicitud) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn btn-reject" onclick="return confirm('¿Rechazar esta solicitud?')">
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
        @endif

        <!-- ========== HISTORIAL (Invitaciones y Solicitudes respondidas) ========== -->
        <div class="section">
            <h2 class="section-title">📋 Historial Reciente</h2>

            @if($invitacionesRespondidas->isEmpty() && $solicitudesRespondidas->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📄</div>
                    <h3>Sin historial</h3>
                    <p>Las notificaciones respondidas aparecerán aquí</p>
                </div>
            @else
                <div class="cards-grid">
                    @php
                        $historial = $invitacionesRespondidas->merge($solicitudesRespondidas)->sortByDesc('responded_at');
                    @endphp

                    @foreach($historial as $notificacion)
                        <div class="notification-card {{ $notificacion->tipo }}" style="opacity: 0.7;">
                            <span class="card-type type-{{ $notificacion->tipo }}">
                                @if($notificacion->tipo === 'invitacion')
                                    📬 INVITACIÓN
                                @else
                                    📥 SOLICITUD
                                @endif
                            </span>

                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-name">{{ $notificacion->invitador->name }}</div>
                                    <div class="user-email">{{ $notificacion->invitador->email }}</div>
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
                                    🕐 Respondida hace {{ $notificacion->responded_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>