<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 mb-4 ml-8 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                ← Volver
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <img src="{{ $event->imagen }}" alt="{{ $event->nombre }}" class="w-full mb-4 rounded" style = "height: 300px; object-fit: cover;">
                    <h1 class="text-2xl font-bold mb-4">{{ $event->nombre}}</h1>
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Descripción</h2>
                        <p class="text-gray-700">{{ $event->descripcion }}</p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Reglas</h2>
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->reglas }}</p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Premios</h2>
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->premios }}</p>
                    </div>
                    
                    <hr class="my-6">

                    {{-- ⭐ NUEVA SECCIÓN: JUECES ASIGNADOS ⭐ --}}
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Jueces del Evento
                            </h2>
                            <span class="text-sm text-gray-500">
                                @php $count = $event->judges ? $event->judges->count() : 0; @endphp
                                {{ $count }} jue{{ $count !== 1 ? 'ces' : 'z' }} asignado{{ $count !== 1 ? 's' : '' }}
                            </span>
                        </div>
                        @if($event->judges && $event->judges->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($event->judges as $judge)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h3 class="text-base font-semibold text-gray-900">
                                                    {{ $judge->name }}
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $judge->email }}
                                                </p>
                                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                                    Juez
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                                <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-gray-600 font-medium">No hay jueces asignados a este evento</p>
                                <p class="text-gray-500 text-sm mt-1">Los administradores pueden asignar jueces al editar el evento</p>
                            </div>
                        @endif
                    </div>

                    <hr class="my-6">
                    
                    {{-- Equipos inscritos --}}
                    <div class="mb-6">
                        <p class="text-lg mb-4">
                            <strong>Equipos inscritos:</strong> 
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                {{ \App\Models\Team::where('evento_id', $event->id)->count() }}
                            </span>
                        </p>
                        
                        @if (auth()->check() && auth()->user()->hasRole('user'))
                            <a href="{{ route('events.teams.index', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Unirse al Evento
                            </a>
                        @else
                            <a href="{{ route('events.teams.index', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Consultar Equipos
                            </a>
                        @endif

                        {{-- Botón de editar para admins --}}
                        @if (auth()->check() && auth()->user()->hasRole('admin'))
                            {{-- <a href="{{ route('events.edit', $event->id) }}" class="inline-flex items-center px-4 py-2 ml-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar Evento
                            </a> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>