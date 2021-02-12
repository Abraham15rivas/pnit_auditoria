<?php

namespace pnit\Http\Middleware;

use Closure;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->is("/")){
            if($request->session()->has("usuario")){
                return redirect()->route("principal");
            }
        } else if($request->is("admin") || $request->is("emp")){
            if(!$request->session()->has("usuario")){
                return redirect()->route("inicio_sesion");
            }
        }
        return $next($request);
    }
}
