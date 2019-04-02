<?php

namespace Victorem\Http\Middleware;

use Closure, Auth;

class Module
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $moduleName)
    {        
        if( ! Auth::user()->type->hasModule($moduleName))
        {
            return redirect()->to('/');
        } 
        
        return $next($request);
    }
}
