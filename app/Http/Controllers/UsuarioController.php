<?php

namespace App\Http\Controllers;
use App\Models\Usuarios;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    // Método para mostrar un usuario específico
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    // Método para crear un nuevo usuario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'contraseña' => 'required|string|min:6',
            'saldo_actual' => 'nullable|numeric'
        ]);

        $usuario = Usuario::create([
            'nombre' => $validatedData['nombre'],
            'email' => $validatedData['email'],
            'contraseña' => bcrypt($validatedData['contraseña']),
            'saldo_actual' => $validatedData['saldo_actual'] ?? 0.00
        ]);

        return response()->json($usuario, 201);
    }

    // Método para actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|unique:usuarios,email,' . $id,
            'contraseña' => 'sometimes|required|string|min:6',
            'saldo_actual' => 'nullable|numeric'
        ]);

        $usuario->update([
            'nombre' => $validatedData['nombre'] ?? $usuario->nombre,
            'email' => $validatedData['email'] ?? $usuario->email,
            'contraseña' => isset($validatedData['contraseña']) ? bcrypt($validatedData['contraseña']) : $usuario->contraseña,
            'saldo_actual' => $validatedData['saldo_actual'] ?? $usuario->saldo_actual
        ]);

        return response()->json($usuario);
    }

    // Método para eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente']);
    }
}
