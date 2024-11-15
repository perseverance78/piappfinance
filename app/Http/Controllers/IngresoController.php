<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::where('id', Auth::id())->get();

        return response()->json($ingresos);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'fuente' => 'nullable|string|max:100',
            'es_fijo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el nuevo ingreso
        $ingreso = Ingreso::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $ingreso,
            'message' => 'Ingreso registrado exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener un ingreso específico
        $ingreso = Ingreso::find($id);
        if (!$ingreso) {
            return response()->json([
                'success' => false,
                'message' => 'Ingreso no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ingreso,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'monto' => 'sometimes|required|numeric|min:0',
            'fuente' => 'nullable|string|max:100',
            'es_fijo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar el ingreso
        $ingreso = Ingreso::find($id);
        if (!$ingreso) {
            return response()->json([
                'success' => false,
                'message' => 'Ingreso no encontrado.',
            ], 404);
        }

        $ingreso->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $ingreso,
            'message' => 'Ingreso actualizado exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar un ingreso
        $ingreso = Ingreso::find($id);
        if (!$ingreso) {
            return response()->json([
                'success' => false,
                'message' => 'Ingreso no encontrado.',
            ], 404);
        }

        $ingreso->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ingreso eliminado exitosamente.',
        ]);
    }
}
