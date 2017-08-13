<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 13/08/2017
 * Time: 13:36
 */

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\Auth;

class ApiMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/api/error');
        }

        return $next($request);
    }
}