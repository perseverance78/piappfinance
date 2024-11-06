<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para registrar un nuevo usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json(['access_token' => $token]);
    }

    // Método para iniciar sesión y obtener un token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'access_token' => $token,
            'user_id' => $user->id
        ]);

    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    // Método para obtener el usuario autenticado
    public function me()
    {
        return response()->json(Auth::user());
    }
}
