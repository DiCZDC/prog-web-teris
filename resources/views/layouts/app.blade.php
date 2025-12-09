<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Stack para estilos adicionales de vistas -->
        @stack('styles')
        
        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', 'Arial', sans-serif;
                background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
                min-height: 100vh;
                color: #e0e7ff;
            }

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem 2.5rem;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
                box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
                border-bottom: 3px solid rgba(167, 139, 250, 0.3);
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 28px;
                font-weight: 700;
                color: white;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #c4b5fd, #a78bfa);
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(167, 139, 250, 0.4);
            }

            .search-box {
                position: relative;
            }

            .search-box input {
                background: rgba(30, 27, 75, 0.7);
                border: 2px solid rgba(167, 139, 250, 0.4);
                border-radius: 25px;
                padding: 12px 20px;
                color: #e0e7ff;
                width: 350px;
                outline: none;
                transition: all 0.2s ease;
                box-shadow: 0 2px 10px rgba(139, 92, 246, 0.2);
            }

            .search-box input:focus {
                border-color: #a78bfa;
                box-shadow: 0 4px 20px rgba(167, 139, 250, 0.4);
                background: rgba(30, 27, 75, 0.9);
            }

            .search-box input::placeholder {
                color: #a78bfa;
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
                transition: all 0.2s ease;
            }

            .nav-menu a:hover {
                opacity: 0.85;
                transform: translateY(-2px);
            }

            .auth-btn {
                background: rgba(167, 139, 250, 0.2);
                padding: 10px 24px;
                border-radius: 25px;
                border: 2px solid rgba(167, 139, 250, 0.4);
                color: white;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                box-shadow: 0 2px 10px rgba(139, 92, 246, 0.2);
            }

            .auth-btn:hover {
                background: rgba(167, 139, 250, 0.3);
                border-color: #a78bfa;
                box-shadow: 0 4px 20px rgba(167, 139, 250, 0.4);
                transform: translateY(-2px);
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .user-name {
                color: #e0e7ff;
                font-size: 16px;
                font-weight: 500;
            }

            .logout-btn {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.3), rgba(220, 38, 38, 0.3));
                border: 2px solid rgba(239, 68, 68, 0.5);
                padding: 10px 24px;
                border-radius: 25px;
                color: white;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                box-shadow: 0 2px 10px rgba(239, 68, 68, 0.2);
            }

            .logout-btn:hover {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.5), rgba(220, 38, 38, 0.5));
                border-color: rgba(239, 68, 68, 0.7);
                box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
                transform: translateY(-2px);
            }

            .container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 40px 20px;
            }

            h1 {
                text-align: center;
                font-size: 2.5rem;
                font-weight: 800;
                margin-bottom: 50px;
                text-transform: uppercase;
                letter-spacing: 4px;
                background: linear-gradient(135deg, #c4b5fd, #a78bfa, #ddd6fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Botón de perfil con menú desplegable */
            .profile-btn {
                display: flex;
                align-items: center;
                gap: 12px;
                background: rgba(167, 139, 250, 0.2);
                border: 2px solid rgba(167, 139, 250, 0.4);
                border-radius: 30px;
                padding: 12px 24px;
                color: white;
                font-size: 18px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(139, 92, 246, 0.2);
            }

            .profile-btn:hover {
                background: rgba(167, 139, 250, 0.3);
                border-color: #a78bfa;
                box-shadow: 0 4px 20px rgba(167, 139, 250, 0.5);
                transform: translateY(-2px);
            }

            .profile-name {
                font-size: 18px;
                font-weight: 600;
                color: #e0e7ff;
                max-width: 180px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .chevron-icon {
                transition: transform 0.3s ease;
                color: #e0e7ff;
            }

            .profile-btn.active .chevron-icon {
                transform: rotate(180deg);
            }

            /* Menú desplegable del perfil */
            .profile-dropdown {
                position: absolute;
                top: calc(100% + 12px);
                right: 0;
                background: linear-gradient(135deg, rgba(49, 46, 129, 0.98), rgba(76, 29, 149, 0.98));
                border: 2px solid rgba(167, 139, 250, 0.4);
                border-radius: 15px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4), 0 4px 15px rgba(139, 92, 246, 0.3);
                min-width: 220px;
                overflow: hidden;
                z-index: 1000;
                animation: slideDown 0.3s ease;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .profile-menu-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 20px;
                color: #e0e7ff;
                text-decoration: none;
                font-size: 16px;
                font-weight: 500;
                transition: all 0.2s ease;
                border: none;
                background: transparent;
                width: 100%;
                text-align: left;
                cursor: pointer;
            }

            .profile-menu-item:hover {
                background: rgba(167, 139, 250, 0.25);
                color: #ffffff;
            }

            .profile-menu-item svg {
                stroke: #a78bfa;
                transition: stroke 0.2s ease;
            }

            .profile-menu-item:hover svg {
                stroke: #c4b5fd;
            }

            .profile-menu-logout {
                border-top: 1px solid rgba(167, 139, 250, 0.2);
            }

            .profile-menu-logout:hover {
                background: rgba(239, 68, 68, 0.2);
                color: #fecaca;
            }

            .profile-menu-logout:hover svg {
                stroke: #fca5a5;
            }

            /* Botones de autenticación para usuarios no autenticados */
            .auth-btn-secondary {
                display: inline-block;
                background: rgba(167, 139, 250, 0.15);
                border: 2px solid rgba(167, 139, 250, 0.3);
                border-radius: 25px;
                padding: 10px 24px;
                color: #e0e7ff;
                font-size: 16px;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(139, 92, 246, 0.1);
            }

            .auth-btn-secondary:hover {
                background: rgba(167, 139, 250, 0.25);
                border-color: #a78bfa;
                box-shadow: 0 4px 20px rgba(167, 139, 250, 0.3);
                transform: translateY(-2px);
            }

            .auth-btn-primary {
                display: inline-flex;
                align-items: center;
                background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
                border: 2px solid rgba(192, 132, 252, 0.5);
                border-radius: 25px;
                padding: 12px 28px;
                color: white;
                font-size: 16px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .auth-btn-primary:hover {
                background: linear-gradient(135deg, #7c3aed 0%, #9333ea 100%);
                border-color: #c084fc;
                box-shadow: 0 6px 30px rgba(139, 92, 246, 0.6);
                transform: translateY(-3px);
            }

            @media (max-width: 768px) {
                .navbar {
                    flex-direction: column;
                    gap: 20px;
                    padding: 1rem;
                }

                .search-box input {
                    width: 100%;
                }

                .nav-menu {
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                }

                .profile-btn {
                    padding: 10px 16px;
                    font-size: 16px;
                }

                .profile-name {
                    max-width: 120px;
                    font-size: 16px;
                }

                .profile-dropdown {
                    min-width: 180px;
                }

                .auth-btn-primary,
                .auth-btn-secondary {
                    font-size: 14px;
                    padding: 8px 18px;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="shadow" style="background: linear-gradient(135deg, rgba(49, 46, 129, 0.95), rgba(76, 29, 149, 0.95)); border-bottom: 2px solid rgba(167, 139, 250, 0.3);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="color: #e0e7ff;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @if(View::hasSection('content'))
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </main>
        </div>

        <!-- Stack para scripts adicionales de vistas -->
        @stack('scripts')

        <!-- JavaScript para el menú desplegable del perfil -->
        <script>
            function toggleProfileMenu() {
                const menu = document.getElementById('profileMenu');
                const button = document.querySelector('.profile-btn');

                if (menu.style.display === 'none' || menu.style.display === '') {
                    menu.style.display = 'block';
                    button.classList.add('active');
                } else {
                    menu.style.display = 'none';
                    button.classList.remove('active');
                }
            }

            // Cerrar el menú al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                const menu = document.getElementById('profileMenu');
                const button = document.querySelector('.profile-btn');

                if (menu && button) {
                    const isClickInsideButton = button.contains(event.target);
                    const isClickInsideMenu = menu.contains(event.target);

                    if (!isClickInsideButton && !isClickInsideMenu && menu.style.display === 'block') {
                        menu.style.display = 'none';
                        button.classList.remove('active');
                    }
                }
            });

            // Cerrar el menú al presionar la tecla Escape
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const menu = document.getElementById('profileMenu');
                    const button = document.querySelector('.profile-btn');

                    if (menu && menu.style.display === 'block') {
                        menu.style.display = 'none';
                        if (button) {
                            button.classList.remove('active');
                        }
                    }
                }
            });
        </script>
    </body>
</html>