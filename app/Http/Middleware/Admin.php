<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        
        if(auth()->user()->role=='admin'){
            return $next($request);
        }else{
            return redirect('home')->with('error','You do not access this page');
        }
        
        if(auth()->user()->role=='user'){
            return redirect('home')->with('status', 'User login successfull!');
        }
        else{
            return redirect('home')->with('error','You do not access this page');
        }
        
    }
}
