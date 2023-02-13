<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'message' => 'Error de validación',
                'data' => $validator->errors(),
            ], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken('MyApp')->accessToken;

        return response()->json([
            'succes' => true,
            'message' => 'Usuario registrado con éxito',
            'token' => $token,
        ], 201);
    }

    public function login(Request $request) {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')->accessToken; 

            return response()->json([
                'succes' => true,
                'message' => 'Usuario logueado con éxito',
                'data' => [
                    'token' => $token,
                ]
            ], 201);    
        } 

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) { 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')->accessToken; 

            return response()->json([
                'succes' => true,
                'message' => 'Usuario logueado con éxito',
                'data' => [
                    'token' => $token,
                ]
            ], 201);    
        } 

        else { 
            return response()->json([
                'succes' => false,
                'message' => 'Unauthorised',
            ], 401);
        } 
    }

    public function user(Request $request) {

        return response()->json([
            'succes' => true,
            'message' => 'Usuario obtenido con éxito',
            'data' => $request->user(),
        ], 201);    
    }

    public function logout(Request $request, $id) {

        $user = User::find($id);
        $request->$user->token()->revoke();

        return response()->json([
            'succes' => true,
            'message' => 'Usuario con id ' . $id . 'con desconectado',
        ]);
    }
}


