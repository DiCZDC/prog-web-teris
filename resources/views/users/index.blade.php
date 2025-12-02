<x-app-layout>
<div class="container-fluid px-0">
    <h1 class="ps-3" style="color:white;">Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle small w-100 text-white bg-dark mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;" class="text-center">#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th style="width: 140px;">Rol</th>
                    <th style="width: 140px;" class="text-center">Creado</th>
                    <th style="width: 200px;" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td class="text-truncate" style="max-width:320px;">{{ Str::limit($user->email ?? '-', 50) }}</td>
                        <td>{{ $user->role ?? '-' }}</td>
                        <td class="text-center"><small class="text-muted">{{ optional($user->created_at)->diffForHumans() ?? '-' }}</small></td>
                        <td class="text-center">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary" title="Ver">Ver</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-secondary" title="Editar">Editar</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay usuarios disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>
</x-app-layout>
