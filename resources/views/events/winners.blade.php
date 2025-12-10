<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganadores - {{ $evento->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .winner-card {
            transition: transform 0.3s;
        }
        .winner-card:hover {
            transform: translateY(-10px);
        }
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: #ffd700;
            animation: fall 3s linear infinite;
        }
        @keyframes fall {
            to { transform: translateY(100vh) rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 min-h-screen">
    
    <!-- Header -->
    <div class="text-center py-12">
        <h1 class="text-5xl font-bold text-white mb-4">
            🏆 GANADORES 🏆
        </h1>
        <h2 class="text-3xl text-yellow-300">{{ $evento->nombre }}</h2>
        <p class="text-gray-300 mt-2">{{ $evento->winners_announced_at->format('d/m/Y') }}</p>
    </div>

    <div class="container mx-auto px-4 pb-12">
        
        <!-- Podio -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 max-w-6xl mx-auto">
            
            @php
                $primer = $ganadores->where('position', '1')->first();
                $segundo = $ganadores->where('position', '2')->first();
                $tercer = $ganadores->where('position', '3')->first();
            @endphp

            <!-- Segundo Lugar (Izquierda) -->
            @if($segundo)
            <div class="md:order-1 md:mt-12">
                <div class="bg-white rounded-lg shadow-2xl p-6 winner-card">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🥈</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">SEGUNDO LUGAR</h3>
                        <div class="border-t-2 border-gray-200 my-4"></div>
                        <h4 class="text-xl font-semibold text-blue-600 mb-2">{{ $segundo->team->nombre }}</h4>
                        <p class="text-gray-600 mb-4">
                            <i class="fas fa-user mr-2"></i>{{ $segundo->team->lider->name }}
                        </p>
                        <div class="bg-gray-100 rounded-lg py-3 px-4 mb-4">
                            <p class="text-3xl font-bold text-gray-800">{{ $segundo->final_score }}</p>
                            <p class="text-sm text-gray-600">puntos</p>
                        </div>
                        @if($segundo->recognition)
                        <p class="text-sm text-gray-700 italic bg-yellow-50 p-3 rounded">
                            "{{ $segundo->recognition }}"
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Primer Lugar (Centro) -->
            @if($primer)
            <div class="md:order-2">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg shadow-2xl p-8 winner-card">
                    <div class="text-center">
                        <div class="text-8xl mb-4">🥇</div>
                        <h3 class="text-3xl font-bold text-white mb-2">PRIMER LUGAR</h3>
                        <div class="border-t-2 border-yellow-300 my-4"></div>
                        <h4 class="text-2xl font-bold text-white mb-2">{{ $primer->team->nombre }}</h4>
                        <p class="text-yellow-100 mb-4">
                            <i class="fas fa-user mr-2"></i>{{ $primer->team->lider->name }}
                        </p>
                        <div class="bg-white rounded-lg py-4 px-6 mb-4">
                            <p class="text-4xl font-bold text-yellow-600">{{ $primer->final_score }}</p>
                            <p class="text-sm text-gray-600">puntos</p>
                        </div>
                        @if($primer->recognition)
                        <p class="text-sm text-white italic bg-yellow-500 bg-opacity-50 p-3 rounded">
                            "{{ $primer->recognition }}"
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Tercer Lugar (Derecha) -->
            @if($tercer)
            <div class="md:order-3 md:mt-12">
                <div class="bg-white rounded-lg shadow-2xl p-6 winner-card">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🥉</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">TERCER LUGAR</h3>
                        <div class="border-t-2 border-gray-200 my-4"></div>
                        <h4 class="text-xl font-semibold text-orange-600 mb-2">{{ $tercer->team->nombre }}</h4>
                        <p class="text-gray-600 mb-4">
                            <i class="fas fa-user mr-2"></i>{{ $tercer->team->lider->name }}
                        </p>
                        <div class="bg-gray-100 rounded-lg py-3 px-4 mb-4">
                            <p class="text-3xl font-bold text-gray-800">{{ $tercer->final_score }}</p>
                            <p class="text-sm text-gray-600">puntos</p>
                        </div>
                        @if($tercer->recognition)
                        <p class="text-sm text-gray-700 italic bg-yellow-50 p-3 rounded">
                            "{{ $tercer->recognition }}"
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Botón Volver -->
        <div class="text-center mt-12">
            <a href="{{ route('events.show', $evento->id) }}" 
               class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-gray-100">
                <i class="fas fa-arrow-left mr-2"></i>Volver al Evento
            </a>
        </div>
    </div>

    <script>
        // Crear confeti
        for (let i = 0; i < 50; i++) {
            let confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.animationDelay = Math.random() * 3 + 's';
            confetti.style.background = ['#ffd700', '#ff6b6b', '#4ecdc4', '#45b7d1'][Math.floor(Math.random() * 4)];
            document.body.appendChild(confetti);
        }
    </script>
</body>
</html>