@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('judge.event.show', $event->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al Evento
        </a>

        <div class="flex items-center justify-between mb-2">
            <h1 class="text-3xl font-bold text-gray-800">{{ $team->nombre }}</h1>
            @if($averageScore)
                <div class="text-right">
                    <p class="text-sm text-gray-500">Promedio General</p>
                    <p class="text-3xl font-bold text-blue-600">{{ number_format($averageScore, 1) }}</p>
                </div>
            @endif
        </div>
        
        <p class="text-gray-600">{{ $event->nombre }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Formulario de Evaluación -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Evaluar por Criterio</h2>
                    <p class="text-sm text-gray-600 mt-1">Selecciona un criterio y asigna la calificación</p>
                </div>

                <div class="p-6">
                    @if($criteria->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="mt-2 text-gray-500">No hay criterios de evaluación disponibles</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($criteria as $criterion)
                                @php
                                    $existingScore = $existingScores->get($criterion->id);
                                @endphp
                                
                                <div class="border border-gray-200 rounded-lg p-6 hover:border-blue-300 transition-colors">
                                    <form action="{{ route('judge.score.store', [$event->id, $team->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="evaluation_criteria_id" value="{{ $criterion->id }}">
                                        
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <h3 class="text-lg font-semibold text-gray-800">{{ $criterion->name }}</h3>
                                                    @if($existingScore)
                                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Evaluado</span>
                                                    @endif
                                                </div>
                                                @if($criterion->description)
                                                    <p class="text-sm text-gray-600 mb-3">{{ $criterion->description }}</p>
                                                @endif
                                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                                    <span>Máximo: {{ $criterion->max_score }} pts</span>
                                                    <span>•</span>
                                                    <span>Peso: {{ $criterion->weight }}x</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Puntuación (0 - {{ $criterion->max_score }}) *
                                                </label>
                                                <input type="number" 
                                                       name="score" 
                                                       step="0.5"
                                                       min="0" 
                                                       max="{{ $criterion->max_score }}" 
                                                       value="{{ $existingScore ? $existingScore->score : '' }}"
                                                       required
                                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg font-semibold">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Comentarios</label>
                                                <textarea name="comments" 
                                                          rows="3"
                                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                                          placeholder="Observaciones...">{{ $existingScore ? $existingScore->comments : '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" 
                                                    class="w-full md:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                                {{ $existingScore ? 'Actualizar Calificación' : 'Guardar Calificación' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - Resumen y Calificaciones -->
        <div class="space-y-6">
            <!-- Información del Equipo -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Equipo</h3>
                
                @if($team->descripcion)
                    <p class="text-gray-600 mb-4">{{ $team->descripcion }}</p>
                @endif

                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>{{ $team->members->count() }} integrantes</span>
                    </div>

                    @if($team->members->isNotEmpty())
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-700 mb-2">Integrantes:</p>
                            <ul class="space-y-1">
                                @foreach($team->members as $member)
                                    <li class="text-sm text-gray-600">• {{ $member->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tu Progreso -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tu Progreso</h3>
                
                @php
                    $evaluatedCount = $existingScores->count();
                    $totalCriteria = $criteria->count();
                    $percentage = $totalCriteria > 0 ? ($evaluatedCount / $totalCriteria) * 100 : 0;
                @endphp

                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>{{ $evaluatedCount }} de {{ $totalCriteria }} criterios</span>
                        <span>{{ number_format($percentage, 0) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>

                @if($percentage === 100)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-green-800 font-medium">Evaluación completa</span>
                    </div>
                @endif
            </div>

            <!-- Todas las Calificaciones -->
            @if($allScores->isNotEmpty())
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Calificaciones de Jueces</h3>
                    
                    <div class="space-y-4">
                        @foreach($allScores as $judgeId => $scores)
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="font-medium text-gray-800 mb-2">
                                    {{ $scores->first()->user->name }}
                                    @if($judgeId == Auth::id())
                                        <span class="text-xs text-blue-600">(Tú)</span>
                                    @endif
                                </p>
                                <div class="space-y-1">
                                    @foreach($scores as $score)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ $score->criteria->name }}</span>
                                            <span class="font-semibold text-gray-800">{{ $score->score }}/{{ $score->criteria->max_score }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection