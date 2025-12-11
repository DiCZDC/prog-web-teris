<x-app-layout>
    @push('styles')
    <style>
        .project-form-container {
            background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
            border-radius: 16px;
            border: 2px solid rgba(167, 139, 250, 0.3);
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
            color: #e0e7ff;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #c4b5fd;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(30, 27, 75, 0.5);
            border: 2px solid rgba(167, 139, 250, 0.3);
            border-radius: 0.5rem;
            color: #e0e7ff;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(167, 139, 250, 0.6);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .form-input::placeholder {
            color: #a5b4fc;
            opacity: 0.6;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 700;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            border: 2px solid rgba(59, 130, 246, 0.3);
            width: 100%;
            font-size: 1.125rem;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.6);
        }

        .back-btn {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
            border: 2px solid rgba(167, 139, 250, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.6);
        }

        .help-text {
            font-size: 0.75rem;
            color: #a5b4fc;
            margin-top: 0.25rem;
        }

        .error-message {
            font-size: 0.875rem;
            color: #fca5a5;
            margin-top: 0.25rem;
        }

        .info-box {
            background: rgba(59, 130, 246, 0.2);
            border: 2px solid rgba(59, 130, 246, 0.4);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-box-title {
            font-weight: 700;
            color: #93c5fd;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-box-text {
            color: #c7d2fe;
            font-size: 0.875rem;
            line-height: 1.5;
        }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('teams.show', $team) }}" class="back-btn mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Equipo
            </a>

            <div class="project-form-container overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h1 class="form-title">
                        {{ isset($project) ? 'Editar Proyecto' : 'Enviar Proyecto' }}
                    </h1>

                    <div class="info-box">
                        <div class="info-box-title">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Información del Equipo
                        </div>
                        <div class="info-box-text">
                            <strong>Equipo:</strong> {{ $team->nombre }}<br>
                            @if($team->evento)
                                <strong>Evento:</strong> {{ $team->evento->nombre }}
                            @else
                                <strong class="text-yellow-400">⚠️ Este equipo no está inscrito en ningún evento</strong>
                            @endif
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg" style="background: rgba(239, 68, 68, 0.2); border: 2px solid #ef4444;">
                            <div class="font-bold mb-2" style="color: #fca5a5;">Error en el formulario:</div>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li class="error-message">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST">
                        @csrf
                        @if(isset($project))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="team_id" value="{{ $team->id }}">

                        <div class="space-y-6">
                            <!-- Nombre del Proyecto -->
                            <div>
                                <label for="nombre" class="form-label">Nombre del Proyecto *</label>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    class="form-input @error('nombre') border-red-500 @enderror"
                                    value="{{ old('nombre', $project->nombre ?? '') }}"
                                    placeholder="Ej: Sistema de Gestión Escolar"
                                    required
                                    maxlength="255"
                                >
                                @error('nombre')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="descripcion" class="form-label">Descripción del Proyecto *</label>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    class="form-input @error('descripcion') border-red-500 @enderror"
                                    placeholder="Describe tu proyecto, sus objetivos y características principales..."
                                    required
                                    rows="5"
                                >{{ old('descripcion', $project->descripcion ?? '') }}</textarea>
                                @error('descripcion')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="help-text">Describe en detalle qué hace tu proyecto y cómo funciona.</p>
                            </div>

                            <!-- URL del Repositorio GitHub -->
                            <div>
                                <label for="repositorio_url" class="form-label">URL del Repositorio (GitHub) *</label>
                                <input
                                    type="url"
                                    id="repositorio_url"
                                    name="repositorio_url"
                                    class="form-input @error('repositorio_url') border-red-500 @enderror"
                                    value="{{ old('repositorio_url', $project->repositorio_url ?? '') }}"
                                    placeholder="https://github.com/usuario/proyecto"
                                    required
                                >
                                @error('repositorio_url')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="help-text">Ingresa la URL completa de tu repositorio en GitHub.</p>
                            </div>

                            <!-- URL de Demo (Opcional) -->
                            <div>
                                <label for="demo_url" class="form-label">URL de Demo (Opcional)</label>
                                <input
                                    type="url"
                                    id="demo_url"
                                    name="demo_url"
                                    class="form-input @error('demo_url') border-red-500 @enderror"
                                    value="{{ old('demo_url', $project->demo_url ?? '') }}"
                                    placeholder="https://mi-proyecto-demo.com"
                                >
                                @error('demo_url')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="help-text">Si tienes una demo en línea de tu proyecto, ingresa la URL aquí.</p>
                            </div>

                            <!-- URL de Documentación (Opcional) -->
                            <div>
                                <label for="documentacion_url" class="form-label">URL de Documentación (Opcional)</label>
                                <input
                                    type="url"
                                    id="documentacion_url"
                                    name="documentacion_url"
                                    class="form-input @error('documentacion_url') border-red-500 @enderror"
                                    value="{{ old('documentacion_url', $project->documentacion_url ?? '') }}"
                                    placeholder="https://docs.mi-proyecto.com"
                                >
                                @error('documentacion_url')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="help-text">Si tienes documentación adicional (README extendido, Wiki, etc.), ingresa la URL aquí.</p>
                            </div>

                            <!-- Botón de envío -->
                            <div class="pt-4">
                                <button type="submit" class="submit-btn">
                                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ isset($project) ? 'Actualizar Proyecto' : 'Enviar Proyecto' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
