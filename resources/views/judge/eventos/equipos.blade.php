
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('judge.eventos.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a Eventos
                    </a>
                    <span class="text-gray-600">|</span>
                    <span class="font-medium">{{ $evento->nombre }}</span>
                </div>
                <span class="text-sm text-gray-600">Juez: {{ auth()->user()->name }}</span>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-users mr-3"></i>Equipos del Evento
            </h1>
            <p class="text-gray-600">{{ $evento->descripcion }}</p>
            
            <div class="flex flex-wrap gap-4 mt-4">
                <div class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    <i class="fas fa-calendar-alt mr-1"></i> {{ $evento->inicio_evento->format('d/m/Y') }} - {{ $evento->fin_evento->format('d/m/Y') }}
                </div>
                <div class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                    <i class="fas fa-users mr-1"></i> {{ $equipos->count() }} equipos
                </div>
                <div class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $evento->modalidad }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Resumen de Evaluaciones -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-pie mr-2"></i>Resumen de Evaluaciones
            </h2>
            
            @php
                $equiposConProyecto = $equipos->filter(function($equipo) {
                    return $equipo->proyecto !== null;
                });
                
                $equiposEvaluados = $equiposConProyecto->filter(function($equipo) {
                    return $equipo->proyecto && $equipo->proyecto->evaluaciones->count() > 0;
                });
                
                $equiposPendientes = $equiposConProyecto->filter(function($equipo) {
                    return $equipo->proyecto && $equipo->proyecto->evaluaciones->count() == 0;
                });
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-3xl font-bold text-blue-600">{{ $equiposConProyecto->count() }}</div>
                    <div class="text-sm text-gray-600 mt-1">Equipos con proyecto</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-3xl font-bold text-green-600">{{ $equiposEvaluados->count() }}</div>
                    <div class="text-sm text-gray-600 mt-1">Evaluados por ti</div>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-3xl font-bold text-yellow-600">{{ $equiposPendientes->count() }}</div>
                    <div class="text-sm text-gray-600 mt-1">Pendientes por evaluar</div>
                </div>
            </div>
        </div>

        <!-- Lista de Equipos -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Lista de Equipos</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Equipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Líder</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proyecto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($equipos as $equipo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $equipo->nombre }}</div>
                                <div class="text-sm text-gray-500">{{ $equipo->descripcion ?? 'Sin descripción' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $equipo->lider->name }}</div>
                                <div class="text-xs text-gray-500">{{ $equipo->lider->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($equipo->proyecto)
                                    <div class="font-medium text-gray-900">{{ $equipo->proyecto->titulo }}</div>
                                    <div class="text-xs text-gray-500">
                                        @if($equipo->proyecto->url)
                                            <a href="{{ $equipo->proyecto->url }}" target="_blank" class="text-blue-600 hover:underline">
                                                <i class="fas fa-link mr-1"></i> Ver proyecto
                                            </a>
                                        @else
                                            <span class="text-yellow-600">Sin enlace</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-red-600">Sin proyecto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($equipo->proyecto)
                                    @if($equipo->proyecto->evaluaciones->count() > 0)
                                        @php
                                            $evaluacion = $equipo->proyecto->evaluaciones->first();
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Evaluado ({{ $evaluacion->total_score }}/10)
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i> Pendiente
                                        </span>
                                    @endif
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-times mr-1"></i> Sin proyecto
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('judge.eventos.equipo.show', [$evento->id, $equipo->id]) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>
                                    
                                    @if($equipo->proyecto && $equipo->proyecto->evaluaciones->count() == 0)
                                    <a href="{{ route('judge.proyectos.evaluar', $equipo->proyecto->id) }}" 
                                       class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-star mr-1"></i> Calificar
                                    </a>
                                    @elseif($equipo->proyecto && $equipo->proyecto->evaluaciones->count() > 0)
                                    <a href="{{ route('judge.proyectos.evaluar', $equipo->proyecto->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900">
                                        <i class="fas fa-edit mr-1"></i> Recalificar
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <i class="fas fa-users-slash text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">No hay equipos registrados en este evento.</p>
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