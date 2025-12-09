@extends('layouts.admin')

@section('title', 'Gestión de Ganadores - ' . $evento->nombre)

@section('content')
<div class="container-fluid py-4">
    <!-- Header del evento -->
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-primary fs-6 p-2">
                                <i class="fas fa-trophy me-2"></i>Ganadores
                            </span>
                        </div>
                        <div>
                            <h1 class="h3 mb-1">{{ $evento->nombre }}</h1>
                            <p class="text-muted mb-0">{{ $evento->descripcion }}</p>
                            <div class="d-flex gap-3 mt-2">
                                <span class="text-muted">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ $evento->inicio_evento->format('d/m/Y') }} - {{ $evento->fin_evento->format('d/m/Y') }}
                                </span>
                                <span class="text-muted">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $evento->teams->count() }} equipos
                                </span>
                                @if($evento->hasPublishedWinners())
                                <span class="badge bg-success">
                                    <i class="fas fa-eye me-1"></i>Publicado
                                </span>
                                @else
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-eye-slash me-1"></i>No publicado
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="btn-group">
                        <a href="{{ route('admin.events.show', $evento->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Volver al evento
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Todos los eventos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sección de Ganadores Asignados -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-medal me-2"></i>Podio de Ganadores
                        </h4>
                        @if($ganadores->count() > 0)
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('admin.events.winners.publish', $evento->id) }}" 
                                          method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" 
                                                @if($ganadores->count() < 3) disabled @endif>
                                            <i class="fas fa-eye me-2"></i>
                                            {{ $evento->hasPublishedWinners() ? 'Ocultar ganadores' : 'Publicar ganadores' }}
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" 
                                            onclick="confirmReset()">
                                        <i class="fas fa-redo me-2"></i>Reiniciar podio
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($ganadores->count() > 0)
                        <!-- 1er Lugar -->
                        <div class="text-center mb-4 p-4 rounded-3" 
                             style="background: linear-gradient(135deg, #FFD700 0%, #FFEC8B 100%); border: 3px solid #FFD700;">
                            <div class="mb-3">
                                <h1 class="display-1">🥇</h1>
                            </div>
                            <h3 class="text-dark mb-2">1er Lugar</h3>
                            <h4 class="text-dark mb-2">{{ $ganadores->firstWhere('position', '1')->team->nombre ?? 'Sin asignar' }}</h4>
                            @if($ganador = $ganadores->firstWhere('position', '1'))
                            <div class="mb-2">
                                <span class="badge bg-dark fs-6 p-2">
                                    Puntaje: {{ $ganador->final_score }}
                                </span>
                            </div>
                            <p class="text-dark mb-3">
                                {{ $ganador->recognition ?? 'Sin reconocimiento especial' }}
                            </p>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-dark" data-bs-toggle="modal" 
                                        data-bs-target="#editRecognitionModal" 
                                        data-winner-id="{{ $ganador->id }}"
                                        data-recognition="{{ $ganador->recognition }}">
                                    <i class="fas fa-edit me-1"></i>Editar reconocimiento
                                </button>
                                <form action="{{ route('admin.events.winners.remove', [$evento->id, $ganador->id]) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Eliminar 1er lugar?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>

                        <!-- 2do y 3er Lugar en fila -->
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" 
                                     style="background: linear-gradient(135deg, #C0C0C0 0%, #E8E8E8 100%); border: 2px solid #C0C0C0;">
                                    <h2 class="mb-2">🥈</h2>
                                    <h5 class="text-dark mb-1">2do Lugar</h5>
                                    <h6 class="text-dark mb-2">{{ $ganadores->firstWhere('position', '2')->team->nombre ?? 'Sin asignar' }}</h6>
                                    @if($ganador = $ganadores->firstWhere('position', '2'))
                                    <span class="badge bg-dark">
                                        Puntaje: {{ $ganador->final_score }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" 
                                     style="background: linear-gradient(135deg, #CD7F32 0%, #E6B87E 100%); border: 2px solid #CD7F32;">
                                    <h2 class="mb-2">🥉</h2>
                                    <h5 class="text-dark mb-1">3er Lugar</h5>
                                    <h6 class="text-dark mb-2">{{ $ganadores->firstWhere('position', '3')->team->nombre ?? 'Sin asignar' }}</h6>
                                    @if($ganador = $ganadores->firstWhere('position', '3'))
                                    <span class="badge bg-dark">
                                        Puntaje: {{ $ganador->final_score }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Acciones de publicación -->
                        @if($evento->hasPublishedWinners())
                        <div class="alert alert-success mt-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle fs-4 me-3"></i>
                                <div>
                                    <h5 class="mb-1">¡Ganadores publicados!</h5>
                                    <p class="mb-0">Los ganadores son visibles públicamente.</p>
                                </div>
                            </div>
                        </div>
                        @elseif($ganadores->count() >= 3)
                        <div class="mt-4">
                            <form action="{{ route('admin.events.winners.publish', $evento->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-bullhorn me-2"></i>Publicar ganadores
                                </button>
                            </form>
                        </div>
                        @endif

                    @else
                        <!-- Estado vacío -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-trophy fa-4x text-muted"></i>
                            </div>
                            <h4 class="text-muted mb-3">Sin ganadores asignados</h4>
                            <p class="text-muted mb-4">
                                Aún no se han asignado ganadores para este evento.
                            </p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="assignAutomatic()">
                                    <i class="fas fa-robot me-2"></i>Asignar automáticamente
                                </button>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" 
                                        data-bs-target="#manualAssignModal">
                                    <i class="fas fa-edit me-2"></i>Asignar manualmente
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h2 class="text-primary">{{ $equipos->count() }}</h2>
                                <small class="text-muted">Equipos con proyecto</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h2 class="text-success">{{ $ganadores->count() }}/3</h2>
                                <small class="text-muted">Ganadores asignados</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded">
                                <h2 class="text-info">{{ $equipos->first()->promedio_evaluaciones ?? 0 }}</h2>
                                <small class="text-muted">Mejor puntaje</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded">
                                <h2 class="text-warning">{{ $equipos->avg('total_evaluaciones') ?? 0 }}</h2>
                                <small class="text-muted">Avg. evaluaciones</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Equipos para asignar -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users me-2"></i>Equipos Evaluados
                            <span class="badge bg-primary ms-2">{{ $equipos->count() }}</span>
                        </h4>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="assignAutomatic()">
                                <i class="fas fa-robot me-1"></i>Asignar automático
                            </button>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                    data-bs-target="#manualAssignModal">
                                <i class="fas fa-edit me-1"></i>Asignar manual
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($equipos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Posición</th>
                                        <th>Equipo</th>
                                        <th>Líder</th>
                                        <th class="text-center">Evaluaciones</th>
                                        <th class="text-center">Puntaje Promedio</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($equipos as $index => $equipo)
                                    @php
                                        $esGanador = $ganadores->contains('team_id', $equipo->id);
                                        $posicionGanador = $esGanador ? $ganadores->firstWhere('team_id', $equipo->id)->position : null;
                                    @endphp
                                    <tr class="@if($esGanador) table-success @elseif($index < 3) table-warning @endif">
                                        <td>
                                            @if($esGanador)
                                                <span class="badge bg-success">
                                                    {{ $posicionGanador }}º Lugar
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">#{{ $index + 1 }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($esGanador)
                                                    <i class="fas fa-crown me-2" 
                                                       style="color: @if($posicionGanador == 1) #FFD700 @elseif($posicionGanador == 2) #C0C0C0 @else #CD7F32 @endif"></i>
                                                @endif
                                                <div>
                                                    <strong>{{ $equipo->nombre }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $equipo->proyecto->nombre ?? 'Sin proyecto' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $equipo->lider->name ?? 'Sin líder' }}
                                            <br>
                                            <small class="text-muted">{{ $equipo->lider->email ?? '' }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info">
                                                {{ $equipo->total_evaluaciones }} eval.
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="progress" style="width: 80px; height: 20px;">
                                                    <div class="progress-bar bg-{{ $equipo->promedio_evaluaciones >= 8 ? 'success' : ($equipo->promedio_evaluaciones >= 6 ? 'warning' : 'danger') }}" 
                                                         role="progressbar" 
                                                         style="width: {{ $equipo->promedio_evaluaciones * 10 }}%">
                                                    </div>
                                                </div>
                                                <span class="ms-2 fw-bold">
                                                    {{ $equipo->promedio_evaluaciones }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if(!$esGanador)
                                            <button class="btn btn-sm btn-outline-primary" 
                                                    onclick="assignTeamToPosition({{ $equipo->id }}, {{ $index + 1 }}, '{{ $equipo->nombre }}')">
                                                <i class="fas fa-medal me-1"></i>Asignar como ganador
                                            </button>
                                            @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Asignado
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Leyenda -->
                        <div class="mt-3">
                            <div class="d-flex gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success me-2" style="width: 15px; height: 15px;"></div>
                                    <small>Equipo ganador</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning me-2" style="width: 15px; height: 15px;"></div>
                                    <small>Top 3 por puntaje</small>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users-slash fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No hay equipos evaluados</h4>
                            <p class="text-muted">
                                Los equipos deben tener proyectos y evaluaciones para aparecer aquí.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Instrucciones -->
            <div class="card shadow mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Instrucciones</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">1</span>
                                </div>
                                <div>
                                    <h6>Asignar ganadores</h6>
                                    <p class="small text-muted mb-0">
                                        Puedes asignar automáticamente basado en puntajes o manualmente seleccionando equipos.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">2</span>
                                </div>
                                <div>
                                    <h6>Personalizar reconocimientos</h6>
                                    <p class="small text-muted mb-0">
                                        Agrega mensajes especiales para cada ganador antes de publicar.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">3</span>
                                </div>
                                <div>
                                    <h6>Publicar resultados</h6>
                                    <p class="small text-muted mb-0">
                                        Una vez asignados los 3 lugares, publícalos para que sean visibles.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Asignación Manual -->
<div class="modal fade" id="manualAssignModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Asignar Ganadores Manualmente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.events.winners.assign-manual', $evento->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Selecciona los equipos para cada posición y define sus puntajes finales.
                    </div>

                    <!-- 1er Lugar -->
                    <div class="card mb-3 border-primary">
                        <div class="card-header bg-primary bg-opacity-10">
                            <h6 class="mb-0">
                                <span class="badge bg-warning me-2">🥇</span>
                                1er Lugar
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Seleccionar equipo</label>
                                    <select name="first_place" class="form-select" required>
                                        <option value="">Seleccionar equipo...</option>
                                        @foreach($equipos as $equipo)
                                        <option value="{{ $equipo->id }}" 
                                                data-score="{{ $equipo->promedio_evaluaciones }}">
                                            {{ $equipo->nombre }} (Puntaje: {{ $equipo->promedio_evaluaciones }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Puntaje final</label>
                                    <input type="number" name="first_place_score" 
                                           class="form-control" step="0.01" min="0" max="10" 
                                           placeholder="Ej: 8.5" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Reconocimiento especial (opcional)</label>
                                    <textarea name="first_place_recognition" class="form-control" 
                                              rows="2" placeholder="Mensaje especial para el ganador..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2do Lugar -->
                    <div class="card mb-3 border-secondary">
                        <div class="card-header bg-secondary bg-opacity-10">
                            <h6 class="mb-0">
                                <span class="badge bg-secondary me-2">🥈</span>
                                2do Lugar
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Seleccionar equipo</label>
                                    <select name="second_place" class="form-select" required>
                                        <option value="">Seleccionar equipo...</option>
                                        @foreach($equipos as $equipo)
                                        <option value="{{ $equipo->id }}"
                                                data-score="{{ $equipo->promedio_evaluaciones }}">
                                            {{ $equipo->nombre }} (Puntaje: {{ $equipo->promedio_evaluaciones }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Puntaje final</label>
                                    <input type="number" name="second_place_score" 
                                           class="form-control" step="0.01" min="0" max="10" 
                                           placeholder="Ej: 7.8" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Reconocimiento especial (opcional)</label>
                                    <textarea name="second_place_recognition" class="form-control" 
                                              rows="2" placeholder="Mensaje especial..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3er Lugar -->
                    <div class="card mb-3 border-warning">
                        <div class="card-header bg-warning bg-opacity-10">
                            <h6 class="mb-0">
                                <span class="badge bg-warning me-2" style="background-color: #CD7F32 !important">🥉</span>
                                3er Lugar
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Seleccionar equipo</label>
                                    <select name="third_place" class="form-select" required>
                                        <option value="">Seleccionar equipo...</option>
                                        @foreach($equipos as $equipo)
                                        <option value="{{ $equipo->id }}"
                                                data-score="{{ $equipo->promedio_evaluaciones }}">
                                            {{ $equipo->nombre }} (Puntaje: {{ $equipo->promedio_evaluaciones }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Puntaje final</label>
                                    <input type="number" name="third_place_score" 
                                           class="form-control" step="0.01" min="0" max="10" 
                                           placeholder="Ej: 7.2" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Reconocimiento especial (opcional)</label>
                                    <textarea name="third_place_recognition" class="form-control" 
                                              rows="2" placeholder="Mensaje especial..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar asignación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Editar Reconocimiento -->
<div class="modal fade" id="editRecognitionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Reconocimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editRecognitionForm" method="POST">
                @csrf 
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="winnerId" name="winner_id">
                    <div class="mb-3">
                        <label class="form-label">Mensaje de reconocimiento</label>
                        <textarea name="recognition" id="recognitionText" class="form-control" 
                                  rows="4" placeholder="Escribe un mensaje especial para el ganador..."></textarea>
                        <small class="text-muted">Máximo 500 caracteres</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Función para asignar automáticamente
function assignAutomatic() {
    if (confirm('¿Asignar ganadores automáticamente basado en los puntajes más altos?')) {
        window.location.href = "{{ route('admin.events.winners.assign-automatic', $evento->id) }}";
    }
}

// Función para confirmar reinicio
function confirmReset() {
    if (confirm('¿Estás seguro de eliminar todos los ganadores asignados?')) {
        // Aquí puedes agregar lógica para eliminar todos los ganadores
        // Por ahora solo recargamos la página
        window.location.reload();
    }
}

// Asignar equipo a posición específica
function assignTeamToPosition(teamId, position, teamName) {
    let posicionTexto = '';
    switch(position) {
        case 1: posicionTexto = '1er Lugar'; break;
        case 2: posicionTexto = '2do Lugar'; break;
        case 3: posicionTexto = '3er Lugar'; break;
    }
    
    if (confirm(`¿Asignar "${teamName}" como ${posicionTexto}?`)) {
        // Aquí puedes implementar asignación directa via AJAX
        alert('Función para asignación directa en desarrollo');
    }
}

// Configurar modal de edición de reconocimiento
document.addEventListener('DOMContentLoaded', function() {
    const editRecognitionModal = document.getElementById('editRecognitionModal');
    if (editRecognitionModal) {
        editRecognitionModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const winnerId = button.getAttribute('data-winner-id');
            const recognition = button.getAttribute('data-recognition');
            
            document.getElementById('winnerId').value = winnerId;
            document.getElementById('recognitionText').value = recognition || '';
            
            // Actualizar formulario con la ruta correcta
            const form = document.getElementById('editRecognitionForm');
            form.action = `/admin/events/{{ $evento->id }}/winners/${winnerId}/recognition`;
        });
    }
    
    // Auto-completar puntajes en selección manual
    const placeSelects = document.querySelectorAll('select[name^="first_place"], select[name^="second_place"], select[name^="third_place"]');
    placeSelects.forEach(select => {
        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const scoreInput = this.closest('.row').querySelector('input[type="number"]');
            if (selectedOption && scoreInput) {
                const teamScore = selectedOption.getAttribute('data-score');
                if (teamScore && !scoreInput.value) {
                    scoreInput.value = parseFloat(teamScore).toFixed(2);
                }
            }
        });
    });
});

// Validar que no se repitan equipos en asignación manual
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#manualAssignModal form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const first = form.querySelector('select[name="first_place"]').value;
            const second = form.querySelector('select[name="second_place"]').value;
            const third = form.querySelector('select[name="third_place"]').value;
            
            if (first === second || first === third || second === third) {
                e.preventDefault();
                alert('⚠️ Error: No puedes seleccionar el mismo equipo para diferentes posiciones.');
            }
        });
    }
});
</script>

<style>
.card-header.bg-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.table-hover tbody tr:hover {
    transform: translateY(-2px);
    transition: transform 0.2s;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.badge.bg-warning {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
}

.badge.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
}
</style>
@endpush