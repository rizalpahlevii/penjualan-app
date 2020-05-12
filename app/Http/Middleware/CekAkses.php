<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $param1, $param2 = null, $param3 = null)
    {
        $level = [$param1, $param2, $param3];
        if (in_array(Auth::user()->level, $level)) {
            return $next($request);
        }
        abort(403, 'This action is unauthorized.');
    }
}
