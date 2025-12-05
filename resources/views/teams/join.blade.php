<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Unirse a Equipo</title>
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

        .container {
            max-width: 700px;
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

        .alert-error {
            background: rgba(244, 67, 54, 0.3);
            border: 1px solid rgba(244, 67, 54, 0.5);
        }

        .alert-warning {
            background: rgba(255, 152, 0, 0.3);
            border: 1px solid rgba(255, 152, 0, 0.5);
        }

        .form-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .info-box {
            background: rgba(33, 150, 243, 0.2);
            border: 1px solid rgba(33, 150, 243, 0.5);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .info-box h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #64B5F6;
        }

        .info-box p {
            margin: 8px 0;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
        }

        .current-team-box {
            background: rgba(255, 152, 0, 0.2);
            border: 2px solid rgba(255, 152, 0, 0.5);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .current-team-box h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #FFB74D;
        }

        .current-team-box p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            margin: 5px 0;
        }

        .current-team-name {
            font-size: 28px;
            font-weight: bold;
            color: #ffd700;
            margin: 15px 0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
        }

        .required {
            color: #ff6b6b;
        }

        .form-input, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 15px 20px;
            color: white;
            font-size: 18px;
            width: 100%;
            outline: none;
            transition: all 0.3s;
            text-align: center;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .form-input:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffd700;
            transform: scale(1.02);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: normal;
        }

        .form-select {
            cursor: pointer;
        }

        .form-select option {
            background: #4a148c;
            color: white;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 8px;
            display: block;
        }

        .help-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 8px;
            font-style: italic;
        }

        .role-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .role-option {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .role-option:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffd700;
        }

        .role-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .role-option input[type="radio"]:checked + label {
            color: #ffd700;
        }

        .role-option input[type="radio"]:checked ~ .role-label {
            border-color: #ffd700;
            background: rgba(255, 215, 0, 0.2);
        }

        .role-label {
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .role-icon {
            font-size: 32px;
        }

        .role-info {
            flex: 1;
        }

        .role-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .role-description {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 18px;
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
                    <a href="{{ route('teams.create') }}">Crear equipo</a>
                    <a href="{{ route('teams.join') }}">Unir a equipo</a>
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
        </ul>
    </nav>

    <div class="container">
        <a href="{{ route('teams.index') }}" class="back-link">
            ← Volver a equipos
        </a>

        <h1>Unirse a un Equipo</h1>
        <p class="subtitle">🤝 Conéctate con otros y forma parte de un equipo increíble</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($equipoActual)
            <div class="current-team-box">
                <h3>⚠️ Ya eres miembro de un equipo</h3>
                <div class="current-team-name">{{ $equipoActual->nombre }}</div>
                <p>Código: <strong>{{ $equipoActual->codigo }}</strong></p>
                <p style="margin-top: 15px;">Debes salir de tu equipo actual antes de unirte a otro.</p>
                <div style="margin-top: 20px;">
                    <a href="{{ route('teams.show', $equipoActual) }}" class="btn btn-primary">Ver Mi Equipo</a>
                </div>
            </div>
        @else
            <div class="info-box">
                <h3>📌 Cómo unirse a un equipo:</h3>
                <p>1️⃣ Solicita el código del equipo a su líder</p>
                <p>2️⃣ Ingresa el código en el campo de abajo</p>
                <p>3️⃣ Selecciona el rol que deseas desempeñar</p>
                <p>4️⃣ ¡Únete y comienza a colaborar!</p>
            </div>

            <div class="form-card">
                <form action="{{ route('teams.join.process') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">
                            Código del Equipo <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="codigo" 
                            class="form-input" 
                            placeholder="Ej: ABC123"
                            value="{{ old('codigo') }}"
                            required
                            maxlength="10"
                            style="text-transform: uppercase;"
                        >
                        <span class="help-text">Ingresa el código de 6 caracteres que te proporcionó el líder del equipo</span>
                        @error('codigo')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Selecciona tu Rol <span class="required">*</span>
                        </label>
                        
                        <div class="role-options">
                            <div class="role-option">
                                <input type="radio" name="rol" value="DISEÑADOR" id="disenador" required {{ old('rol') == 'DISEÑADOR' ? 'checked' : '' }}>
                                <label for="disenador" class="role-label">
                                    <div class="role-icon">🎨</div>
                                    <div class="role-info">
                                        <div class="role-name">DISEÑADOR</div>
                                        <div class="role-description">Responsable del diseño visual, UX/UI y branding del proyecto</div>
                                    </div>
                                </label>
                            </div>

                            <div class="role-option">
                                <input type="radio" name="rol" value="PROGRAMADOR FRONT" id="frontprog" required {{ old('rol') == 'PROGRAMADOR FRONT' ? 'checked' : '' }}>
                                <label for="frontprog" class="role-label">
                                    <div class="role-icon">💻</div>
                                    <div class="role-info">
                                        <div class="role-name">PROGRAMADOR FRONTEND</div>
                                        <div class="role-description">Desarrollo de interfaces de usuario y experiencia del cliente</div>
                                    </div>
                                </label>
                            </div>

                            <div class="role-option">
                                <input type="radio" name="rol" value="PROGRAMADOR BACK" id="backprog" required {{ old('rol') == 'PROGRAMADOR BACK' ? 'checked' : '' }}>
                                <label for="backprog" class="role-label">
                                    <div class="role-icon">⚙️</div>
                                    <div class="role-info">
                                        <div class="role-name">PROGRAMADOR BACKEND</div>
                                        <div class="role-description">Desarrollo del servidor, bases de datos y lógica de negocio</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        @error('rol')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary">🚀 Unirse al Equipo</button>
                        <a href="{{ route('teams.index') }}" class="btn btn-secondary">✕ Cancelar</a>
                    </div>
                </form>
            </div>
        @endif
    </div>
</body>
</html>