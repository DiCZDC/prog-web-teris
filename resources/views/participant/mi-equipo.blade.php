<x-app-layout>
    @push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
            min-height: 100vh;
            font-family: 'Inter', 'Arial', sans-serif;
            color: #e0e7ff;
        }

        .page-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .btn-volver:hover {
            color: #c4b5fd;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: white;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }

        .mi-rol-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            margin-top: 0.5rem;
        }

        .rol-lider { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
        .rol-disenador { background: linear-gradient(135deg, #ec4899, #db2777); color: white; }
        .rol-front { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
        .rol-back { background: linear-gradient(135deg, #10b981, #059669); color: white; }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
            border-radius: 16px;
            padding: 1.5rem;
            border: 2px solid rgba(167, 139, 250, 0.3);
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #c4b5fd;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(167, 139, 250, 0.3);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .miembro-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: rgba(30, 27, 75, 0.5);
            border-radius: 10px;
            margin-bottom: 0.75rem;
        }

        .miembro-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .miembro-info h4 {
            font-weight: 600;
            color: white;
        }

        .miembro-info p {
            font-size: 0.8rem;
            color: #a5b4fc;
        }

        .miembro-rol {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .proyecto-card {
            background: rgba(34, 197, 94, 0.1);
            border: 2px solid rgba(34, 197, 94, 0.3);
        }

        .proyecto-card.sin-proyecto {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.3);
        }

        .proyecto-nombre {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .proyecto-descripcion {
            color: #c7d2fe;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .proyecto-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .proyecto-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .link-proyecto { background: #3b82f6; color: white; }
        .link-repo { background: #6366f1; color: white; }
        .link-demo { background: #10b981; color: white; }
        .link-docs { background: #f59e0b; color: white; }

        .empty-proyecto-icon svg {
            width: 4rem;
            height: 4rem;
            margin-bottom: 1rem;
        }

        .btn-subir-proyecto {
            display: block;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-align: center;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            gap: .5rem;
            justify-content: center;
            align-items: center;
        }

        .info-label {
            color: #a78bfa;
            font-weight: 600;
        }
    </style>
    @endpush

    <!-- Header -->
    <div class="page-header">
        <div class="container mx-auto px-4">

            <!-- Botón volver -->
            <a href="{{ route('mis-eventos') }}" class="btn-volver">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a mis eventos
            </a>

            <h1 class="page-title">{{ $equipo->evento->nombre }}</h1>
            <p class="page-subtitle">{{ $equipo->nombre }}</p>

            <span class="mi-rol-badge 
                @if($miRol == 'LIDER') rol-lider
                @elseif($miRol == 'DISEÑADOR') rol-disenador
                @elseif($miRol == 'PROGRAMADOR FRONT') rol-front
                @else rol-back @endif">
                {{ $miRol }}
            </span>
        </div>
    </div>

    <!-- Contenido -->
    <div class="container mx-auto px-4 pb-12">
        <div class="content-grid">

            <!-- Columna Izquierda -->
            <div>
                <!-- Info del Equipo -->
                <div class="card">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm-7 8h5v-2a4 4 0 00-3-3.87M12 12v8m5 0v-8" />
                        </svg>
                        Información del Equipo
                    </h3>

                    <div class="space-y-3">
                        <p><span class="info-label">Código:</span> {{ $equipo->codigo }}</p>

                        @if($equipo->descripcion)
                            <p><span class="info-label">Descripción:</span> {{ $equipo->descripcion }}</p>
                        @endif

                        <p>
                            <span class="info-label">Estado:</span>
                            <span class="px-2 py-1 rounded text-sm {{ $equipo->estado ? 'bg-green-500/30 text-green-300' : 'bg-red-500/30 text-red-300' }}">
                                {{ $equipo->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Miembros -->
                <div class="card">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87m-14 3.87v-2a4 4 0 013-3.87m14 3.87A4 4 0 0017 9a4 4 0 00-8 0 4 4 0 00-4 4 4 4 0 001 7.87" />
                        </svg>
                        Miembros del Equipo
                    </h3>

                    @if($equipo->lider)
                    <div class="miembro-item">
                        <div class="miembro-avatar">{{ strtoupper(substr($equipo->lider->name, 0, 1)) }}</div>
                        <div class="miembro-info">
                            <h4>{{ $equipo->lider->name }}</h4>
                            <p>{{ $equipo->lider->email }}</p>
                        </div>
                        <span class="miembro-rol rol-lider">LÍDER</span>
                    </div>
                    @endif

                    @if($equipo->disenador)
                    <div class="miembro-item">
                        <div class="miembro-avatar">{{ strtoupper(substr($equipo->disenador->name, 0, 1)) }}</div>
                        <div class="miembro-info">
                            <h4>{{ $equipo->disenador->name }}</h4>
                            <p>{{ $equipo->disenador->email }}</p>
                        </div>
                        <span class="miembro-rol rol-disenador">DISEÑADOR</span>
                    </div>
                    @endif

                    @if($equipo->frontprog)
                    <div class="miembro-item">
                        <div class="miembro-avatar">{{ strtoupper(substr($equipo->frontprog->name, 0, 1)) }}</div>
                        <div class="miembro-info">
                            <h4>{{ $equipo->frontprog->name }}</h4>
                            <p>{{ $equipo->frontprog->email }}</p>
                        </div>
                        <span class="miembro-rol rol-front">FRONT</span>
                    </div>
                    @endif

                    @if($equipo->backprog)
                    <div class="miembro-item">
                        <div class="miembro-avatar">{{ strtoupper(substr($equipo->backprog->name, 0, 1)) }}</div>
                        <div class="miembro-info">
                            <h4>{{ $equipo->backprog->name }}</h4>
                            <p>{{ $equipo->backprog->email }}</p>
                        </div>
                        <span class="miembro-rol rol-back">BACK</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Columna Derecha -->
            <div>
                <!-- Proyecto -->
                @if($equipo->proyecto)
                    <div class="card proyecto-card">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7h6l2 2h10v11H3V7z" />
                            </svg>
                            Proyecto
                        </h3>

                        <h2 class="proyecto-nombre">{{ $equipo->proyecto->nombre ?? $equipo->proyecto->titulo }}</h2>

                        @if($equipo->proyecto->descripcion)
                            <p class="proyecto-descripcion">{{ $equipo->proyecto->descripcion }}</p>
                        @endif

                        <p class="text-sm text-indigo-300 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                            </svg>
                            Subido el {{ $equipo->proyecto->created_at->format('d/m/Y') }}
                            a las {{ $equipo->proyecto->created_at->format('H:i') }}
                        </p>

                        <div class="proyecto-links">

                            @if($equipo->proyecto->url)
                            <a href="{{ $equipo->proyecto->url }}" target="_blank"
                                class="proyecto-link link-proyecto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 11-5.656-5.656l1.415-1.414m6.242-6.242a4 4 0 015.657 5.657l-1.416 1.414" />
                                </svg>
                                Ver Proyecto
                            </a>
                            @endif

                            @if($equipo->proyecto->repositorio_url)
                            <a href="{{ $equipo->proyecto->repositorio_url }}" target="_blank"
                                class="proyecto-link link-repo">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 2v6l4 2 4-2V2m0 20v-6m-4 4l-4-2V8" />
                                </svg>
                                Repositorio
                            </a>
                            @endif

                            @if($equipo->proyecto->demo_url)
                            <a href="{{ $equipo->proyecto->demo_url }}" target="_blank"
                                class="proyecto-link link-demo">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3l14 9-14 9V3z" />
                                </svg>
                                Demo
                            </a>
                            @endif

                            @if($equipo->proyecto->documentacion_url)
                            <a href="{{ $equipo->proyecto->documentacion_url }}" target="_blank"
                                class="proyecto-link link-docs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 3h10v18H7z" />
                                </svg>
                                Documentación
                            </a>
                            @endif

                        </div>
                    </div>

                @else
                    <!-- Sin Proyecto -->
                    <div class="card proyecto-card sin-proyecto">
                        <div class="empty-proyecto text-center">
                            <div class="empty-proyecto-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-red-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7l9-4 9 4-9 4-9-4zm0 0v10l9 4 9-4V7" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold text-red-300 mb-2">Sin Proyecto</h3>
                            <p class="text-indigo-300 mb-4">Tu equipo aún no ha subido un proyecto</p>

                            @if($esLider)
                            <a href="{{ route('projects.create', $equipo->id) }}" class="btn-subir-proyecto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v2h16v-2M12 3v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                                Subir Proyecto
                            </a>
                            @else
                                <p class="text-sm text-indigo-400">
                                    Solo el líder del equipo puede subir el proyecto
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
