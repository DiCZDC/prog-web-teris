{{-- resources/views/admin/usuarios/index.blade.php --}}
<x-app-layout>
    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <!-- Botón Regresar -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-white-900 transition-colors duration-200">
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
                                    @elseif($roleName == 'judge') bg-blue-100 text-blue-800
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
    
    <!-- ==================== AQUÍ EMPIEZA LO NUEVO ==================== -->
    <!-- Modal para cambiar rol -->
    <div id="changeRoleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fas fa-user-tag mr-2"></i>Cambiar Rol
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="changeRoleForm" action="{{ route('admin.usuarios.cambiar-rol') }}" method="POST">
                    @csrf
                    {{-- IMPORTANTE: Si en routes/web.php usas POST, DEJA ESTA LÍNEA COMENTADA --}}
                    {{-- Si usas PUT, DESCOMENTA esta línea: --}}
                    {{-- @method('PUT') --}}
                    
                    <input type="hidden" name="user_id" id="modal_user_id">
                    
                    <div class="mb-4 p-3 bg-gray-50 rounded">
                        <p class="text-sm text-gray-700 mb-1">
                            <i class="fas fa-user mr-2"></i>
                            <span id="modal_user_name" class="font-semibold"></span>
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-tag mr-2"></i>
                            Rol actual: <span id="modal_current_role" class="font-medium"></span>
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="new_role" class="block text-sm font-medium text-gray-700 mb-2 text-left">
                            <i class="fas fa-star mr-2"></i>Seleccionar nuevo rol:
                        </label>
                        <select name="new_role" id="new_role" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 rounded-md">
                            <option value="user">👤 Usuario Regular</option>
                            <option value="juez">⚖️ Juez</option>
                            <option value="admin">👑 Administrador</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="closeModal()"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-200">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200">
                            <i class="fas fa-check mr-2"></i>Cambiar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showChangeRoleModal(userId, userName, currentRole) {
            console.log('Abriendo modal para:', userId, userName, currentRole);
            
            // Llenar los datos del modal
            document.getElementById('modal_user_id').value = userId;
            document.getElementById('modal_user_name').textContent = userName;
            document.getElementById('modal_current_role').textContent = currentRole;
            
            // Establecer el valor actual en el select
            document.getElementById('new_role').value = currentRole;
            
            // Mostrar modal
            document.getElementById('changeRoleModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('changeRoleModal').classList.add('hidden');
        }
        
        // Cerrar modal al hacer clic fuera
        document.getElementById('changeRoleModal').addEventListener('click', function(e) {
            if (e.target.id === 'changeRoleModal') {
                closeModal();
            }
        });
        
        // Manejar envío del formulario
        document.getElementById('changeRoleForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Cambiar texto del botón mientras se procesa
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST', // IMPORTANTE: Cambia a 'PUT' si en routes usas PUT
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Mostrar mensaje de éxito
                    alert('✅ ' + data.message);
                    closeModal();
                    
                    // Recargar la página después de 1.5 segundos
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    alert('❌ ' + data.message);
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Hubo un error de conexión. Por favor, intenta nuevamente.');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
        
        // Cerrar con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>

</x-app-layout>