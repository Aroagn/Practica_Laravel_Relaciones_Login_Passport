<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateId
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
        $id = $request->id;
        if (is_numeric($id) && ctype_digit($id)) {
            return $next($request);
        }

        return response()->json(
            ['message' => "El id introducido no es correcto"],
            422
        );
    }
}
