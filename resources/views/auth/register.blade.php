<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Registrarse</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #4a148c 0%, #6a1b9a 50%, #8e24aa 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        .tetris-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(20, 1fr);
            grid-template-rows: repeat(15, 1fr);
            opacity: 0.3;
            pointer-events: none;
        }

        .block {
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeBlock 3s infinite;
        }

        @keyframes fadeBlock {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.5; }
        }

        .block:nth-child(3n) { background: rgba(255, 0, 100, 0.3); }
        .block:nth-child(3n+1) { background: rgba(0, 100, 255, 0.3); }
        .block:nth-child(3n+2) { background: rgba(255, 215, 0, 0.3); }

        .container {
            position: relative;
            z-index: 10;
            width: 90%;
            max-width: 600px;
        }

        .welcome-title {
            text-align: center;
            color: white;
            font-size: 42px;
            font-weight: bold;
            letter-spacing: 6px;
            margin-bottom: 30px;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
        }

        .register-box {
            background: rgba(139, 0, 139, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        .logo-blocks {
            display: grid;
            grid-template-columns: repeat(2, 25px);
            gap: 3px;
        }

        .logo-block {
            width: 25px;
            height: 25px;
            border-radius: 4px;
        }

        .logo-block:nth-child(1) { background: #ff0080; }
        .logo-block:nth-child(2) { background: #8b00ff; }
        .logo-block:nth-child(3) { background: #0080ff; }
        .logo-block:nth-child(4) { background: #ffd700; }

        .logo-text {
            font-size: 32px;
            font-weight: bold;
            color: white;
            letter-spacing: 3px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: white;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 16px;
            outline: none;
            transition: all 0.3s;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffd700;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 20px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .toggle-password:hover {
            opacity: 1;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff0080, #ff00ff);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(255, 0, 128, 0.4);
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255, 0, 128, 0.6);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-link a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #ffd700;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.3);
            border: 1px solid rgba(255, 0, 0, 0.5);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: #ffcccc;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .welcome-title {
                font-size: 28px;
                letter-spacing: 3px;
            }

            .register-box {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="tetris-bg">
        @for($i = 0; $i < 300; $i++)
            <div class="block"></div>
        @endfor
    </div>

    <div class="container">
        <h1 class="welcome-title">CREAR CUENTA</h1>

        <div class="register-box">
            <div class="logo">
                <div class="logo-blocks">
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                </div>
                <div class="logo-text">TERIS</div>
            </div>

            @if($errors->any())
                <div class="error-message">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Juan Pérez" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="correo@ejemplo.com" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Mínimo 8 caracteres" 
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            👁️
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Repite tu contraseña" 
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            👁️
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-register">Registrarse</button>

                <div class="login-link">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleBtn = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        window.addEventListener('load', () => {
            const registerBox = document.querySelector('.register-box');
            registerBox.style.opacity = '0';
            registerBox.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                registerBox.style.transition = 'all 0.5s ease';
                registerBox.style.opacity = '1';
                registerBox.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>