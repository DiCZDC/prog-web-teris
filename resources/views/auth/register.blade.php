<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Registrarse</title>
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
            max-width: 1200px;
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

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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

        .terms-text {
            font-size: 13px;
            color: #666;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .terms-text a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        .password-requirements {
            background: #f8f9ff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 10px;
            font-size: 13px;
        }

        .password-requirements h4 {
            color: #667eea;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            margin-bottom: 4px;
        }

        .requirement svg {
            flex-shrink: 0;
        }

        .requirement.valid {
            color: #10b981;
        }

        .requirement.invalid {
            color: #ef4444;
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

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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

            .form-row {
                flex-direction: column;
                gap: 0;
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
                <h2>Únete a la comunidad<br>de programadores</h2>
                <p>Participa en eventos, forma equipos y demuestra tus habilidades en competencias de programación.</p>
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
                <h1>Regístrate</h1>
                <p>Crea tu cuenta para comenzar tu aventura</p>
            </div>

            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Juan"
                            required
                            oninput="validateName(this)"
                        >
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            value="{{ old('apellido') }}"
                            placeholder="Pérez"
                        >
                    </div>
                </div>

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
                            placeholder="Mínimo 8 caracteres"
                            required
                            oninput="validatePassword()"
                            onfocus="showPasswordRequirements()"
                            onblur="hidePasswordRequirements()"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-open-password">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-closed-password" style="display: none;">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61M2 2l20 20"/>
                                </g>
                            </svg>
                        </button>
                    </div>

                    <div class="password-requirements" id="passwordRequirements" style="display: none;">
                        <h4>Requisitos de la contraseña:</h4>
                        <div class="requirement" id="req-length">
                            
                            </svg>
                            <span>- Mínimo 8 caracteres</span>
                        </div>
                        <div class="requirement" id="req-lowercase">
                           
                            <span>- Una letra minúscula (a-z)</span>
                        </div>
                        <div class="requirement" id="req-uppercase">
                            
                            <span>- Una letra mayúscula (A-Z)</span>
                        </div>
                        <div class="requirement" id="req-number">
                           
                            <span>- Un número (0-9)</span>
                        </div>
                        <div class="requirement" id="req-special">
                           
                            <span>- Un carácter especial (@$!%*#?&)</span>
                        </div>
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
                            oninput="validatePasswordMatch()"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-open-confirmation">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="eye-closed-confirmation" style="display: none;">
                                <g fill="none" stroke="#666" stroke-width="2">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61M2 2l20 20"/>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>

                <p class="terms-text">
                    Al continuar aceptas los
                    <a href="#">términos y condiciones</a> y el
                    <a href="#">aviso de privacidad</a>
                </p>

                <button type="submit" class="btn-submit">Crear cuenta</button>

                <div class="login-link">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const wrapper = passwordInput.parentElement;
            const toggleBtn = wrapper.querySelector('.toggle-password');

            let eyeOpen, eyeClosed;
            if (fieldId === 'password') {
                eyeOpen = toggleBtn.querySelector('.eye-open-password');
                eyeClosed = toggleBtn.querySelector('.eye-closed-password');
            } else {
                eyeOpen = toggleBtn.querySelector('.eye-open-confirmation');
                eyeClosed = toggleBtn.querySelector('.eye-closed-confirmation');
            }

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

        function validateName(input) {
            // Permitir solo letras, espacios y caracteres con acentos
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            }
        }

        function showPasswordRequirements() {
            const password = document.getElementById('password').value;
            const requirementsDiv = document.getElementById('passwordRequirements');

            // Solo mostrar si hay texto en el campo
            if (password.length > 0) {
                requirementsDiv.style.display = 'block';
            }
        }

        function hidePasswordRequirements() {
            const requirementsDiv = document.getElementById('passwordRequirements');
            requirementsDiv.style.display = 'none';
        }

        function validatePassword() {
            const password = document.getElementById('password').value;
            const lengthReq = document.getElementById('req-length');
            const lowercaseReq = document.getElementById('req-lowercase');
            const uppercaseReq = document.getElementById('req-uppercase');
            const numberReq = document.getElementById('req-number');
            const specialReq = document.getElementById('req-special');

            // Validar longitud mínima
            if (password.length >= 8) {
                lengthReq.classList.remove('invalid');
                lengthReq.classList.add('valid');
            } else {
                lengthReq.classList.remove('valid');
                lengthReq.classList.add('invalid');
            }

            // Validar letra minúscula
            if (/[a-z]/.test(password)) {
                lowercaseReq.classList.remove('invalid');
                lowercaseReq.classList.add('valid');
            } else {
                lowercaseReq.classList.remove('valid');
                lowercaseReq.classList.add('invalid');
            }

            // Validar letra mayúscula
            if (/[A-Z]/.test(password)) {
                uppercaseReq.classList.remove('invalid');
                uppercaseReq.classList.add('valid');
            } else {
                uppercaseReq.classList.remove('valid');
                uppercaseReq.classList.add('invalid');
            }

            // Validar número
            if (/[0-9]/.test(password)) {
                numberReq.classList.remove('invalid');
                numberReq.classList.add('valid');
            } else {
                numberReq.classList.remove('valid');
                numberReq.classList.add('invalid');
            }

            // Validar carácter especial
            if (/[@$!%*#?&]/.test(password)) {
                specialReq.classList.remove('invalid');
                specialReq.classList.add('valid');
            } else {
                specialReq.classList.remove('valid');
                specialReq.classList.add('invalid');
            }
        }

        function validatePasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const confirmInput = document.getElementById('password_confirmation');

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    confirmInput.style.borderColor = '#10b981';
                } else {
                    confirmInput.style.borderColor = '#ef4444';
                }
            } else {
                confirmInput.style.borderColor = '#e0e0e0';
            }
        }
    </script>
</body>
</html>
