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

    .alert-error {
        background: rgba(244, 67, 54, 0.3);
        border: 1px solid rgba(244, 67, 54, 0.5);
        color: #f44336;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.4), rgba(167, 139, 250, 0.4));
        border: 2px solid rgba(167, 139, 250, 0.6);
        color: #c4b5fd;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.6), rgba(167, 139, 250, 0.6));
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
    }

    .btn-secondary {
        background: rgba(33, 150, 243, 0.3);
        border: 2px solid #2196F3;
        color: #2196F3;
    }

    .btn-secondary:hover {
        background: rgba(33, 150, 243, 0.5);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
    }

    .btn-accent {
        background: rgba(156, 39, 176, 0.3);
        border: 2px solid #9C27B0;
        color: #E1BEE7;
    }

    .btn-accent:hover {
        background: rgba(156, 39, 176, 0.5);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(156, 39, 176, 0.4);
    }

    .teams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
        padding: 20px 0;
    }

    .team-card {
        background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid rgba(167, 139, 250, 0.3);
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 40px rgba(139, 92, 246, 0.5);
        border-color: rgba(167, 139, 250, 0.6);
    }

    .team-header {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.95), rgba(49, 46, 129, 0.95));
        padding: 30px;
        text-align: center;
        position: relative;
        border-bottom: 2px solid rgba(167, 139, 250, 0.3);
    }

    .team-icon {
        width: 90px;
        height: 90px;
        background: rgba(167, 139, 250, 0.3);
        border-radius: 50%;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        border: 3px solid rgba(167, 139, 250, 0.5);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .team-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .team-code {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(109, 40, 217, 0.7);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
        color: #c4b5fd;
        border: 1px solid rgba(167, 139, 250, 0.5);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
    }

    .team-content {
        padding: 25px;
    }

    .team-name {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #c4b5fd;
    }

    .team-description {
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 20px;
        line-height: 1.6;
        text-align: center;
        font-size: 14px;
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
        gap: 12px;
        padding: 12px;
        background: rgba(109, 40, 217, 0.2);
        border-radius: 10px;
        border-left: 3px solid transparent;
        transition: all 0.3s;
        border: 1px solid rgba(167, 139, 250, 0.2);
    }

    .member-item:hover {
        background: rgba(109, 40, 217, 0.3);
        border-color: rgba(167, 139, 250, 0.4);
    }

    .member-item.filled {
        border-left-color: #4CAF50;
        background: rgba(109, 40, 217, 0.25);
    }

    .member-item.available {
        border-left-color: rgba(167, 139, 250, 0.3);
        opacity: 0.6;
    }

    .role-badge {
        background: rgba(167, 139, 250, 0.3);
        border: 1px solid rgba(167, 139, 250, 0.6);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11px;
        color: #c4b5fd;
        font-weight: bold;
        min-width: 160px;
        text-align: center;
        text-transform: uppercase;
    }

    .role-badge.gerente {
        background: rgba(233, 30, 99, 0.3);
        border-color: #E91E63;
        color: #F48FB1;
    }

    .member-name {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
    }

    .team-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid rgba(255, 255, 255, 0.1);
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
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
        background: rgba(139, 92, 246, 0.3);
        border: 1px solid rgba(167, 139, 250, 0.6);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        color: #c4b5fd;
        font-weight: bold;
    }

    .view-btn {
        display: block;
        margin-top: 20px;
        padding: 12px 20px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.3), rgba(167, 139, 250, 0.3));
        border: 2px solid rgba(167, 139, 250, 0.6);
        border-radius: 10px;
        color: #c4b5fd;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
        font-weight: bold;
    }

    .view-btn:hover {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.5), rgba(167, 139, 250, 0.5));
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        border-color: rgba(167, 139, 250, 0.8);
    }

    .empty-state {
        grid-column: 1/-1;
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
        opacity: 0.6;
        filter: drop-shadow(0 4px 8px rgba(139, 92, 246, 0.3));
    }

    .empty-state h2 {
        font-size: 32px;
        margin-bottom: 15px;
        color: #c4b5fd;
    }

    .empty-state p {
        opacity: 0.8;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.8);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background: rgba(255, 215, 0, 0.3);
        border-color: #ffd700;
    }

    .pagination .active span {
        background: rgba(255, 215, 0, 0.3);
        border-color: #ffd700;
        color: #ffd700;
    }

    @media (max-width: 768px) {
        .teams-grid {
            grid-template-columns: 1fr;
        }

        h1 {
            font-size: 36px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .role-badge {
            min-width: 130px;
            font-size: 10px;
        }

        .member-name {
            font-size: 13px;
        }

        .team-name {
            font-size: 22px;
        }
    }
</style>

<body>
    <div class="container">
        <h1>Equipos Disponibles</h1>
        <p class="subtitle">Encuentra tu equipo ideal o crea uno nuevo</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @auth   
        @if(auth()->user()->hasRole('user') && !auth()->user()->is_banned && !auth()->user()->is_suspended && !auth()->user()->hasRole('admin') && !auth()->user()->hasRole('judge'))
            <div class="action-buttons">

                <!-- MIS EQUIPOS -->
                <a href="{{ route('teams.my-teams') }}" class="btn btn-secondary">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="9" cy="7" r="4" 
                                stroke="currentColor" stroke-width="2" 
                                stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Mis equipos
                </a>

                <!-- CREAR EQUIPO -->
                <a href="{{ route('teams.create') }}" class="btn btn-primary">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M12 5v14M5 12h14" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Crear Nuevo Equipo
                </a>

                <!-- UNIRSE A UN EQUIPO -->
                <a href="{{ route('teams.join') }}" class="btn btn-secondary">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M3 11l4-4 5 5 5-5 4 4-9 9-9-9z"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 13l4 4 4-4"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Unirse a un Equipo
                </a>


                <!-- NOTIFICACIONES -->
                <a href="{{ route('teams.my-invitations') }}" class="btn btn-accent">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" 
                            stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Mis notificaciones
                </a>

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
                                <svg width="55" height="55" viewBox="0 0 24 24" fill="none">
                                    <circle cx="9" cy="7" r="4" 
                                            stroke="currentColor" stroke-width="2" 
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 11c1.66 0 3-1.34 3-3s-1.34-3-3-3" 
                                        stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2" 
                                        stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 13a4 4 0 0 1 4 4v2" 
                                        stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
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
                                <div class="member-item filled">
                                    <span class="role-badge gerente">LÍDER</span>
                                    <span class="member-name">{{ $team->lider->name }}</span>
                                </div>
                            @endif
                            
                            @if($team->disenador)
                                <div class="member-item filled">
                                    <span class="role-badge">DISEÑADOR</span>
                                    <span class="member-name">{{ $team->disenador->name }}</span>
                                </div>
                            @else
                                <div class="member-item available">
                                    <span class="role-badge">DISEÑADOR</span>
                                    <span class="member-name">Disponible</span>
                                </div>
                            @endif
                            
                            @if($team->frontprog)
                                <div class="member-item filled">
                                    <span class="role-badge">PROG. FRONT</span>
                                    <span class="member-name">{{ $team->frontprog->name }}</span>
                                </div>
                            @else
                                <div class="member-item available">
                                    <span class="role-badge">PROG. FRONT</span>
                                    <span class="member-name">Disponible</span>
                                </div>
                            @endif
                            
                            @if($team->backprog)
                                <div class="member-item filled">
                                    <span class="role-badge">PROG. BACK</span>
                                    <span class="member-name">{{ $team->backprog->name }}</span>
                                </div>
                            @else
                                <div class="member-item available">
                                    <span class="role-badge">PROG. BACK</span>
                                    <span class="member-name">Disponible</span>
                                </div>
                            @endif
                        </div>

                        <div class="team-status">
                            <span class="status-badge {{ $team->estado ? 'status-active' : 'status-inactive' }}">
                                {{ $team->estado ? '✓ Activo' : '✕ Inactivo' }}
                            </span>
                            
                            @if($team->estaCompleto())
                                <span class="team-complete">✓ Completo</span>
                            @endif
                        </div>

                        <a href="{{ route('teams.show', $team) }}" class="view-btn">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <h2>No hay equipos disponibles</h2>
                    <p>Sé el primero en crear un equipo increíble</p>
                </div>
            @endforelse
        </div>

        @if($teams->hasPages())
            <div class="pagination">
                {{ $teams->links() }}
            </div>
        @endif
    </div>
</body>
</x-app-layout>