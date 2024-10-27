<?php

namespace App\Http\Controllers;
use App\Models\Categoria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoriaController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        return response()->json(Categoria::all());
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:50',
            'tipo' => 'required|in:Ingreso,Gasto',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear la nueva categoría
        $categoria = Categoria::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $categoria,
            'message' => 'Categoría creada exitosamente.',
        ], 201);
    }

    public function show($id)
    {
        // Obtener una categoría específica
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $categoria,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:50',
            'tipo' => 'sometimes|required|in:Ingreso,Gasto',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar la categoría
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada.',
            ], 404);
        }

        $categoria->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $categoria,
            'message' => 'Categoría actualizada exitosamente.',
        ]);
    }

    public function destroy($id)
    {
     
        // Eliminar una categoría
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada.',
            ], 404);
        }

        $categoria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada exitosamente.',
        ]);
    }
}
