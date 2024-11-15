<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DeudaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\OjetivoAhorroController;
use App\Http\Controllers\ReporteController;





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

Route::prefix('alerta')->middleware('auth:api')->group(function () {
    Route::get('/', [AlertaController::class, 'index']); 
    Route::get('/{id}', [AlertaController::class, 'show']); 
    Route::post('/', [AlertaController::class, 'store']); 
    Route::put('/{id}', [AlertaController::class, 'update']); 
    Route::delete('/{id}', [ AlertaController::class, 'destroy']); 
});

Route::prefix('deuda')->middleware('auth:api')->group(function () {
    Route::get('/', [DeudaController::class, 'index']); 
    Route::get('/{id}', [DeudaController::class, 'show']); 
    Route::post('/', [DeudaController::class, 'store']); 
    Route::put('/{id}', [DeudaController::class, 'update']); 
    Route::delete('/{id}', [ DeudaController::class, 'destroy']); 
});

Route::prefix('objetivo-ahorro')->middleware('auth:api')->group(function () {
    Route::get('/', [ObjetivoAhorroController::class, 'index']); 
    Route::get('/{id}', [ObjetivoAhorroController::class, 'show']); 
    Route::post('/', [ObjetivoAhorroController::class, 'store']); 
    Route::put('/{id}', [ObjetivoAhorroController::class, 'update']); 
    Route::delete('/{id}', [ ObjetivoAhorroController::class, 'destroy']); 
});

// Rutas para gráficos y reportes financieros
Route::prefix('reportes')->middleware('auth:api')->group(function () {
    Route::get('/resumen-mensual', [ReporteController::class, 'resumenMensual']);
    Route::get('/graficos/gastos-categoria', [ReporteController::class, 'graficoGastosCategoria']);
    Route::get('/graficos/ingresos-vs-gastos', [ReporteController::class, 'graficoIngresosVsGastos']);
    Route::get('/graficos/deudas', [ReporteController::class, 'graficoDeudas']);
    Route::get('/graficos/progreso-ahorro', [ReporteController::class, 'graficoProgresoAhorro']);
    Route::get('/saldo-actual', [ReporteController::class, 'saldoActual']);
    Route::get('/flujo-semanal', [ReporteController::class, 'flujoSemanal']);
    Route::get('/proyeccion-ingresos-gastos', [ReporteController::class, 'proyeccionIngresosGastos']); 
   
});






