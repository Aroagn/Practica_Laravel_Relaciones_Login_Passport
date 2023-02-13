<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $datos = $request->only('name', 'email', 'password');
        $token = Auth::attempt($datos);

        if (Auth::check() && auth()->user()->$token) {
            return response()->json([
                'success' => false,
                'message' => "Error de validación",
            ], 401);
        }

        return $next($request);
    }
}
