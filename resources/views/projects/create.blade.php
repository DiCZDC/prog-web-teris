<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-800 to-purple-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Botón Regresar -->
            <div class="mb-6">
                @if(isset($team) && $team)
                    <a href="{{ route('teams.show', $team) }}" 
                       class="inline-flex items-center text-white hover:text-yellow-300 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="font-medium">← Volver al equipo</span>
                    </a>
                @else
                    <a href="{{ route('teams.my-teams') }}" 
                       class="inline-flex items-center text-white hover:text-yellow-300 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="font-medium">← Mis equipos</span>
                    </a>
                @endif
            </div>

            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20">
                <!-- Encabezado -->
                <div class="bg-gradient-to-r from-purple-700 to-indigo-800 px-8 py-6">
                    <h1 class="text-3xl font-bold text-white flex items-center">
                        <i class="fas fa-cloud-upload-alt mr-3"></i>
                        Subir Proyecto para Evaluación
                    </h1>
                    <p class="text-white/90 mt-2">
                        @if(isset($team) && $team)
                            Para el equipo: <span class="font-bold text-yellow-300">{{ $team->nombre }}</span>
                            @if($team->evento)
                                - Evento: <span class="font-bold text-yellow-300">{{ $team->evento->nombre }}</span>
                            @endif
                        @else
                            Selecciona un equipo y proporciona los enlaces de tu proyecto
                        @endif
                    </p>
                </div>

                <!-- Formulario -->
                <div class="p-8">
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 text-red-200 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-3"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 text-green-200 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                        @csrf

                        <!-- Selección de equipo -->
                        @if(!isset($team) || !$team)
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-users mr-2"></i>Seleccionar Equipo
                                <span class="text-red-400 ml-1">*</span>
                            </label>
                            <select name="team_id" 
                                    required
                                    class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">-- Selecciona un equipo --</option>
                                @if(isset($misEquipos) && $misEquipos->count() > 0)
                                    @foreach($misEquipos as $equipoOption)
                                        <option value="{{ $equipoOption->id }}">
                                            {{ $equipoOption->nombre }} 
                                            @if($equipoOption->evento)
                                                - {{ $equipoOption->evento->nombre }}
                                            @endif
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('team_id')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            @if(!isset($misEquipos) || $misEquipos->count() === 0)
                                <div class="p-4 bg-yellow-500/20 border border-yellow-500/30 rounded-xl">
                                    <p class="text-yellow-200">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        No tienes equipos disponibles para subir proyectos.
                                        <a href="{{ route('teams.create') }}" class="text-yellow-300 underline ml-1">Crear un equipo</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                        @else
                            <input type="hidden" name="team_id" value="{{ $team->id }}">
                        @endif

                        <!-- Título del proyecto -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-heading mr-2"></i>Título del Proyecto
                                <span class="text-red-400 ml-1">*</span>
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   required
                                   value="{{ old('nombre') }}"
                                   placeholder="Ej: Sistema de Gestión de Eventos"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('nombre')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-align-left mr-2"></i>Descripción del Proyecto
                            </label>
                            <textarea name="descripcion" 
                                      rows="4"
                                      placeholder="Describe tu proyecto, tecnologías utilizadas, funcionalidades principales..."
                                      class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL del proyecto (principal) -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-link mr-2"></i>URL del Proyecto
                                <span class="text-red-400 ml-1">*</span>
                                <span class="block text-sm font-normal text-white/70 mt-1">(Enlace a tu proyecto desplegado - GitHub Pages, Vercel, Netlify, etc.)</span>
                            </label>
                            <input type="url" 
                                   name="url" 
                                   required
                                   value="{{ old('url') }}"
                                   placeholder="https://tuproyecto.com o https://github.com/usuario/proyecto"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('url')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-white/70 text-sm flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Este es el enlace principal que los jueces evaluarán
                            </p>
                        </div>

                        <!-- URL del repositorio -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fab fa-github mr-2"></i>Repositorio GitHub (Opcional)
                            </label>
                            <input type="url" 
                                   name="repositorio_url"
                                   value="{{ old('repositorio_url') }}"
                                   placeholder="https://github.com/usuario/repositorio"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('repositorio_url')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL de demo -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-play-circle mr-2"></i>URL de Demo (Opcional)
                            </label>
                            <input type="url" 
                                   name="demo_url"
                                   value="{{ old('demo_url') }}"
                                   placeholder="https://demo.tuproyecto.com"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('demo_url')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL de documentación -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-white">
                                <i class="fas fa-book mr-2"></i>Documentación (Opcional)
                            </label>
                            <input type="url" 
                                   name="documentacion_url"
                                   value="{{ old('documentacion_url') }}"
                                   placeholder="https://docs.tuproyecto.com"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('documentacion_url')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Información importante -->
                        <div class="p-4 bg-yellow-500/20 border border-yellow-500/30 rounded-xl">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-yellow-300 mt-1 mr-3"></i>
                                <div>
                                    <h3 class="font-bold text-yellow-300 mb-2">Importante</h3>
                                    <ul class="text-white/90 space-y-1 text-sm">
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Una vez subido el proyecto, los jueces asignados podrán evaluarlo</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Asegúrate de que todos los enlaces funcionen correctamente</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Solo el líder del equipo puede subir/editar el proyecto</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>Cada equipo solo puede tener un proyecto por evento</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="mr-2">•</span>
                                            <span>El proyecto debe estar relacionado con el evento del equipo</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between pt-6 border-t border-white/20">
                            @if(isset($team) && $team)
                                <a href="{{ route('teams.show', $team) }}" 
                                   class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Cancelar
                                </a>
                            @else
                                <a href="{{ route('teams.my-teams') }}" 
                                   class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Cancelar
                                </a>
                            @endif
                            
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-black font-bold rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-cloud-upload-alt mr-2"></i>Subir Proyecto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para validación básica -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validar URLs al salir del campo
            const urlInputs = document.querySelectorAll('input[type="url"]');
            urlInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    const value = this.value.trim();
                    if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
                        alert('Por favor, incluye https:// al inicio de la URL');
                        this.focus();
                    }
                });
            });

            // Validar formulario antes de enviar
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const teamSelect = document.querySelector('select[name="team_id"]');
                if (teamSelect && !teamSelect.value) {
                    event.preventDefault();
                    alert('Por favor selecciona un equipo');
                    teamSelect.focus();
                    return;
                }

                const titleInput = document.querySelector('input[name="nombre"]');
                if (!titleInput.value.trim()) {
                    event.preventDefault();
                    alert('Por favor ingresa un título para el proyecto');
                    titleInput.focus();
                    return;
                }

                const urlInput = document.querySelector('input[name="url"]');
                if (!urlInput.value.trim()) {
                    event.preventDefault();
                    alert('Por favor ingresa la URL del proyecto');
                    urlInput.focus();
                    return;
                }

                const urlValue = urlInput.value.trim();
                if (!urlValue.startsWith('http://') && !urlValue.startsWith('https://')) {
                    event.preventDefault();
                    alert('La URL debe comenzar con http:// o https://');
                    urlInput.focus();
                    return;
                }
            });
        });
    </script>
</x-app-layout>