
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Eventos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<x-app-layout>
    <body>
    <!-- Barra de navegación con búsqueda -->
        <nav class="navbar">
            <div class="search-box">
                <form action="{{ route('events.search') }}" method="GET">
                    <input type="text" name="q" placeholder="Buscar evento" />
                </form>
            </div>
        </nav>
    <!-- Contenido principal -->
        <div class="container">
            <h1>Eventos Populares</h1>
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <div style="text-align: center; margin: 20px 0;">
                        <a class="btn" href="{{ route('events.create') }}" style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: 500; transition: background-color 0.3s;">
                            Crear Evento
                        </a>
                    </div>
                @endif
            @endauth
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