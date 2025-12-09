@extends('layouts.app')

@section('title', 'Gestión de Equipos - Admin')

@push('styles')
<style>
    .admin-equipos {
        min-height: 100vh;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 40px 20px;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .title {
        font-size: 42px;
        font-weight: bold;
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-back {
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: #ffd700;
        transform: translateX(-5px);
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .stat-number {
        font-size: 42px;
        font-weight: bold;
        color: #ffd700;
        margin-bottom: 10px;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 16px;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    thead tr {
        background: rgba(255, 215, 0, 0.1);
        border-radius: 10px;
    }

    th {
        padding: 15px 20px;
        text-align: left;
        color: #ffd700;
        font-weight: bold;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    th:first-child {
        border-radius: 10px 0 0 10px;
    }

    th:last-child {
        border-radius: 0 10px 10px 0;
    }

    tbody tr {
        background: rgba(255, 255, 255, 0.03);
        transition: all 0.3s;
    }

    tbody tr:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateX(5px);
    }

    td {
        padding: 20px;
        color: rgba(255, 255, 255, 0.9);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    td:first-child {
        border-left: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 10px 0 0 10px;
    }

    td:last-child {
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 0 10px 10px 0;
    }

    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .badge-activo {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .badge-inactivo {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-completo {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
        margin: 0 5px;
    }

    .btn-ver {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .btn-ver:hover {
        background: rgba(59, 130, 246, 0.3);
        transform: translateY(-2px);
    }

    .btn-banear {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-banear:hover {
        background: rgba(239, 68, 68, 0.3);
        transform: translateY(-2px);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: rgba(255, 255, 255, 0.5);
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="admin-equipos">
    <div class="container">
        <div class="header">
            <h1 class="title">👥 Gestión de Equipos</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                ← Volver al Dashboard
            </a>
        </div>

        <!-- Estadísticas -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number">{{ $equipos->total() }}</div>
                <div class="stat-label">Total Equipos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $equipos->where('estado', true)->count() }}</div>
                <div class="stat-label">Equipos Activos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{ $equipos->filter(function($equipo) {
                        return $equipo->estaCompleto();
                    })->count() }}
                </div>
                <div class="stat-label">Equipos Completos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{ $equipos->filter(function($equipo) {
                        return $equipo->tieneProyecto();
                    })->count() }}
                </div>
                <div class="stat-label">Con Proyecto</div>
            </div>
        </div>

        <!-- Tabla de equipos -->
        <div class="table-container">
            @if($equipos->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Líder</th>
                            <th>Evento</th>
                            <th>Miembros</th>
                            <th>Estado</th>
                            <th>Creado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipos as $equipo)
                            <tr>
                                <td><strong>#{{ $equipo->id }}</strong></td>
                                <td>
                                    <strong>{{ $equipo->nombre }}</strong>
                                    @if($equipo->estaCompleto())
                                        <span class="badge badge-completo" style="margin-left: 10px;">
                                            ✓ Completo
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $equipo->lider->name ?? 'Sin líder' }}
                                    <br>
                                    <small style="opacity: 0.6;">{{ $equipo->lider->email ?? '' }}</small>
                                </td>
                                <td>
                                    {{ $equipo->evento->nombre ?? 'Sin evento' }}
                                </td>
                                <td>
                                    <strong>{{ $equipo->contarMiembros() }}/4</strong>
                                </td>
                                <td>
                                    @if($equipo->estado)
                                        <span class="badge badge-activo">✓ Activo</span>
                                    @else
                                        <span class="badge badge-inactivo">✗ Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $equipo->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.equipos.show', $equipo->id) }}" 
                                       class="btn-action btn-ver">
                                        👁️ Ver
                                    </a>
                                    
                                    @if($equipo->estado)
                                        <form action="{{ route('admin.equipos.banear', $equipo->id) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                    class="btn-action btn-banear"
                                                    onclick="return confirm('¿Desactivar este equipo?')">
                                                🚫 Banear
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.equipos.desbanear', $equipo->id) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                    class="btn-action btn-ver"
                                                    onclick="return confirm('¿Reactivar este equipo?')">
                                                ✓ Activar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="pagination">
                    {{ $equipos->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <p style="font-size: 20px;">No hay equipos registrados aún</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
<x-app-layout>
    
    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Botón Regresar -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-100 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">← Regresar</span>
                </a>
            </div>
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white-800 mb-2">
                <i class="fas fa-users mr-3"></i>Gestión de Equipos
            </h1>
            <p class="text-gray-600">Administra los equipos creados</p>
        </div>
        
        <!-- Mensajes Flash -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        
        <!-- Tabla de Usuarios -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Lista de Usuarios</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de Creación:</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($equipos as $equipo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $equipo->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $equipo->nombre}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $equipo->evento->nombre ?? 'Sin evento' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $equipo->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.equipos.show', $equipo->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-users-slash text-4xl mb-4 block"></i>
                                No hay usuarios registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            @if($equipos->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $equipos->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
    <!-- JavaScript simple -->
    <script>
        function showChangeRoleModal(userId, userName, currentRole) {
            alert('Funcionalidad para cambiar rol de ' + userName + ' (Actual: ' + currentRole + ')\n\nID: ' + userId);
            // En una implementación real, esto abriría un modal
        }
    </script>

{{-- </body>
</html> --}}
