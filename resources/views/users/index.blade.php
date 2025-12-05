<x-app-layout>
<div class="container-fluid px-0">
    <h1 class="ps-3" style="color:white;">Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle small text-white bg-dark mb-0 mx-auto" style="width: auto;">
            <thead class="table-dark">
            <tr>
                <th style="width: 50px;" class="text-center">#</th>
                <th style="width: 300px;">Nombre</th>
                <th  style= "width: 300px;">Email</th>
                <th>Rol</th>
                <th  style= "width: 200px;" class="text-center">Creado</th>
                <th  style= "width: 200px;" class="text-center">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td class="fw-bold">{{ $user->name }}</td>
                <td class="text-truncate" style="max-width:320px;">{{ Str::limit($user->email ?? '-', 50) }}</td>
                <td>
                    <select class="form-select form-select-sm bg-dark text-black border-secondary" data-user-id="{{ $user->id }}">
                    <option value="user" {{ ($user->role ?? 'user') === 'user' ? 'selected' : '' }}>Usuario</option>
                    <option value="admin" {{ ($user->role ?? 'user') === 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </td>
                <td class="text-center"><small class="text-muted">{{ optional($user->created_at)->diffForHumans() ?? '-' }}</small></td>
                <td class="text-center">
                    <br>
                    <button class="btn btn-sm btn-primary me-1">Actualizar</button>
                    <br>
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                    <br>
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
