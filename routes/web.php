<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index']); // Ejemplo de ruta para listar usuarios
    Route::get('/{id}', [UsuarioController::class, 'show']); // Ejemplo de ruta para mostrar un usuario específico
    Route::post('/', [UsuarioController::class, 'store']); // Ejemplo de ruta para crear un usuario
    Route::put('/{id}', [UsuarioController::class, 'update']); // Ejemplo de ruta para actualizar un usuario
    Route::delete('/{id}', [UsuarioController::class, 'destroy']); // Ejemplo de ruta para eliminar un usuario
});

