<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-800 to-purple-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="mb-6 p-6 bg-green-500/20 border-2 border-green-500/50 text-green-200 rounded-2xl shadow-xl animate-pulse">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-4xl text-green-400"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-green-300">¡Proyecto Subido Exitosamente!</h3>
                            <p class="mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Botón Regresar -->
            <div class="mb-6">
                <a href="{{ route('teams.show', $project->team) }}" 
                   class="inline-flex items-center text-white hover:text-yellow-300 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="font-medium">← Volver al equipo</span>
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20">
                <!-- Encabezado -->
                <div class="bg-gradient-to-r from-purple-700 to-indigo-800 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-white flex items-center">
                                <i class="fas fa-project-diagram mr-3"></i>
                                {{ $project->nombre }}
                            </h1>
                            <p class="text-white/90 mt-2">
                                Equipo: <span class="font-bold text-yellow-300">{{ $project->team->nombre }}</span>
                                @if($project->team->evento)
                                    - Evento: <span class="font-bold text-yellow-300">{{ $project->team->evento->nombre }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-4 py-2 bg-green-500/30 text-green-200 rounded-full text-sm font-semibold">
                                <i class="fas fa-check-circle mr-2"></i>
                                Proyecto Enviado
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Alerta de No Edición -->
                <div class="mx-8 mt-6 p-4 bg-yellow-500/20 border-l-4 border-yellow-500 rounded-r-xl">
                    <div class="flex items-start">
                        <i class="fas fa-lock text-yellow-300 text-xl mt-1 mr-3"></i>
                        <div>
                            <h3 class="font-bold text-yellow-300 mb-1">Proyecto Bloqueado</h3>
                            <p class="text-white/90 text-sm">
                                Este proyecto ha sido enviado y <strong>no puede ser editado</strong>. 
                                Los jueces ya pueden acceder a él para su evaluación.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contenido del Proyecto -->
                <div class="p-8 space-y-8">
                    
                    <!-- Descripción -->
                    @if($project->descripcion)
                    <div class="space-y-3">
                        <h2 class="text-xl font-bold text-white flex items-center border-b border-white/20 pb-2">
                            <i class="fas fa-align-left mr-2 text-yellow-400"></i>
                            Descripción del Proyecto
                        </h2>
                        <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                            <p class="text-white/90 leading-relaxed whitespace-pre-wrap">{{ $project->descripcion }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Enlaces del Proyecto -->
                    <div class="space-y-3">
                        <h2 class="text-xl font-bold text-white flex items-center border-b border-white/20 pb-2">
                            <i class="fas fa-link mr-2 text-yellow-400"></i>
                            Enlaces del Proyecto
                        </h2>
                        
                        <div class="grid gap-4">
                            <!-- URL Principal -->
                            <div class="bg-white/5 rounded-xl p-5 border border-white/10 hover:bg-white/10 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-globe text-blue-400 text-lg mr-2"></i>
                                            <h3 class="font-bold text-white">URL del Proyecto</h3>
                                            <span class="ml-2 px-2 py-1 bg-blue-500/30 text-blue-200 text-xs rounded-full">Principal</span>
                                        </div>
                                        <a href="{{ $project->url }}" 
                                           target="_blank" 
                                           class="text-blue-300 hover:text-blue-200 break-all inline-flex items-center">
                                            {{ $project->url }}
                                            <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Repositorio -->
                            @if($project->repositorio_url)
                            <div class="bg-white/5 rounded-xl p-5 border border-white/10 hover:bg-white/10 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <i class="fab fa-github text-purple-400 text-lg mr-2"></i>
                                            <h3 class="font-bold text-white">Repositorio GitHub</h3>
                                        </div>
                                        <a href="{{ $project->repositorio_url }}" 
                                           target="_blank" 
                                           class="text-purple-300 hover:text-purple-200 break-all inline-flex items-center">
                                            {{ $project->repositorio_url }}
                                            <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Demo -->
                            @if($project->demo_url)
                            <div class="bg-white/5 rounded-xl p-5 border border-white/10 hover:bg-white/10 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-play-circle text-green-400 text-lg mr-2"></i>
                                            <h3 class="font-bold text-white">Demo en Vivo</h3>
                                        </div>
                                        <a href="{{ $project->demo_url }}" 
                                           target="_blank" 
                                           class="text-green-300 hover:text-green-200 break-all inline-flex items-center">
                                            {{ $project->demo_url }}
                                            <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Documentación -->
                            @if($project->documentacion_url)
                            <div class="bg-white/5 rounded-xl p-5 border border-white/10 hover:bg-white/10 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-book text-yellow-400 text-lg mr-2"></i>
                                            <h3 class="font-bold text-white">Documentación</h3>
                                        </div>
                                        <a href="{{ $project->documentacion_url }}" 
                                           target="_blank" 
                                           class="text-yellow-300 hover:text-yellow-200 break-all inline-flex items-center">
                                            {{ $project->documentacion_url }}
                                            <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información de Envío -->
                    <div class="space-y-3">
                        <h2 class="text-xl font-bold text-white flex items-center border-b border-white/20 pb-2">
                            <i class="fas fa-info-circle mr-2 text-yellow-400"></i>
                            Información del Envío
                        </h2>
                        
                        <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-white/60 text-sm mb-1">Fecha de Envío</p>
                                    <p class="text-white font-semibold flex items-center">
                                        <i class="fas fa-calendar mr-2 text-blue-400"></i>
                                        {{ $project->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-white/60 text-sm mb-1">Hora de Envío</p>
                                    <p class="text-white font-semibold flex items-center">
                                        <i class="fas fa-clock mr-2 text-blue-400"></i>
                                        {{ $project->created_at->format('H:i:s') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-white/60 text-sm mb-1">Líder del Equipo</p>
                                    <p class="text-white font-semibold flex items-center">
                                        <i class="fas fa-user-tie mr-2 text-yellow-400"></i>
                                        {{ $project->team->lider->name }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-white/60 text-sm mb-1">Estado</p>
                                    <p class="text-white font-semibold flex items-center">
                                        <i class="fas fa-hourglass-half mr-2 text-green-400"></i>
                                        Pendiente de Evaluación
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="p-6 bg-blue-500/20 border border-blue-500/30 rounded-xl">
                        <div class="flex items-start">
                            <i class="fas fa-lightbulb text-blue-300 text-xl mt-1 mr-3"></i>
                            <div>
                                <h3 class="font-bold text-blue-300 mb-2">Próximos Pasos</h3>
                                <ul class="text-white/90 space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <span class="mr-2">✓</span>
                                        <span>Tu proyecto ha sido registrado exitosamente</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2">✓</span>
                                        <span>Los jueces asignados recibirán una notificación</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2">✓</span>
                                        <span>Podrás ver las evaluaciones cuando estén disponibles</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="mr-2">✓</span>
                                        <span>Mantente atento a actualizaciones sobre el evento</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-between pt-6 border-t border-white/20">
                        <a href="{{ route('teams.show', $project->team) }}" 
                           class="px-6 py-3 bg-white/10 border border-white/30 text-white rounded-xl hover:bg-white/20 transition-all duration-200 flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Volver al Equipo
                        </a>
                        
                        <a href="{{ route('teams.my-teams') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-700 text-white font-bold rounded-xl hover:from-purple-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            Ver Mis Equipos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para animación del mensaje de éxito -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quitar la animación después de 3 segundos
            const successMessage = document.querySelector('.animate-pulse');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.classList.remove('animate-pulse');
                }, 3000);
            }
        });
    </script>
</x-app-layout>