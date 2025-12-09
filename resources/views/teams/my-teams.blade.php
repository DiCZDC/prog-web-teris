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

    h1 {
        text-align: center;
        font-size: 48px;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 4px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        color: #c4b5fd;
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
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid rgba(76, 175, 80, 0.5);
        color: #4CAF50;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 40px;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.4), rgba(167, 139, 250, 0.4));
        border: 2px solid rgba(167, 139, 250, 0.6);
        color: #c4b5fd;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.6), rgba(167, 139, 250, 0.6));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
    }

    .btn-secondary {
        background: rgba(33, 150, 243, 0.3);
        border: 2px solid #2196F3;
        color: #2196F3;
    }

    .btn-secondary:hover {
        background: rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
    }

    .teams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
    }

    .team-card {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.95), rgba(49, 46, 129, 0.95));
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(139, 92, 246, 0.3);
        transition: transform 0.3s;
        position: relative;
        border: 2px solid rgba(167, 139, 250, 0.3);
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(139, 92, 246, 0.5);
        border-color: rgba(167, 139, 250, 0.6);
    }

    .team-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(167, 139, 250, 0.3);
    }

    .team-info {
        flex: 1;
    }

    .team-name {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #c4b5fd;
    }

    .team-code {
        background: rgba(109, 40, 217, 0.3);
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 14px;
        display: inline-block;
        border: 1px solid rgba(167, 139, 250, 0.5);
        color: #c4b5fd;
    }

    .mi-rol-badge {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.6), rgba(167, 139, 250, 0.6));
        padding: 8px 15px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        white-space: nowrap;
        border: 1px solid rgba(167, 139, 250, 0.8);
        color: #c4b5fd;
    }

    .team-body {
        margin-bottom: 20px;
    }

    .member-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
    }

    .member-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: rgba(109, 40, 217, 0.2);
        border-radius: 8px;
        border: 1px solid rgba(167, 139, 250, 0.2);
    }

    .role-badge {
        background: rgba(167, 139, 250, 0.3);
        border: 1px solid rgba(167, 139, 250, 0.6);
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 12px;
        color: #c4b5fd;
        font-weight: bold;
        min-width: 140px;
        text-align: center;
    }

    .member-name {
        color: rgba(255, 255, 255, 0.9);
    }

    .team-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-small {
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        border: 2px solid;
        cursor: pointer;
    }

    .btn-invite {
        background: rgba(167, 139, 250, 0.3);
        border-color: rgba(167, 139, 250, 0.6);
        color: #c4b5fd;
    }

    .btn-invite:hover {
        background: rgba(167, 139, 250, 0.5);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }

    .btn-view {
        background: rgba(33, 150, 243, 0.3);
        border-color: #2196F3;
        color: #2196F3;
    }

    .btn-view:hover {
        background: rgba(33, 150, 243, 0.5);
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.4);
    }

    .btn-edit {
        background: rgba(76, 175, 80, 0.3);
        border-color: #4CAF50;
        color: #4CAF50;
    }

    .btn-edit:hover {
        background: rgba(76, 175, 80, 0.5);
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
    }

    .btn-danger {
        background: rgba(244, 67, 54, 0.3);
        border-color: #f44336;
        color: #f44336;
    }

    .btn-danger:hover {
        background: rgba(244, 67, 54, 0.5);
        box-shadow: 0 4px 15px rgba(244, 67, 54, 0.4);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: linear-gradient(135deg, rgba(49, 46, 129, 0.5), rgba(76, 29, 149, 0.5));
        border-radius: 20px;
        border: 2px dashed rgba(167, 139, 250, 0.4);
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.2);
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: 20px;
        filter: drop-shadow(0 4px 8px rgba(139, 92, 246, 0.3));
    }

    .empty-state h2 {
        font-size: 32px;
        margin-bottom: 15px;
        color: #c4b5fd;
    }

    .empty-state p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 18px;
        margin-bottom: 30px;
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: bold;
        display: inline-block;
        margin-top: 10px;
    }

    .status-complete {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid #4CAF50;
        color: #4CAF50;
    }

    .status-incomplete {
        background: rgba(255, 152, 0, 0.3);
        border: 1px solid #FF9800;
        color: #FF9800;
    }

    @media (max-width: 768px) {
        .teams-grid {
            grid-template-columns: 1fr;
        }

        .team-actions {
            flex-direction: column;
        }
    }
