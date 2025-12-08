{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Admin</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50"> --}}
<x-app-layout>
    
    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Botón Regresar -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-100 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">← Regresar</span>
                </a>
            </div>
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white-800 mb-2">
                <i class="fas fa-users mr-3"></i>Gestión de Usuarios
            </h1>
            <p class="text-gray-600">Administra los usuarios del sistema</p>
        </div>
        
        <!-- Mensajes Flash -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        
        <!-- Tabla de Usuarios -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Lista de Usuarios</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $usuario->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $role = $usuario->roles->first();
                                    $roleName = $role ? $role->name : 'user';
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($roleName == 'admin') bg-purple-100 text-purple-800
                                    @elseif($roleName == 'juez') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($roleName) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $usuario->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.usuarios.show', $usuario->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <button onclick="showChangeRoleModal({{ $usuario->id }}, '{{ $usuario->name }}', '{{ $roleName }}')"
                                        class="text-purple-600 hover:text-purple-900">
                                    <i class="fas fa-user-tag"></i> Cambiar Rol
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-users-slash text-4xl mb-4 block"></i>
                                No hay usuarios registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            @if($usuarios->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $usuarios->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
    <!-- JavaScript simple -->
    <script>
        function showChangeRoleModal(userId, userName, currentRole) {
            alert('Funcionalidad para cambiar rol de ' + userName + ' (Actual: ' + currentRole + ')\n\nID: ' + userId);
            // En una implementación real, esto abriría un modal
        }
    </script>

{{-- </body>
</html> --}}