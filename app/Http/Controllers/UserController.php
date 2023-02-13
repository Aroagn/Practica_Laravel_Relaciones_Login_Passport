<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Método para obtener todas los alumnos

    public function getALl(Request $request) {

        return User::paginate();
    }

    // Método para obtener el alumno por id

    public function getById(Request $request, $id) {

        return User::find($id);
    }

    // Método para crear un alumno

    public function create(Request $request) {

        User::create($request->validate([
            'name' => 'required|max:32',
            'email' => 'required|email|unique:students|max:64',
            'password' => 'required|max:64',
        ]));

        return response()->json([
            'succes' => true,
            'message' => 'Has creado un usuario nuevo',
        ]);

        User::paginate();
    }

    // Método para borrar un alumno

    public function delete(Request $request, $id) {

        $student = User::find($id);

        $student->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Has borrado el usuario con id ' . $id,
        ]);
    }

    // Método para modificar un alumno

    public function update(Request $request, $id) {

        $datos = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|email|unique:students|max:64',
            'password' => 'required|max:64',
        ]);

        User::where('id', $id)->update($datos);

        return response()->json([
            'succes' => true,
            'message' => 'Has modificado el usuario con id ' . $id,
        ]);
    }
}
