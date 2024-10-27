<?php

namespace App\Http\Controllers;
use App\Models\Presupuesto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PresupuestoController extends Controller
{
    public function index()
    {
        // Obtener todos los presupuestos
        return response()->json(Presupuesto::all());
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'categoria_id' => 'required|exists:categorias,categoria_id',
            'monto_max' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el nuevo presupuesto
        $presupuesto = Presupuesto::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $presupuesto,
            'message' => 'Presupuesto creado exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener un presupuesto específico
        $presupuesto = Presupuesto::find($id);
        if (!$presupuesto) {
            return response()->json([
                'success' => false,
                'message' => 'Presupuesto no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $presupuesto,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'sometimes|required|exists:categorias,categoria_id',
            'monto_max' => 'sometimes|required|numeric',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'sometimes|required|date|after_or_equal:fecha_inicio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar el presupuesto
        $presupuesto = Presupuesto::find($id);
        if (!$presupuesto) {
            return response()->json([
                'success' => false,
                'message' => 'Presupuesto no encontrado.',
            ], 404);
        }

        $presupuesto->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $presupuesto,
            'message' => 'Presupuesto actualizado exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar un presupuesto
        $presupuesto = Presupuesto::find($id);
        if (!$presupuesto) {
            return response()->json([
                'success' => false,
                'message' => 'Presupuesto no encontrado.',
            ], 404);
        }

        $presupuesto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Presupuesto eliminado exitosamente.',
        ]);
    }
}
