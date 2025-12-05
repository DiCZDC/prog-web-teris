@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header del Proyecto -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $project->name }}</h1>
                <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Editar
                </a>
            </div>
            
            @if($project->description)
                <p class="text-gray-600 mb-4">{{ $project->description }}</p>
            @endif

            <div class="flex gap-4 text-sm text-gray-500">
                <span><strong>Creado:</strong> {{ $project->created_at->format('d/m/Y') }}</span>
                <span><strong>Actualizado:</strong> {{ $project->updated_at->format('d/m/Y') }}</span>
            </div>
        </div>

        <!-- Tareas del Proyecto -->
        @if($project->tasks && $project->tasks->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tareas</h2>
            <ul class="space-y-3">
                @foreach($project->tasks as $task)
                <li class="border-l-4 border-blue-500 pl-4 py-2">
                    <h3 class="font-medium">{{ $task->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $task->description }}</p>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Botón Volver -->
        <div class="mt-6">
            <a href="{{ route('projects.index') }}" class="text-blue-500 hover:text-blue-600">
                ← Volver a proyectos
            </a>
        </div>
    </div>
</div>
@endsection
