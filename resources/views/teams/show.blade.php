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
        background: rgba(168, 85, 247, 0.2);
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

    /* ===== ESTILOS AGREGADOS PARA LA SECCIÓN DE PROYECTO ===== */
    .project-section {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid rgba(255, 255, 255, 0.2);
    }

    .project-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .project-card {
        background: rgba(76, 175, 80, 0.15);
        border: 2px solid rgba(76, 175, 80, 0.4);
        border-radius: 15px;
        padding: 25px;
        position: relative;
    }

    .project-card-warning {
        background: rgba(255, 193, 7, 0.15);
        border: 2px solid rgba(255, 193, 7, 0.4);
    }

    .project-status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid #4CAF50;
        color: #4CAF50;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .project-info-header {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }

    .project-icon {
        font-size: 32px;
        width: 50px;
        height: 50px;
        background: rgba(76, 175, 80, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .project-info {
        flex: 1;
    }

    .project-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 8px;
        color: white;
    }

    .project-date {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }

    .project-description {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        font-size: 15px;
    }

    .project-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .project-btn {
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 2px solid;
    }

    .project-btn-primary {
        background: rgba(33, 150, 243, 0.3);
        border-color: #2196F3;
        color: #2196F3;
    }

    .project-btn-primary:hover {
        background: rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
    }

    .project-btn-success {
        background: rgba(76, 175, 80, 0.3);
        border-color: #4CAF50;
        color: #4CAF50;
    }

    .project-btn-success:hover {
        background: rgba(76, 175, 80, 0.5);
        transform: translateY(-2px);
    }

    .project-warning-icon {
        font-size: 32px;
        margin-right: 15px;
    }

    .project-warning-content {
        flex: 1;
    }

    .project-warning-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #FFC107;
    }

    .project-warning-text {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .project-info-box {
        background: rgba(33, 150, 243, 0.15);
        border: 1px solid rgba(33, 150, 243, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        margin-top: 15px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .project-upload-note {
        background: rgba(255, 193, 7, 0.2);
        border: 1px solid rgba(255, 193, 7, 0.4);
        border-radius: 10px;
        padding: 12px 15px;
        margin-top: 15px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    /* ===== FIN DE ESTILOS AGREGADOS ===== */

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

        .project-actions {
            flex-direction: column;
        }

        .project-status-badge {
            position: static;
            margin-bottom: 15px;
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

            {{-- ===== SECCIÓN DE PROYECTO AGREGADA ===== --}}
            <div class="project-section">
                <div class="project-title">
                    📦 Proyecto del Equipo
                </div>

                @if($team->tieneProyecto())
                    {{-- PROYECTO EXISTENTE --}}
                    <div class="project-card">
                        <div class="project-status-badge">
                            ✓ Enviado
                        </div>

                        <div class="project-info-header">
                            <div class="project-icon">🚀</div>
                            <div class="project-info">
                                <div class="project-name">{{ $team->proyecto->nombre }}</div>
                                <div class="project-date">
                                    Enviado el {{ $team->proyecto->created_at->format('d/m/Y') }} 
                                    a las {{ $team->proyecto->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>

                        @if($team->proyecto->descripcion)
                        <div class="project-description">
                            {{ Str::limit($team->proyecto->descripcion, 200) }}
                        </div>
                        @endif

                        <div class="project-actions">
                            <a href="{{ route('projects.show', $team->proyecto) }}" 
                               class="project-btn project-btn-primary">
                                👁️ Ver Proyecto Completo
                            </a>
                            
                            <a href="{{ $team->proyecto->url }}" 
                               target="_blank"
                               class="project-btn project-btn-success">
                                🔗 Abrir Proyecto
                            </a>
                        </div>

                        <div class="project-info-box">
                            🔒 El proyecto ha sido enviado y no puede ser modificado
                        </div>
                    </div>
                @else
                    {{-- SIN PROYECTO --}}
                    <div class="project-card project-card-warning">
                        <div class="project-info-header">
                            <div class="project-warning-icon">⚠️</div>
                            <div class="project-warning-content">
                                <div class="project-warning-title">No hay proyecto subido</div>
                                <div class="project-warning-text">
                                    Este equipo aún no ha subido su proyecto para evaluación.
                                    @if($team->esLider(Auth::id()))
                                        Como líder del equipo, puedes subir el proyecto ahora.
                                    @else
                                        Solo el líder del equipo puede subir el proyecto.
                                    @endif
                                </div>

                                @if($team->esLider(Auth::id()))
                                    <div class="project-actions">
                                        <a href="{{ route('projects.create', ['team_id' => $team->id]) }}" 
                                           class="project-btn project-btn-success">
                                            ⬆️ Subir Proyecto
                                        </a>
                                    </div>

                                    <div class="project-upload-note">
                                        <span>⚡</span>
                                        <span><strong>Importante:</strong> Solo tendrás una oportunidad para subir el proyecto. Una vez enviado, no podrá ser editado ni eliminado.</span>
                                    </div>
                                @else
                                    <div class="project-info-box">
                                        👤 Líder del equipo: <strong>{{ $team->lider->name }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{-- ===== FIN DE SECCIÓN DE PROYECTO ===== --}}

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

            {{-- NUEVA SECCIÓN: PROYECTO DEL EQUIPO --}}
            @if($team->evento)
            <div class="members-section" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid rgba(255, 255, 255, 0.2);">
                <div class="members-title">📦 Proyecto del Equipo:</div>

                @if($team->proyecto)
                    {{-- Equipo ya tiene proyecto --}}
                    <div style="background: rgba(34, 197, 94, 0.2); border: 2px solid #22c55e; border-radius: 10px; padding: 20px; margin-bottom: 15px;">
                        <div style="display: flex; align-items: start; gap: 15px;">
                            <div style="flex-shrink: 0;">
                                <svg style="width: 48px; height: 48px; color: #22c55e;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div style="flex: 1;">
                                <h3 style="font-size: 20px; font-weight: bold; color: #22c55e; margin-bottom: 8px;">
                                    {{ $team->proyecto->nombre }}
                                </h3>
                                <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 12px; line-height: 1.5;">
                                    {{ $team->proyecto->descripcion }}
                                </p>
                                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
                                    @if($team->proyecto->repositorio_url)
                                    <a href="{{ $team->proyecto->repositorio_url }}" target="_blank"
                                       style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; background: rgba(255, 255, 255, 0.2); border-radius: 6px; color: white; text-decoration: none; font-size: 14px; transition: all 0.2s;">
                                        <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        GitHub
                                    </a>
                                    @endif
                                    @if($team->proyecto->demo_url)
                                    <a href="{{ $team->proyecto->demo_url }}" target="_blank"
                                       style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; background: rgba(255, 255, 255, 0.2); border-radius: 6px; color: white; text-decoration: none; font-size: 14px;">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Demo
                                    </a>
                                    @endif
                                    @if($team->proyecto->documentacion_url)
                                    <a href="{{ $team->proyecto->documentacion_url }}" target="_blank"
                                       style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; background: rgba(255, 255, 255, 0.2); border-radius: 6px; color: white; text-decoration: none; font-size: 14px;">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Docs
                                    </a>
                                    @endif
                                </div>
                                <div style="font-size: 12px; color: rgba(255, 255, 255, 0.7);">
                                    Enviado el {{ $team->proyecto->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Equipo no tiene proyecto --}}
                    <div style="background: rgba(249, 115, 22, 0.2); border: 2px solid #f97316; border-radius: 10px; padding: 20px; text-align: center;">
                        <svg style="width: 48px; height: 48px; color: #fb923c; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p style="font-weight: bold; color: #fb923c; margin-bottom: 6px;">
                            Este equipo aún no ha enviado su proyecto
                        </p>
                        <p style="font-size: 14px; color: rgba(255, 255, 255, 0.8);">
                            El líder del equipo debe enviar el proyecto para que los jueces puedan evaluarlo
                        </p>
                    </div>
                @endif
            </div>
            @endif

            @auth
            <div class="action-buttons">
                @if($team->lider_id === Auth::id())
                    {{-- Botones para el líder --}}
                    @if($team->evento)
                        @if($team->proyecto)
                            <a href="{{ route('projects.edit', $team->proyecto) }}" class="btn btn-primary">Ver Proyecto</a>
                        @else
                            <a href="{{ route('projects.create', ['team_id' => $team->id]) }}" class="btn btn-primary">📤 Enviar Proyecto</a>
                        @endif
                    @endif
                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary">✏️ Editar Equipo</a>
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