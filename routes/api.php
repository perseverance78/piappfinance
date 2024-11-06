<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

// Route::middleware('auth:api')->group(function () {
//     Route::get('usuario', [UsuarioController::class, 'index']);
//     Route::get('usuario/{id}', [UsuarioController::class, 'show']);
// });

// Grupo de rutas para usuarios con prefijo 'categorias'
Route::prefix('categoria')->middleware('auth:api')->group(function () {
    Route::get('/', [CategoriaController::class, 'index']); 
    Route::get('/{id}', [CategoriaController::class, 'show']); 
    Route::post('/', [CategoriaController::class, 'store']); 
    Route::put('/{id}', [CategoriaController::class, 'update']); 
    Route::delete('/{id}', [ CategoriaController::class, 'destroy']); 
});

Route::prefix('presupuesto')->middleware('auth:api')->group(function () {
    Route::get('/', [PresupuestoController::class, 'index']); 
    Route::get('/{id}', [PresupuestoController::class, 'show']); 
    Route::post('/', [PresupuestoController::class, 'store']); 
    Route::put('/{id}', [PresupuestoController::class, 'update']); 
    Route::delete('/{id}', [ PresupuestoController::class, 'destroy']); 
});

Route::prefix('ingreso')->middleware('auth:api')->group(function () {
    Route::get('/', [IngresoController::class, 'index']); 
    Route::get('/{id}', [IngresoController::class, 'show']); 
    Route::post('/', [IngresoController::class, 'store']); 
    Route::put('/{id}', [IngresoController::class, 'update']); 
    Route::delete('/{id}', [ IngresoController::class, 'destroy']); 
});

Route::prefix('gasto')->middleware('auth:api')->group(function () {
    Route::get('/', [GastoController::class, 'index']); 
    Route::get('/{id}', [GastoController::class, 'show']); 
    Route::post('/', [GastoController::class, 'store']); 
    Route::put('/{id}', [GastoController::class, 'update']); 
    Route::delete('/{id}', [ GastoController::class, 'destroy']); 
});



