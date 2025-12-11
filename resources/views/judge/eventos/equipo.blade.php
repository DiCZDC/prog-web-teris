<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-800 to-purple-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            <!-- Breadcrumb / Navegación -->
            <div class="mb-6">
                {{-- CORREGIDO: Usar array con nombre de parámetro explícito --}}
                <a href="{{ route('judge.eventos.equipos', ['evento' => $equipo->evento_id]) }}" 
                   class="inline-flex items-center text-white hover:text-yellow-300 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="font-medium">← Volver a equipos del evento</span>
                </a>
            </div>

            <!-- Título -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">
                    <i class="fas fa-users mr-3"></i>{{ $equipo->nombre }}
                </h1>
                <p class="text-white/80 text-lg">
                    Evento: <span class="font-semibold text-yellow-300">{{ $equipo->evento->nombre }}</span>
                </p>
            </div>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 text-green-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 text-red-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Columna Izquierda: Información del Equipo -->
                <div class="lg:col-span-1 space-y-6">
                    
                    <!-- Card de Información del Equipo -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                        <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/20 pb-3">
                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                            Información del Equipo
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-white/60 text-sm mb-1">Código del Equipo</p>
                                <p class="text-white font-semibold text-lg">{{ $equipo->codigo }}</p>
                            </div>

                            @if($equipo->descripcion)
                            <div>
                                <p class="text-white/60 text-sm mb-1">Descripción</p>
                                <p class="text-white/90">{{ $equipo->descripcion }}</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-white/60 text-sm mb-1">Estado</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $equipo->estado ? 'bg-green-500/30 text-green-200' : 'bg-gray-500/30 text-gray-200' }}">
                                    <i class="fas fa-circle text-xs mr-2"></i>
                                    {{ $equipo->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card de Integrantes -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                        <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/20 pb-3">
                            <i class="fas fa-user-friends mr-2 text-purple-400"></i>
                            Integrantes
                        </h2>
                        
                        <div class="space-y-3">
                            <!-- Líder -->
                            @if($equipo->lider)
                            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-3">
                                <p class="text-yellow-300 text-xs font-bold uppercase mb-1">
                                    <i class="fas fa-crown mr-1"></i>Líder
                                </p>
                                <p class="text-white font-semibold">{{ $equipo->lider->name }}</p>
                                <p class="text-white/60 text-sm">{{ $equipo->lider->email }}</p>
                            </div>
                            @endif

                            <!-- Diseñador -->
                            @if($equipo->disenador)
                            <div class="bg-white/5 border border-white/10 rounded-lg p-3">
                                <p class="text-purple-300 text-xs font-bold uppercase mb-1">
                                    <i class="fas fa-palette mr-1"></i>Diseñador
                                </p>
                                <p class="text-white">{{ $equipo->disenador->name }}</p>
                            </div>
                            @endif

                            <!-- Programador Front -->
                            @if($equipo->frontprog)
                            <div class="bg-white/5 border border-white/10 rounded-lg p-3">
                                <p class="text-blue-300 text-xs font-bold uppercase mb-1">
                                    <i class="fas fa-code mr-1"></i>Programador Front
                                </p>
                                <p class="text-white">{{ $equipo->frontprog->name }}</p>
                            </div>
                            @endif

                            <!-- Programador Back -->
                            @if($equipo->backprog)
                            <div class="bg-white/5 border border-white/10 rounded-lg p-3">
                                <p class="text-green-300 text-xs font-bold uppercase mb-1">
                                    <i class="fas fa-database mr-1"></i>Programador Back
                                </p>
                                <p class="text-white">{{ $equipo->backprog->name }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Proyecto y Evaluaciones -->
                <div class="lg:col-span-2 space-y-6">
                    
                    @if($equipo->proyecto)
                        <!-- Card del Proyecto -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/20">
                                <h2 class="text-2xl font-bold text-white">
                                    <i class="fas fa-project-diagram mr-2 text-green-400"></i>
                                    Proyecto
                                </h2>
                                <span class="px-3 py-1 bg-green-500/30 text-green-200 rounded-full text-sm font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Subido
                                </span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">{{ $equipo->proyecto->nombre }}</h3>
                                    <p class="text-white/60 text-sm">
                                        Subido el {{ $equipo->proyecto->created_at->format('d/m/Y') }} a las {{ $equipo->proyecto->created_at->format('H:i') }}
                                    </p>
                                </div>

                                @if($equipo->proyecto->descripcion)
                                <div class="bg-white/5 rounded-xl p-4">
                                    <p class="text-white/90 leading-relaxed">{{ $equipo->proyecto->descripcion }}</p>
                                </div>
                                @endif

                                <!-- Enlaces del Proyecto -->
                                <div class="grid md:grid-cols-2 gap-3">
                                    <a href="{{ $equipo->proyecto->url }}" 
                                       target="_blank"
                                       class="flex items-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>Ver Proyecto</span>
                                    </a>

                                    @if($equipo->proyecto->repositorio_url)
                                    <a href="{{ $equipo->proyecto->repositorio_url }}" 
                                       target="_blank"
                                       class="flex items-center gap-2 px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                                        <i class="fab fa-github"></i>
                                        <span>Repositorio</span>
                                    </a>
                                    @endif

                                    @if($equipo->proyecto->demo_url)
                                    <a href="{{ $equipo->proyecto->demo_url }}" 
                                       target="_blank"
                                       class="flex items-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                        <i class="fas fa-play-circle"></i>
                                        <span>Demo</span>
                                    </a>
                                    @endif

                                    @if($equipo->proyecto->documentacion_url)
                                    <a href="{{ $equipo->proyecto->documentacion_url }}" 
                                       target="_blank"
                                       class="flex items-center gap-2 px-4 py-3 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                                        <i class="fas fa-book"></i>
                                        <span>Documentación</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card de Estadísticas -->
                        @if($estadisticasProyecto)
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                            <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/20 pb-3">
                                <i class="fas fa-chart-bar mr-2 text-yellow-400"></i>
                                Estadísticas de Evaluación
                            </h2>
                            
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="bg-white/5 rounded-lg p-4 text-center">
                                    <p class="text-white/60 text-sm mb-1">Total Evaluaciones</p>
                                    <p class="text-3xl font-bold text-white">{{ $estadisticasProyecto['total_evaluaciones'] }}</p>
                                </div>
                                
                                <div class="bg-white/5 rounded-lg p-4 text-center">
                                    <p class="text-white/60 text-sm mb-1">Promedio General</p>
                                    <p class="text-3xl font-bold text-yellow-300">{{ number_format($estadisticasProyecto['promedio_general'], 1) }}</p>
                                </div>
                                
                                <div class="bg-white/5 rounded-lg p-4 text-center">
                                    <p class="text-white/60 text-sm mb-1">Mi Calificación</p>
                                    <p class="text-3xl font-bold {{ $estadisticasProyecto['evaluado_por_mi'] ? 'text-green-300' : 'text-red-300' }}">
                                        {{ $estadisticasProyecto['mi_calificacion'] ? number_format($estadisticasProyecto['mi_calificacion'], 1) : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Botón de Evaluar / Ver Mi Evaluación -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                            @if($miEvaluacion)
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="fas fa-check-circle text-6xl text-green-400"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Ya evaluaste este proyecto</h3>
                                    <p class="text-white/80 mb-4">Tu calificación: <span class="text-2xl font-bold text-yellow-300">{{ number_format($miEvaluacion->total_score, 1) }}</span></p>
                                    
                                    @if($miEvaluacion->comments)
                                    <div class="bg-white/5 rounded-lg p-4 mb-4">
                                        <p class="text-white/60 text-sm mb-2">Tus comentarios:</p>
                                        <p class="text-white/90">{{ $miEvaluacion->comments }}</p>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="fas fa-clipboard-list text-6xl text-yellow-400"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-4">¿Listo para evaluar?</h3>
                                    <a href="{{ route('judge.proyectos.evaluar', $equipo->proyecto->id) }}" 
                                       class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-black font-bold rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-star"></i>
                                        <span>Evaluar Proyecto</span>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Otras Evaluaciones -->
                        @if($todasEvaluaciones->count() > 0)
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-6">
                            <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/20 pb-3">
                                <i class="fas fa-users mr-2 text-blue-400"></i>
                                Evaluaciones de Otros Jueces ({{ $todasEvaluaciones->count() }})
                            </h2>
                            
                            <div class="space-y-3">
                                @foreach($todasEvaluaciones as $evaluacion)
                                <div class="bg-white/5 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-white font-semibold">
                                                {{ $evaluacion->judge->name ?? 'Juez' }}
                                                @if($evaluacion->judge_id === Auth::id())
                                                    <span class="text-yellow-300 text-sm">(Tú)</span>
                                                @endif
                                            </p>
                                            <p class="text-white/60 text-sm">{{ $evaluacion->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-3xl font-bold text-yellow-300">{{ number_format($evaluacion->total_score, 1) }}</p>
                                            <p class="text-white/60 text-xs">Puntuación</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    @else
                        <!-- Sin Proyecto -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 p-12 text-center">
                            <div class="mb-6">
                                <i class="fas fa-folder-open text-8xl text-white/30"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Sin Proyecto</h3>
                            <p class="text-white/70 text-lg">
                                Este equipo aún no ha subido su proyecto para evaluación.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>