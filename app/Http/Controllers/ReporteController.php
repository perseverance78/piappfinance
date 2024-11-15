<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\Deuda;
use App\Models\ObjetivoAhorro;
use Illuminate\Support\Facades\Auth;


class ReporteController extends Controller
{
      // Resumen mensual de ingresos y gastos
      public function resumenMensual()
      {
          $userId = Auth::id();
        //   dd($userId);
  
          $ingresos = Ingreso::where('id', $userId)
              ->whereMonth('fecha', now()->month)
              ->sum('monto');
        // dd('ingesos:',$ingresos);
          $gastos = Gasto::where('id', $userId)
              ->whereMonth('fecha', now()->month)
              ->sum('monto');
  
          return response()->json([
              'ingresos' => $ingresos,
              'gastos' => $gastos,
              'balance' => $ingresos - $gastos,
          ]);
      }

       // Saldo actual
       public function saldoActual()
       {
           $userId = Auth::id();
 
           $ingresos = Ingreso::where('id', $userId)->sum('monto');
           $gastos = Gasto::where('id', $userId)->sum('monto');
   
           return response()->json([
               'saldo' => $ingresos - $gastos,
           ]);
       }
  
      // Gráfico de gastos por categoría
      public function graficoGastosCategoria()
      {
          $userId = Auth::id();
  
          $gastosPorCategoria = Gasto::where('id', $userId)
              ->selectRaw('categoria_id, SUM(monto) as total')
              ->groupBy('categoria_id')
              ->with('categoria')
              ->get()
              ->map(function ($gasto) {
                  return [
                      'categoria' => $gasto->categoria->nombre,
                      'total' => $gasto->total
                  ];
              });
  
          return response()->json($gastosPorCategoria);
      }
  
      // Gráfico de ingresos vs gastos
      public function graficoIngresosVsGastos()
      {
          $userId = Auth::id();
  
          $ingresos = Ingreso::where('id', $userId)
              ->selectRaw('DATE_FORMAT(fecha, "%Y-%m") as mes, SUM(monto) as total')
              ->groupBy('mes')
              ->pluck('total', 'mes');
  
          $gastos = Gasto::where('id', $userId)
              ->selectRaw('DATE_FORMAT(fecha, "%Y-%m") as mes, SUM(monto) as total')
              ->groupBy('mes')
              ->pluck('total', 'mes');
  
          $result = collect($ingresos->keys())->map(function ($mes) use ($ingresos, $gastos) {
            return [
                'mes' => $mes,
                'ingresos' => $ingresos->get($mes, 0),  // Obtener el valor de ingresos, 0 si no existe
                'gastos' => $gastos->get($mes, 0)  // Obtener el valor de gastos, 0 si no existe
            ];
          });

          // Devolver los resultados en formato JSON
          return response()->json($result);
      }
  
      // Gráfico de deudas pendientes
      public function graficoDeudas()
      {
          $userId = Auth::id();
  
          $deudas = Deuda::where('id', $userId)
              ->where('pagada', false)
              ->selectRaw('fecha_vencimiento, monto')
              ->orderBy('fecha_vencimiento')
              ->get();
  
          return response()->json($deudas);
      }
  
      // Gráfico del progreso en los objetivos de ahorro
      public function graficoProgresoAhorro()
      {
          $userId = Auth::id();
  
          $objetivos = ObjetivoAhorro::where('id', $userId)
              ->select('monto_objetivo', 'monto_ahorrado', 'fecha_objetivo')
              ->get();
  
          $progreso = $objetivos->map(function ($objetivo) {
              return [
                  'objetivo' => $objetivo->monto_objetivo,
                  'ahorrado' => $objetivo->monto_ahorrado,
                  'fecha_objetivo' => $objetivo->fecha_objetivo,
                  'progreso' => ($objetivo->monto_ahorrado / $objetivo->monto_objetivo) * 100,
              ];
          });
  
          return response()->json($progreso);
      }

  
      // Flujo semanal de ingresos y gastos
      public function flujoSemanal()
      {
          $userId = Auth::id();
          $startOfWeek = now()->startOfWeek();
          $endOfWeek = now()->endOfWeek();
  
          $ingresos = Ingreso::where('id', $userId)
              ->whereBetween('fecha', [$startOfWeek, $endOfWeek])
              ->selectRaw('DATE(fecha) as dia, SUM(monto) as total')
              ->groupBy('dia')
              ->pluck('total', 'dia');
  
          $gastos = Gasto::where('id', $userId)
              ->whereBetween('fecha', [$startOfWeek, $endOfWeek])
              ->selectRaw('DATE(fecha) as dia, SUM(monto) as total')
              ->groupBy('dia')
              ->pluck('total', 'dia');
  
          return response()->json([
              'ingresos' => $ingresos,
              'gastos' => $gastos,
          ]);
      }
  
      // Proyección de ingresos y gastos futuros
      public function proyeccionIngresosGastos()
      {
          $userId = Auth::id();
  
          $fechaInicio = now()->subMonths(3);
          $ingresosPromedio = Ingreso::where('id', $userId)
              ->where('fecha', '>=', $fechaInicio)
              ->avg('monto');
  
          $gastosPromedio = Gasto::where('id', $userId)
              ->where('fecha', '>=', $fechaInicio)
              ->avg('monto');
  
          $proyeccion = [
              'proyeccion_ingresos_mensual' => $ingresosPromedio,
              'proyeccion_gastos_mensual' => $gastosPromedio,
          ];
  
          return response()->json($proyeccion);
      }
}
