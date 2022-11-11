<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNationalAdmin
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
        $user = auth()->user();
        if($user->approved && $user->role_id <= 4) {
            return $next($request);
        } else {
            abort(401, 'UNAUTHORIZED');
        }
    }
}
