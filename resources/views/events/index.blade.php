<x-app-layout>
<div class="container-fluid px-0">
    <h1 class="ps-3" style="color:white;" >Eventos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle small w-100 text-white bg-dark mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;" class="text-center">#</th>
                    <th>Nombre</th>
                    <th style="max-width: 320px;">Descripción</th>
                    <th style="width: 160px;">Fecha Inicio</th>
                    <th style="width: 160px;">Fecha Fin</th>
                    <th style="width: 140px;" class="text-center">Creado</th>
                    <th style="width: 200px;" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td class="text-center">{{ $event->id }}</td>
                        <td class="fw-bold">{{ $event->nombre }}</td>
                        <td class="text-truncate" style="max-width:320px;">{{ Str::limit($event->descripcion ?? '-', 100) }}</td>
                        <td>{{ $event->inicio_evento}}</td>
                        <td>{{ $event->fin_evento }}</td>
                        <td class="text-center"><small class="text-muted">{{ optional($event->created_at)->diffForHumans() ?? '-' }}</small></td>
                        <td class="text-center">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary" title="Ver">Ver</a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-secondary" title="Editar">Editar</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este evento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay eventos disponibles.</td>
                    </tr>
                @endforelse
                {{ $events->links() }}
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>
