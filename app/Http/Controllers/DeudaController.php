<?php

namespace App\Http\Controllers;

use App\Models\Deuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DeudaController extends Controller
{
    public function index()
    {
        $deudas = Deuda::where('id', Auth::id())->get();

        return response()->json($deudas);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:100',
            'monto_total' => 'required|numeric|min:0',
            'monto_pagado' => 'nullable|numeric|min:0',
            'fecha_vencimiento' => 'required|date',
            'recordatorio' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear la nueva deuda
        $deuda = Deuda::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $deuda,
            'message' => 'Deuda registrada exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener una deuda específica
        $deuda = Deuda::find($id);
        if (!$deuda) {
            return response()->json([
                'success' => false,
                'message' => 'Deuda no encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $deuda,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:100',
            'monto_total' => 'sometimes|required|numeric|min:0',
            'monto_pagado' => 'nullable|numeric|min:0',
            'fecha_vencimiento' => 'sometimes|required|date',
            'recordatorio' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar la deuda
        $deuda = Deuda::find($id);
        if (!$deuda) {
            return response()->json([
                'success' => false,
                'message' => 'Deuda no encontrada.',
            ], 404);
        }

        $deuda->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $deuda,
            'message' => 'Deuda actualizada exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar una deuda
        $deuda = Deuda::find($id);
        if (!$deuda) {
            return response()->json([
                'success' => false,
                'message' => 'Deuda no encontrada.',
            ], 404);
        }

        $deuda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deuda eliminada exitosamente.',
        ]);
    }
}
