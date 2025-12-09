    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f56565;
            --light-bg: #f8f9fa;
            --card-bg: rgba(255, 255, 255, 0.98);
        }
        
        body {
            background: #0a0a0a;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }
        
        .form-wrapper {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }
        
        .form-background {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1693746046775-f5f060b099ad?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: 0;
            filter: brightness(0.4) contrast(1.1) saturate(1.2);
        }
        
        .form-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(102, 126, 234, 0.25) 0%, 
                rgba(118, 75, 162, 0.25) 50%, 
                rgba(0, 0, 0, 0.4) 100%);
            z-index: 1;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 28px;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                0 0 60px rgba(102, 126, 234, 0.3);
            padding: 4rem;
            width: 100%;
            max-width: 1100px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg,
                var(--primary-color),
                var(--secondary-color),
                #f56565);
            border-radius: 28px 28px 0 0;
        }
        
        .header-content {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            box-shadow:
                0 10px 25px rgba(102, 126, 234, 0.3),
                0 0 0 4px rgba(255, 255, 255, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }
        
        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 50%;
            padding: 5px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .form-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg,
                var(--primary-color),
                var(--secondary-color),
                #f56565);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .form-subtitle {
            color: #4a5568;
            font-size: 1.25rem;
            max-width: 700px;
            margin: 1.5rem auto 0;
            line-height: 1.7;
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #2d3748;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.2px;
        }
        
        .form-label i {
            color: var(--primary-color);
            font-size: 1.4rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 10px;
            padding: 6px;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            font-family: inherit;
            color: #2d3748;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .form-input:hover:not(:focus) {
            border-color: rgba(102, 126, 234, 0.4);
        }
        
        textarea.form-input {
            min-height: 150px;
            resize: vertical;
            line-height: 1.7;
            padding: 20px;
        }
        
        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23667eea' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 24px center;
            background-size: 24px;
            padding-right: 60px;
            cursor: pointer;
        }
        
        .image-preview-container {
            margin-top: 20px;
            border-radius: 20px;
            overflow: hidden;
            border: 3px dashed rgba(203, 213, 224, 0.6);
            transition: all 0.5s ease;
            position: relative;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(237, 242, 247, 0.9));
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .image-preview-container:hover {
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
            border-style: solid;
        }
        
        .preview-label {
            padding: 40px 30px;
            text-align: center;
            color: #718096;
            font-size: 1.1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }
        
        .preview-label i {
            font-size: 3rem;
            opacity: 0.7;
            color: var(--primary-color);
        }
        
        .preview-image {
            width: 100%;
            height: 100%;
            max-height: 350px;
            object-fit: cover;
            display: block;
            transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .preview-image:hover {
            transform: scale(1.03);
        }
        
        .checkbox-container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 25px 30px;
            background: linear-gradient(135deg, 
                rgba(102, 126, 234, 0.08), 
                rgba(118, 75, 162, 0.08));
            border-radius: 20px;
            border: 2px solid rgba(102, 126, 234, 0.15);
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .checkbox-container:hover {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, 
                rgba(102, 126, 234, 0.15), 
                rgba(118, 75, 162, 0.15));
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }
        
        .checkbox-input {
            width: 26px;
            height: 26px;
            border-radius: 10px;
            border: 3px solid rgba(203, 213, 224, 0.8);
            cursor: pointer;
            position: relative;
            transition: all 0.4s ease;
            flex-shrink: 0;
            margin-top: 4px;
            background: white;
        }
        
        .checkbox-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            animation: checkPop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        @keyframes checkPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }
        
        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 16px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .checkbox-label {
            font-weight: 800;
            color: #2d3748;
            cursor: pointer;
            line-height: 1.6;
            font-size: 1.15rem;
        }
        
        .checkbox-label p {
            font-weight: normal;
            color: #718096;
            font-size: 1rem;
            margin-top: 8px;
            line-height: 1.7;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid rgba(226, 232, 240, 0.6);
            position: relative;
        }
        
        .form-actions::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            animation: actionGlow 3s ease-in-out infinite;
        }
        
        @keyframes actionGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        
        .btn {
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-family: inherit;
        }

        .btn-back {
            background: rgba(237, 242, 247, 0.9);
            color: #4a5568;
            border: 2px solid rgba(203, 213, 224, 0.5);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .btn-back:hover {
            background: rgba(226, 232, 240, 0.95);
            color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
        
        .form-section {
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid rgba(226, 232, 240, 0.6);
            display: flex;
            align-items: center;
            gap: 15px;
            letter-spacing: -0.3px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }
        
        .char-count {
            font-size: 0.95rem;
            color: #718096;
            text-align: right;
            margin-top: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 0.95rem;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            background: rgba(229, 62, 62, 0.08);
            padding: 12px 16px;
            border-radius: 12px;
            border-left: 4px solid #e53e3e;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .loading-spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(226, 232, 240, 0.8);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
            margin-bottom: 30px;
            position: relative;
        }
        
        .loading-spinner::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border: 4px solid transparent;
            border-top: 4px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 2s linear infinite reverse;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 8px;
            font-weight: 900;
            font-size: 1.2em;
        }
        
        .floating-decorations {
            display: none;
        }
        
        @media (max-width: 1200px) {
            .form-container {
                max-width: 95%;
                padding: 3.5rem;
            }
            
            .form-title {
                font-size: 2.75rem;
            }
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 2.5rem 2rem;
                border-radius: 24px;
                margin: 1rem;
            }
            
            .form-title {
                font-size: 2.25rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1.75rem;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
                padding: 22px 30px;
            }
            
            .logo-container {
                width: 120px;
                height: 120px;
            }
            
            .logo-container img {
                width: 90px;
                height: 90px;
            }
            
            .form-background {
                background-size: 150%;
            }
            
            @keyframes zoomBackground {
                0%, 100% { background-size: 150%; }
                50% { background-size: 160%; }
            }
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }
            
            .form-title {
                font-size: 1.9rem;
            }
            
            .form-subtitle {
                font-size: 1.1rem;
                padding: 1.25rem 1.5rem;
            }
            
            .floating-decorations {
                display: none;
            }
            
            .form-input {
                padding: 16px 20px;
                font-size: 1rem;
            }
        }
        
        .particles {
            display: none;
        }
        
        .success-particles {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 10000;
            opacity: 0;
        }
    </style>
