<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Mi Perfil</title>
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
            padding: 20px;
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            text-decoration: none;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }

        .profile-header {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            font-weight: bold;
            color: #4a148c;
            border: 5px solid rgba(255, 255, 255, 0.3);
        }

        .profile-details h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .profile-details p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(5px);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.8;
        }

        .profile-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
        }

        .section-card {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.4);
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ffd700;
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 16px;
        }

        .form-input:focus {
            outline: none;
            border-color: #ffd700;
            background: rgba(255, 255, 255, 0.15);
        }

        .btn {
            padding: 12px 30px;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            border: none;
            border-radius: 8px;
            color: #4a148c;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-danger {
            background: rgba(220, 53, 69, 0.8);
            color: white;
        }

        .btn-danger:hover {
            background: rgba(220, 53, 69, 1);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid rgba(40, 167, 69, 0.5);
        }

        .message-error {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.5);
        }

        @media (max-width: 768px) {
            .profile-info {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-sections {
                grid-template-columns: 1fr;
            }
            
            .profile-avatar {
                width: 120px;
                height: 120px;
                font-size: 48px;
            }
            
            .profile-details h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <a href="{{ route('home') }}" class="back-btn">
            ← Volver a Inicio
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
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="profile-details">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->email }}</p>
                    <p>Miembro desde: {{ $user->created_at->format('d/m/Y') }}</p>
                    <p>Rol: {{ $user->hasRole('admin') ? 'Administrador' : 'Usuario' }}</p>
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
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn">Actualizar Perfil</button>
                        <a href="{{ route('profile.edit-password') }}" class="btn btn-secondary">Cambiar Contraseña</a>
                    </div>
                </form>
            </div>

            <!-- Sección para cambiar contraseña -->
            <div class="section-card">
                <h2 class="section-title">Cambiar Contraseña</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Contraseña Actual</label>
                        <input type="password" name="current_password" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-input" required>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn">Actualizar Contraseña</button>
                    </div>
                </form>
            </div>

            <!-- Sección de configuración avanzada -->
            <div class="section-card">
                <h2 class="section-title">Configuración Avanzada</h2>
                
                <div class="form-group">
                    <label class="form-label">Preferencias de Notificación</label>
                    <div style="margin-top: 10px;">
                        <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <input type="checkbox" checked> Notificaciones por Email
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px;">
                            <input type="checkbox" checked> Recordatorios de Eventos
                        </label>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary">Guardar Preferencias</button>
                </div>
            </div>

            <!-- Sección de eliminación de cuenta -->
            <div class="section-card">
                <h2 class="section-title" style="color: #ff6b6b;">Zona de Peligro</h2>
                <p style="margin-bottom: 20px; opacity: 0.8;">
                    Una vez que elimines tu cuenta, no podrás recuperarla. Todos tus datos serán eliminados permanentemente.
                </p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    
                    <div class="form-group">
                        <label class="form-label">Ingresa tu contraseña para confirmar</label>
                        <input type="password" name="password" class="form-input" required placeholder="Tu contraseña actual">
                    </div>

                    <button type="submit" class="btn btn-danger">Eliminar Mi Cuenta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar mensajes de éxito/error
            const messages = document.querySelectorAll('.message');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s';
                    setTimeout(() => message.remove(), 500);
                }, 5000);
            });

            // Validación de formularios
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const inputs = this.querySelectorAll('[required]');
                    let valid = true;
                    
                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            valid = false;
                            input.style.borderColor = '#ff6b6b';
                        } else {
                            input.style.borderColor = '';
                        }
                    });
                    
                    if (!valid) {
                        e.preventDefault();
                        alert('Por favor, completa todos los campos requeridos.');
                    }
                });
            });
        });
    </script>
</body>
</html>