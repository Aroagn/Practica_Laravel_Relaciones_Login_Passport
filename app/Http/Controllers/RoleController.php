<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Método para obtener todas los alumnos

    public function getALl(Request $request) {

        return Role::paginate();
    }

    // Método para obtener el alumno por id

    public function getById(Request $request, $id) {

        return Role::find($id);
    }

    // Método para crear un alumno

    public function create(Request $request) {

        Role::create($request->validate([
            'name' => 'required|max:45',
        ]));

        return response()->json([
            'succes' => true,
            'message' => 'Has creado un rol nuevo',
        ]);

        Role::paginate();
    }

    // Método para borrar un alumno

    public function delete(Request $request, $id) {

        $student = Role::find($id);

        $student->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Has borrado el rol con id ' . $id,
        ]);
    }

    // Método para modificar un alumno

    public function update(Request $request, $id) {

        $datos = $request->validate([
            'name' => 'required|max:45',
        ]);

        Role::where('id', $id)->update($datos);

        return response()->json([
            'succes' => true,
            'message' => 'Has modificado el rol con id ' . $id,
        ]);
    }
}
