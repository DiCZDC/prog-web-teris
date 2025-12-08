<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - {{ $team->nombre }}</title>
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
            background: rgba(255, 215, 0, 0.3);
            border: 2px solid #ffd700;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 24px;
            font-weight: bold;
            color: #ffd700;
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
            background: rgba(255, 215, 0, 0.2);
            border: 1px solid #ffd700;
            border-radius: 10px;
            padding: 12px 15px;
            color: #ffd700;
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
            background: rgba(255, 215, 0, 0.3);
            border: 2px solid #ffd700;
            color: #ffd700;
        }

        .btn-primary:hover {
            background: rgba(255, 215, 0, 0.5);
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
</head>
<body>
    <nav class="navbar">
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
                <li>
                    <div class="user-info">
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
    </nav>

    <div class="container">
        <a href="{{ route('teams.index') }}" class="back-link">
            ← Volver a equipos
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
                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary">✏️ Editar Equipo</a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este equipo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Eliminar Equipo</button>
                    </form>
                @elseif($team->esMiembro(Auth::id()))
                    <form action="{{ route('teams.leave', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de salir de este equipo?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">🚪 Salir del Equipo</button>
                    </form>
                @elseif(!$team->estaCompleto())
                    <a href="{{ route('teams.join') }}" class="btn btn-primary">🤝 Unirse a este Equipo</a>
                @endif
                
                <a href="{{ route('teams.index') }}" class="btn btn-secondary">← Volver</a>
            </div>
            @endauth
        </div>
    </div>
</body>
</html>