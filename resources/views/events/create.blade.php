<style>
    *{
        color: black;
    }
    body {
        background-color: #f0f2f5;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
    }
</style>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <h1 class="text-2xl font-bold mb-6" style="color: black;">Crear Nuevo Evento</h1>
                    
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nombre del Evento -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Nombre del Evento *</label>
                            <input type="text" name="nombre" class="w-full border rounded px-3 py-2" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Descripción *</label>
                            <textarea name="descripcion" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Imagen del Evento *</label>
                            <input type="file" name="imagen" class="w-full border rounded px-3 py-2" accept="image/*" required>
                            <small class="text-gray-500">Formatos: jpeg, png, jpg, gif, webp. Máximo 2MB</small>
                            @error('imagen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fechas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block mb-2" style="color:black;">Fecha de Inicio *</label>
                                <input type="datetime-local" name="inicio_evento" class="w-full border rounded px-3 py-2" value="{{ old('inicio_evento') }}" required>
                                @error('inicio_evento')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-2" style="color:black;">Fecha de Fin *</label>
                                <input type="datetime-local" name="fin_evento" class="w-full border rounded px-3 py-2" value="{{ old('fin_evento') }}" required>
                                @error('fin_evento')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Estado y Modalidad -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block mb-2" style="color:black;">Estado *</label>
                                <select name="estado" class="w-full border rounded px-3 py-2" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-2" style="color:black;">Modalidad *</label>
                                <select name="modalidad" class="w-full border rounded px-3 py-2" required>
                                    <option value="">Seleccione una modalidad</option>
                                    <option value="Presencial" {{ old('modalidad') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="Virtual" {{ old('modalidad') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                    <option value="Híbrido" {{ old('modalidad') == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
                                @error('modalidad')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Ubicación (si aplica)</label>
                            <input type="text" name="ubicacion" class="w-full border rounded px-3 py-2" value="{{ old('ubicacion') }}">
                            @error('ubicacion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reglas -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Reglas *</label>
                            <textarea name="reglas" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('reglas') }}</textarea>
                            @error('reglas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Premios -->
                        <div class="mb-4">
                            <label class="block mb-2" style="color:black;">Premios *</label>
                            <textarea name="premios" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('premios') }}</textarea>
                            @error('premios')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ⭐ NUEVA SECCIÓN: ASIGNAR JUECES ⭐ -->
                        <div class="mb-6 border-t pt-4">
                            <label class="block mb-3 text-lg font-semibold" style="color:black;">
                                Asignar Jueces al Evento
                                <span class="text-gray-500 text-sm font-normal">(Opcional)</span>
                            </label>
                            
                            @if(isset($judges) && $judges->isNotEmpty())
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-300" style="max-height: 300px; overflow-y: auto;">
                                    <div class="space-y-2">
                                        @foreach($judges as $judge)
                                            <label class="flex items-center p-3 hover:bg-white rounded-lg cursor-pointer transition-colors border border-transparent hover:border-blue-300">
                                                <input 
                                                    type="checkbox" 
                                                    name="judges[]" 
                                                    value="{{ $judge->id }}"
                                                    class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500 judge-checkbox"
                                                    {{ is_array(old('judges')) && in_array($judge->id, old('judges')) ? 'checked' : '' }}
                                                >
                                                <div class="ml-3 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-medium" style="color: #1f2937;">
                                                            {{ $judge->name }}
                                                        </span>
                                                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                                            Juez
                                                        </span>
                                                    </div>
                                                    <span class="text-sm text-gray-600">{{ $judge->email }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Contador de jueces seleccionados -->
                                <div class="mt-2 flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span id="selected-count" style="color: #4b5563;">0 jueces seleccionados</span>
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-300">
                                    <svg class="w-16 h-16 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <p class="font-medium text-gray-700">No hay jueces disponibles</p>
                                    <p class="text-sm text-gray-500 mt-1">Crea usuarios con rol de juez primero</p>
                                </div>
                            @endif

                            @error('judges')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Evento Popular -->
                        <div class="mb-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="popular" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" {{ old('popular') ? 'checked' : '' }}>
                                <span class="ml-2" style="color:black;">Marcar como evento popular</span>
                            </label>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-3">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors">
                                Crear Evento
                            </button>
                            <a href="{{ route('events.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition-colors">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JavaScript para contador de jueces -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.judge-checkbox');
            const counter = document.getElementById('selected-count');
            
            function updateCounter() {
                const selected = document.querySelectorAll('.judge-checkbox:checked').length;
                counter.textContent = `${selected} juez${selected !== 1 ? 'es' : ''} seleccionado${selected !== 1 ? 's' : ''}`;
            }
            
            // Actualizar al cargar la página (por si hay valores old())
            updateCounter();
            
            // Actualizar al cambiar checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCounter);
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

</x-app-layout>