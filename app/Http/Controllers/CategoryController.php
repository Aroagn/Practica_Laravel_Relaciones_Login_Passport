<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Método para obtener todas los alumnos

    public function getALl(Request $request) {

        return Category::paginate();
    }

    // Método para obtener el alumno por id

    public function getById(Request $request, $id) {

        return Category::find($id);
    }

    // Método para crear un alumno

    public function create(Request $request) {

        Category::create($request->validate([
            'name' => 'required|max:45',
        ]));

        return response()->json([
            'succes' => true,
            'message' => 'Has creado una categoría nueva',
        ]);

        Category::paginate();
    }

    // Método para borrar un alumno

    public function delete(Request $request, $id) {

        $student = Category::find($id);

        $student->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Has borrado la categoría con id ' . $id,
        ]);
    }

    // Método para modificar un alumno

    public function update(Request $request, $id) {

        $datos = $request->validate([
            'name' => 'required|max:45',
        ]);

        Category::where('id', $id)->update($datos);

        return response()->json([
            'succes' => true,
            'message' => 'Has modificado la categoría con id ' . $id,
        ]);
    }
}
