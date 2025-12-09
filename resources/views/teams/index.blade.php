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

    /* ========== ESTILOS PARA BADGE DE NOTIFICACIONES ========== */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #f44336;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: bold;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .user-menu-item {
        position: relative;
    }
    /* ========================================================== */

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
        background: linear-gradient(135deg, #ffd700, #ffed4e);
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

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
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
    }

    .btn-primary {
        background: rgba(255, 215, 0, 0.3);
        border: 2px solid #ffd700;
        color: #ffd700;
    }

    .btn-primary:hover {
        background: rgba(255, 215, 0, 0.5);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(33, 150, 243, 0.3);
        border: 2px solid #2196F3;
        color: #2196F3;
    }

    .btn-secondary:hover {
        background: rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
    }

    .teams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 20px;
    }

    .team-card {
        background: rgba(0, 0, 0, 0.4);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.5);
    }

    .team-header {
        background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 50%, #6c5b7b 100%);
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .team-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }

    .team-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .team-code {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
    }

    .team-content {
        padding: 25px;
    }

    .team-name {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .team-description {
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 20px;
        line-height: 1.6;
        text-align: center;
    }

    .team-members {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    .member-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: rgba(255, 255, 255, 0.1);
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
        min-width: 150px;
        text-align: center;
    }

    .member-name {
        color: rgba(255, 255, 255, 0.9);
    }

    .team-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
    }

    .status-active {
        background: rgba(76, 175, 80, 0.3);
        border: 1px solid #4CAF50;
        color: #4CAF50;
    }

    .status-inactive {
        background: rgba(158, 158, 158, 0.3);
        border: 1px solid #9E9E9E;
        color: #9E9E9E;
    }

    .team-complete {
        background: rgba(33, 150, 243, 0.3);
        border: 1px solid #2196F3;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 14px;
        color: #2196F3;
    }

    .view-btn {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background: rgba(255, 215, 0, 0.2);
        border: 1px solid #ffd700;
        border-radius: 8px;
        color: #ffd700;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
    }

    .view-btn:hover {
        background: rgba(255, 215, 0, 0.4);
        transform: scale(1.05);
    }

    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px;
    }

    .empty-state h2 {
        font-size: 32px;
        margin-bottom: 15px;
    }

    .empty-state p {
        opacity: 0.7;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .teams-grid {
            grid-template-columns: 1fr;
        }

        .navbar {
            flex-direction: column;
            gap: 20px;
        }
    }
</style>

<x-app-layout>
    <body>
    
    <div class="container">
        <h1>Equipos Disponibles</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @auth   
            @if(auth()->user()->hasRole('user'))
                <div class="action-buttons">
                    <a href="{{ route('teams.my-teams') }}" class="btn btn-secondary">🤝 Mis equipos</a>
                    <a href="{{ route('teams.create') }}" class="btn btn-primary">➕ Crear Nuevo Equipo</a>
                    <a href="{{ route('teams.join') }}" class="btn btn-secondary">🤝 Unirse a un Equipo</a>
                    <a href="{{ route('teams.my-invitations') }}" class="btn btn-primary">📬 Mis notificaciones</a>
                </div>
            @endif
        @endauth

        <div class="teams-grid">
            @forelse($teams as $team)
                <div class="team-card" onclick="window.location='{{ route('teams.show', $team) }}'">
                    <div class="team-header">
                        <div class="team-code">{{ $team->codigo }}</div>
                        <div class="team-icon">
                            @if($team->icono)
                                <img src="{{ asset('storage/' . $team->icono) }}" alt="{{ $team->nombre }}">
                            @else
                                👥
                            @endif
                        </div>
                        <div class="team-name">{{ $team->nombre }}</div>
                    </div>
                    
                    <div class="team-content">
                        @if($team->descripcion)
                            <p class="team-description">{{ Str::limit($team->descripcion, 100) }}</p>
                        @endif
                        
                        <div class="team-members">
                            @if($team->lider)
                                <div class="member-item">
                                    <span class="role-badge">GERENTE</span>
                                    <span class="member-name">{{ $team->lider->name }}</span>
                                </div>
                            @endif
                            
                            @if($team->disenador)
                                <div class="member-item">
                                    <span class="role-badge">DISEÑADOR</span>
                                    <span class="member-name">{{ $team->disenador->name }}</span>
                                </div>
                            @else
                                <div class="member-item">
                                    <span class="role-badge" style="opacity: 0.5;">DISEÑADOR</span>
                                    <span class="member-name" style="opacity: 0.5;">Disponible</span>
                                </div>
                            @endif
                            
                            @if($team->frontprog)
                                <div class="member-item">
                                    <span class="role-badge">PROGRAMADOR FRONT</span>
                                    <span class="member-name">{{ $team->frontprog->name }}</span>
                                </div>
                            @else
                                <div class="member-item">
                                    <span class="role-badge" style="opacity: 0.5;">PROGRAMADOR FRONT</span>
                                    <span class="member-name" style="opacity: 0.5;">Disponible</span>
                                </div>
                            @endif
                            
                            @if($team->backprog)
                                <div class="member-item">
                                    <span class="role-badge">PROGRAMADOR BACK</span>
                                    <span class="member-name">{{ $team->backprog->name }}</span>
                                </div>
                            @else
                                <div class="member-item">
                                    <span class="role-badge" style="opacity: 0.5;">PROGRAMADOR BACK</span>
                                    <span class="member-name" style="opacity: 0.5;">Disponible</span>
                                </div>
                            @endif
                        </div>

                        <div class="team-status">
                            <span class="status-badge {{ $team->estado ? 'status-active' : 'status-inactive' }}">
                                {{ $team->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                            
                            @if($team->estaCompleto())
                                <span class="team-complete">✓ Completo</span>
                            @endif
                        </div>

                        <a href="{{ route('teams.show', $team) }}" class="view-btn">Ver Detalles</a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h2>No hay equipos disponibles</h2>
                    <p>Sé el primero en crear un equipo</p>
                    
                </div>
            @endforelse
        </div>

        @if($teams->hasPages())
            <div style="margin-top: 40px; text-align: center;">
                {{ $teams->links() }}
            </div>
        @endif
    </div>
</body>
</x-app-layout>