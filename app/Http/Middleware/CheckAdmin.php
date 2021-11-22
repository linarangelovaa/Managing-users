<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        $type = $request->user()->type->name;
        if ($type == 'admin') {
            return redirect()->route('dashboard');
        }
        if ($type == 'regular') {
            return redirect()->route('dashboarduser');
        }

        /*     return $next($request); */

        /* if ($request->user()->type->name == 'admin') {
            return redirect()->route('dashboard');
        } elseif (($request->user()->type->name == 'regular')) {
            return redirect()->route('dashboarduser');
        } */
    }
}