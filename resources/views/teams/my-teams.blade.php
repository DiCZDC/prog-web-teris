
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

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 40px;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        border: 2px solid;
    }

    .btn-primary {
        background: rgba(255, 215, 0, 0.3);
        border-color: #ffd700;
        color: #ffd700;
    }

    .btn-primary:hover {
        background: rgba(255, 215, 0, 0.5);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(33, 150, 243, 0.3);
        border-color: #2196F3;
        color: #2196F3;
    }

    .btn-secondary:hover {
        background: rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
    }

    .teams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
    }

    .team-card {
        background: rgba(0, 0, 0, 0.4);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s;
        position: relative;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .team-info {
        flex: 1;
    }

    .team-name {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #ffd700;
    }

    .team-code {
        background: rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 14px;
        display: inline-block;
    }

    .mi-rol-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 8px 15px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        white-space: nowrap;
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
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }

    .role-badge {
        background: rgba(255, 215, 0, 0.3);
        border: 1px solid #ffd700;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 12px;
        color: #ffd700;
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
        background: rgba(255, 215, 0, 0.3);
        border-color: #ffd700;
        color: #ffd700;
    }

    .btn-invite:hover {
        background: rgba(255, 215, 0, 0.5);
    }

    .btn-view {
        background: rgba(33, 150, 243, 0.3);
        border-color: #2196F3;
        color: #2196F3;
    }

    .btn-view:hover {
        background: rgba(33, 150, 243, 0.5);
    }

    .btn-edit {
        background: rgba(76, 175, 80, 0.3);
        border-color: #4CAF50;
        color: #4CAF50;
    }

    .btn-edit:hover {
        background: rgba(76, 175, 80, 0.5);
    }

    .btn-danger {
        background: rgba(244, 67, 54, 0.3);
        border-color: #f44336;
        color: #f44336;
    }

    .btn-danger:hover {
        background: rgba(244, 67, 54, 0.5);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 20px;
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: 20px;
    }

    .empty-state h2 {
        font-size: 32px;
        margin-bottom: 15px;
    }

    .empty-state p {
        color: rgba(255, 255, 255, 0.7);
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
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-100 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">← Regresar</span>
                </a>
            </div>
        <h1>Mis Equipos</h1>
        <p class="subtitle">Equipos en los que participas</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('teams.create') }}" class="btn btn-primary">➕ Crear Nuevo Equipo</a>
            <a href="{{ route('teams.join') }}" class="btn btn-secondary">🤝 Unirse a Equipo</a>
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
                                <div style="margin-bottom: 15px; padding: 10px; background: rgba(33, 150, 243, 0.2); border-radius: 8px;">
                                    <strong>📅 Evento:</strong> {{ $team->evento->nombre }}
                                </div>
                            @endif

                            <div class="member-list">
                                @foreach($team->getTodosMiembros() as $rol => $miembro)
                                    <div class="member-item">
                                        <span class="role-badge">{{ $rol }}</span>
                                        <span class="member-name">{{ $miembro->name }}</span>
                                        @if($miembro->id === Auth::id())
                                            <span style="margin-left: auto; font-size: 18px;">👈</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if($team->estaCompleto())
                                <span class="status-badge status-complete">✓ Equipo Completo</span>
                            @else
                                <span class="status-badge status-incomplete">
                                    ⏳ Faltan: {{ implode(', ', $team->posicionesDisponibles()) }}
                                </span>
                            @endif
                        </div>

                        <div class="team-actions">
                            <a href="{{ route('teams.show', $team) }}" class="btn-small btn-view">
                                👁️ Ver Detalle
                            </a>

                            @if($team->esLider(Auth::id()))
                                <a href="{{ route('teams.invite', $team) }}" class="btn-small btn-invite">
                                    📨 Invitar Miembros
                                </a>
                                <a href="{{ route('teams.edit', $team) }}" class="btn-small btn-edit">
                                    ✏️ Editar
                                </a>
                            @else
                                <form action="{{ route('teams.leave', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Salir de este equipo?')">
                                    @csrf
                                    <button type="submit" class="btn-small btn-danger">
                                        🚪 Salir
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