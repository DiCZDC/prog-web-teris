<x-app-layout>
    @push('styles')
    <style>
        .event-detail-container {
            background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
            border-radius: 16px;
            border: 2px solid rgba(167, 139, 250, 0.3);
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
            color: #e0e7ff;
        }

        .back-btn {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
            border: 2px solid rgba(167, 139, 250, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.6);
        }

        .event-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #c4b5fd;
            margin-bottom: 0.5rem;
        }

        .section-content {
            color: #c7d2fe;
            line-height: 1.6;
        }

        .judge-card {
            background: rgba(30, 27, 75, 0.5);
            border: 2px solid rgba(167, 139, 250, 0.3);
            border-radius: 12px;
            padding: 1rem;
            transition: all 0.2s ease;
        }

        .judge-card:hover {
            border-color: rgba(167, 139, 250, 0.6);
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
            transform: translateY(-2px);
        }

        .team-count-badge {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(37, 99, 235, 0.3));
            border: 2px solid rgba(59, 130, 246, 0.5);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: #93c5fd;
            font-weight: 700;
        }

        .action-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .action-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.6);
        }

        .empty-state {
            background: rgba(30, 27, 75, 0.3);
            border: 2px solid rgba(167, 139, 250, 0.2);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
        }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('events.index') }}" class="inline-flex items-center back-btn mb-4 ml-8">
                ← Volver
            </a>
            <div class="event-detail-container overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <img src="{{ $event->imagen }}" alt="{{ $event->nombre }}" class="w-full mb-4 rounded" style="height: 300px; object-fit: cover; border: 3px solid #a78bfa;">
                    <h1 class="event-title mb-4">{{ $event->nombre}}</h1>
                    <div class="mb-6">
                        <h2 class="section-title">Descripción</h2>
                        <p class="section-content">{{ $event->descripcion }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="section-title">Reglas</h2>
                        <p class="section-content whitespace-pre-line">{{ $event->reglas }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="section-title">Premios</h2>
                        <p class="section-content whitespace-pre-line">{{ $event->premios }}</p>
                    </div>
                    
                    <hr class="my-6">

                    {{-- ⭐ NUEVA SECCIÓN: JUECES ASIGNADOS ⭐ --}}
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="section-title flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Jueces del Evento
                            </h2>
                            <span class="text-sm" style="color: #a5b4fc;">
                                {{ $event->jueces->count() }} jue{{ $event->jueces->count() !== 1 ? 'ces' : 'z' }} asignado{{ $event->jueces->count() !== 1 ? 's' : '' }}
                            </span>
                        </div>
                        @if($event->jueces && $event->jueces->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($event->jueces as $judge)
                                    <div class="judge-card">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(37, 99, 235, 0.3));">
                                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h3 class="text-base font-semibold" style="color: #e0e7ff;">
                                                    {{ $judge->name }}
                                                </h3>
                                                <p class="text-sm mt-1" style="color: #a5b4fc;">
                                                    {{ $judge->email }}
                                                </p>
                                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full" style="background: rgba(59, 130, 246, 0.2); color: #93c5fd;">
                                                    Juez
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <svg class="w-16 h-16 mx-auto mb-3" style="color: #a5b4fc;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="font-medium" style="color: #c7d2fe;">No hay jueces asignados a este evento</p>
                                <p class="text-sm mt-1" style="color: #a5b4fc;">Los administradores pueden asignar jueces al editar el evento</p>
                            </div>
                        @endif
                    </div>

                    <hr class="my-6">
                    
                    {{-- Equipos inscritos --}}
                    <div class="mb-6">
                        <p class="text-lg mb-4" style="color: #e0e7ff;">
                            <strong style="color: #c4b5fd;">Equipos inscritos:</strong>
                            <span class="team-count-badge">
                                {{ \App\Models\Team::where('evento_id', $event->id)->count() }}
                            </span>
                        </p>

                        @if (auth()->check() && auth()->user()->hasRole('user'))
                            <a href="{{ route('events.teams.index', $event->id) }}" class="inline-flex items-center action-btn">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Unirse al Evento
                            </a>
                        @else
                            <a href="{{ route('events.teams.index', $event->id) }}" class="inline-flex items-center action-btn">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Consultar Equipos
                            </a>
                        @endif

                        {{-- Botones de editar y eliminar para admins --}}
                        @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background: linear-gradient(135deg, #8b5cf6, #a855f7); box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4); border: 2px solid rgba(167, 139, 250, 0.3);">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar Evento
                                </a>

                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background: linear-gradient(135deg, #dc2626, #ef4444); box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4); border: 2px solid rgba(239, 68, 68, 0.3);">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Eliminar Evento
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>