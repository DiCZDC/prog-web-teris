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
    <body>
    <!-- Contenido principal -->
        <div class="container">
            <h1>Eventos Populares</h1>
        <!-- Eventos populares -->
            <div class="eventos-grid">
                @forelse($events as $event)
                    <div class="evento-card" onclick="window.location='{{ route('events.show', $event->id) }}'">
                        <img src="{{ asset($event->imagen) }}" alt="{{ $event->nombre }}" class="evento-imagen">
                        
                        <div class="evento-content">
                            <h2 class="evento-titulo">{{ $event->nombre }}</h2>
                            <p class="evento-descripcion">{{ Str::limit($event->descripcion, 150) }}</p>
                            
                            <div class="evento-info">
                                <div><strong>Fecha de inicio:</strong> {{ $event->inicio_evento }}</div>
                                <div><strong>Fecha de finalización:</strong> {{ $event->fin_evento }}</div>
                                <div><strong>Estado:</strong> {{ $event->estado }}</div>
                                <div><strong>Modalidad:</strong> {{ $event->modalidad }}@if($event->ubicacion) ({{ $event->ubicacion }})@endif</div>
                            </div>
        
                            <a href="{{ route('events.show', $event->id) }}" class="detalles-link">Detalles adicionales</a>
                        </div>
                    </div>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                    <h2>No hay eventos populares disponibles</h2>
                    <p style="margin-top: 10px; opacity: 0.7;">Pronto agregaremos nuevos eventos</p>
                </div>
                @endforelse
            </div>
            
            </div>
    </body>
    
</x-app-layout>