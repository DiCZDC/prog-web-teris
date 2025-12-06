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
                    <p class="text-gray-600 mb-2"><strong>Fecha de inicio:</strong> {{ $event->inicio_evento }}</p>
                    <p class="text-gray-600 mb-2"><strong>Fecha de finalización:</strong> {{ $event->fin_evento }}</p>
                    
                    <p class="text-gray-600 mb-2"><strong>Estado:</strong> {{ $event->estado }}</p>
                    <p class="text-gray-600 mb-2"><strong>Modalidad:</strong> {{ $event->modalidad }}</p>
                    <p class="text-gray-600 mb-2"><strong>Ubicación:</strong> {{ $event->ubicacion }}</p>
                    
                    <hr>
                    
                    <p class="mt-4">{{ $event->descripcion }}</p>
                    <p class="mt-4"><strong>Reglas:</strong> {{ $event->reglas }}</p>
                    <p class="mt-4"><strong>Premios:</strong> {{ $event->premios }}</p>
                    <hr>
                    <p class="mt-4"><strong>Equipos inscritos :</strong> {{ \App\Models\Team::where('evento_id', $event->id)->count() }}</p>
                    @if (auth()->check() && auth()->user()->hasRole('user'))
                        <a href="{{ route('teams.create', $event->id) }}" class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Unirse
                        </a>
                    @else
                        <a href="{{ route('events.teams.index', $event->id) }}" class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Consultar Equipos
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>



</x-app-layout>