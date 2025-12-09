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
        border-color: #a855f7; /* reemplazo */
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
        border-color: #a855f7; /* reemplazo */
    }

    .role-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .role-option input[type="radio"]:checked + label {
        color: #a855f7; /* reemplazo */
    }

    .role-option input[type="radio"]:checked ~ .role-label {
        border-color: #a855f7; /* reemplazo */
        background: rgba(168, 85, 247, 0.2); /* reemplazo */
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
        background: rgba(168, 85, 247, 0.3); /* reemplazo */
        border: 2px solid #a855f7;          /* reemplazo */
        color: #a855f7;                     /* reemplazo */
    }

    .btn-primary:hover {
        background: rgba(168, 85, 247, 0.5); /* reemplazo */
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
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                style="vertical-align: middle; margin-right: 6px; display: inline-block;">
                <path d="M15 18l-6-6 6-6" 
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Regresar
        </a>

        <h1>Unirse a un Equipo</h1>
        <p class="subtitle">Conéctate con otros y forma parte de un equipo increíble</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="info-box">
            <h3 style="display: flex; align-items: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                    style="vertical-align: middle; margin-right: 6px;">
                    <path d="M12 2l4 7h6l-5 4 2 7-7-4-7 4 2-7-5-4h6l4-7z"
                        stroke="currentColor" stroke-width="2"
                        stroke-linejoin="round" fill="none"/>
                </svg>
                Cómo unirse a un equipo:
            </h3>

            <p>
                <span style="font-weight: bold; margin-right: 8px;">•</span>
                Solicita el código del equipo a su líder
            </p>

            <p>
                <span style="font-weight: bold; margin-right: 8px;">•</span>
                Ingresa el código en el campo de abajo
            </p>

            <p>
                <span style="font-weight: bold; margin-right: 8px;">•</span>
                Selecciona el rol que deseas desempeñar
            </p>

            <p>
                <span style="font-weight: bold; margin-right: 8px;">•</span>
                ¡Únete y comienza a colaborar!
            </p>

            <p style="margin-top: 15px; color: #ffd700;">
                <strong>Puedes unirte a múltiples equipos en diferentes roles</strong>
            </p>
        </div>


        <div class="form-card">
            <form action="{{ route('teams.join.send') }}" method="POST">
                @csrf

                <!-- CÓDIGO DEL EQUIPO -->
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

                <!-- SELECCIONAR ROL -->
                <div class="form-group">
                    <label class="form-label">
                        Selecciona tu Rol <span class="required">*</span>
                    </label>

                    <div class="role-options">

                        <!-- DISEÑADOR -->
                        <div class="role-option">
                            <input type="radio" name="rol" value="DISEÑADOR" id="disenador"
                                required {{ old('rol') == 'DISEÑADOR' ? 'checked' : '' }}>
                            
                            <label for="disenador" class="role-label">
                                <div class="role-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M3 17l6-6m0 0l4 4m-4-4l6-6 4 4-6 6"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <div class="role-info">
                                    <div class="role-name">DISEÑADOR</div>
                                    <div class="role-description">Responsable del diseño visual, UX/UI y branding</div>
                                </div>
                            </label>
                        </div>

                        <!-- FRONTEND -->
                        <div class="role-option">
                            <input type="radio" name="rol" value="PROGRAMADOR FRONT" id="frontprog"
                                required {{ old('rol') == 'PROGRAMADOR FRONT' ? 'checked' : '' }}>

                            <label for="frontprog" class="role-label">
                                <div class="role-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 5h16v14H4V5z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M9 9l-3 3 3 3m6-6l3 3-3 3"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <div class="role-info">
                                    <div class="role-name">PROGRAMADOR FRONTEND</div>
                                    <div class="role-description">Desarrollo de interfaces y experiencia del usuario</div>
                                </div>
                            </label>
                        </div>

                        <!-- BACKEND -->
                        <div class="role-option">
                            <input type="radio" name="rol" value="PROGRAMADOR BACK" id="backprog"
                                required {{ old('rol') == 'PROGRAMADOR BACK' ? 'checked' : '' }}>

                            <label for="backprog" class="role-label">
                                <div class="role-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="3"
                                                stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 5v2M12 17v2M5 12h2M17 12h2
                                                 M7 7l1.5 1.5M15.5 15.5L17 17
                                                 M7 17l1.5-1.5M15.5 8.5L17 7"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <div class="role-info">
                                    <div class="role-name">PROGRAMADOR BACKEND</div>
                                    <div class="role-description">Lógica del servidor y bases de datos</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    @error('rol')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- BOTONES -->
                <div class="action-buttons">

                    <button type="submit" class="btn btn-primary">
                        Enviar solicitud
                    </button>

                    <a href="{{ route('teams.index') }}" class="btn btn-secondary">
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
</x-app-layout>
