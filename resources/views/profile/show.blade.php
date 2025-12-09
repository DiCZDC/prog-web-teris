@extends('layouts.app')

@section('title', 'TERIS - Mi Perfil')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Fondo con overlay para mejor contraste */
    .profile-bg {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(rgba(74, 20, 140, 0.85), rgba(106, 27, 154, 0.9)),
                    url('https://images.pexels.com/photos/249798/pexels-photo-249798.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 20px;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        padding: 20px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.25);
        border-radius: 12px;
        color: white;
        text-decoration: none;
        margin-bottom: 30px;
        transition: all 0.3s;
        backdrop-filter: blur(10px);
        font-weight: 600;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(-5px);
        border-color: #ffd700;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3);
    }

    /* Tarjeta principal del perfil */
    .profile-header {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        backdrop-filter: blur(15px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    /* Efecto de brillo sutil */
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 40px;
        position: relative;
        z-index: 1;
    }

    .profile-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffd700, #ffed4e, #ffd700);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 70px;
        font-weight: bold;
        color: #4a148c;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .profile-avatar::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .profile-details h1 {
        font-size: 42px;
        margin-bottom: 15px;
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-details p {
        font-size: 18px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.9);
    }

    .profile-details p::before {
        content: '•';
        color: #ffd700;
        font-size: 24px;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
        margin-top: 40px;
        position: relative;
        z-index: 1;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        backdrop-filter: blur(10px);
        transition: all 0.4s;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.1);
        border-color: #ffd700;
        box-shadow: 0 15px 30px rgba(255, 215, 0, 0.2);
    }

    .stat-number {
        font-size: 48px;
        font-weight: bold;
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .profile-sections {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 35px;
        margin-top: 20px;
    }

    .section-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 35px;
        backdrop-filter: blur(15px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        transition: all 0.4s;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .section-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border-color: rgba(255, 215, 0, 0.3);
    }

    .section-title {
        font-size: 26px;
        margin-bottom: 25px;
        color: #ffd700;
        border-bottom: 2px solid rgba(255, 215, 0, 0.3);
        padding-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '✦';
        font-size: 20px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 12px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
    }

    .form-input {
        width: 100%;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.08);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: white;
        font-size: 16px;
        transition: all 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #ffd700;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
    }

    .btn {
        padding: 15px 35px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        border: none;
        border-radius: 12px;
        color: #4a148c;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        background: linear-gradient(135deg, #ffed4e, #ffd700);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d);
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #e4606d, #dc3545);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
    }

    .action-buttons {
        display: flex;
        gap: 20px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .message {
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 2px solid;
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

    .message-success {
        background: rgba(40, 167, 69, 0.15);
        border-color: rgba(40, 167, 69, 0.4);
        color: #a3e9b4;
    }

    .message-error {
        background: rgba(220, 53, 69, 0.15);
        border-color: rgba(220, 53, 69, 0.4);
        color: #f5c6cb;
    }

    /* Efectos de partículas para fondo */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .particle {
        position: absolute;
        background: rgba(255, 215, 0, 0.1);
        border-radius: 50%;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% {
            transform: translateY(100vh) rotate(0deg);
        }
        100% {
            transform: translateY(-100vh) rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .profile-info {
            flex-direction: column;
            text-align: center;
            gap: 25px;
        }
        
        .profile-sections {
            grid-template-columns: 1fr;
            gap: 25px;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            font-size: 60px;
        }
        
        .profile-details h1 {
            font-size: 32px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Estilos para checkboxes personalizados */
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        transition: all 0.3s;
    }

    .checkbox-item:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .checkbox-item input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #ffd700;
    }

    .checkbox-item label {
        color: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        flex-grow: 1;
    }

    /* Tooltip para íconos */
    .tooltip {
        position: relative;
        display: inline-flex;
        align-items: center;
        margin-left: 8px;
    }

    .tooltip-icon {
        width: 18px;
        height: 18px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: help;
    }

    .tooltip-text {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        margin-bottom: 8px;
    }

    .tooltip:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
    }
</style>
@endpush

@section('content')
<div class="profile-bg">
    <!-- Efecto de partículas en el fondo -->
    <div class="particles" id="particles"></div>
    
    <div class="profile-container">
        <a href="{{ route('home') }}" class="back-btn">
            ← Volver al Inicio
        </a>

        @if(session('success'))
            <div class="message message-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="message message-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="message message-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-header">
            <div class="profile-info">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="profile-details">
                    <h1>{{ auth()->user()->name }}</h1>
                    <p>{{ auth()->user()->email }}</p>
                    <p>Miembro desde: {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    <p>Rol: {{ auth()->user()->hasRole('admin') ? 'Administrador' : 'Usuario' }}</p>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Eventos Inscritos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Equipos Activos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Proyectos Creados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Puntos Acumulados</div>
                </div>
            </div>
        </div>

        <div class="profile-sections">
            <!-- Sección para editar información del perfil -->
            <div class="section-card">
                <h2 class="section-title">Editar Información Personal</h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input" required>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn">
                            <span>Actualizar Perfil</span>
                        </button>
                        <a href="{{ route('profile.edit-password') }}" class="btn btn-secondary">
                            <span>Cambiar Contraseña</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Sección para cambiar contraseña -->
            <div class="section-card">
                <h2 class="section-title">Cambiar Contraseña</h2>
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Contraseña Actual</label>
                        <input type="password" name="current_password" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-input" required>
                        <small style="color: rgba(255,255,255,0.6); display: block; margin-top: 5px;">
                            Mínimo 8 caracteres
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-input" required>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn">
                            <span>Actualizar Contraseña</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sección de configuración avanzada -->
            <div class="section-card">
                <h2 class="section-title">Configuración Avanzada</h2>
                
                <div class="form-group">
                    <label class="form-label">Preferencias de Notificación</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="notify-email" checked>
                            <label for="notify-email">Notificaciones por Email</label>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="tooltip-text">Recibir notificaciones por correo electrónico</span>
                            </div>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="notify-events" checked>
                            <label for="notify-events">Recordatorios de Eventos</label>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="tooltip-text">Recordatorios antes de eventos importantes</span>
                            </div>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="notify-team">
                            <label for="notify-team">Actualizaciones de Equipo</label>
                            <div class="tooltip">
                                <span class="tooltip-icon">?</span>
                                <span class="tooltip-text">Notificaciones sobre actividades del equipo</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary">Guardar Preferencias</button>
                </div>
            </div>

            <!-- Sección de eliminación de cuenta -->
            <div class="section-card">
                <h2 class="section-title" style="color: #ff6b6b;">Zona de Peligro</h2>
                <p style="margin-bottom: 20px; opacity: 0.8; line-height: 1.6;">
                    Una vez que elimines tu cuenta, no podrás recuperarla. Todos tus datos, eventos, equipos y proyectos serán eliminados permanentemente.
                </p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    
                    <div class="form-group">
                        <label class="form-label">Ingresa tu contraseña para confirmar</label>
                        <input type="password" name="password" class="form-input" required placeholder="Tu contraseña actual">
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn btn-danger" id="deleteBtn">
                            <span>Eliminar Mi Cuenta Permanentemente</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efecto de partículas en el fondo
        const particlesContainer = document.getElementById('particles');
        if (particlesContainer) {
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = Math.random() * 20 + 10 + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.opacity = Math.random() * 0.3 + 0.1;
                particlesContainer.appendChild(particle);
            }
        }

        // Mostrar mensajes de éxito/error con animación
        const messages = document.querySelectorAll('.message');
        messages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transform = 'translateY(-20px)';
                message.style.transition = 'all 0.5s ease-in-out';
                setTimeout(() => message.remove(), 500);
            }, 5000);
        });

        // Validación de formularios mejorada
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const inputs = this.querySelectorAll('[required]');
                let valid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        valid = false;
                        input.style.borderColor = '#ff6b6b';
                        input.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.2)';
                        
                        // Agregar mensaje de error
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                            const errorMsg = document.createElement('small');
                            errorMsg.className = 'error-message';
                            errorMsg.style.color = '#ff6b6b';
                            errorMsg.style.display = 'block';
                            errorMsg.style.marginTop = '5px';
                            errorMsg.textContent = 'Este campo es requerido';
                            input.parentNode.appendChild(errorMsg);
                        }
                    } else {
                        input.style.borderColor = '';
                        input.style.boxShadow = '';
                        
                        // Remover mensaje de error si existe
                        const errorMsg = input.parentNode.querySelector('.error-message');
                        if (errorMsg) {
                            errorMsg.remove();
                        }
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                }
            });
        });

        // Confirmación especial para eliminar cuenta
        const deleteForm = document.getElementById('deleteForm');
        const deleteBtn = document.getElementById('deleteBtn');
        
        if (deleteForm && deleteBtn) {
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: '¿Estás completamente seguro?',
                    html: `
                        <div style="text-align: left; margin: 15px 0;">
                            <p style="color: #ff6b6b; margin-bottom: 10px;">⚠️ Esta acción NO se puede deshacer</p>
                            <ul style="color: rgba(255,255,255,0.8); font-size: 14px;">
                                <li>Tu cuenta será eliminada permanentemente</li>
                                <li>Todos tus datos se perderán</li>
                                <li>No podrás recuperar eventos o equipos</li>
                            </ul>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar cuenta',
                    cancelButtonText: 'Cancelar',
                    background: 'rgba(74, 20, 140, 0.9)',
                    color: 'white',
                    backdrop: 'rgba(0,0,0,0.7)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mostrar confirmación final
                        Swal.fire({
                            title: 'Ingresa "ELIMINAR" para confirmar',
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Confirmar eliminación',
                            showLoaderOnConfirm: true,
                            preConfirm: (input) => {
                                if (input !== 'ELIMINAR') {
                                    Swal.showValidationMessage('Debes escribir exactamente: ELIMINAR');
                                }
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((finalResult) => {
                            if (finalResult.isConfirmed) {
                                deleteForm.submit();
                            }
                        });
                    }
                });
            });
        }

        // Animación para las tarjetas de estadísticas
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = (index * 0.1) + 's';
        });

        // Efecto de hover para inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
@endsection