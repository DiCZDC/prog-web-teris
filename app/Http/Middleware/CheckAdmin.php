<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        // Verificar si tiene rol de admin
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes permisos de administrador para acceder a esta sección.');
        }

        return $next($request);
    }
}