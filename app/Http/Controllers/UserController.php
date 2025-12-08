<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        
        $user->update($request->only(['name', 'email']));
        
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
    
    /**
     * Cambiar rol de usuario
     */
    public function cambiarRol(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_role' => 'required|in:admin,juez,user'
        ]);
        
        try {
            $usuario = User::findOrFail($request->user_id);
            
            // Remover todos los roles actuales
            $usuario->roles()->detach();
            
            // Asignar nuevo rol
            $role = Role::where('name', $request->new_role)->first();
            if ($role) {
                $usuario->assignRole($role);
            }
            
            // Si es petición AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rol cambiado exitosamente'
                ]);
            }
            
            return back()->with('success', 'Rol cambiado exitosamente');
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al cambiar el rol: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Error al cambiar el rol: ' . $e->getMessage());
        }
    }
}
