<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Applicant
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
    
            
            if (!Auth::check()) {
                return response('Unauthorized.', 403);
            }         
            else{        
         
            $part_type = str_replace("App\\Models\\","",Auth::user()->userable_type);
             
            if ($part_type == "Applicant" || $part_type == "Admin") {
    
                return $next($request); 
    
            }else{
                return response('Unauthorized.', 403);   
            }
        
        }
              
      

    }
}
