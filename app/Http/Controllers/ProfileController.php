<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Mostrar la página del perfil del usuario
     */
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }
        
        // Pasar el usuario a la vista usando view()->share para asegurar disponibilidad
        view()->share('profileUser', $user);
        
        return view('profile.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar el perfil
     */
    public function edit()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Actualizar la información del perfil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.show')
            ->with('success', 'Perfil actualizado correctamente.')
            ->with('user', $user); // Pasar usuario en sesión
    }

    /**
     * Mostrar el formulario para cambiar la contraseña
     */
    public function editPassword()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        return view('profile.edit-password', compact('user'));
    }

    /**
     * Actualizar la contraseña del usuario
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Contraseña actualizada correctamente.')
            ->with('user', $user);
    }

    /**
     * Eliminar la cuenta del usuario
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')
            ->with('success', 'Tu cuenta ha sido eliminada permanentemente.');
    }

    /**
     * Método para obtener estadísticas del usuario (si las necesitas)
     */
    public function getUserStats()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
        
        $stats = [
            'eventos_inscritos' => 0, // Cambia por tu lógica real
            'equipos_activos' => 0,
            'proyectos_creados' => 0,
            'puntos_acumulados' => 0,
        ];
        
        return $stats;
    }
}