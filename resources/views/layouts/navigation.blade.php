<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <nav class="navbar">
        <a href="/">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>TERIS</span>
            </div>
        </a>

        <ul class="nav-menu">
            @auth    
                <!-- EVENTOS - Para todos los usuarios autenticados -->
                <li>
                    <a href="{{ route('events.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24">
                            <path fill="#ffffff" d="M12 14.154q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192"/>
                        </svg>
                        Eventos
                    </a>
                </li>

                <!-- EQUIPOS - Para todos los usuarios autenticados -->
                <li>
                    <a href="{{ route('teams.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 2048 2048">
                            <path fill="#ffffff" d="M1850 688q45 25 82 61t62 80t40 93t14 102h-128q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 91-41 173t-115 136q65 33 117 81t90 108t57 128t20 142h-128q0-79-30-149t-83-122t-122-82t-149-31q-79 0-149 30t-122 83t-82 122t-31 149H512q0-73 20-141t57-128t89-108t118-82q-73-54-114-136t-42-173q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99H0q0-52 14-101t39-93t63-80t82-62q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81q82 45 134 124q54-80 138-126t182-46q97 0 181 46t139 126q52-79 134-124q-33-35-51-81t-19-95q0-52 20-99t55-81t81-55t100-21q52 0 99 20t81 55t55 82t21 99q0 49-18 95t-52 81M256 512q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50m768 768q52 0 99-20t81-55t55-81t21-100q0-52-20-99t-55-81t-82-55t-99-21q-53 0-99 20t-81 55t-55 82t-21 99q0 53 20 99t55 81t81 55t100 21m512-768q0 27 10 50t27 40t41 28t50 10q27 0 50-10t40-27t28-41t10-50q0-27-10-50t-27-40t-41-28t-50-10q-27 0-50 10t-40 27t-28 41t-10 50"/>
                        </svg> 
                        Equipos
                    </a>
                </li>

                <!-- DASHBOARD DE JUEZ - Solo para jueces -->
                {{-- Panel Juez - SOLO para jueces, NO para admin --}}
                @if(auth()->user()->hasRole('juez') )
                    <li>
                        <a href="{{ route('judge.dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M12 2.25a2.75 2.75 0 0 0-2.703 3.26c-.577.315-.981.683-1.29.964q-.144.134-.264.235a2.1 2.1 0 0 1-.634.382c-.247.09-.589.159-1.109.159a.75.75 0 1 0 0 1.5c.652 0 1.177-.086 1.626-.251c.454-.167.79-.4 1.074-.635c.153-.127.284-.245.407-.357c.272-.246.508-.46.86-.655c.34.373.783.653 1.283.795V16.5c0 1.168-.236 1.987-.606 2.496c-.344.472-.856.754-1.644.754a.75.75 0 0 0 0 1.5c1.212 0 2.2-.468 2.857-1.371q.063-.09.123-.18q.191.283.427.519c.727.726 1.68 1.032 2.593 1.032a.75.75 0 0 0 0-1.5c-.586 0-1.133-.194-1.532-.593c-.393-.393-.718-1.06-.718-2.157V7.646a2.75 2.75 0 0 0 1.283-.795c.352.196.588.41.86.656c.124.112.255.23.407.357c.285.236.62.468 1.074.635c.45.165.974.251 1.626.251a.75.75 0 0 0 0-1.5c-.52 0-.862-.068-1.108-.16a2.1 2.1 0 0 1-.634-.38a8 8 0 0 1-.265-.236c-.309-.28-.713-.649-1.29-.964q.046-.248.047-.51A2.75 2.75 0 0 0 12 2.25M10.75 5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0"/>
                                <path fill="#ffffff" d="M2.5 13.25a.75.75 0 0 0-.75.75a4.25 4.25 0 0 0 8.5 0a.75.75 0 0 0-.75-.75h-.532L7.111 9.457l-.018-.035a1.25 1.25 0 0 0-2.203.035L3.032 13.25zm.983 1.5h5.164a2.751 2.751 0 0 1-5.293 0zm3.815-1.5H4.702L6 10.6zm6.452.75a.75.75 0 0 1 .75-.75h.532l1.858-3.793l.017-.035a1.25 1.25 0 0 1 2.204.035l1.857 3.793h.532a.75.75 0 0 1 .75.75a4.25 4.25 0 0 1-8.5 0m6.735.75h-5.132a2.751 2.751 0 0 0 5.294 0zm-1.187-1.5L18 10.6l-1.297 2.65z"/>
                            </svg>
                            Panel Juez
                        </a>
                    </li>
                @endif

                <!-- PANEL ADMIN - Solo para administradores -->
                @if(auth()->user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24">
                                <path fill="#ffffff" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                            Admin
                        </a>
                    </li>
                @endif

                <!-- PERFIL Y LOGOUT -->
                <li>
                    <div class="user-info">
                        <span class="user-name">
                            <a href="{{ route('profile.show') }}" class="auth-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="display: inline; vertical-align: middle;">
                                    <g fill="none" fill-rule="evenodd">
                                        <path fill="#ffffff" d="M16 14a5 5 0 0 1 4.995 4.783L21 19v1a2 2 0 0 1-1.85 1.995L19 22H5a2 2 0 0 1-1.995-1.85L3 20v-1a5 5 0 0 1 4.783-4.995L8 14zm0 2H8a3 3 0 0 0-2.995 2.824L5 19v1h14v-1a3 3 0 0 0-2.824-2.995zM12 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/>
                                    </g>
                                </svg>
                            </a>
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
                <!-- LOGIN para usuarios no autenticados -->
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