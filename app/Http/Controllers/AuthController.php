<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\MailController;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        
        // Redirigir según el rol del usuario
        if ($user->hasRole('admin')) {
            return redirect()->route('events.index')
                ->with('success', '¡Bienvenido Admin ' . $user->name . '!');
        }
        
        if ($user->hasRole('juez')) {
            return redirect()->route('judge.dashboard')
                ->with('success', '¡Bienvenido Juez ' . $user->name . '!');
        }
        
        // Usuario normal
        return redirect()->route('home')
            ->with('success', '¡Bienvenido ' . $user->name . '!');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email');
}

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar rol de usuario por defecto
        $user->assignRole('user');

        Auth::login($user);
        $mailController = new MailController();
        $mailController->sendCreatedAccountEmail($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}