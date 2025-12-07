@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Jueces</h1>
            <p class="text-gray-600 mt-2">Administra los jueces y sus eventos asignados</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i>Volver a Usuarios
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($judges as $judgeData)
            @php
                $judge = $judgeData['judge'];
                $eventsCount = $judgeData['events_count'];
                $scoresGiven = $judgeData['scores_given'];
            @endphp
            
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                <div class="flex items-center mb-4">
                    <div class="h-16 w-16 rounded-full bg-purple-500 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($judge->name, 0, 1)) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $judge->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $judge->email }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>Eventos asignados
                        </span>
                        <span class="font-semibold text-gray-800">{{ $eventsCount }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>Calificaciones dadas
                        </span>
                        <span class="font-semibold text-gray-800">{{ $scoresGiven }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-clock text-green-500 mr-2"></i>Registrado
                        </span>
                        <span class="text-sm text-gray-800">{{ $judge->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                @if($judge->eventsAsJudge->isNotEmpty())
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Eventos Activos:</h4>
                        <div class="space-y-2">
                            @foreach($judge->eventsAsJudge->take(3) as $event)
                                <a href="{{ route('events.show', $event->id) }}" 
                                   class="block text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                    <i class="fas fa-trophy text-xs mr-1"></i>{{ $event->nombre }}
                                </a>
                            @endforeach
                            
                            @if($judge->eventsAsJudge->count() > 3)
                                <p class="text-xs text-gray-500 italic">
                                    Y {{ $judge->eventsAsJudge->count() - 3 }} más...
                                </p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <p class="text-sm text-gray-500 italic text-center">
                            Sin eventos asignados
                        </p>
                    </div>
                @endif

                <div class="mt-4 flex justify-end space-x-2">
                    <a href="{{ route('admin.users.edit', $judge) }}" 
                       class="text-sm text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit mr-1"></i>Editar
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-user-tie text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay jueces registrados</h3>
                <p class="text-gray-500 mb-4">Crea un usuario con rol de juez para empezar</p>
                <a href="{{ route('admin.users.create') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Crear Juez
                </a>
            </div>
        @endforelse
    </div>

    @if($judges->isNotEmpty())
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-bar text-blue-500 mr-2"></i>Estadísticas Generales
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $judges->count() }}</div>
                    <div class="text-sm text-gray-600 mt-1">Total de Jueces</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600">
                        {{ $judges->sum(fn($j) => $j['events_count']) }}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">Eventos Asignados</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-yellow-600">
                        {{ $judges->sum(fn($j) => $j['scores_given']) }}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">Calificaciones Dadas</div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection