@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm" aria-label="breadcrumb">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('judge.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-medium">{{ $event->nombre }}</li>
        </ol>
    </nav>

    <!-- Header del Evento -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $event->nombre }}</h1>
                <p class="text-blue-100 mb-4">{{ $event->descripcion }}</p>
                <div class="flex flex-wrap gap-4 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($event->inicio_evento)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $event->ubicacion }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        <span>{{ $event->teams->count() }} equipos</span>
                    </div>
                </div>
            </div>
            <div class="text-right">
                @if($event->estado === 'activo')
                    <span class="inline-block bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-circle text-xs mr-1"></i>Activo
                    </span>
                @elseif($event->estado === 'completado')
                    <span class="inline-block bg-gray-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-check-circle mr-1"></i>Completado
                    </span>
                @else
                    <span class="inline-block bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-times-circle mr-1"></i>Cancelado
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Estadísticas del Evento -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Equipos</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $teams->count() }}</h3>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Evaluados</p>
                    <h3 class="text-3xl font-bold text-green-600">
                        {{ $teams->where('evaluated', true)->count() }}
                    </h3>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Pendientes</p>
                    <h3 class="text-3xl font-bold text-orange-600">
                        {{ $teams->where('evaluated', false)->count() }}
                    </h3>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <i class="fas fa-clock text-orange-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Criterios</p>
                    <h3 class="text-3xl font-bold text-purple-600">{{ $event->criteria->count() }}</h3>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-list-check text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Criterios de Evaluación -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-clipboard-list text-blue-600 mr-2"></i>
                Criterios de Evaluación
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($event->criteria as $criterion)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold text-gray-800">{{ $criterion->name }}</h3>
                            @if($criterion->is_default)
                                <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                    Predeterminado
                                </span>
                            @endif
                        </div>
                        @if($criterion->description)
                            <p class="text-sm text-gray-600 mb-3">{{ $criterion->description }}</p>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">
                                <i class="fas fa-star text-yellow-500 mr-1"></i>
                                Máx: <strong>{{ $criterion->max_score }}</strong>
                            </span>
                            <span class="text-gray-600">
                                <i class="fas fa-weight-hanging text-blue-500 mr-1"></i>
                                Peso: <strong>{{ $criterion->weight }}</strong>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Lista de Equipos -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-users text-blue-600 mr-2"></i>
                Equipos Participantes
            </h2>
        </div>
        <div class="p-6">
            @if($teams->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg">No hay equipos registrados en este evento</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($teams as $teamData)
                        @php
                            $team = $teamData['team'];
                            $evaluated = $teamData['evaluated'];
                            $averageScore = $teamData['average_score'];
                        @endphp
                        
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition {{ $evaluated ? 'bg-green-50' : 'bg-white' }}">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $team->nombre }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-users text-gray-400 mr-1"></i>
                                        {{ $team->users->count() }} integrantes
                                    </p>
                                </div>
                                @if($evaluated)
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check mr-1"></i>Evaluado
                                    </span>
                                @else
                                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pendiente
                                    </span>
                                @endif
                            </div>

                            @if($averageScore > 0)
                                <div class="bg-white border border-gray-200 rounded-lg p-3 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Promedio Actual:</span>
                                        <span class="text-2xl font-bold text-blue-600">
                                            {{ number_format($averageScore, 2) }}
                                        </span>
                                    </div>
                                    <div class="mt-2 bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all" 
                                             style="width: {{ ($averageScore / 10) * 100 }}%"></div>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('judge.teams.show', [$event->id, $team->id]) }}" 
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition font-medium">
                                <i class="fas fa-star mr-2"></i>
                                {{ $evaluated ? 'Ver/Editar Evaluación' : 'Evaluar Equipo' }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Panel de Jueces Asignados -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-gavel text-purple-600 mr-2"></i>
                Jueces Asignados
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($event->judges as $judge)
                    <div class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg">
                        <div class="h-12 w-12 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($judge->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $judge->name }}</p>
                            <p class="text-xs text-gray-500">{{ $judge->email }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection