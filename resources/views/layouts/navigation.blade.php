<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <nav class="navbar">
        <a href="/">
        <div class="logo">
            <div class="logo-icon"></div>
            <span>TERIS</span>
        </div>
        </a>
        {{-- <div class="search-box">
            <form action="{{ route('events.search') }}" method="GET">
                <input type="text" name="q" placeholder="Buscar evento" />
            </form>
        </div> --}}
        <ul class="nav-menu">
            <!-- Enlaces solo para usuarios autenticados -->
            @auth    
                <!--Eventos-->
                <li>
                    <a href="{{ route('events.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24">
                            <path fill="#ffffff" d="M12 14.154q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192"/>
                        </svg>
                        Eventos
                    </a>
                </li>
                    {{-- <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M14.272 10.445L18 2m-8.684 8.632L5 2m7.762 8.048L8.835 2m5.525 0l-1.04 2.5M6 16a6 6 0 1 0 12 0a6 6 0 0 0-12 0"/><path d="m10.5 15l2-1.5v5"/></g></svg>Concursos</a></li> --}}
                <!--Equipos-->
                <li>
                    <a href="/teams">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 2048 2048">
                            <path fill="#ffffff" d="M1850 688q45 25 82 61t62 80t40 93t14 102h-128q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 91-41 173t-115 136q65 33 117 81t90 108t57 128t20 142h-128q0-79-30-149t-83-122t-122-82t-149-31q-79 0-149 30t-122 83t-82 122t-31 149H512q0-73 20-141t57-128t89-108t118-82q-73-54-114-136t-42-173q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99H0q0-52 14-101t39-93t63-80t82-62q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81q82 45 134 124q54-80 138-126t182-46q97 0 181 46t139 126q52-79 134-124q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81M256 512q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50m768 768q52 0 99-20t81-55t55-81t21-100q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 53 20 99t55 81t81 55t100 21m512-768q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50"/>
                        </svg> 
                        Equipos
                    </a>
                </li>
                <!-- Mostrar enlaces solo para administradores -->
                @if(auth()->check() && auth()->user()->hasRole('admin'))
                    <!--Proyectos-->
                        <li>
                            <a href="/projects">
                                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 8 8">
                                    <path fill="#ffffff" d="M0 0v7h1V0H0zm7 0v7h1V0H7zM2 1v1h2V1H2zm1 2v1h2V3H3zm1 2v1h2V5H4z"/>
                                </svg> 
                                Proyectos
                            </a>
                        </li>
                    <!--Lista de usuarios-->
                    <li>
                        <a href="/users">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M12 12q2.075 0 3.538-1.463T17 7q0-2.075-1.463-3.538T12 2q-2.075 0-3.538 1.463T7 7q0 2.075 1.463 3.538T12 12zm0 2q-2.925 0-4.963 2.038T5 19v1h14v-1q0-2.925-2.038-4.963T12 14z"/>
                            </svg> 
                            Usuarios
                        </a>
                    </li>
                @endif
            @endauth
            <!-- Enlaces solo para usuarios autenticados -->
            @auth
                <li>
                    <div class="user-info">
                        <span class="user-name">
                            {{-- <a href="{{ route('profile.show') }}" class="auth-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="display: inline; vertical-align: middle;">
                                    <g fill="none" fill-rule="evenodd">
                                        <path fill="#ffffff" d="M16 14a5 5 0 0 1 4.995 4.783L21 19v1a2 2 0 0 1-1.85 1.995L19 22H5a2 2 0 0 1-1.995-1.85L3 20v-1a5 5 0 0 1 4.783-4.995L8 14zm0 2H8a3 3 0 0 0-2.995 2.824L5 19v1h14v-1a3 3 0 0 0-2.824-2.995zM12 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/>
                                    </g>
                                </svg>
                            </a> --}}
                                Hola, {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                🚪 Cerrar sesión
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <!-- Enlace para usuarios no autenticados -->
                <li>
                    <a href="{{ route('login') }}" class="auth-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="display: inline; vertical-align: middle;">
                            <g fill="none" fill-rule="evenodd">
                                <path fill="#ffffff" d="M16 14a5 5 0 0 1 4.995 4.783L21 19v1a2 2 0 0 1-1.85 1.995L19 22H5a2 2 0 0 1-1.995-1.85L3 20v-1a5 5 0 0 1 4.783-4.995L8 14zm0 2H8a3 3 0 0 0-2.995 2.824L5 19v1h14v-1a3 3 0 0 0-2.824-2.995zM12 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/>
                            </g>
                        </svg>
                        Iniciar sesión
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
</nav>
