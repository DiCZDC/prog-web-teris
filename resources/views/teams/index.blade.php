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
    {{-- <nav class="navbar">
        <div class="logo">
            <div class="logo-icon"></div>
            <span>TERIS</span>
        </div>

        <ul class="nav-menu">
            <li><a href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ffffff" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg>
                Inicio
            </a></li>
            
            <li class="dropdown">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048"><path fill="#ffffff" d="M1850 688q45 25 82 61t62 80t40 93t14 102h-128q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 91-41 173t-115 136q65 33 117 81t90 108t57 128t20 142h-128q0-79-30-149t-83-122t-122-82t-149-31q-79 0-149 30t-122 83t-82 122t-31 149H512q0-73 20-141t57-128t89-108t118-82q-73-54-114-136t-42-173q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99H0q0-52 14-101t39-93t63-80t82-62q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81q82 45 134 124q54-80 138-126t182-46q97 0 181 46t139 126q52-79 134-124q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81M256 512q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50m768 768q52 0 99-20t81-55t55-81t21-100q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 53 20 99t55 81t81 55t100 21m512-768q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50"/></svg>
                    Equipo
                </a>
                <div class="dropdown-content">
                    <a href="{{ route('teams.index') }}">Ver equipos</a>
                    @auth
                        <a href="{{ route('teams.my-teams') }}">Mis equipos</a>
                        <a href="{{ route('teams.create') }}">Crear equipo</a>
                        <a href="{{ route('teams.join') }}">Unir a equipo</a>
                        
                        
                    @endauth
                </div>
            </li>
            
            <li><a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M14.272 10.445L18 2m-8.684 8.632L5 2m7.762 8.048L8.835 2m5.525 0l-1.04 2.5M6 16a6 6 0 1 0 12 0a6 6 0 0 0-12 0"/><path d="m10.5 15l2-1.5v5"/></g></svg>
                Concursos
            </a></li>
            
            <li><a href="{{ route('events.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ffffff" d="M12 14.154q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192"/></svg>
                Eventos
            </a></li>
            
            @auth
                <li class="user-menu-item">
                    <div class="user-info">
                        <!-- Botón de invitaciones con badge -->
                        <a href="{{ route('teams.my-invitations') }}" style="position: relative; margin-right: 20px; font-size: 24px; text-decoration: none;" title="Mis invitaciones">
                            @php
                                $invitacionesPendientes = Auth::user()->invitacionesPendientes()->count();
                            @endphp
                            @if($invitacionesPendientes > 0)
                                <span class="notification-badge">{{ $invitacionesPendientes }}</span>
                            @endif
                        </a>
                        
                        <span style="color: rgba(255, 255, 255, 0.9);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="display: inline; vertical-align: middle;">
                                <g fill="none" fill-rule="evenodd"><path fill="#ffffff" d="M16 14a5 5 0 0 1 4.995 4.783L21 19v1a2 2 0 0 1-1.85 1.995L19 22H5a2 2 0 0 1-1.995-1.85L3 20v-1a5 5 0 0 1 4.783-4.995L8 14zm0 2H8a3 3 0 0 0-2.995 2.824L5 19v1h14v-1a3 3 0 0 0-2.824-2.995zM12 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></g>
                            </svg>
                            {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">Cerrar sesión</button>
                        </form>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="auth-btn">Iniciar sesión</a>
                </li>
            @endauth
        </ul>
    </nav> --}}
    
    <div class="container">
        <h1>Equipos Disponibles</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @auth
            <div class="action-buttons">
                <a href="{{ route('teams.my-teams') }}" class="btn btn-secondary">🤝 Mis equipos</a>
                <a href="{{ route('teams.create') }}" class="btn btn-primary">➕ Crear Nuevo Equipo</a>
                <a href="{{ route('teams.join') }}" class="btn btn-secondary">🤝 Unirse a un Equipo</a>
                <a href="{{ route('teams.my-invitations') }}" class="btn btn-primary">📬 Mis invitaciones</a>
            </div>
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