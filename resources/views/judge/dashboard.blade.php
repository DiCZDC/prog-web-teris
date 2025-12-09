@extends('layouts.app')

@section('title', 'Panel de Juez - TERIS')

@push('styles')
<style>
    .judge-dashboard {
        min-height: 100vh;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 40px 20px;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .dashboard-title {
        font-size: 48px;
        font-weight: bold;
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 18px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #ffd700;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
    }

    .stat-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 42px;
        font-weight: bold;
        color: #ffd700;
        margin-bottom: 10px;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 32px;
        color: #ffd700;
        margin-bottom: 30px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.3);
        padding-bottom: 15px;
    }

    .eventos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .evento-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s;
    }

    .evento-card:hover {
        transform: translateY(-5px);
        border-color: #ffd700;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
    }

    .evento-nombre {
        font-size: 22px;
        font-weight: bold;
        color: white;
        margin-bottom: 15px;
    }

    .evento-info {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-evaluar {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        border: none;
        border-radius: 10px;
        color: #1a1a2e;
        font-weight: bold;
        cursor: pointer;
        margin-top: 15px;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-evaluar:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
    }

    .pendientes-list {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 15px;
        padding: 20px;
    }

    .pendiente-item {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #ffd700;
        transition: all 0.3s;
    }

    .pendiente-item:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateX(5px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255, 255, 255, 0.5);
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="judge-dashboard">
    <div class="dashboard-header">
        <h1 class="dashboard-title">⚖️ Panel de Juez</h1>
        <p class="dashboard-subtitle">Bienvenido, {{ auth()->user()->name }}</p>
    </div>

    <!-- Estadísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-number">{{ $stats['total_eventos'] }}</div>
            <div class="stat-label">Eventos Asignados</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-number">{{ $stats['total_evaluaciones'] }}</div>
            <div class="stat-label">Evaluaciones Realizadas</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-number">{{ $stats['pendientes_por_calificar'] }}</div>
            <div class="stat-label">Pendientes</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⭐</div>
            <div class="stat-number">{{ number_format($stats['promedio_calificaciones'], 1) }}</div>
            <div class="stat-label">Promedio General</div>
        </div>
    </div>

    <div class="section-container">
        <!-- Eventos Asignados -->
        <h2 class="section-title">📅 Mis Eventos</h2>
        
        @if($eventos->count() > 0)
            <div class="eventos-grid">
                @foreach($eventos as $evento)
                    <div class="evento-card">
                        <div class="evento-nombre">{{ $evento->nombre }}</div>
                        <div class="evento-info">
                            📍 {{ $evento->ubicacion ?? 'Virtual' }}
                        </div>
                        <div class="evento-info">
                            📅 {{ $evento->inicio_evento->format('d/m/Y') }}
                        </div>
                        <div class="evento-info">
                            👥 {{ $evento->teams_count }} equipos
                        </div>
                        <div class="evento-info">
                            📦 {{ $evento->teams_con_proyecto }} con proyecto
                        </div>
                        <a href="{{ route('judge.eventos.equipos', $evento->id) }}" class="btn-evaluar">
                            Ver Equipos
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <p>No tienes eventos asignados aún</p>
            </div>
        @endif

        <!-- Equipos Pendientes por Calificar -->
        <h2 class="section-title">⏳ Pendientes por Calificar</h2>
        
        @if($pendientesPorCalificar->count() > 0)
            <div class="pendientes-list">
                @foreach($pendientesPorCalificar as $equipo)
                    <div class="pendiente-item">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h3 style="color: white; font-size: 18px; margin-bottom: 8px;">
                                    {{ $equipo->nombre }}
                                </h3>
                                <p style="color: rgba(255,255,255,0.6); margin-bottom: 5px;">
                                    Evento: {{ $equipo->evento->nombre }}
                                </p>
                                <p style="color: rgba(255,255,255,0.6);">
                                    Proyecto: {{ $equipo->proyecto->nombre }}
                                </p>
                            </div>
                            <a href="{{ route('judge.proyectos.evaluar', $equipo->proyecto->id) }}" 
                               class="btn-evaluar" 
                               style="width: auto; padding: 10px 25px; margin: 0;">
                                Evaluar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">✅</div>
                <p>¡No hay proyectos pendientes por evaluar!</p>
            </div>
        @endif
    </div>
</div>
@endsection