</style>
<x-app-layout>
    <div class="container">
        <!-- Botón Regresar -->
            <div class="mb-6">
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
        <h1>Mis Equipos</h1>
        <p class="subtitle">Equipos en los que participas</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="action-buttons">
            <!-- CREAR EQUIPO -->
            <a href="{{ route('teams.create') }}" class="btn btn-primary">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                    style="vertical-align: middle; margin-right: 6px; display: inline-block;">
                    <path d="M12 5v14M5 12h14" 
                        stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Crear Nuevo Equipo
            </a>

            <!-- UNIRSE A UN EQUIPO -->
            <a href="{{ route('teams.join') }}" class="btn btn-secondary">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                    style="vertical-align: middle; margin-right: 6px; display: inline-block;">
                    <path d="M3 11l4-4 5 5 5-5 4 4-9 9-9-9z"
                        stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 13l4 4 4-4"
                        stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Unirse a un Equipo
            </a>

        </div>

        @if($misEquipos->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h2>No tienes equipos aún</h2>
                <p>Crea un nuevo equipo o únete a uno existente para empezar</p>
            </div>
        @else
            <div class="teams-grid">
                @foreach($misEquipos as $team)
                    <div class="team-card">
                        <div class="team-header">
                            <div class="team-info">
                                <div class="team-name">{{ $team->nombre }}</div>
                                <span class="team-code">Código: {{ $team->codigo }}</span>
                            </div>
                            <div class="mi-rol-badge">
                                {{ $team->getRolDelUsuario(Auth::id()) }}
                            </div>
                        </div>

                        <div class="team-body">
                            @if($team->descripcion)
                                <p style="color: rgba(255,255,255,0.8); margin-bottom: 15px;">
                                    {{ Str::limit($team->descripcion, 100) }}
                                </p>
                            @endif

                            @if($team->evento)
                                <div style="margin-bottom: 15px; padding: 10px; background: rgba(33, 150, 243, 0.2); border-radius: 8px; border: 1px solid rgba(33, 150, 243, 0.4);">
                                    <strong>Evento:</strong> {{ $team->evento->nombre }}
                                </div>
                            @endif

                            <div class="member-list">
                                @foreach($team->getTodosMiembros() as $rol => $miembro)
                                    <div class="member-item">
                                        <span class="role-badge">{{ $rol }}</span>
                                        <span class="member-name">{{ $miembro->name }}</span>
                                        @if($miembro->id === Auth::id())
                                            <span style="margin-left: auto; font-size: 18px;">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                    <path d="M15 18l-6-6 6-6" 
                                                        stroke="currentColor" 
                                                        stroke-width="2" 
                                                        stroke-linecap="round" 
                                                        stroke-linejoin="round"/>
                                                </svg>
                                            </span>

                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if($team->estaCompleto())
                                <span class="status-badge status-complete">✓ Equipo Completo</span>
                            @else
                                <span class="status-badge status-incomplete">
                                    Faltan: {{ implode(', ', $team->posicionesDisponibles()) }}
                                </span>
                            @endif
                        </div>

                        <div class="team-actions">
                            <a href="{{ route('teams.show', $team) }}" class="btn-small btn-view">
                                Ver Detalle
                            </a>

                            @if($team->esLider(Auth::id()))
                                <a href="{{ route('teams.invite', $team) }}" class="btn-small btn-invite">
                                    Invitar Miembros
                                </a>
                                <a href="{{ route('teams.edit', $team) }}" class="btn-small btn-edit">
                                    Editar
                                </a>
                            @else
                                <form action="{{ route('teams.leave', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Salir de este equipo?')">
                                    @csrf
                                    <button type="submit" class="btn-small btn-danger">
                                        Salir
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
</html>