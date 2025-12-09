<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Juez</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
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
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                <i class="fas fa-user-circle mr-3"></i>Mi Perfil
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Información Personal -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">
                            <i class="fas fa-user-edit mr-2"></i>Información Personal
                        </h2>
                        
                        <form method="POST" action="{{ route('judge.perfil.update') }}">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nombre Completo *
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ $user->name }}"
                                           required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Correo Electrónico *
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           value="{{ $user->email }}"
                                           required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Especialidad
                                    </label>
                                    <input type="text" 
                                           name="especialidad" 
                                           value="{{ $user->especialidad ?? '' }}"
                                           placeholder="Ej: Desarrollo Frontend, UX/UI, Base de Datos, etc."
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Biografía
                                    </label>
                                    <textarea name="biografia" 
                                              rows="4"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                              placeholder="Cuéntanos sobre tu experiencia, formación y áreas de expertise...">{{ $user->biografia ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                    <i class="fas fa-save mr-2"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Cambiar Contraseña -->
                    <div class="bg-white rounded-lg shadow p-6 mt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">
                            <i class="fas fa-lock mr-2"></i>Cambiar Contraseña
                        </h2>
                        
                        <form method="POST" action="{{ route('judge.perfil.password') }}">
                            @csrf
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Contraseña Actual *
                                    </label>
                                    <input type="password" 
                                           name="current_password" 
                                           required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nueva Contraseña *
                                    </label>
                                    <input type="password" 
                                           name="password" 
                                           required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirmar Nueva Contraseña *
                                    </label>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium">
                                    <i class="fas fa-key mr-2"></i> Cambiar Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Estadísticas y Información -->
                <div>
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">
                            <i class="fas fa-chart-line mr-2"></i>Mis Estadísticas
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Eventos Asignados</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $estadisticas['total_eventos'] }}</p>
                                </div>
                                <i class="fas fa-calendar-alt text-2xl text-blue-400"></i>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Evaluaciones Realizadas</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $estadisticas['total_evaluaciones'] }}</p>
                                </div>
                                <i class="fas fa-star text-2xl text-green-400"></i>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Fecha de Registro</p>
                                    <p class="text-lg font-bold text-purple-600">{{ $estadisticas['fecha_registro'] }}</p>
                                </div>
                                <i class="fas fa-calendar-plus text-2xl text-purple-400"></i>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Última Evaluación</p>
                                    <p class="text-lg font-bold text-yellow-600">{{ $estadisticas['ultima_evaluacion'] }}</p>
                                </div>
                                <i class="fas fa-clock text-2xl text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rol y Estado -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">
                            <i class="fas fa-user-tag mr-2"></i>Mi Rol
                        </h2>
                        
                        <div class="text-center">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full">
                                <i class="fas fa-gavel mr-2"></i>
                                <span class="font-semibold">JUEZ</span>
                            </div>
                            
                            <p class="text-sm text-gray-600 mt-4">
                                Como juez, tienes la responsabilidad de evaluar proyectos de manera justa y objetiva.
                            </p>
                            
                            <div class="mt-6 p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-700">
                                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                    Tus evaluaciones influyen directamente en los resultados de los eventos.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>