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


<x-app-layout>
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
