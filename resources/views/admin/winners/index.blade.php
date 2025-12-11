<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Ganadores - {{ $evento->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('events.show', $evento->id) }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i> Volver al Evento
                </a>
                <span class="text-sm text-gray-600">Admin: {{ auth()->user()->name }}</span>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-trophy mr-3"></i>Gestionar Ganadores
            </h1>
            <p class="text-gray-600">{{ $evento->nombre }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Estado de Publicación -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Estado de Publicación</h2>
                    @if($evento->winners_published)
                        <p class="text-green-600 font-medium">
                            <i class="fas fa-check-circle mr-2"></i>Ganadores Publicados
                        </p>
                        <p class="text-sm text-gray-500">
                            Publicados el {{ $evento->winners_announced_at->format('d/m/Y H:i') }}
                        </p>
                    @else
                        <p class="text-yellow-600 font-medium">
                            <i class="fas fa-eye-slash mr-2"></i>Ganadores Ocultos
                        </p>
                    @endif
                </div>
                
                @if($ganadores->count() >= 3)
                    @if(!$evento->winners_published)
                        <form method="POST" action="{{ route('admin.events.winners.publish', $evento->id) }}">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                <i class="fas fa-eye mr-2"></i>Publicar Ganadores
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.events.winners.unpublish', $evento->id) }}">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                                <i class="fas fa-eye-slash mr-2"></i>Ocultar Ganadores
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        <!-- Ganadores Actuales -->
        @if($ganadores->count() > 0)
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Ganadores Actuales</h2>
            
            <div class="space-y-4">
                @foreach($ganadores as $ganador)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex items-start space-x-4">
                            <div class="text-4xl">
                                {{ $ganador->medal_emoji }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">{{ $ganador->position_name }}</h3>
                                <p class="text-gray-700">Equipo: <strong>{{ $ganador->team->nombre }}</strong></p>
                                <p class="text-gray-600 text-sm">Líder: {{ $ganador->team->lider->name }}</p>
                                <p class="text-blue-600 font-medium">Puntuación: {{ $ganador->final_score }}/10</p>
                                
                                @if($ganador->recognition)
                                <p class="text-gray-600 text-sm mt-2">
                                    <i class="fas fa-award mr-1"></i>{{ $ganador->recognition }}
                                </p>
                                @endif
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.events.winners.remove', [$evento->id, $ganador->id]) }}" 
                              onsubmit="return confirm('¿Eliminar este ganador?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Métodos de Asignación -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Asignación Automática -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    <i class="fas fa-magic mr-2"></i>Asignación Automática
                </h2>
                <p class="text-gray-600 mb-4">
                    Los ganadores se seleccionan automáticamente según el promedio de evaluaciones.
                </p>
                
                <form method="POST" action="{{ route('admin.events.winners.assign-automatic', $evento->id) }}" 
                      onsubmit="return confirm('¿Asignar ganadores automáticamente? Esto reemplazará los ganadores actuales.')">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Asignar Top 3 Automáticamente
                    </button>
                </form>
            </div>

            <!-- Asignación Manual -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    <i class="fas fa-hand-pointer mr-2"></i>Asignación Manual
                </h2>
                <p class="text-gray-600 mb-4">
                    Selecciona manualmente los equipos ganadores.
                </p>
                
                <form method="POST" action="{{ route('admin.events.winners.assign-manual', $evento->id) }}">
                    @csrf
                    
                    <!-- Primer Lugar -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            🥇 Primer Lugar
                        </label>
                        <select name="first_place" required class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Seleccionar equipo</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}">
                                    {{ $equipo->nombre }} - Promedio: {{ $equipo->promedio_evaluaciones }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="first_place_score" step="0.01" min="0" max="10" 
                               placeholder="Puntuación" class="w-full px-3 py-2 border rounded-lg mt-2" required>
                    </div>

                    <!-- Segundo Lugar -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            🥈 Segundo Lugar
                        </label>
                        <select name="second_place" required class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Seleccionar equipo</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}">
                                    {{ $equipo->nombre }} - Promedio: {{ $equipo->promedio_evaluaciones }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="second_place_score" step="0.01" min="0" max="10" 
                               placeholder="Puntuación" class="w-full px-3 py-2 border rounded-lg mt-2" required>
                    </div>

                    <!-- Tercer Lugar -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            🥉 Tercer Lugar
                        </label>
                        <select name="third_place" required class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Seleccionar equipo</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}">
                                    {{ $equipo->nombre }} - Promedio: {{ $equipo->promedio_evaluaciones }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="third_place_score" step="0.01" min="0" max="10" 
                               placeholder="Puntuación" class="w-full px-3 py-2 border rounded-lg mt-2" required>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Asignar Ganadores Manualmente
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabla de Equipos con Promedios -->
        <div class="bg-white rounded-lg shadow p-6 mt-8">
            <h2 class="text-xl font-semibold mb-4">Equipos Evaluados</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posición</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Equipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Líder</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Promedio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evaluaciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($equipos as $index => $equipo)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $index === 0 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $index === 1 ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $index === 2 ? 'bg-orange-100 text-orange-800' : '' }}">
                                    #{{ $index + 1 }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $equipo->nombre }}</td>
                            <td class="px-6 py-4">{{ $equipo->lider->name }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-blue-600">
                                    {{ $equipo->promedio_evaluaciones }}/10
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $equipo->total_evaluaciones }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>