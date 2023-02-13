<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    // Método para obtener todas los alumnos

    public function getALl(Request $request) {

        return Profile::paginate();
    }

    // Método para obtener el alumno por id

    public function getById(Request $request, $id) {

        return Profile::find($id);
    }

    // Método para crear un alumno

    public function create(Request $request) {

        Profile::create($request->validate([
            'tittle' => 'required|max:45',
            'website' => 'max:45',
        ]));

        return response()->json([
            'succes' => true,
            'message' => 'Has creado un perfil nuevo',
        ]);

        Profile::paginate();
    }

    // Método para borrar un alumno

    public function delete(Request $request, $id) {

        $student = Profile::find($id);

        $student->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Has borrado el perfil con id ' . $id,
        ]);
    }

    // Método para modificar un alumno

    public function update(Request $request, $id) {

        $datos = $request->validate([
            'tittle' => 'required|max:45',
            'website' => 'max:45',
        ]);

        Profile::where('id', $id)->update($datos);

        return response()->json([
            'succes' => true,
            'message' => 'Has modificado el perfil con id ' . $id,
        ]);
    }
}
