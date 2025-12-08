{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard - Administrador')

@push('styles')
<style>
    .admin-dashboard {
        background: linear-gradient(135deg, #0c2461 0%, #1e3799 100%);
        min-height: 100vh;
        padding: 30px;
    }

    .admin-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .admin-title {
        font-size: 42px;
        font-weight: bold;
        color: #ffd700;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        margin-bottom: 10px;
    }

    .admin-subtitle {
        color: rgba(255,255,255,0.8);
        font-size: 18px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.15);
    }

    .stat-number {
        font-size: 48px;
        font-weight: bold;
        color: #ffd700;
        margin-bottom: 10px;
    }

    .stat-label {
        color: rgba(255,255,255,0.9);
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-detail {
        color: rgba(255,255,255,0.7);
        font-size: 14px;
        margin-top: 5px;
    }

    .sections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .section-card {
        background: rgba(0,0,0,0.3);
        border-radius: 15px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .section-title {
        font-size: 22px;
        color: #ffd700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255,215,0,0.3);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .item-name {
        color: white;
        font-weight: bold;
    }

    .item-date {
        color: rgba(255,255,255,0.6);
        font-size: 14px;
    }

    .item-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .status-active {
        background: rgba(76, 175, 80, 0.2);
        color: #4CAF50;
    }

    .status-inactive {
        background: rgba(244, 67, 54, 0.2);
        color: #f44336;
    }

    .view-all {
        display: inline-block;
        margin-top: 15px;
        padding: 8px 20px;
        background: rgba(255,215,0,0.2);
        border: 1px solid #ffd700;
        color: #ffd700;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .view-all:hover {
        background: rgba(255,215,0,0.3);
        transform: translateY(-2px);
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 30px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 10px;
        text-decoration: none;
        color: white;
        transition: all 0.3s;
    }

    .action-btn:hover {
        background: rgba(255,255,255,0.12);
        transform: translateY(-3px);
        border-color: #ffd700;
    }

    .action-icon {
        font-size: 28px;
        color: #ffd700;
    }

    .action-text {
        font-weight: bold;
        font-size: 16px;
    }
</style>
@endpush

@section('content')
<div class="admin-dashboard">
    <div class="admin-header">
        <h1 class="admin-title">👨‍💼 Panel de Administración</h1>
        <p class="admin-subtitle">Bienvenido, {{ auth()->user()->name }}</p>
    </div>

    <!-- Estadísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_eventos'] }}</div>
            <div class="stat-label">Total Eventos</div>
            <div class="stat-detail">{{ $stats['eventos_activos'] }} activos</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_usuarios'] }}</div>
            <div class="stat-label">Total Usuarios</div>
            <div class="stat-detail">{{ $stats['total_jueces'] }} jueces</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_equipos'] }}</div>
            <div class="stat-label">Total Equipos</div>
            <div class="stat-detail">Registrados</div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions">
        <a href="{{ route('events.create') }}" class="action-btn">
            <div class="action-icon">➕</div>
            <div class="action-text">Crear Evento</div>
        </a>
        
        <a href="{{ route('admin.jueces.index') }}" class="action-btn">
            <div class="action-icon">👨‍⚖️</div>
            <div class="action-text">Gestionar Jueces</div>
        </a>
        
        <a href="{{ route('admin.usuarios.index') }}" class="action-btn">
            <div class="action-icon">👥</div>
            <div class="action-text">Gestionar Usuarios</div>
        </a>
        
        <a href="{{ route('admin.equipos.index') }}" class="action-btn">
            <div class="action-icon">🏢</div>
            <div class="action-text">Gestionar Equipos</div>
        </a>
    </div>

    <!-- Secciones de Información -->
    <div class="sections-grid">
        <!-- Eventos Recientes -->
        <div class="section-card">
            <h2 class="section-title">📅 Eventos Recientes</h2>
            @foreach($eventosRecientes as $evento)
                <div class="list-item">
                    <div>
                        <div class="item-name">{{ $evento->nombre }}</div>
                        <div class="item-date">
                            {{ $evento->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                    <span class="item-status {{ $evento->estado == 'Activo' ? 'status-active' : 'status-inactive' }}">
                        {{ $evento->estado }}
                    </span>
                </div>
            @endforeach
            <a href="{{ route('events.index') }}" class="view-all">Ver todos los eventos →</a>
        </div>

        <!-- Usuarios Recientes -->
        <div class="section-card">
            <h2 class="section-title">👤 Usuarios Recientes</h2>
            @foreach($usuariosRecientes as $usuario)
                <div class="list-item">
                    <div>
                        <div class="item-name">{{ $usuario->name }}</div>
                        <div class="item-date">{{ $usuario->email }}</div>
                    </div>
                    <span class="item-status status-active">
                        {{ $usuario->created_at->format('d/m/Y') }}
                    </span>
                </div>
            @endforeach
            <a href="{{ route('admin.usuarios.index') }}" class="view-all">Ver todos los usuarios →</a>
        </div>
    </div>
</div>
@endsection