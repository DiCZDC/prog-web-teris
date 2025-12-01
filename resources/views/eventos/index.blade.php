<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERIS - Eventos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4a148c 0%, #6a1b9a 50%, #8e24aa 100%);
            min-height: 100vh;
            color: white;
        }
        

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 28px;
            font-weight: bold;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            border-radius: 8px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            width: 300px;
            outline: none;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .nav-menu {
            display: flex;
            gap: 45px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 27px;
            transition: opacity 0.3s;
        }

        .nav-menu a:hover {
            opacity: 0.8;
        }

        .auth-btn {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            font-size: 48px;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 4px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .eventos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .evento-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .evento-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.5);
        }

        .evento-imagen {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 50%, #6c5b7b 100%);
        }

        .evento-content {
            padding: 25px;
        }

        .evento-titulo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .evento-descripcion {
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .evento-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .evento-info strong {
            color: #ffd700;
        }

        .detalles-link {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: rgba(255, 215, 0, 0.2);
            border: 1px solid #ffd700;
            border-radius: 8px;
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .detalles-link:hover {
            background: rgba(255, 215, 0, 0.4);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .eventos-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 20px;
            }

            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon"></div>
            <span>TERIS</span>
        </div>

        <div class="search-box">
            <form action="{{ route('eventos.buscar') }}" method="GET">
                <input type="text" name="q" placeholder="Buscar evento" />
            </form>
        </div>

        <ul class="nav-menu">
            
            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 2048 2048"><path fill="#ffffff" d="M1850 688q45 25 82 61t62 80t40 93t14 102h-128q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 91-41 173t-115 136q65 33 117 81t90 108t57 128t20 142h-128q0-79-30-149t-83-122t-122-82t-149-31q-79 0-149 30t-122 83t-82 122t-31 149H512q0-73 20-141t57-128t89-108t118-82q-73-54-114-136t-42-173q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99H0q0-52 14-101t39-93t63-80t82-62q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81q82 45 134 124q54-80 138-126t182-46q97 0 181 46t139 126q52-79 134-124q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81M256 512q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50m768 768q52 0 99-20t81-55t55-81t21-100q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 53 20 99t55 81t81 55t100 21m512-768q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50"/></svg> Equipo</a></li>
            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M14.272 10.445L18 2m-8.684 8.632L5 2m7.762 8.048L8.835 2m5.525 0l-1.04 2.5M6 16a6 6 0 1 0 12 0a6 6 0 0 0-12 0"/><path d="m10.5 15l2-1.5v5"/></g></svg>Concursos</a></li>
            <li><a href="{{ route('eventos.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24"><path fill="#ffffff" d="M12 14.154q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192"/></svg>Eventos</a></li>
            <li><a href="#" class="auth-btn"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#ffffff" d="M16 14a5 5 0 0 1 4.995 4.783L21 19v1a2 2 0 0 1-1.85 1.995L19 22H5a2 2 0 0 1-1.995-1.85L3 20v-1a5 5 0 0 1 4.783-4.995L8 14zm0 2H8a3 3 0 0 0-2.995 2.824L5 19v1h14v-1a3 3 0 0 0-2.824-2.995zM12 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></g></svg>Iniciar sesión/ Registrarse</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Eventos Populares</h1>

        <div class="eventos-grid">
            @forelse($eventosPopulares as $evento)
            <div class="evento-card" onclick="window.location='{{ route('eventos.show', $evento->id) }}'">
                <img src="{{ asset('storage/' . $evento->imagen) }}" alt="{{ $evento->nombre }}" class="evento-imagen">
                
                <div class="evento-content">
                    <h2 class="evento-titulo">{{ $evento->nombre }}</h2>
                    <p class="evento-descripcion">{{ Str::limit($evento->descripcion, 150) }}</p>
                    
                    <div class="evento-info">
                        <div><strong>Fecha de inicio:</strong> {{ $evento->fecha_inicio->format('F d, Y') }}</div>
                        <div><strong>Fecha de finalización:</strong> {{ $evento->fecha_finalizacion->format('F d, Y') }}</div>
                        <div><strong>Estado:</strong> {{ $evento->estado }}</div>
                        <div><strong>Modalidad:</strong> {{ $evento->modalidad }}@if($evento->ubicacion) ({{ $evento->ubicacion }})@endif</div>
                    </div>

                    <a href="{{ route('eventos.show', $evento->id) }}" class="detalles-link">Detalles adicionales</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
                <h2>No hay eventos populares disponibles</h2>
                <p style="margin-top: 10px; opacity: 0.7;">Pronto agregaremos nuevos eventos</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>