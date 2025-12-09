<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Crear Equipo</title>
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

        .info-box {
            background: rgba(33, 150, 243, 0.2);
            border: 1px solid rgba(33, 150, 243, 0.5);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
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
<x-app-layout>
    <div class="container">
        <a href="{{ route('teams.index') }}" class="back-link">
            ← Volver a equipos
        </a>

        <h1>Crear Nuevo Equipo</h1>

        <div class="form-card">
            <div class="info-box">
                <p>📋 <strong>Importante:</strong></p>
                <p>• Serás asignado automáticamente como LIDER de equipo</p>
                <p>• El código del equipo se generará automáticamente</p>
                <p>• Otros usuarios podrán unirse usando el código</p>
            </div>

            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">
                            Nombre del Equipo <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nombre" 
                            class="form-input" 
                            placeholder="Ingrese el nombre del equipo"
                            value="{{ old('nombre') }}"
                            required
                        >
                        @error('nombre')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Descripción</label>
                        <textarea 
                            name="descripcion" 
                            class="form-textarea"
                            placeholder="Describe tu equipo, objetivos, habilidades requeridas..."
                        >{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Icono del Equipo</label>
                        <div class="file-input-wrapper">
                            <input 
                                type="file" 
                                name="icono" 
                                id="icono"
                                accept="image/*"
                                onchange="displayFileName(this)"
                            >
                            <label for="icono" class="file-input-label">
                                📁 Seleccionar imagen
                            </label>
                        </div>
                        <div class="file-name" id="file-name"></div>
                        @error('icono')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Evento (Opcional)</label>
                        <select name="evento_id" class="form-select">
                            <option value="">Sin evento asignado</option>
                            @foreach($eventos as $evento)
                                <option value="{{ $evento->id }}" {{ old('evento_id') == $evento->id ? 'selected' : '' }}>
                                    {{ $evento->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('evento_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">✓ Crear Equipo</button>
                    <a href="{{ route('teams.index') }}" class="btn btn-secondary">✕ Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileNameDisplay = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = '📄 ' + input.files[0].name;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>

</x-app-layout>