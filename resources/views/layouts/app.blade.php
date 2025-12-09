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
    </body>
</html>