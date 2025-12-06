<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Mostrar la página del perfil del usuario
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar el perfil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Actualizar la información del perfil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Mostrar el formulario para cambiar la contraseña
     */
    public function editPassword()
    {
        return view('profile.edit-password');
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

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Contraseña actualizada correctamente.');
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

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada.');
    }
}