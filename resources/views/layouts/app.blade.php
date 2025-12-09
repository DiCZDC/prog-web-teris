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
                color: white;
                font-size: 16px;
                cursor: pointer;
                transition: all 0.3s;
            }

            .auth-btn:hover {
                background: rgba(255, 255, 255, 0.3);
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .user-name {
                color: rgba(255, 255, 255, 0.9);
                font-size: 16px;
            }

            .logout-btn {
                background: rgba(255, 0, 0, 0.3);
                border: 1px solid rgba(255, 0, 0, 0.5);
                padding: 8px 20px;
                border-radius: 20px;
                color: white;
                cursor: pointer;
                transition: all 0.3s;
            }

            .logout-btn:hover {
                background: rgba(255, 0, 0, 0.5);
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="nav-bar bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
    </body>
</html>