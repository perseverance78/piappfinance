<?php

namespace App\Http\Controllers;

use App\Models\Ingresos;
use App\Http\Requests\StoreIngresosRequest;
use App\Http\Requests\UpdateIngresosRequest;

class IngresosController extends Controller
{
    public function index()
    {
        // Obtener todos los ingresos
        return response()->json(Ingreso::all());
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
            'fecha' => 'sometimes|required|date',
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
