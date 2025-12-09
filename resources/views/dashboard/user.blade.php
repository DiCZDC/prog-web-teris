<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Dashboard - TERIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .event-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #ff5252, #ff3838);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">
    
    <!-- Navbar -->
    @include('layouts.navbar')
    
    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        
        <!-- Bienvenida -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold mb-4">
                <i class="fas fa-rocket mr-3"></i>Bienvenido, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-300 text-lg">Participa en eventos, forma equipos y desarrolla proyectos increíbles.</p>
        </div>
        
        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="stat-card rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/20 text-blue-400 mr-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-300">Mis Equipos</p>
                        <p class="text-3xl font-bold">{{ $stats['mis_equipos'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500/20 text-green-400 mr-4">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-300">Eventos Activos</p>
                        <p class="text-3xl font-bold">{{ $stats['eventos_activos'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500/20 text-purple-400 mr-4">
                        <i class="fas fa-project-diagram text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-300">Mis Proyectos</p>
                        <p class="text-3xl font-bold">{{ $stats['mis_proyectos'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Mis Equipos -->
            <div class="event-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        <i class="fas fa-users mr-3"></i>Mis Equipos
                    </h2>
                    <a href="{{ route('teams.join') }}" class="btn-primary px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i> Nuevo Equipo
                    </a>
                </div>
                
                @if($misEquipos && $misEquipos->count() > 0)
                    <div class="space-y-4">
                        @foreach($misEquipos as $equipo)
                        <div class="bg-gray-800/50 rounded-xl p-4 hover:bg-gray-800/70 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg mb-1">{{ $equipo->nombre }}</h3>
                                    <p class="text-gray-400 text-sm mb-2">{{ $equipo->evento->nombre }}</p>
                                    
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded text-xs">
                                            <i class="fas fa-crown mr-1"></i> {{ $equipo->lider->name }}
                                        </span>
                                        
                                        @if($equipo->miRol(auth()->id()) == 'líder')
                                        <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded text-xs">
                                            <i class="fas fa-star mr-1"></i> Líder
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <a href="{{ route('teams.show', $equipo->id) }}" 
                                       class="btn-secondary px-3 py-1 rounded text-sm">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('teams.join') }}" class="text-blue-400 hover:text-blue-300">
                            <i class="fas fa-arrow-right mr-1"></i> Ver todos mis equipos
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-users text-4xl text-gray-600 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-400 mb-2">No perteneces a ningún equipo</h3>
                        <p class="text-gray-500 mb-4">Únete a un equipo existente o crea uno nuevo para participar en eventos.</p>
                        <a href="{{ route('teams.join') }}" class="btn-primary inline-block px-6 py-2 rounded-lg">
                            <i class="fas fa-plus mr-2"></i> Crear mi primer equipo
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Eventos Destacados -->
            <div class="event-card rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        <i class="fas fa-calendar-star mr-3"></i>Eventos Destacados
                    </h2>
                    <a href="{{ route('events.index') }}" class="btn-secondary px-4 py-2 rounded-lg">
                        <i class="fas fa-list mr-2"></i> Ver Todos
                    </a>
                </div>
                
                @if($eventosDestacados && $eventosDestacados->count() > 0)
                    <div class="space-y-4">
                        @foreach($eventosDestacados as $evento)
                        <div class="bg-gray-800/50 rounded-xl p-4 hover:bg-gray-800/70 transition">
                            <div class="flex items-center gap-4 mb-3">
                                @if($evento->imagen)
                                <img src="{{ $evento->imagen }}" 
                                     alt="{{ $evento->nombre }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                                @else
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-2xl"></i>
                                </div>
                                @endif
                                
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg">{{ $evento->nombre }}</h3>
                                    <p class="text-gray-400 text-sm">
                                        <i class="fas fa-calendar-alt mr-1"></i> {{ $evento->inicio_evento->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <p class="text-gray-300 text-sm mb-3">{{ Str::limit($evento->descripcion, 100) }}</p>
                            
                            <div class="flex justify-between items-center">
                                <span class="px-3 py-1 rounded-full text-sm 
                                    {{ $evento->estado == 'Activo' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ $evento->estado }}
                                </span>
                                
                                <a href="{{ route('events.show', $evento->id) }}" 
                                   class="btn-secondary px-3 py-1 rounded text-sm">
                                    <i class="fas fa-info-circle mr-1"></i> Detalles
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-4xl text-gray-600 mb-4"></i>
                        <p class="text-gray-500">No hay eventos destacados en este momento.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Acciones Rápidas -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('events.index') }}" 
               class="event-card rounded-xl p-6 text-center hover:bg-gray-800/50 transition group">
                <div class="text-3xl mb-4 text-blue-400 group-hover:text-blue-300">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Explorar Eventos</h3>
                <p class="text-gray-400 text-sm">Encuentra eventos para participar</p>
            </a>
            
            <a href="{{ route('teams.join') }}" 
               class="event-card rounded-xl p-6 text-center hover:bg-gray-800/50 transition group">
                <div class="text-3xl mb-4 text-green-400 group-hover:text-green-300">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Unirse a Equipo</h3>
                <p class="text-gray-400 text-sm">Busca equipos que necesiten miembros</p>
            </a>
            
            <a href="{{ route('projects.create') }}" 
               class="event-card rounded-xl p-6 text-center hover:bg-gray-800/50 transition group">
                <div class="text-3xl mb-4 text-yellow-400 group-hover:text-yellow-300">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Crear Proyecto</h3>
                <p class="text-gray-400 text-sm">Sube tu proyecto para evaluación</p>
            </a>
            
            <a href="{{ route('profile.show') }}" 
               class="event-card rounded-xl p-6 text-center hover:bg-gray-800/50 transition group">
                <div class="text-3xl mb-4 text-purple-400 group-hover:text-purple-300">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Mi Perfil</h3>
                <p class="text-gray-400 text-sm">Actualiza tu información personal</p>
            </a>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-900/50 border-t border-gray-800 mt-12">
        <div class="container mx-auto px-4 py-6">
            <div class="text-center text-gray-400 text-sm">
                <p>TERIS - Plataforma de Hackathones y Competencias</p>
                <p class="mt-1">© {{ date('Y') }} Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
</body>
</html>