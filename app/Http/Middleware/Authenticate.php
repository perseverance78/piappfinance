<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

use Closure; 
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    

  
    public function handle($request, Closure $next, ...$guards) 
    {
        if (!Auth::guard('api')->check()) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        return $next($request); // Permite que la solicitud continúe si está autenticado
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    


   
}
