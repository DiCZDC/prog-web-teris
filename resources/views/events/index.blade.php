
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Eventos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<x-app-layout>
    <body>
        <nav class="navbar">
            <div class="search-box">
                <form action="{{ route('events.search') }}" method="GET">
                    <input type="text" name="q" placeholder="Buscar evento" />
                </form>
            </div>
        </nav>
    
        <div class="container">
            <h1>Eventos Populares</h1>
            @if(auth()->check() && auth()->user()->hasRole('admin'))
                <a class = "btn" href="{{ route('events.create') }}">
                    Crear Evento
                </a>
            @endif
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