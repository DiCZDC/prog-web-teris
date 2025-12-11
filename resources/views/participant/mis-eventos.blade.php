<x-app-layout>
    @push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
            min-height: 100vh;
            font-family: 'Inter', 'Arial', sans-serif;
            color: #e0e7ff;
        }

        .page-header-content {
            padding: 2rem 0;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .page-title .icon {
            width: 2.5rem;
            height: 2.5rem;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            text-align: center;
        }

        .eventos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 25px;
        }

        @media (max-width: 480px) {
            .eventos-grid {
                grid-template-columns: 1fr;
            }
        }

        .evento-card {
            background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
            transition: all 0.3s ease;
            border: 2px solid rgba(167, 139, 250, 0.3);
        }

        .evento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(167, 139, 250, 0.4);
            border-color: rgba(167, 139, 250, 0.5);
        }

        .evento-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(139, 92, 246, 0.3));
            padding: 1.5rem;
            border-bottom: 1px solid rgba(167, 139, 250, 0.3);
        }

        .evento-nombre {
            font-size: 1.4rem;
            font-weight: 700;
            color: #c4b5fd;
            margin-bottom: 0.5rem;
        }

        .evento-fechas {
            color: #a5b4fc;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .evento-fechas .icon {
            width: 1rem;
            height: 1rem;
        }

        .evento-body {
            padding: 1.5rem;
        }

        .equipo-info {
            background: rgba(30, 27, 75, 0.5);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .equipo-nombre {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .equipo-nombre .icon {
            width: 1.25rem;
            height: 1.25rem;
            color: #fbbf24;
        }

        .mi-rol {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .rol-lider {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .rol-disenador {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
        }

        .rol-front {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .rol-back {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .proyecto-status {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .proyecto-pendiente {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        .proyecto-subido {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.4);
        }

        .status-icon {
            width: 2rem;
            height: 2rem;
            flex-shrink: 0;
        }

        .proyecto-subido .status-icon {
            color: #86efac;
        }

        .proyecto-pendiente .status-icon {
            color: #fca5a5;
        }

        .status-text h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .proyecto-pendiente .status-text h4 {
            color: #fca5a5;
        }

        .proyecto-subido .status-text h4 {
            color: #86efac;
        }

        .status-text p {
            font-size: 0.85rem;
            color: #c7d2fe;
        }

        .calificacion-box {
            background: rgba(30, 27, 75, 0.5);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }

        .calificacion-label {
            font-size: 0.85rem;
            color: #a5b4fc;
            margin-bottom: 0.5rem;
        }

        .calificacion-valor {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .calificacion-pending {
            font-size: 1.2rem;
            color: #a5b4fc;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .calificacion-pending .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .btn-ver-detalles {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            text-align: center;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-ver-detalles:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(124, 58, 237, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(49, 46, 129, 0.5);
            border-radius: 20px;
            border: 2px dashed rgba(167, 139, 250, 0.3);
        }

        .empty-icon {
            width: 5rem;
            height: 5rem;
            margin: 0 auto 1rem;
            color: #c4b5fd;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #c4b5fd;
            margin-bottom: 0.5rem;
        }

        .empty-text {
            color: #a5b4fc;
            margin-bottom: 1.5rem;
        }

        .btn-explorar {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-explorar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5);
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-volver:hover {
            color: #c4b5fd;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .stat-item {
            background: rgba(30, 27, 75, 0.4);
            padding: 0.75rem;
            border-radius: 8px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #c4b5fd;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #a5b4fc;
        }
    </style>
    @endpush

    <!-- Contenido -->
    <div class="container mx-auto px-4 pb-12">
        <!-- Header -->
        <div class="page-header-content mb-8">
            <a href="{{ route('events.index') }}" class="btn-volver mb-4 inline-block">
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Volver a eventos
            </a>
            <h1 class="page-title">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Mis Eventos
            </h1>
            <p class="page-subtitle">Eventos en los que participas como miembro de un equipo</p>
        </div>
        @if($eventosConEquipos->count() > 0)
            <div class="eventos-grid">
                @foreach($eventosConEquipos as $item)
                    <div class="evento-card">
                        <!-- Header del evento -->
                        <div class="evento-header">
                            
                            @if(!empty($item['evento']->nombre))
                                <h2 class="evento-nombre">{{ $item['evento']->nombre }}</h2>
                            
                            <p class="evento-fechas">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            
                                {{ \Carbon\Carbon::parse($item['evento']->inicio_evento)->format('d/m/Y') }} 
                                - {{ \Carbon\Carbon::parse($item['evento']->fin_evento)->format('d/m/Y') }}
                            @else
                                <h2 class="evento-nombre">Sin Evento</h2>
                                @endif
                            </p>
                        </div>

                        <!-- Body -->
                        <div class="evento-body">
                            <!-- Info del equipo -->
                            <div class="equipo-info">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="equipo-nombre">
                                            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                                            </svg>
                                            {{ $item['equipo']->nombre }}
                                        </h3>
                                        <p class="text-sm text-indigo-300">Código: {{ $item['equipo']->codigo }}</p>
                                    </div>
                                    <span class="mi-rol 
                                        @if($item['mi_rol'] == 'LIDER') rol-lider
                                        @elseif($item['mi_rol'] == 'DISEÑADOR') rol-disenador
                                        @elseif($item['mi_rol'] == 'PROGRAMADOR FRONT') rol-front
                                        @else rol-back @endif">
                                        {{ $item['mi_rol'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Estado del proyecto -->
                            @if($item['tiene_proyecto'])
                                <div class="proyecto-status proyecto-subido">
                                    <svg class="status-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    <div class="status-text">
                                        <h4>Proyecto Subido</h4>
                                        <p>{{ $item['proyecto']->nombre ?? $item['proyecto']->titulo ?? 'Sin nombre' }}</p>
                                    </div>
                                </div>

                                <!-- Calificación -->
                                <div class="calificacion-box">
                                    <p class="calificacion-label">Calificación Promedio</p>
                                    @if($item['esta_calificado'])
                                        <p class="calificacion-valor">{{ number_format($item['promedio_calificacion'], 1) }}/10</p>
                                        <p class="text-sm text-indigo-300 mt-1">
                                            {{ $item['total_evaluaciones'] }} evaluación(es)
                                        </p>
                                    @else
                                        <p class="calificacion-pending">
                                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12 6 12 12 16 14"/>
                                            </svg>
                                            Pendiente de evaluación
                                        </p>
                                    @endif
                                </div>
                            @else
                                <div class="proyecto-status proyecto-pendiente">
                                    <svg class="status-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                        <line x1="12" y1="9" x2="12" y2="13"/>
                                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                                    </svg>
                                    <div class="status-text">
                                        <h4>Proyecto Pendiente</h4>
                                        <p>Aún no has subido el proyecto de tu equipo</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Botón ver detalles -->
                            @if(!empty($item['evento']->nombre))
                                <a href="{{ route('mis-eventos.equipo', $item['evento']->id) }}" class="btn-ver-detalles">
                                    Ver detalles completos
                                    <svg style="display: inline-block; vertical-align: middle; margin-left: 0.5rem;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío -->
            <div class="empty-state">
                <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <circle cx="12" cy="12" r="6"/>
                    <circle cx="12" cy="12" r="2"/>
                </svg>
                <h2 class="empty-title">No participas en ningún evento</h2>
                <p class="empty-text">
                    Únete a un equipo o crea el tuyo para participar en los eventos disponibles.
                </p>
                <a href="{{ route('events.index') }}" class="btn-explorar">
                    Explorar Eventos
                    <svg style="display: inline-block; vertical-align: middle; margin-left: 0.5rem;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</x-app-layout>