<x-app-layout>
    

    <div class="form-wrapper">
        <div class="form-background"></div>
        
        <!-- Partículas flotantes -->
        <div class="particles" id="particles"></div>
        
        <div class="form-container">
            <!-- Decoraciones flotantes -->
            <div class="floating-decorations">
                <div class="floating-decoration">⚡</div>
                <div class="floating-decoration">🎯</div>
                <div class="floating-decoration">✨</div>
            </div>
            
            <!-- Encabezado con logo -->
            <div class="header-content">
                <div class="logo-container">
                    <img src="https://lh3.googleusercontent.com/pw/AP1GczPldrhndLJ4PriR8KdVJOQjVFpOxtSs1JsFp_m96A2Qph9aiXgu920yv15-dkFEP-hYcTpoHh6d0biBlJiopzHMQzjQ4X303HV9ZTARaWhIVQ6ftYaNFYiawNYVYz-JrDVL7-uhgQsgyAnCRaCMAgHX=w500-h500-s-no-gm?authuser=0" 
                         alt="Logo TERIS" 
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Ik0xMSA1VjNNMTMgM1Y1TTQgMTBIMjBNNSAyMUgxOU0yMCAxNkwxNiAxMk04IDEyTDQgMTZNMTIgMTZIOE0xMiA4SDE2TTEyIDhWMTYiIHN0cm9rZT0iIzY2N2VlYSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48L3N2Zz4='">
                </div>
                
                <h1 class="form-title">Crear Nuevo Evento</h1>
                <p class="form-subtitle">Organiza experiencias inolvidables. Cada detalle cuenta para crear momentos extraordinarios en la comunidad TERIS.</p>
            </div>
            
            @if ($errors->any())
                <div class="mb-8 p-6 bg-gradient-to-r from-red-50/80 to-pink-50/80 border-l-6 border-red-500 text-red-900 rounded-2xl shadow-xl backdrop-blur-sm">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <strong class="text-xl font-bold block mb-2">¡Atención! Por favor revisa los siguientes puntos:</strong>
                            <ul class="mt-3 space-y-2">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center gap-3 p-3 bg-white/50 rounded-lg">
                                        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="font-medium">{{ $error }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.events.store') }}" id="eventForm">
                @csrf
                
                <!-- Sección: Información Básica -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Información Básica
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">
                                <i>📝</i>
                                Nombre del Evento
                            </label>
                            <input type="text" name="name" class="form-input" 
                                   value="{{ old('name') }}" 
                                   placeholder="Ej: Hackathon TERIS 2024 • Innovación Digital"
                                   required>
                            @error('name')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label required">
                                <i>📍</i>
                                Modalidad
                            </label>
                            <select name="modalidad" class="form-input" required>
                                <option value="">Seleccione una modalidad</option>
                                <option value="Presencial" {{ old('modalidad') == 'Presencial' ? 'selected' : '' }}>🎯 Presencial</option>
                                <option value="Virtual" {{ old('modalidad') == 'Virtual' ? 'selected' : '' }}>🌐 Virtual</option>
                                <option value="Híbrido" {{ old('modalidad') == 'Híbrido' ? 'selected' : '' }}>🔀 Híbrido</option>
                            </select>
                            @error('modalidad')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            <i>📄</i>
                            Descripción
                        </label>
                        <textarea name="description" class="form-input" 
                                  placeholder="Describe el evento, su propósito, objetivos, y qué pueden esperar los participantes..."
                                  rows="6"
                                  required>{{ old('description') }}</textarea>
                        <div class="char-count" id="description-count">
                            <i>📊</i><span>0/2000 caracteres</span>
                        </div>
                        @error('description')
                            <span class="error-message">
                                <i>⚠️</i>{{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                
                <!-- Sección: Imagen y Multimedia -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Imagen del Evento
                    </h2>
                    
                    <div class="form-group">
                        <label class="form-label required">
                            <i>🖼️</i>
                            URL de la Imagen
                        </label>
                        <input type="url" name="image_url" id="image_url" 
                               class="form-input" 
                               value="{{ old('image_url') }}" 
                               placeholder="https://ejemplo.com/imagen-eventos-teris.jpg"
                               required
                               oninput="previewImage(this.value)">
                        <p class="text-sm text-gray-600 mt-4 pl-4 border-l-4 border-blue-300 bg-blue-50/50 p-3 rounded-r-xl">
                            <i class="text-blue-600 mr-2">💡</i>
                            <strong>Recomendación:</strong> Usa imágenes de alta calidad (mínimo 1200x600px) para una mejor presentación. Formatos soportados: JPG, PNG, GIF.
                        </p>
                        @error('image_url')
                            <span class="error-message">
                                <i>⚠️</i>{{ $message }}
                            </span>
                        @enderror
                        
                        <div class="image-preview-container" id="image_preview_container">
                            <div class="preview-label" id="preview_label">
                                <i>🖼️</i>
                                <span>Vista previa de la imagen</span>
                                <small class="text-sm opacity-75">La imagen aparecerá automáticamente cuando ingreses una URL válida</small>
                            </div>
                            <img id="preview_image" class="preview-image" style="display: none;">
                        </div>
                    </div>
                </div>
                
                <!-- Sección: Fechas y Ubicación -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fechas y Ubicación
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">
                                <i>📅</i>
                                Fecha de Inicio
                            </label>
                            <input type="date" name="inicio_evento" 
                                   class="form-input" 
                                   value="{{ old('inicio_evento') }}" 
                                   required>
                            @error('inicio_evento')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required">
                                <i>🏁</i>
                                Fecha de Finalización
                            </label>
                            <input type="date" name="fin_evento" 
                                   class="form-input" 
                                   value="{{ old('fin_evento') }}" 
                                   required>
                            @error('fin_evento')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i>🏙️</i>
                            Ubicación
                        </label>
                        <input type="text" name="ubicacion" 
                               class="form-input" 
                               value="{{ old('ubicacion') }}"
                               placeholder="Ej: Centro de Convenciones TERIS • Av. Principal 123, Ciudad, País">
                        <p class="text-sm text-gray-600 mt-4 pl-4 border-l-4 border-green-300 bg-green-50/50 p-3 rounded-r-xl">
                            <i class="text-green-600 mr-2">ℹ️</i>
                            <strong>Nota:</strong> Este campo es opcional. Solo necesario para eventos presenciales o híbridos.
                        </p>
                        @error('ubicacion')
                            <span class="error-message">
                                <i>⚠️</i>{{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                
                <!-- Sección: Detalles Adicionales -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Detalles Adicionales
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i>📋</i>
                                Reglas del Evento
                            </label>
                            <textarea name="reglas" class="form-input" 
                                      placeholder="Reglas específicas, requisitos de participación, criterios de evaluación, código de conducta..."
                                      rows="5">{{ old('reglas') }}</textarea>
                            <div class="char-count" id="rules-count">
                                <i>📊</i><span>0/1500 caracteres</span>
                            </div>
                            @error('reglas')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i>🏆</i>
                                Premios y Reconocimientos
                            </label>
                            <textarea name="premios" class="form-input" 
                                      placeholder="Premios en efectivo, becas, certificados, oportunidades de empleo, mentorías, herramientas..."
                                      rows="5">{{ old('premios') }}</textarea>
                            <div class="char-count" id="prizes-count">
                                <i>📊</i><span>0/1500 caracteres</span>
                            </div>
                            @error('premios')
                                <span class="error-message">
                                    <i>⚠️</i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Sección: Asignación de Jueces -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Asignación de Jueces
                    </h2>

                    <div class="form-group">
                        <label class="form-label">
                            <i>👨‍⚖️</i>
                            Buscar y Seleccionar Jueces
                        </label>

                        <div style="position: relative;">
                            <input type="text"
                                   id="judge-search"
                                   class="form-input"
                                   placeholder="Buscar jueces por nombre o email..."
                                   autocomplete="off"
                                   oninput="searchJudges(this.value)">

                            <div id="search-results"
                                 style="display: none; position: absolute; z-index: 1000; background: white; border: 2px solid rgba(102, 126, 234, 0.3); border-radius: 16px; margin-top: 8px; max-height: 300px; overflow-y: auto; width: 100%; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 mt-4 pl-4 border-l-4 border-purple-300 bg-purple-50/50 p-3 rounded-r-xl">
                            <i class="text-purple-600 mr-2">💡</i>
                            <strong>Sugerencia:</strong> Escribe el nombre o email del juez para buscar. Los jueces seleccionados aparecerán abajo.
                        </p>
                    </div>

                    <div class="form-group mt-6">
                        <label class="form-label">
                            <i>✅</i>
                            Jueces Asignados al Evento
                        </label>

                        <div id="selected-judges"
                             style="min-height: 120px; background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(237, 242, 247, 0.9)); border: 2px dashed rgba(203, 213, 224, 0.6); border-radius: 20px; padding: 20px; display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: center;">
                            <div style="text-align: center; color: #718096; width: 100%;">
                                <i style="font-size: 2.5rem; opacity: 0.5;">👥</i>
                                <p style="margin-top: 10px; font-size: 1rem;">No hay jueces asignados aún</p>
                                <small style="opacity: 0.7;">Usa el buscador para añadir jueces a este evento</small>
                            </div>
                        </div>

                        <input type="hidden" name="judges" id="judges-input" value="">
                    </div>
                </div>

                <!-- Sección: Configuración -->
                <div class="form-section">
                    <h2 class="section-title">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Configuración del Evento
                    </h2>
                    
                    <div class="checkbox-container" onclick="toggleCheckbox()">
                        <input type="checkbox" name="popular" id="popular" 
                               class="checkbox-input"
                               {{ old('popular') ? 'checked' : '' }}>
                        <label for="popular" class="checkbox-label">
                            <strong>⭐ Marcar como Evento Destacado</strong>
                            <p>Los eventos destacados aparecen en la sección principal del sitio web, tienen mayor visibilidad y prioridad en las búsquedas. Recomendado para eventos especiales y de gran importancia.</p>
                        </label>
                    </div>
                </div>
                
                <!-- Acciones del Formulario -->
                <div class="form-actions">
                    <a href="{{ route('events.index') }}" class="btn btn-back">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancelar y Volver
                    </a>
                    
                    <button type="submit" class="btn btn-submit" onclick="showLoading()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Crear Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Overlay de carga -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <p class="text-2xl font-bold text-gray-800 mt-8">Creando tu evento...</p>
        <p class="text-gray-600 mt-3 text-lg">Preparando una experiencia increíble para la comunidad</p>
        <div class="mt-10 flex space-x-4">
            <div class="w-4 h-4 bg-blue-500 rounded-full animate-bounce"></div>
            <div class="w-4 h-4 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
            <div class="w-4 h-4 bg-pink-500 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
        </div>
    </div>
    
    <!-- Partículas de éxito -->
    <div class="success-particles" id="successParticles"></div>
    
    @push('scripts')
    <script>
        // Contador de caracteres
        function setupCharacterCount(textareaId, counterId, maxLength) {
            const textarea = document.querySelector(`textarea[name="${textareaId}"]`);
            const counter = document.getElementById(counterId);
            
            if (textarea && counter) {
                const updateCounter = () => {
                    const length = textarea.value.length;
                    const span = counter.querySelector('span');
                    span.textContent = `${length}/${maxLength} caracteres`;
                    
                    if (length > maxLength) {
                        counter.style.color = '#e53e3e';
                        counter.querySelector('i').textContent = '⚠️';
                    } else if (length > maxLength * 0.9) {
                        counter.style.color = '#ed8936';
                        counter.querySelector('i').textContent = '⚠️';
                    } else if (length > maxLength * 0.75) {
                        counter.style.color = '#ecc94b';
                        counter.querySelector('i').textContent = '📊';
                    } else {
                        counter.style.color = '#718096';
                        counter.querySelector('i').textContent = '📊';
                    }
                };
                
                textarea.addEventListener('input', updateCounter);
                updateCounter(); // Inicializar
            }
        }
        
        // Vista previa de imagen
        function previewImage(url) {
            const previewContainer = document.getElementById('image_preview_container');
            const previewLabel = document.getElementById('preview_label');
            const previewImage = document.getElementById('preview_image');
            
            if (url && isValidUrl(url)) {
                previewLabel.style.display = 'none';
                previewImage.src = url;
                previewImage.style.display = 'block';
                previewImage.onerror = function() {
                    previewLabel.style.display = 'flex';
                    previewImage.style.display = 'none';
                    previewLabel.innerHTML = '<i>❌</i><span>No se puede cargar la imagen</span><small class="text-sm opacity-75">Verifica que la URL sea correcta y accesible</small>';
                    previewLabel.style.color = '#e53e3e';
                    previewContainer.style.borderColor = '#e53e3e';
                    previewContainer.style.background = 'linear-gradient(135deg, rgba(229, 62, 62, 0.05), rgba(237, 100, 166, 0.05))';
                };
                previewImage.onload = function() {
                    previewLabel.style.display = 'none';
                    previewContainer.style.borderColor = '#48bb78';
                    previewContainer.style.background = 'linear-gradient(135deg, rgba(72, 187, 120, 0.05), rgba(56, 178, 172, 0.05))';
                    previewContainer.style.borderStyle = 'solid';
                };
            } else {
                previewLabel.style.display = 'flex';
                previewImage.style.display = 'none';
                previewLabel.innerHTML = '<i>🖼️</i><span>Vista previa de la imagen</span><small class="text-sm opacity-75">La imagen aparecerá automáticamente cuando ingreses una URL válida</small>';
                previewLabel.style.color = '#718096';
                previewContainer.style.borderColor = 'rgba(203, 213, 224, 0.6)';
                previewContainer.style.background = 'linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(237, 242, 247, 0.9))';
                previewContainer.style.borderStyle = 'dashed';
            }
        }
        
        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }
        
        // Toggle checkbox con clic en el contenedor
        function toggleCheckbox() {
            const checkbox = document.getElementById('popular');
            checkbox.checked = !checkbox.checked;
            updateCheckboxStyle();
            
            // Efecto de sonido (simulado)
            if (checkbox.checked) {
                playSound('check');
            } else {
                playSound('uncheck');
            }
        }
        
        function playSound(type) {
            // Simulación de sonido con vibración
            if (navigator.vibrate) {
                if (type === 'check') {
                    navigator.vibrate([50, 30, 50]);
                } else {
                    navigator.vibrate([30]);
                }
            }
        }
        
        function updateCheckboxStyle() {
            const checkbox = document.getElementById('popular');
            const container = checkbox.closest('.checkbox-container');
            
            if (checkbox.checked) {
                container.style.borderColor = 'var(--primary-color)';
                container.style.background = 'linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.15))';
                container.style.boxShadow = '0 20px 40px rgba(102, 126, 234, 0.15)';
            } else {
                container.style.borderColor = 'rgba(102, 126, 234, 0.15)';
                container.style.background = 'linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08))';
                container.style.boxShadow = 'none';
            }
        }
        
        // Mostrar overlay de carga
        function showLoading() {
            const form = document.getElementById('eventForm');
            const overlay = document.getElementById('loadingOverlay');
            
            if (form.checkValidity()) {
                // Validar longitud máxima
                const description = document.querySelector('textarea[name="description"]');
                const reglas = document.querySelector('textarea[name="reglas"]');
                const premios = document.querySelector('textarea[name="premios"]');
                
                let isValid = true;
                let errorMessage = '';
                
                if (description && description.value.length > 2000) {
                    errorMessage = 'La descripción no puede exceder los 2000 caracteres';
                    isValid = false;
                }
                if (reglas && reglas.value.length > 1500) {
                    errorMessage = 'Las reglas no pueden exceder los 1500 caracteres';
                    isValid = false;
                }
                if (premios && premios.value.length > 1500) {
                    errorMessage = 'Los premios no pueden exceder los 1500 caracteres';
                    isValid = false;
                }
                
                if (!isValid) {
                    alert(`⚠️ ${errorMessage}`);
                    return false;
                }
                
                if (isValid) {
                    overlay.classList.add('active');
                    return true;
                }
            }
            return false;
        }
        
        // Configurar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            
            // Establecer fecha mínima como hoy
            const today = new Date().toISOString().split('T')[0];
            const startDateInput = document.querySelector('input[name="inicio_evento"]');
            const endDateInput = document.querySelector('input[name="fin_evento"]');
            
            if (startDateInput) {
                startDateInput.min = today;
                
                // Cuando cambia la fecha de inicio, actualizar mínima de fecha fin
                startDateInput.addEventListener('change', function() {
                    if (endDateInput) {
                        endDateInput.min = this.value;
                        if (endDateInput.value && endDateInput.value < this.value) {
                            endDateInput.value = this.value;
                        }
                    }
                });
            }
            
            // Inicializar contadores de caracteres
            setupCharacterCount('description', 'description-count', 2000);
            setupCharacterCount('reglas', 'rules-count', 1500);
            setupCharacterCount('premios', 'prizes-count', 1500);
            
            // Inicializar vista previa si hay valor
            const imageUrlInput = document.getElementById('image_url');
            if (imageUrlInput && imageUrlInput.value) {
                previewImage(imageUrlInput.value);
            }
            
            // Inicializar estilo del checkbox
            updateCheckboxStyle();
            
            // Validación en tiempo real de URL
            imageUrlInput.addEventListener('blur', function() {
                if (this.value && !isValidUrl(this.value)) {
                    this.style.borderColor = '#e53e3e';
                    this.style.boxShadow = '0 0 0 4px rgba(229, 62, 62, 0.1)';
                    this.style.background = 'rgba(229, 62, 62, 0.05)';
                } else {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                    this.style.background = '';
                }
            });
            
            
            // Actualizar checkbox cuando cambia
            const popularCheckbox = document.getElementById('popular');
            if (popularCheckbox) {
                popularCheckbox.addEventListener('change', updateCheckboxStyle);
            }
            
            // Efecto de tecleo en textareas
            const textareas = document.querySelectorAll('textarea.form-input');
            textareas.forEach(textarea => {
                textarea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        const start = this.selectionStart;
                        const end = this.selectionEnd;
                        this.value = this.value.substring(0, start) + '\n' + this.value.substring(end);
                        this.selectionStart = this.selectionEnd = start + 1;
                    }
                });
            });
        });
        
        // Deshabilitar doble envío del formulario
        let formSubmitted = false;
        document.getElementById('eventForm').addEventListener('submit', function(e) {
            if (formSubmitted) {
                e.preventDefault();
                return false;
            }
            formSubmitted = true;
            
            // Deshabilitar botón de envío con animación
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Creando evento...
                `;
                submitBtn.style.opacity = '0.8';
                submitBtn.style.cursor = 'not-allowed';
            }
            
            // Crear efecto de partículas de éxito
            createSuccessParticles();
            
            return true;
        });
        
        // Crear partículas de éxito
        function createSuccessParticles() {
            const container = document.getElementById('successParticles');
            container.style.opacity = '1';

            const colors = ['#667eea', '#764ba2', '#f56565', '#48bb78', '#ed8936'];

            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = '15px';
                particle.style.height = '15px';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.left = '50%';
                particle.style.top = '50%';
                particle.style.transform = 'translate(-50%, -50%)';
                particle.style.boxShadow = '0 0 20px currentColor';

                const angle = Math.random() * Math.PI * 2;
                const distance = 100 + Math.random() * 200;
                const duration = 1 + Math.random() * 1;

                particle.animate([
                    {
                        transform: 'translate(-50%, -50%) scale(1)',
                        opacity: 1
                    },
                    {
                        transform: `translate(${Math.cos(angle) * distance - 50}%, ${Math.sin(angle) * distance - 50}%) scale(0)`,
                        opacity: 0
                    }
                ], {
                    duration: duration * 1000,
                    easing: 'cubic-bezier(0.34, 1.56, 0.64, 1)'
                });

                container.appendChild(particle);

                // Remover partícula después de animación
                setTimeout(() => {
                    particle.remove();
                }, duration * 1000);
            }

            // Ocultar partículas después de 3 segundos
            setTimeout(() => {
                container.style.opacity = '0';
            }, 3000);
        }

        // ============================================
        // FUNCIONALIDAD DE BÚSQUEDA Y SELECCIÓN DE JUECES
        // ============================================

        let selectedJudges = [];
        let searchTimeout = null;

        // Buscar jueces
        function searchJudges(query) {
            const searchResults = document.getElementById('search-results');

            // Limpiar timeout anterior
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            // Debounce: esperar 300ms después del último tecleo
            searchTimeout = setTimeout(() => {
                fetch(`/api/judges/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.judges && data.judges.length > 0) {
                            renderSearchResults(data.judges);
                            searchResults.style.display = 'block';
                        } else {
                            searchResults.innerHTML = `
                                <div style="padding: 20px; text-align: center; color: #718096;">
                                    <i style="font-size: 2rem; opacity: 0.5;">🔍</i>
                                    <p style="margin-top: 10px;">No se encontraron jueces con ese criterio</p>
                                </div>
                            `;
                            searchResults.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error al buscar jueces:', error);
                        searchResults.innerHTML = `
                            <div style="padding: 20px; text-align: center; color: #e53e3e;">
                                <i style="font-size: 2rem;">⚠️</i>
                                <p style="margin-top: 10px;">Error al buscar jueces</p>
                            </div>
                        `;
                        searchResults.style.display = 'block';
                    });
            }, 300);
        }

        // Renderizar resultados de búsqueda
        function renderSearchResults(judges) {
            const searchResults = document.getElementById('search-results');
            searchResults.innerHTML = '';

            judges.forEach(judge => {
                const isSelected = selectedJudges.some(j => j.id === judge.id);

                const judgeItem = document.createElement('div');
                judgeItem.style.cssText = `
                    padding: 16px 20px;
                    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    background: ${isSelected ? 'rgba(102, 126, 234, 0.08)' : 'white'};
                `;

                judgeItem.innerHTML = `
                    <div style="flex: 1;">
                        <div style="font-weight: 600; color: #2d3748; margin-bottom: 4px;">${judge.name}</div>
                        <div style="font-size: 0.9rem; color: #718096;">${judge.email}</div>
                    </div>
                    <div style="padding: 8px 16px; background: ${isSelected ? 'rgba(102, 126, 234, 0.2)' : 'rgba(102, 126, 234, 0.1)'}; border-radius: 12px; font-size: 0.9rem; font-weight: 600; color: ${isSelected ? '#667eea' : '#4a5568'};">
                        ${isSelected ? '✓ Seleccionado' : '+ Agregar'}
                    </div>
                `;

                judgeItem.onmouseover = function() {
                    if (!isSelected) {
                        this.style.background = 'rgba(102, 126, 234, 0.05)';
                    }
                };

                judgeItem.onmouseout = function() {
                    if (!isSelected) {
                        this.style.background = 'white';
                    }
                };

                judgeItem.onclick = function() {
                    if (!isSelected) {
                        addJudge(judge);
                        document.getElementById('judge-search').value = '';
                        searchResults.style.display = 'none';
                    }
                };

                searchResults.appendChild(judgeItem);
            });
        }

        // Agregar juez a la lista de seleccionados
        function addJudge(judge) {
            if (selectedJudges.some(j => j.id === judge.id)) {
                return;
            }

            selectedJudges.push(judge);
            updateSelectedJudgesUI();
            updateJudgesInput();
        }

        // Remover juez de la lista de seleccionados
        function removeJudge(judgeId) {
            selectedJudges = selectedJudges.filter(j => j.id !== judgeId);
            updateSelectedJudgesUI();
            updateJudgesInput();
        }

        // Actualizar la UI de jueces seleccionados
        function updateSelectedJudgesUI() {
            const container = document.getElementById('selected-judges');

            if (selectedJudges.length === 0) {
                container.innerHTML = `
                    <div style="text-align: center; color: #718096; width: 100%;">
                        <i style="font-size: 2.5rem; opacity: 0.5;">👥</i>
                        <p style="margin-top: 10px; font-size: 1rem;">No hay jueces asignados aún</p>
                        <small style="opacity: 0.7;">Usa el buscador para añadir jueces a este evento</small>
                    </div>
                `;
                container.style.border = '2px dashed rgba(203, 213, 224, 0.6)';
            } else {
                container.innerHTML = '';
                container.style.border = '2px solid rgba(102, 126, 234, 0.3)';

                selectedJudges.forEach(judge => {
                    const judgeTag = document.createElement('div');
                    judgeTag.style.cssText = `
                        display: inline-flex;
                        align-items: center;
                        gap: 12px;
                        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.15));
                        border: 2px solid rgba(102, 126, 234, 0.3);
                        border-radius: 16px;
                        padding: 12px 16px;
                        font-weight: 600;
                        color: #2d3748;
                        transition: all 0.3s ease;
                    `;

                    judgeTag.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.1rem;">
                                ${judge.name.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #2d3748;">${judge.name}</div>
                                <div style="font-size: 0.85rem; color: #718096; font-weight: 400;">${judge.email}</div>
                            </div>
                        </div>
                        <button type="button"
                                onclick="removeJudge(${judge.id})"
                                style="background: rgba(229, 62, 62, 0.1); border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; color: #e53e3e; font-size: 1.2rem; font-weight: bold;"
                                onmouseover="this.style.background='rgba(229, 62, 62, 0.2)'; this.style.transform='scale(1.1)'"
                                onmouseout="this.style.background='rgba(229, 62, 62, 0.1)'; this.style.transform='scale(1)'">
                            ×
                        </button>
                    `;

                    container.appendChild(judgeTag);
                });
            }
        }

        // Actualizar el input hidden con los IDs de jueces
        function updateJudgesInput() {
            const judgesInput = document.getElementById('judges-input');
            judgesInput.value = JSON.stringify(selectedJudges.map(j => j.id));
        }

        // Cerrar resultados de búsqueda al hacer clic fuera
        document.addEventListener('click', function(event) {
            const searchInput = document.getElementById('judge-search');
            const searchResults = document.getElementById('search-results');

            if (searchInput && searchResults &&
                !searchInput.contains(event.target) &&
                !searchResults.contains(event.target)) {
                searchResults.style.display = 'none';
            }
        });
    </script>
    @endpush
</x-app-layout>