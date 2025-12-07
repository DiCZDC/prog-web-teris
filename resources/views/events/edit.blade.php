@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Evento: {{ $event->nombre }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Evento *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $event->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $event->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            @if($event->imagen)
                                <div class="mb-2">
                                    <img src="{{ asset($event->imagen) }}" alt="{{ $event->nombre }}" style="max-width: 200px;" class="img-thumbnail">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                            <small class="text-muted">Dejar vacío para mantener la imagen actual. Formatos: jpeg, png, jpg, gif, webp. Máximo 2MB</small>
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inicio_evento" class="form-label">Fecha de Inicio *</label>
                                <input type="datetime-local" class="form-control @error('inicio_evento') is-invalid @enderror" id="inicio_evento" name="inicio_evento" value="{{ old('inicio_evento', $event->inicio_evento->format('Y-m-d\TH:i')) }}" required>
                                @error('inicio_evento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin_evento" class="form-label">Fecha de Fin *</label>
                                <input type="datetime-local" class="form-control @error('fin_evento') is-invalid @enderror" id="fin_evento" name="fin_evento" value="{{ old('fin_evento', $event->fin_evento->format('Y-m-d\TH:i')) }}" required>
                                @error('fin_evento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                    <option value="Activo" {{ old('estado', $event->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $event->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="modalidad" class="form-label">Modalidad *</label>
                                <select class="form-control @error('modalidad') is-invalid @enderror" id="modalidad" name="modalidad" required>
                                    <option value="Presencial" {{ old('modalidad', $event->modalidad) == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="Virtual" {{ old('modalidad', $event->modalidad) == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                    <option value="Híbrido" {{ old('modalidad', $event->modalidad) == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
                                @error('modalidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $event->ubicacion) }}">
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reglas" class="form-label">Reglas *</label>
                            <textarea class="form-control @error('reglas') is-invalid @enderror" id="reglas" name="reglas" rows="4" required>{{ old('reglas', $event->reglas) }}</textarea>
                            @error('reglas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="premios" class="form-label">Premios *</label>
                            <textarea class="form-control @error('premios') is-invalid @enderror" id="premios" name="premios" rows="4" required>{{ old('premios', $event->premios) }}</textarea>
                            @error('premios')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ⭐ SECCIÓN DE JUECES MEJORADA ⭐ -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Asignar Jueces al Evento
                                <span class="text-muted fw-normal">(Opcional)</span>
                            </label>
                            
                            @if(isset($judges) && $judges->isNotEmpty())
                                <div class="card">
                                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                        @foreach($judges as $judge)
                                            <div class="form-check mb-2 p-2 rounded hover-bg-light">
                                                <input 
                                                    class="form-check-input judge-checkbox" 
                                                    type="checkbox" 
                                                    name="judges[]" 
                                                    value="{{ $judge->id }}" 
                                                    id="judge{{ $judge->id }}"
                                                    {{ (is_array(old('judges')) && in_array($judge->id, old('judges'))) || (!old('judges') && $event->judges->contains($judge->id)) ? 'checked' : '' }}
                                                >
                                                <label class="form-check-label w-100" for="judge{{ $judge->id }}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $judge->name }}</strong>
                                                            <br>
                                                            <small class="text-muted">{{ $judge->email }}</small>
                                                        </div>
                                                        <span class="badge bg-primary">Juez</span>
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Contador de jueces -->
                                <small class="text-muted d-flex align-items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    <span id="selected-count">
                                        {{ $event->judges->count() }} juez{{ $event->judges->count() !== 1 ? 'es' : '' }} seleccionado{{ $event->judges->count() !== 1 ? 's' : '' }}
                                    </span>
                                </small>
                            @else
                                <div class="alert alert-info">
                                    <strong>No hay jueces disponibles</strong>
                                    <p class="mb-0">Crea usuarios con rol de juez primero para poder asignarlos al evento.</p>
                                </div>
                            @endif

                            @error('judges')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="popular" id="popular" value="1" {{ old('popular', $event->popular) ? 'checked' : '' }}>
                            <label class="form-check-label" for="popular">
                                Marcar como Evento Popular
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para contador de jueces -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.judge-checkbox');
        const counter = document.getElementById('selected-count');
        
        function updateCounter() {
            const selected = document.querySelectorAll('.judge-checkbox:checked').length;
            counter.textContent = `${selected} juez${selected !== 1 ? 'es' : ''} seleccionado${selected !== 1 ? 's' : ''}`;
        }
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateCounter);
        });
    });
</script>

<style>
    .hover-bg-light:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
</style>
@endsection