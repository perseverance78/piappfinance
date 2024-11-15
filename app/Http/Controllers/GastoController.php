<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class GastoController extends Controller
{
    public function index()
    {
        $Gastos = Gasto::where('id', Auth::id())->get();

        return response()->json($Gastos);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'categoria_id' => 'required|exists:categorias,categoria_id',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
            'es_fijo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el nuevo gasto
        $gasto = Gasto::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $gasto,
            'message' => 'Gasto registrado exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener un gasto específico
        $gasto = Gasto::find($id);
        if (!$gasto) {
            return response()->json([
                'success' => false,
                'message' => 'Gasto no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gasto,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'monto' => 'sometimes|required|numeric|min:0',
            'fecha' => 'sometimes|required|date',
            'descripcion' => 'nullable|string|max:255',
            'es_fijo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar el gasto
        $gasto = Gasto::find($id);
        if (!$gasto) {
            return response()->json([
                'success' => false,
                'message' => 'Gasto no encontrado.',
            ], 404);
        }

        $gasto->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $gasto,
            'message' => 'Gasto actualizado exitosamente.',
        ]);
    }

    public function destroy($id)
    {
        // Eliminar un gasto
        $gasto = Gasto::find($id);
        if (!$gasto) {
            return response()->json([
                'success' => false,
                'message' => 'Gasto no encontrado.',
            ], 404);
        }

        $gasto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gasto eliminado exitosamente.',
        ]);
    }
}
