<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluar Proyecto - Juez</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .rating-slider {
            width: 100%;
            height: 8px;
            -webkit-appearance: none;
            appearance: none;
            background: #e5e7eb;
            border-radius: 4px;
            outline: none;
        }
        .rating-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #3b82f6;
            cursor: pointer;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .rating-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3b82f6;
            min-width: 50px;
            text-align: center;
        }
        .rating-label {
            transition: color 0.3s;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('judge.eventos.equipos', $proyecto->team->evento_id) }}" 
                   class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a Equipos
                </a>
                <span class="text-sm text-gray-600">Juez: {{ auth()->user()->name }}</span>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Información del Proyecto -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-star mr-3"></i>Evaluar Proyecto
                </h1>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Información del Proyecto</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Título:</p>
                            <p class="font-medium text-gray-900">{{ $proyecto->titulo }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Equipo:</p>
                            <p class="font-medium text-gray-900">{{ $proyecto->team->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Evento:</p>
                            <p class="font-medium text-gray-900">{{ $proyecto->team->evento->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Líder del equipo:</p>
                            <p class="font-medium text-gray-900">{{ $proyecto->team->lider->name }}</p>
                        </div>
                    </div>
                    
                    @if($proyecto->descripcion)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Descripción:</p>
                        <p class="text-gray-900">{{ $proyecto->descripcion }}</p>
                    </div>
                    @endif
                    
                    @if($proyecto->url)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Enlace del proyecto:</p>
                        <a href="{{ $proyecto->url }}" 
                           target="_blank" 
                           class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                            <i class="fas fa-external-link-alt mr-2"></i> {{ $proyecto->url }}
                        </a>
                    </div>
                    @endif
                    
                    @if($proyecto->github_url)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Repositorio GitHub:</p>
                        <a href="{{ $proyecto->github_url }}" 
                           target="_blank" 
                           class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                            <i class="fab fa-github mr-2"></i> Ver código fuente
                        </a>
                    </div>
                    @endif
                </div>
                
                @if($evaluacionExistente)
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                        <div>
                            <p class="font-medium text-yellow-800">Ya has evaluado este proyecto anteriormente</p>
                            <p class="text-sm text-yellow-700 mt-1">
                                Tu calificación anterior fue: <strong>{{ $evaluacionExistente->total_score }}/10</strong>
                            </p>
                            <p class="text-sm text-yellow-700">
                                Si envías una nueva evaluación, reemplazará la anterior.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Formulario de Evaluación -->
            <form method="POST" action="{{ route('judge.proyectos.calificar', $proyecto->id) }}" 
                  class="bg-white rounded-lg shadow p-6">
                @csrf
                
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-clipboard-check mr-2"></i>Formulario de Evaluación
                </h2>
                
                <!-- Innovación -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-4 rating-label" id="innovacionLabel">
                        Innovación y Creatividad
                        <span class="text-sm font-normal text-gray-500">(¿Qué tan original y creativa es la solución?)</span>
                    </label>
                    
                    <div class="flex items-center space-x-6">
                        <input type="range" 
                               min="1" 
                               max="10" 
                               step="1"
                               name="score_innovacion"
                               value="{{ $evaluacionExistente->score_innovacion ?? 5 }}"
                               class="rating-slider" 
                               id="innovacionSlider"
                               oninput="updateRating('innovacion', this.value)">
                        
                        <div class="rating-value" id="innovacionValue">
                            {{ $evaluacionExistente->score_innovacion ?? 5 }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>1 - Poco innovador</span>
                        <span>10 - Muy innovador</span>
                    </div>
                </div>
                
                <!-- Funcionalidad -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-4 rating-label" id="funcionalidadLabel">
                        Funcionalidad y Usabilidad
                        <span class="text-sm font-normal text-gray-500">(¿Funciona correctamente y es fácil de usar?)</span>
                    </label>
                    
                    <div class="flex items-center space-x-6">
                        <input type="range" 
                               min="1" 
                               max="10" 
                               step="1"
                               name="score_funcionalidad"
                               value="{{ $evaluacionExistente->score_funcionalidad ?? 5 }}"
                               class="rating-slider" 
                               id="funcionalidadSlider"
                               oninput="updateRating('funcionalidad', this.value)">
                        
                        <div class="rating-value" id="funcionalidadValue">
                            {{ $evaluacionExistente->score_funcionalidad ?? 5 }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>1 - No funciona bien</span>
                        <span>10 - Funciona perfectamente</span>
                    </div>
                </div>
                
                <!-- Diseño -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-4 rating-label" id="disenoLabel">
                        Diseño y Experiencia de Usuario
                        <span class="text-sm font-normal text-gray-500">(Calidad del diseño e interfaz de usuario)</span>
                    </label>
                    
                    <div class="flex items-center space-x-6">
                        <input type="range" 
                               min="1" 
                               max="10" 
                               step="1"
                               name="score_diseno"
                               value="{{ $evaluacionExistente->score_diseno ?? 5 }}"
                               class="rating-slider" 
                               id="disenoSlider"
                               oninput="updateRating('diseno', this.value)">
                        
                        <div class="rating-value" id="disenoValue">
                            {{ $evaluacionExistente->score_diseno ?? 5 }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>1 - Diseño deficiente</span>
                        <span>10 - Diseño excelente</span>
                    </div>
                </div>
                
                <!-- Presentación -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-4 rating-label" id="presentacionLabel">
                        Presentación y Comunicación
                        <span class="text-sm font-normal text-gray-500">(Calidad de la presentación y documentación)</span>
                    </label>
                    
                    <div class="flex items-center space-x-6">
                        <input type="range" 
                               min="1" 
                               max="10" 
                               step="1"
                               name="score_presentacion"
                               value="{{ $evaluacionExistente->score_presentacion ?? 5 }}"
                               class="rating-slider" 
                               id="presentacionSlider"
                               oninput="updateRating('presentacion', this.value)">
                        
                        <div class="rating-value" id="presentacionValue">
                            {{ $evaluacionExistente->score_presentacion ?? 5 }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>1 - Presentación pobre</span>
                        <span>10 - Presentación excepcional</span>
                    </div>
                </div>
                
                <!-- Calificación Total -->
                <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Calificación Total Estimada</p>
                            <p class="text-3xl font-bold text-blue-600" id="totalScore">0</p>
                            <p class="text-sm text-gray-500" id="totalText">Puntuación basada en tus calificaciones</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Rango</p>
                            <p class="text-lg font-semibold text-gray-800">1 - 10</p>
                        </div>
                    </div>
                </div>
                
                <!-- Comentarios -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-4">
                        <i class="fas fa-comment-alt mr-2"></i>Comentarios y Observaciones
                        <span class="text-sm font-normal text-gray-500">(Opcional - retroalimentación para el equipo)</span>
                    </label>
                    
                    <textarea name="comments" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Proporciona retroalimentación constructiva para el equipo...">{{ $evaluacionExistente->comments ?? '' }}</textarea>
                    
                    <p class="text-sm text-gray-500 mt-2">
                        Los comentarios serán visibles para los miembros del equipo después de que finalice el evento.
                    </p>
                </div>
                
                <!-- Botones -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('judge.eventos.equipos', $proyecto->team->evento_id) }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </a>
                    
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ $evaluacionExistente ? 'Actualizar Evaluación' : 'Enviar Evaluación' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para actualizar la calificación mostrada
        function updateRating(category, value) {
            // Actualizar el valor mostrado
            document.getElementById(category + 'Value').textContent = value;
            
            // Actualizar el color del label según la calificación
            const label = document.getElementById(category + 'Label');
            if (value >= 9) {
                label.style.color = '#10b981'; // Verde
            } else if (value >= 7) {
                label.style.color = '#3b82f6'; // Azul
            } else if (value >= 5) {
                label.style.color = '#f59e0b'; // Amarillo
            } else {
                label.style.color = '#ef4444'; // Rojo
            }
            
            // Calcular y mostrar la calificación total
            calculateTotalScore();
        }
        
        // Calcular la calificación total
        function calculateTotalScore() {
            const innovacion = parseInt(document.getElementById('innovacionSlider').value);
            const funcionalidad = parseInt(document.getElementById('funcionalidadSlider').value);
            const diseno = parseInt(document.getElementById('disenoSlider').value);
            const presentacion = parseInt(document.getElementById('presentacionSlider').value);
            
            const total = (innovacion + funcionalidad + diseno + presentacion) / 4;
            const roundedTotal = Math.round(total * 10) / 10; // Redondear a 1 decimal
            
            document.getElementById('totalScore').textContent = roundedTotal.toFixed(1);
            
            // Actualizar texto descriptivo
            const totalText = document.getElementById('totalText');
            if (roundedTotal >= 9) {
                totalText.textContent = 'Excelente - Proyecto sobresaliente';
                totalText.className = 'text-sm text-green-600';
                document.getElementById('totalScore').className = 'text-3xl font-bold text-green-600';
            } else if (roundedTotal >= 7) {
                totalText.textContent = 'Bueno - Proyecto de calidad';
                totalText.className = 'text-sm text-blue-600';
                document.getElementById('totalScore').className = 'text-3xl font-bold text-blue-600';
            } else if (roundedTotal >= 5) {
                totalText.textContent = 'Regular - Necesita mejoras';
                totalText.className = 'text-sm text-yellow-600';
                document.getElementById('totalScore').className = 'text-3xl font-bold text-yellow-600';
            } else {
                totalText.textContent = 'Deficiente - Requiere mucho trabajo';
                totalText.className = 'text-sm text-red-600';
                document.getElementById('totalScore').className = 'text-3xl font-bold text-red-600';
            }
        }
        
        // Inicializar los controles deslizantes y calcular la calificación total
        document.addEventListener('DOMContentLoaded', function() {
            // Actualizar todos los valores iniciales
            updateRating('innovacion', document.getElementById('innovacionSlider').value);
            updateRating('funcionalidad', document.getElementById('funcionalidadSlider').value);
            updateRating('diseno', document.getElementById('disenoSlider').value);
            updateRating('presentacion', document.getElementById('presentacionSlider').value);
            
            // Calcular la calificación total inicial
            calculateTotalScore();
        });
    </script>
</body>
</html>