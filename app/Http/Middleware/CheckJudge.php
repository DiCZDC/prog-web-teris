<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJudge
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

        $user = auth()->user();

        // Los admins pueden acceder a las vistas de juez también
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // Verificar si tiene rol de juez
        if (!$user->hasRole('judge')) {
            abort(403, 'No tienes permisos de juez para acceder a esta sección.');
        }

        // Si la ruta tiene parámetro de evento, verificar que sea juez de ese evento
        $eventId = $request->route('evento') ?? $request->route('event');
        
        if ($eventId && !$user->esJuezDe($eventId)) {
            abort(403, 'No eres juez de este evento específico.');
        }

        return $next($request);
    }
}   