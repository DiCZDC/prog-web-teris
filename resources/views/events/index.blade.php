<x-app-layout>
    @push('styles')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .search-box input {
            width: 300px;
            padding: 10px 15px;
            border-radius: 25px;
            border: none;
            outline: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .eventos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .evento-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        
        .evento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .evento-imagen {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .evento-content {
            padding: 20px;
        }
        
        .evento-titulo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .evento-descripcion {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        
        .evento-info div {
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #555;
        }
        
        .detalles-link {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .detalles-link:hover {
            background-color: #4338ca;
        }
        
        .btn-crear {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-crear:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }
    </style>
    @endpush

    <!-- Barra de navegación con búsqueda -->
    <nav class="navbar">
        <div class="search-box text-center">
            <form action="{{ route('events.search') }}" method="GET">
                <input type="text" name="q" placeholder="🔍 Buscar evento por nombre..." 
                       value="{{ request('q') }}" />
            </form>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Eventos Populares</h1>
            
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.events.create') }}" class="btn-crear">
                        ＋ Crear Nuevo Evento
                    </a>
                @endif
            @endauth
        </div>
        
        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Eventos populares -->
        <div class="eventos-grid">
            @forelse($events as $event)
                <div class="evento-card" onclick="window.location='{{ route('events.show', $event->id) }}'">
                    <img src="{{ $event->imagen }}" alt="{{ $event->nombre }}" class="evento-imagen"
                         onerror="this.src='https://via.placeholder.com/350x200?text=Evento+Sin+Imagen'">
                    
                    <div class="evento-content">
                        <h2 class="evento-titulo">{{ $event->nombre }}</h2>
                        <p class="evento-descripcion">{{ Str::limit($event->descripcion, 120) }}</p>
                        
                        <div class="evento-info">
                            <div><strong>📅 Inicio:</strong> {{ \Carbon\Carbon::parse($event->inicio_evento)->format('d/m/Y') }}</div>
                            <div><strong>🏁 Fin:</strong> {{ \Carbon\Carbon::parse($event->fin_evento)->format('d/m/Y') }}</div>
                            <div>
                                <strong>📊 Estado:</strong> 
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $event->estado == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $event->estado }}
                                </span>
                            </div>
                            <div><strong>📍 Modalidad:</strong> {{ $event->modalidad }}</div>
                            @if($event->ubicacion)
                                <div><strong>🏙️ Ubicación:</strong> {{ $event->ubicacion }}</div>
                            @endif
                        </div>
    
                        <a href="{{ route('events.show', $event->id) }}" class="detalles-link">
                            Ver detalles completos →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-600 mb-2">No hay eventos disponibles</h2>
                    <p class="text-gray-500">No se encontraron eventos activos en este momento.</p>
                    
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('events.create') }}" class="inline-block mt-6 btn-crear">
                                Crear mi primer evento
                            </a>
                        @endif
                    @endauth
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
</x-app-layout>