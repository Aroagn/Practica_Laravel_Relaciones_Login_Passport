<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Método para obtener todas los alumnos

    public function getALl(Request $request) {

        return Post::paginate();
    }

    // Método para obtener el alumno por id

    public function getById(Request $request, $id) {

        return Post::find($id);
    }

    // Método para crear un alumno

    public function create(Request $request) {

        Post::create($request->validate([
            'name' => 'required|max:32',
            'body' => 'required',
        ]));

        return response()->json([
            'succes' => true,
            'message' => 'Has creado una publicación nueva',
        ]);

        Post::paginate();
    }

    // Método para borrar un alumno

    public function delete(Request $request, $id) {

        $student = Post::find($id);

        $student->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Has borrado la publicación con id ' . $id,
        ]);
    }

    // Método para modificar un alumno

    public function update(Request $request, $id) {

        $datos = $request->validate([
            'name' => 'required|max:32',
            'body' => 'required',
        ]);

        Post::where('id', $id)->update($datos);

        return response()->json([
            'succes' => true,
            'message' => 'Has modificado la publicación con id ' . $id,
        ]);
    }
}
