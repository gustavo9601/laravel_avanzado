<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    // Recibiendo parametros en el middleware
    public function handle($request, Closure $next)
    {

        // Obtiene todos los parametros que se pasen como arreglo
        $roles = func_get_args();
        // Cortamos los 2 primeros valores del array, yaq ue son propios del middleware
        $roles = array_slice($roles, 2);

        if (auth()->user()->hasRoles($roles)) {
            return $next($request);
        }


        return redirect()->route('home');

    }
}
