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

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 28px;
        font-weight: bold;
    }

    .logo-icon {
        width: 40px;
        height: 40px;
        /* Antes amarillo */
        background: linear-gradient(135deg, #a855f7, #c084fc);
        border-radius: 8px;
    }

    .nav-menu {
        display: flex;
        gap: 45px;
        list-style: none;
        align-items: center;
    }

    .nav-menu a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 27px;
        transition: opacity 0.3s;
    }

    .nav-menu a:hover {
        opacity: 0.8;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: rgba(0, 0, 0, 0.9);
        min-width: 200px;
        border-radius: 10px;
        margin-top: 10px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        z-index: 1000;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        display: block;
        padding: 12px 20px;
        font-size: 16px;
        color: white;
        text-decoration: none;
        transition: background 0.3s;
    }

    .dropdown-content a:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logout-btn {
        background: rgba(255, 0, 0, 0.3);
        border: 1px solid rgba(255, 0, 0, 0.5);
        padding: 8px 20px;
        border-radius: 20px;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: rgba(255, 0, 0, 0.5);
    }

    .auth-btn {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .auth-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .container {
        max-width: 1000px;
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
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 4px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
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

    .alert-error {
        background: rgba(244, 67, 54, 0.3);
        border: 1px solid rgba(244, 67, 54, 0.5);
    }

    .team-detail-card {
        background: rgba(0, 0, 0, 0.4);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .team-header-section {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .team-icon-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 50%, #6c5b7b 100%);
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
    }

    .team-icon-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .team-name-large {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .team-code-large {
        display: inline-block;
        /* Antes amarillo */
        background: rgba(168, 85, 247, 0.3);
        border: 2px solid #a855f7;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 24px;
        font-weight: bold;
        color: #a855f7;
        margin-bottom: 15px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-value {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        color: white;
        font-size: 16px;
    }

    .form-value textarea {
        background: transparent;
        border: none;
        color: white;
        width: 100%;
        resize: none;
        outline: none;
    }

    .members-section {
        margin-top: 30px;
    }

    .members-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255, 255, 255, 0.9);
    }

    .member-row {
        display: grid;
        grid-template-columns: 200px 1fr 100px;
        gap: 15px;
        margin-bottom: 15px;
        align-items: center;
    }

    .role-input {
        background: rgba(168, 85, 247, 0.2); /* antes amarillo */
        border: 1px solid #a855f7;
        border-radius: 10px;
        padding: 12px 15px;
        color: #a855f7;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
    }

    .member-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        color: white;
        font-size: 16px;
    }

    .status-input {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid #4CAF50;
        border-radius: 10px;
        padding: 12px 15px;
        color: #4CAF50;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .status-inactive {
        background: rgba(158, 158, 158, 0.3);
        border: 1px solid #9E9E9E;
        color: #9E9E9E;
    }

    .member-available {
        opacity: 0.5;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid rgba(255, 255, 255, 0.2);
    }

    .btn {
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        /* Antes amarillo */
        background: rgba(168, 85, 247, 0.3);
        border: 2px solid #a855f7;
        color: #a855f7;
    }

    .btn-primary:hover {
        background: rgba(168, 85, 247, 0.5);
        transform: translateY(-2px);
    }

    .btn-danger {
        background: rgba(244, 67, 54, 0.3);
        border: 2px solid #f44336;
        color: #f44336;
    }

    .btn-danger:hover {
        background: rgba(244, 67, 54, 0.5);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(158, 158, 158, 0.3);
        border: 2px solid #9E9E9E;
        color: #9E9E9E;
    }

    .btn-secondary:hover {
        background: rgba(158, 158, 158, 0.5);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .member-row {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .navbar {
            flex-direction: column;
            gap: 20px;
        }
    }
</style>

<x-app-layout>
    <div class="container">
        <a href="{{ route('teams.index') }}" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                style="vertical-align: middle; margin-right: 6px; display: inline-block;">
                <path d="M15 18l-6-6 6-6" 
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Regresar
        </a>

        <h1>Ver Equipo</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="team-detail-card">
            <div class="team-header-section">
                <div class="team-icon-large">
                    @if($team->icono)
                        <img src="{{ asset('storage/' . $team->icono) }}" alt="{{ $team->nombre }}">
                    @else
                        👥
                    @endif
                </div>
                <div class="team-name-large">{{ $team->nombre }}</div>
                <div class="team-code-large">{{ $team->codigo }}</div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nombre del Equipo:</label>
                    <div class="form-value">{{ $team->nombre }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Código:</label>
                    <div class="form-value">{{ $team->codigo }}</div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Descripción:</label>
                    <div class="form-value">
                        <textarea rows="3" readonly>{{ $team->descripcion ?? 'Sin descripción' }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Fecha Creación:</label>
                    <div class="form-value">{{ $team->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Estado:</label>
                    <div class="form-value status-input {{ !$team->estado ? 'status-inactive' : '' }}">
                        {{ $team->estado ? 'Activo' : 'Inactivo' }}
                    </div>
                </div>

                @if($team->evento)
                <div class="form-group full-width">
                    <label class="form-label">Evento:</label>
                    <div class="form-value">{{ $team->evento->nombre }}</div>
                </div>
                @endif
            </div>
            {{-- En teams/show.blade.php, después de los botones de acción --}}

@if($team->esLider(Auth::id()) && !$team->tieneProyecto())
    <a href="{{ route('projects.create', ['team_id' => $team->id]) }}" 
       class="btn btn-success">
        <i class="fas fa-cloud-upload-alt mr-2"></i>
        Subir Proyecto
    </a>
@endif

@if($team->tieneProyecto())
    <a href="{{ route('projects.show', $team->proyecto) }}" 
       class="btn btn-primary">
        <i class="fas fa-eye mr-2"></i>
        Ver Proyecto
    </a>
@endif
            <div class="members-section">
                <div class="members-title">Integrantes:</div>

                <div class="member-row">
                    <div class="role-input">GERENTE</div>
                    <div class="member-input">
                        {{ $team->lider ? $team->lider->name : 'Sin asignar' }}
                    </div>
                    <div class="status-input">ASIGNADO</div>
                </div>

                <div class="member-row {{ !$team->disenador ? 'member-available' : '' }}">
                    <div class="role-input">DISEÑADOR</div>
                    <div class="member-input">
                        {{ $team->disenador ? $team->disenador->name : 'Disponible' }}
                    </div>
                    <div class="status-input {{ !$team->disenador ? 'status-inactive' : '' }}">
                        {{ $team->disenador ? 'ASIGNADO' : 'DISPONIBLE' }}
                    </div>
                </div>

                <div class="member-row {{ !$team->frontprog ? 'member-available' : '' }}">
                    <div class="role-input">PROGRAMADOR FRONT</div>
                    <div class="member-input">
                        {{ $team->frontprog ? $team->frontprog->name : 'Disponible' }}
                    </div>
                    <div class="status-input {{ !$team->frontprog ? 'status-inactive' : '' }}">
                        {{ $team->frontprog ? 'ASIGNADO' : 'DISPONIBLE' }}
                    </div>
                </div>

                <div class="member-row {{ !$team->backprog ? 'member-available' : '' }}">
                    <div class="role-input">PROGRAMADOR BACK</div>
                    <div class="member-input">
                        {{ $team->backprog ? $team->backprog->name : 'Disponible' }}
                    </div>
                    <div class="status-input {{ !$team->backprog ? 'status-inactive' : '' }}">
                        {{ $team->backprog ? 'ASIGNADO' : 'DISPONIBLE' }}
                    </div>
                </div>
            </div>

            @auth
            <div class="action-buttons">
                @if($team->lider_id === Auth::id())
                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary">Editar Equipo</a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este equipo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Equipo</button>
                    </form>
                @elseif($team->esMiembro(Auth::id()))
                    <form action="{{ route('teams.leave', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de salir de este equipo?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">Salir del Equipo</button>
                    </form>
                @elseif(!$team->estaCompleto())
                    <a href="{{ route('teams.join') }}" class="btn btn-primary">Unirse a este Equipo</a>
                @endif
                
                <a href="{{ route('teams.index') }}" class="btn btn-secondary">← Volver</a>
            </div>
            @endauth
        </div>
    </div>
</x-app-layout>