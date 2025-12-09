<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            padding: 20px;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            margin: auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        /* Panel izquierdo */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            left: -100px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
        }

        .logo-section {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo-blocks {
            display: grid;
            grid-template-columns: repeat(2, 35px);
            gap: 5px;
            margin: 0 auto 25px;
        }

        .logo-block {
            width: 35px;
            height: 35px;
            border-radius: 6px;
        }

        .logo-block:nth-child(1) { background: #ff0080; }
        .logo-block:nth-child(2) { background: #8b00ff; }
        .logo-block:nth-child(3) { background: #0080ff; }
        .logo-block:nth-child(4) { background: #ffd700; }

        .logo-text {
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .left-panel h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .left-panel p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Panel derecho */
        .right-panel {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            gap: 12px;
            color: #764ba2;
        }

        .back-btn svg {
            transition: transform 0.3s;
        }

        .back-btn:hover svg {
            transform: translateX(-3px);
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            color: #333;
            transition: all 0.3s;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        input[type="password"] {
            padding-right: 50px;
        }

        input:focus {
            border-color: #667eea;
            background: #f8f9ff;
        }

        input::placeholder {
            color: #999;
        }

        /* Ocultar el icono de ojo nativo del navegador */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input[type="text"]::-ms-reveal,
        input[type="text"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-reveal,
        input[type="password"]::-webkit-clear-button,
        input[type="text"]::-webkit-reveal,
        input[type="text"]::-webkit-clear-button {
            display: none;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
            padding: 5px;
            display: flex;
            align-items: center;
        }

        .toggle-password:hover {
            opacity: 0.8;
        }

        .toggle-password svg {
            pointer-events: none;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #c33;
            font-size: 14px;
        }

        .error-message ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-message li {
            margin-bottom: 5px;
        }

        .success-message {
            background: #efe;
            border: 1px solid #cfc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #383;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
            }

            .left-panel {
                padding: 40px 30px;
                min-height: 300px;
            }

            .right-panel {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Izquierdo -->
        <div class="left-panel">
            <div class="logo-section">
                <div class="logo-blocks">
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                    <div class="logo-block"></div>
                </div>
                <div class="logo-text">TERIS</div>
                <h2>¡Bienvenido<br>de vuelta!</h2>
                <p>Continúa tu aventura en el mundo de la programación competitiva. Accede a tus eventos y proyectos.</p>
            </div>
        </div>

        <!-- Panel Derecho -->
        <div class="right-panel">
            <a href="/" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>

            <div class="form-header">
                <h1>Iniciar Sesión</h1>
                <p>Ingresa a tu cuenta para continuar</p>
            </div>

            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
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
                            placeholder="Ingresa tu contraseña"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-open">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-closed" style="display: none;">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61M2 2l20 20"/>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-submit">Ingresar</button>

                <div class="register-link">
                    ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.querySelector('.eye-open');
            const eyeClosed = document.querySelector('.eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
</body>
</html>
