<title>Mis Eventos - Juez</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<x-app-layout>
    
    {{-- <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('judge.dashboard') }}" class="text-xl font-bold text-blue-600">
                        <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
                    </a>
                </div>
                <span class="text-sm text-gray-600">Juez: {{ auth()->user()->name }}</span>
            </div>
        </div>
    </nav> --}}

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-calendar-alt mr-3"></i>Mis Eventos Asignados
        </h1>
        <p class="text-gray-600 mb-8">Eventos donde eres juez y puedes evaluar proyectos</p>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Buscar evento..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Todos los estados</option>
                        <option value="activo">Activos</option>
                        <option value="finalizado">Finalizados</option>
                        <option value="proximo">Próximos</option>
                    </select>
                </div>
            </div>
        </div>

        @if($eventos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="eventsContainer">
            @foreach($eventos as $evento)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow event-card" 
                 data-status="{{ $evento->estado }}" 
                 data-name="{{ strtolower($evento->nombre) }}">
                <!-- Imagen del evento -->
                <div class="h-48 overflow-hidden">
                    <img src="{{ $evento->imagen }}" 
                         alt="{{ $evento->nombre }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-bold text-gray-800">{{ $evento->nombre }}</h3>
                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                            <i class="fas fa-gavel mr-1"></i> Juez
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($evento->descripcion, 100) }}
                    </p>
                    
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar-day mr-2"></i>
                            {{ $evento->inicio_evento->format('d/m/Y') }} - {{ $evento->fin_evento->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-users mr-2"></i>
                            {{ $evento->teams_count }} equipos registrados
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-project-diagram mr-2"></i>
                            {{ $evento->teams_con_proyecto }} con proyecto
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $evento->modalidad }} • {{ $evento->ubicacion ?? 'Virtual' }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm px-3 py-1 rounded-full 
                            {{ $evento->estado == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $evento->estado }}
                        </span>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('judge.eventos.equipos', $evento->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="fas fa-list mr-2"></i> Equipos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $eventos->links() }}
        </div>
        @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-calendar-times text-5xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">No tienes eventos asignados</h3>
            <p class="text-gray-500 mb-6">Los administradores te asignarán eventos donde podrás calificar proyectos.</p>
            <a href="{{ route('judge.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
            </a>
        </div>
        @endif
    </div>

    <script>
        // Filtrado de eventos
        document.getElementById('searchInput').addEventListener('input', filterEvents);
        document.getElementById('statusFilter').addEventListener('change', filterEvents);
        
        function filterEvents() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const events = document.querySelectorAll('.event-card');
            
            events.forEach(event => {
                const eventName = event.getAttribute('data-name');
                const eventStatus = event.getAttribute('data-status').toLowerCase();
                let show = true;
                
                // Filtrar por búsqueda
                if (searchTerm && !eventName.includes(searchTerm)) {
                    show = false;
                }
                
                // Filtrar por estado
                if (statusFilter) {
                    if (statusFilter === 'activo' && eventStatus !== 'activo') {
                        show = false;
                    } else if (statusFilter === 'finalizado' && eventStatus === 'activo') {
                        show = false;
                    } else if (statusFilter === 'proximo') {
                        // Lógica para eventos próximos (podrías agregar una fecha)
                        show = false;
                    }
                }
                
                event.style.display = show ? 'block' : 'none';
            });
        }
    </script>
</x-app-layout>