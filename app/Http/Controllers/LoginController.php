<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'required|email:rfc',
            'password' => 'required',
        ]);

        if (Auth::attempt($data, true)) {
            return response()->json([
                'success' => true,
                'message' => "Tu usuario ya está logueado, bienvenido.",
                'data' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Has sido logueado, bienvenido.",
            'data' => Auth::user()
        ]);
    }

    public function whoAmI(Request $request) {

        return response()->json([
            'success' => true,
            'message' => "Tu usuario está logueado.",
            'data' => Auth::user()
        ]);
    }
}

