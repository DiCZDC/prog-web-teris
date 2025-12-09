
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
        max-width: 1200px;
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

    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 30px;
    }

    .card {
        background: rgba(0, 0, 0, 0.4);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #a855f7; /* antes: #ffd700 */
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
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

    .form-select, .form-textarea {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        color: white;
        font-size: 16px;
        outline: none;
        transition: all 0.3s;
    }

    .form-select:focus, .form-textarea:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: #a855f7; /* antes: #ffd700 */
    }

    .form-select option {
        background: #4a148c;
        color: white;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    .error-message {
        color: #ff6b6b;
        font-size: 13px;
        margin-top: 5px;
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
        width: 100%;
    }

    .btn-primary {
        background: rgba(168, 85, 247, 0.3); /* antes: rgba(255, 215, 0, 0.3) */
        border: 2px solid #a855f7;          /* antes: #ffd700 */
        color: #a855f7;                     /* antes: #ffd700 */
    }

    .btn-primary:hover {
        background: rgba(168, 85, 247, 0.5); /* antes: rgba(255, 215, 0, 0.5) */
        transform: translateY(-2px);
    }

    .invitations-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .invitation-item {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .invitation-info {
        flex: 1;
    }

    .invitation-user {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .invitation-rol {
        background: rgba(168, 85, 247, 0.3); /* antes: rgba(255, 215, 0, 0.3) */
        border: 1px solid #a855f7;           /* antes: #ffd700 */
        padding: 3px 10px;
        border-radius: 5px;
        font-size: 12px;
        color: #a855f7;                      /* antes: #ffd700 */
        display: inline-block;
        margin-right: 10px;
    }

    .invitation-date {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    .btn-cancel {
        background: rgba(244, 67, 54, 0.3);
        border: 2px solid #f44336;
        color: #f44336;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: rgba(244, 67, 54, 0.5);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: rgba(255, 255, 255, 0.6);
    }

    .empty-icon {
        font-size: 60px;
        margin-bottom: 15px;
    }

    @media (max-width: 968px) {
        .two-columns {
            grid-template-columns: 1fr;
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

    <h1>
        Invitar Miembros
    </h1>

    <p class="subtitle">Equipo: {{ $team->nombre }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif


    <div class="two-columns">

        <!-- ================= FORMULARIO INVITAR ================= -->
        <div class="card">
            <h2 class="card-title">
                <!-- ícono "+" -->
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                    style="vertical-align: middle; margin-right: 6px;">
                    <path d="M12 5v14M5 12h14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Nueva Invitación
            </h2>

            <form action="{{ route('teams.send-invitation', $team) }}" method="POST">
                @csrf

                <!-- IDENTIFICADOR -->
                <div class="form-group">
                    <label class="form-label">Nombre o Email del Usuario <span class="required">*</span></label>
                    <input 
                        type="text" 
                        name="user_identifier" 
                        class="form-select" 
                        placeholder="Escribe el nombre o email del usuario"
                        value="{{ old('user_identifier') }}"
                        required
                    >

                    <span style="font-size: 13px; color: rgba(255,255,255,0.6); display: block; margin-top: 6px;">
                        <!-- Ícono de bombilla -->
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                            style="vertical-align: middle; margin-right: 4px;">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 8v4M10 16h4" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Escribe el nombre completo o email del usuario que quieres invitar
                    </span>

                    @error('user_identifier')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    @error('user_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ROL -->
                <div class="form-group">
                    <label class="form-label">Rol <span class="required">*</span></label>
                    <select name="rol" class="form-select" required>
                        <option value="">Selecciona un rol</option>
                        @foreach($team->posicionesDisponibles() as $rol)
                            <option value="{{ $rol }}" {{ old('rol') == $rol ? 'selected' : '' }}>{{ $rol }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- MENSAJE -->
                <div class="form-group">
                    <label class="form-label">Mensaje (opcional)</label>
                    <textarea name="mensaje" class="form-textarea"
                        placeholder="Escribe un mensaje personalizado para el usuario..."
                    >{{ old('mensaje') }}</textarea>
                    @error('mensaje')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- BOTÓN DE ENVIAR -->
                <button type="submit" class="btn btn-primary">
                    Enviar Invitación
                </button>

            </form>
        </div>


        <!-- ================= INVITACIONES PENDIENTES ================= -->
        <div class="card">
            <h2 class="card-title">
                Invitaciones Pendientes
            </h2>

            @if($invitacionesPendientes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon" style="display:flex; justify-content:center;">
                        <!-- Ícono de bandeja vacía -->
                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none">
                            <path d="M4 4h16l2 10h-6l-2 3h-4l-2-3H2L4 4z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p>No hay invitaciones pendientes</p>
                </div>
            @else
                <div class="invitations-list">

                    @foreach($invitacionesPendientes as $invitacion)
                        <div class="invitation-item">

                            <div class="invitation-info">
                                <div class="invitation-user">{{ $invitacion->invitado->name }}</div>
                                <span class="invitation-rol">{{ $invitacion->rol }}</span>
                                <div class="invitation-date">
                                    Enviada: {{ $invitacion->created_at->diffForHumans() }}
                                </div>

                                @if($invitacion->mensaje)
                                    <div style="font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 5px;">
                                        <!-- Ícono mensaje -->
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            style="vertical-align: middle; margin-right: 4px;">
                                            <path d="M4 4h16v12H7l-3 3V4z"
                                                stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        {{ Str::limit($invitacion->mensaje, 50) }}
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('invitations.cancel', $invitacion) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-cancel" onclick="return confirm('¿Cancelar esta invitación?')">
                                    <!-- Ícono cancelar -->
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        style="vertical-align: middle; margin-right: 4px;">
                                        <path d="M6 6l12 12M18 6L6 18"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    Cancelar
                                </button>
                            </form>

                        </div>
                    @endforeach

                </div>
            @endif
        </div>

    </div>
</div>
</x-app-layout>
