<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AlertaController extends Controller
{
    public function index()
    {
        $alertas = Alerta::where('id', Auth::id())->get();

        return response()->json($alertas);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'tipo_alerta' => 'required|in:presupuesto,deuda,ahorro,ingreso,gasto_diario',
            'mensaje' => 'required|string',
            'fecha_alerta' => 'required|date',
            'vista' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear una nueva alerta
        $alerta = Alerta::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $alerta,
            'message' => 'Alerta registrada exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener una alerta específica
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json([
                'success' => false,
                'message' => 'Alerta no encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $alerta,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'mensaje' => 'nullable|string',
            'vista' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar la alerta
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json([
                'success' => false,
                'message' => 'Alerta no encontrada.',
            ], 404);
        }

        $alerta->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $alerta,
            'message' => 'Alerta actualizada exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar una alerta
        $alerta = Alerta::find($id);
        if (!$alerta) {
            return response()->json([
                'success' => false,
                'message' => 'Alerta no encontrada.',
            ], 404);
        }

        $alerta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Alerta eliminada exitosamente.',
        ]);
    }
}
