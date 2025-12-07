<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    Eventos Populares
                </h2>
                <p class="text-purple-200 mt-1">Descubre y participa en los mejores eventos tecnológicos</p>
            </div>
            
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <x-button :href="route('events.create')" variant="primary" size="md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Crear Evento
                    </x-button>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alertas -->
            @if(session('success'))
                <div class="mb-6">
                    <x-alert variant="success" dismissible>
                        {{ session('success') }}
                    </x-alert>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6">
                    <x-alert variant="error" dismissible>
                        {{ session('error') }}
                    </x-alert>
                </div>
            @endif

            <!-- Barra de búsqueda -->
            <div class="mb-8">
                <form action="{{ route('events.search') }}" method="GET">
                    <div class="relative group max-w-2xl mx-auto">
                        <input type="text" 
                               name="q" 
                               placeholder="Buscar eventos..." 
                               class="w-full px-6 py-4 pl-12 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <button type="submit" 
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-gradient-to-r from-purple-500 to-purple-700 rounded-xl text-white hover:from-purple-600 hover:to-purple-800 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Grid de eventos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($events as $event)
                    <x-card variant="glass" class="hover:scale-105 transition-transform cursor-pointer" onclick="window.location='{{ route('events.show', $event->id) }}'">
                        <!-- Imagen -->
                        <div class="relative h-48 -mx-6 -mt-6 mb-4 rounded-t-2xl overflow-hidden">
                            <img src="{{ asset($event->imagen) }}" 
                                 alt="{{ $event->nombre }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 right-4">
                                <x-badge :variant="$event->estado === 'Activo' ? 'success' : 'danger'">
                                    {{ $event->estado }}
                                </x-badge>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <h3 class="text-xl font-bold text-white mb-2">{{ $event->nombre }}</h3>
                        <p class="text-white/70 text-sm mb-4 line-clamp-2">{{ $event->descripcion }}</p>

                        <!-- Info -->
                        <div class="space-y-2 text-sm text-white/80">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->inicio_evento->format('d/m/Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $event->modalidad }}
                            </div>
                        </div>

                        <!-- Link -->
                        <div class="mt-4 pt-4 border-t border-white/10">
                            <a href="{{ route('events.show', $event->id) }}" class="text-purple-300 hover:text-purple-200 font-semibold text-sm">
                                Ver detalles →
                            </a>
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-full">
                        <x-card variant="default" padding="large">
                            <div class="text-center py-12">
                                <h3 class="text-2xl font-bold text-white mb-2">No hay eventos disponibles</h3>
                                <p class="text-white/70">Pronto agregaremos nuevos eventos</p>
                            </div>
                        </x-card>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if($events->hasPages())
                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>