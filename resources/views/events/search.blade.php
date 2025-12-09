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

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa, #ddd6fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(167, 139, 250, 0.3);
        }

        .search-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.2));
            border: 2px solid rgba(59, 130, 246, 0.4);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            color: #93c5fd;
            font-weight: 600;
            margin-bottom: 2rem;
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
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.6);
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

        /* Estado vacío */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state svg {
            color: #a5b4fc;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #c7d2fe;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #a5b4fc;
        }
    </style>
    @endpush

    <!-- Barra de navegación con búsqueda -->
    <nav class="navbar">
        <div class="search-box text-center">
            <form action="{{ route('events.search') }}" method="GET">
                <input type="text" name="q" placeholder="🔍 Buscar evento por nombre..."
                       value="{{ $query }}" autofocus />
            </form>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('events.index') }}" class="back-btn">← Volver a Eventos</a>

        <h1 class="page-title mb-6">Resultados de Búsqueda</h1>

        @if($query)
            <div class="search-info">
                <span>📝 Mostrando resultados para: <strong>"{{ $query }}"</strong></span>
                <span class="ml-4">• {{ $eventos->total() }} evento(s) encontrado(s)</span>
            </div>
        @endif

        <!-- Eventos encontrados -->
        <div class="eventos-grid">
            @forelse($eventos as $event)
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
                <div class="col-span-full empty-state">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3>No se encontraron eventos</h3>
                    <p class="mt-2">
                        @if($query)
                            No hay eventos que coincidan con "{{ $query }}"
                        @else
                            Realiza una búsqueda para encontrar eventos
                        @endif
                    </p>
                    <a href="{{ route('events.index') }}" class="back-btn mt-6">
                        Ver todos los eventos
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($eventos->hasPages())
            <div class="mt-8">
                {{ $eventos->appends(['q' => $query])->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
