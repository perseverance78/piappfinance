<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoAhorroController extends Controller
{
    public function index()
    {
        // Obtener todos los objetivos de ahorro
        $objetivosAhorro = ObjetivoAhorro::where('id', Auth::id())->get();
        return response()->json($objetivosAhorro);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:100',
            'monto_objetivo' => 'required|numeric|min:0',
            'monto_actual' => 'nullable|numeric|min:0',
            'fecha_meta' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el nuevo objetivo de ahorro
        $objetivoAhorro = ObjetivoAhorro::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $objetivoAhorro,
            'message' => 'Objetivo de ahorro registrado exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener un objetivo de ahorro específico
        $objetivoAhorro = ObjetivoAhorro::find($id);
        if (!$objetivoAhorro) {
            return response()->json([
                'success' => false,
                'message' => 'Objetivo de ahorro no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $objetivoAhorro,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:100',
            'monto_objetivo' => 'sometimes|required|numeric|min:0',
            'monto_actual' => 'nullable|numeric|min:0',
            'fecha_meta' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar el objetivo de ahorro
        $objetivoAhorro = ObjetivoAhorro::find($id);
        if (!$objetivoAhorro) {
            return response()->json([
                'success' => false,
                'message' => 'Objetivo de ahorro no encontrado.',
            ], 404);
        }

        $objetivoAhorro->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $objetivoAhorro,
            'message' => 'Objetivo de ahorro actualizado exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar un objetivo de ahorro
        $objetivoAhorro = ObjetivoAhorro::find($id);
        if (!$objetivoAhorro) {
            return response()->json([
                'success' => false,
                'message' => 'Objetivo de ahorro no encontrado.',
            ], 404);
        }

        $objetivoAhorro->delete();

        return response()->json([
            'success' => true,
            'message' => 'Objetivo de ahorro eliminado exitosamente.',
        ]);
    }
}
