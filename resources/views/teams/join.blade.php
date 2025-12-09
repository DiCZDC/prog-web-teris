
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
        }
    </style>

<x-app-layout>
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

        <div class="info-box">
            <h3>📌 Cómo unirse a un equipo:</h3>
            <p>1️⃣ Solicita el código del equipo a su líder</p>
            <p>2️⃣ Ingresa el código en el campo de abajo</p>
            <p>3️⃣ Selecciona el rol que deseas desempeñar</p>
            <p>4️⃣ ¡Únete y comienza a colaborar!</p>
            <p style="margin-top: 15px; color: #ffd700;">💡 <strong>Puedes unirte a múltiples equipos en diferentes roles</strong></p>
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
    </div>
</x-app-layout>
