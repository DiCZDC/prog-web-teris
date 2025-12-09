<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Evaluaciones - Juez</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('judge.dashboard') }}" class="text-xl font-bold text-blue-600">
                        <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
                    </a>
                </div>
                <span class="text-sm text-gray-600">Juez: {{ auth()->user()->name }}</span>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-history mr-3"></i>Historial de Evaluaciones
        </h1>
        <p class="text-gray-600 mb-8">Todas las evaluaciones que has realizado</p>

        <!-- Estadísticas del Historial -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $estadisticas['total_evaluaciones'] }}</div>
                    <p class="text-sm text-gray-600 mt-1">Total Evaluaciones</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600">{{ number_format($estadisticas['promedio_general'], 1) }}</div>
                    <p class="text-sm text-gray-600 mt-1">Promedio General</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ number_format($estadisticas['mejor_calificacion'], 1) }}</div>
                    <p class="text-sm text-gray-600 mt-1">Mejor Calificación</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-red-600">{{ number_format($estadisticas['peor_calificacion'], 1) }}</div>
                    <p class="text-sm text-gray-600 mt-1">Peor Calificación</p>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Buscar proyecto o equipo..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select id="eventFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Todos los eventos</option>
                        <!-- Aquí podrías cargar dinámicamente los eventos -->
                    </select>
                </div>
                <div>
                    <select id="scoreFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Todas las calificaciones</option>
                        <option value="9-10">Excelente (9-10)</option>
                        <option value="7-8.9">Bueno (7-8.9)</option>
                        <option value="5-6.9">Regular (5-6.9)</option>
                        <option value="1-4.9">Deficiente (1-4.9)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabla de Evaluaciones -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Evaluaciones Realizadas</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="evaluationsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proyecto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Equipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Calificación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($evaluaciones as $evaluacion)
                        <tr class="evaluation-row" 
                            data-project="{{ strtolower($evaluacion->project->titulo ?? '') }}"
                            data-team="{{ strtolower($evaluacion->project->team->nombre ?? '') }}"
                            data-event="{{ strtolower($evaluacion->project->team->evento->nombre ?? '') }}"
                            data-score="{{ $evaluacion->total_score }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $evaluacion->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $evaluacion->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $evaluacion->project->titulo ?? 'Sin título' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    @if($evaluacion->project->url)
                                        <a href="{{ $evaluacion->project->url }}" target="_blank" class="text-blue-600 hover:underline">
                                            <i class="fas fa-external-link-alt mr-1"></i> Enlace
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $evaluacion->project->team->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $evaluacion->project->team->lider->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $evaluacion->project->team->evento->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $evaluacion->project->team->evento->modalidad }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        @if($evaluacion->total_score >= 9) bg-green-100 text-green-800
                                        @elseif($evaluacion->total_score >= 7) bg-blue-100 text-blue-800
                                        @elseif($evaluacion->total_score >= 5) bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ number_format($evaluacion->total_score, 1) }}
                                    </span>
                                    <div class="ml-3 text-xs text-gray-500">
                                        <div class="flex space-x-1">
                                            <span>I:{{ $evaluacion->score_innovacion }}</span>
                                            <span>F:{{ $evaluacion->score_funcionalidad }}</span>
                                            <span>D:{{ $evaluacion->score_diseno }}</span>
                                            <span>P:{{ $evaluacion->score_presentacion }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('judge.evaluacion.show', $evaluacion->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>
                                    <a href="{{ route('judge.proyectos.evaluar', $evaluacion->project_id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <i class="fas fa-clipboard-list text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">No has realizado evaluaciones todavía.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            @if($evaluaciones->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $evaluaciones->links() }}
            </div>
            @endif
        </div>
    </div>

    <script>
        // Filtrado de evaluaciones
        document.getElementById('searchInput').addEventListener('input', filterEvaluations);
        document.getElementById('eventFilter').addEventListener('change', filterEvaluations);
        document.getElementById('scoreFilter').addEventListener('change', filterEvaluations);
        
        function filterEvaluations() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const eventFilter = document.getElementById('eventFilter').value.toLowerCase();
            const scoreFilter = document.getElementById('scoreFilter').value;
            const rows = document.querySelectorAll('.evaluation-row');
            
            rows.forEach(row => {
                const project = row.getAttribute('data-project');
                const team = row.getAttribute('data-team');
                const event = row.getAttribute('data-event');
                const score = parseFloat(row.getAttribute('data-score'));
                let show = true;
                
                // Filtrar por búsqueda
                if (searchTerm && !project.includes(searchTerm) && !team.includes(searchTerm)) {
                    show = false;
                }
                
                // Filtrar por evento
                if (eventFilter && !event.includes(eventFilter)) {
                    show = false;
                }
                
                // Filtrar por calificación
                if (scoreFilter) {
                    const [min, max] = scoreFilter.split('-').map(parseFloat);
                    if (score < min || score > max) {
                        show = false;
                    }
                }
                
                row.style.display = show ? 'table-row' : 'none';
            });
        }
    </script>
</body>
</html>