<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Editar Equipo</title>
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
            max-width: 900px;
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

        .form-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .current-icon {
            text-align: center;
            margin-bottom: 30px;
        }

        .current-icon img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .current-icon-placeholder {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 50%, #6c5b7b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
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

        .required {
            color: #ff6b6b;
        }

        .form-input, .form-select, .form-textarea {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 12px 15px;
            color: white;
            font-size: 16px;
            outline: none;
            transition: all 0.3s;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffd700;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-select {
            cursor: pointer;
        }

        .form-select option {
            background: #4a148c;
            color: white;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 16px;
            cursor: pointer;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px dashed rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-input-label:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffd700;
        }

        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
        }

        .info-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 5px;
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

    <h1>Editar Equipo</h1>

    <div class="form-card">

        {{-- ICONO ACTUAL O PLACEHOLDER --}}
        @if($team->icono)
            <div class="current-icon">
                <img src="{{ asset('storage/' . $team->icono) }}" alt="{{ $team->nombre }}">
                <p style="margin-top: 10px; font-size: 14px; color: rgba(255,255,255,0.7);">Icono actual</p>
            </div>
        @else
            <div class="current-icon">
                <div class="current-icon-placeholder">
                    <!-- SVG PERSONA / EQUIPO -->
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2"/>
                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6"
                              stroke="currentColor" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>
                </div>
                <p style="margin-top: 10px; font-size: 14px; color: rgba(255,255,255,0.7);">Sin icono personalizado</p>
            </div>
        @endif


        <form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- NOMBRE --}}
                <div class="form-group">
                    <label class="form-label">
                        Nombre del Equipo <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nombre" 
                        class="form-input" 
                        placeholder="Ingrese el nombre del equipo"
                        value="{{ old('nombre', $team->nombre) }}"
                        required
                    >
                    @error('nombre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- CÓDIGO --}}
                <div class="form-group">
                    <label class="form-label">Código</label>
                    <input 
                        type="text" 
                        class="form-input" 
                        value="{{ $team->codigo }}"
                        disabled
                    >
                    <span class="info-text">El código no se puede modificar</span>
                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="form-group full-width">
                    <label class="form-label">Descripción</label>
                    <textarea 
                        name="descripcion" 
                        class="form-textarea"
                        placeholder="Describe tu equipo, objetivos, habilidades requeridas..."
                    >{{ old('descripcion', $team->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- SUBIR ICONO --}}
                <div class="form-group">
                    <label class="form-label">Cambiar Icono del Equipo</label>

                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            name="icono" 
                            id="icono"
                            accept="image/*"
                            onchange="displayFileName(this)"
                        >
                        <label for="icono" class="file-input-label">
                            <!-- ÍCONO DE CARPETA -->
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                style="vertical-align: middle; margin-right: 6px;">
                                <path d="M3 6h6l2 2h10v10H3V6z"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round"/>
                            </svg>
                            Seleccionar nueva imagen
                        </label>
                    </div>

                    <div class="file-name" id="file-name"></div>

                    @error('icono')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- EVENTO --}}
                <div class="form-group">
                    <label class="form-label">Evento</label>
                    <select name="evento_id" class="form-select">
                        <option value="">Sin evento asignado</option>
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}" 
                                {{ old('evento_id', $team->evento_id) == $evento->id ? 'selected' : '' }}>
                                {{ $evento->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('evento_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- ESTADO --}}
                <div class="form-group full-width">
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            name="estado" 
                            id="estado" 
                            value="1"
                            {{ old('estado', $team->estado) ? 'checked' : '' }}
                        >
                        <label for="estado">Equipo activo</label>
                    </div>
                    <span class="info-text">Si desmarcas esta opción, el equipo aparecerá como inactivo</span>
                </div>
            </div>

            {{-- BOTONES --}}
            <div class="action-buttons">

                {{-- GUARDAR --}}
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                        style="vertical-align: middle; margin-right: 6px;">
                        <path d="M5 3h14l2 2v14H3V3h2zm0 4h14M9 3v4m6-4v4"
                              stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Guardar Cambios
                </button>

                {{-- CANCELAR --}}
                <a href="{{ route('teams.show', $team) }}" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                        style="vertical-align: middle; margin-right: 6px;">
                        <path d="M6 6l12 12M18 6L6 18"
                              stroke="currentColor" stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>
                    Cancelar
                </a>

            </div>
        </form>
    </div>
</div>

<script>
    function displayFileName(input) {
        const fileNameDisplay = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            fileNameDisplay.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                    style="vertical-align: middle; margin-right: 6px;">
                    <path d="M4 4h14v16H4z" stroke="currentColor" stroke-width="2"/>
                    <path d="M4 8h14" stroke="currentColor" stroke-width="2"/>
                </svg>
                ${input.files[0].name}
            `;
        } else {
            fileNameDisplay.textContent = '';
        }
    }
</script>

</body>
</x-app-layout>
