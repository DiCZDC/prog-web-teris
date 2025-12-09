<x-app-layout>
    @push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
            min-height: 100vh;
            font-family: 'Inter', 'Arial', sans-serif;
            color: #e0e7ff;
        }

        .navbar {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
            border-bottom: 3px solid rgba(167, 139, 250, 0.3);
        }

        .search-box input {
            width: 350px;
            padding: 12px 20px;
            border-radius: 25px;
            border: 2px solid rgba(167, 139, 250, 0.4);
            outline: none;
            background: rgba(30, 27, 75, 0.7);
            color: #e0e7ff;
            box-shadow: 0 2px 10px rgba(139, 92, 246, 0.2);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #a78bfa;
            box-shadow: 0 4px 20px rgba(167, 139, 250, 0.4);
            background: rgba(30, 27, 75, 0.9);
        }

        .search-box input::placeholder {
            color: #a78bfa;
        }

        .eventos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .evento-card {
            background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95));
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid rgba(167, 139, 250, 0.3);
        }

        .evento-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(167, 139, 250, 0.5);
            border-color: rgba(167, 139, 250, 0.6);
        }

        .evento-imagen {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 3px solid #a78bfa;
        }

        .evento-content {
            padding: 24px;
        }

        .evento-titulo {
            font-size: 1.6rem;
            font-weight: 700;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
        }

        .evento-descripcion {
            color: #c7d2fe;
            line-height: 1.6;
            margin-bottom: 18px;
            font-size: 0.95rem;
        }

        .evento-info div {
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #e0e7ff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .evento-info strong {
            color: #c4b5fd;
            font-weight: 600;
        }

        .detalles-link {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 24px;
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .detalles-link:hover {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.6);
        }

        .btn-crear {
            background: linear-gradient(135deg, #a855f7 0%, #8b5cf6 100%);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(168, 85, 247, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-crear:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 35px rgba(168, 85, 247, 0.6);
            background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa, #ddd6fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(167, 139, 250, 0.3);
        }

        /* Estilos para badges de estado */
        .bg-green-100 {
            background: rgba(134, 239, 172, 0.2) !important;
        }

        .text-green-800 {
            color: #86efac !important;
        }

        .bg-gray-100 {
            background: rgba(156, 163, 175, 0.2) !important;
        }

        .text-gray-800 {
            color: #d1d5db !important;
        }

        /* Mensajes de éxito */
        .bg-green-100.border.border-green-400 {
            background: rgba(134, 239, 172, 0.15) !important;
            border-color: rgba(134, 239, 172, 0.4) !important;
        }

        .text-green-700 {
            color: #86efac !important;
        }

        /* Estado vacío */
        .text-gray-400, .text-gray-500, .text-gray-600 {
            color: #a5b4fc !important;
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
            <h1 class="page-title">Eventos Populares</h1>
            
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