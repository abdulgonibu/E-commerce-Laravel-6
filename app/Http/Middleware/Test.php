<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Test
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
        if (Auth::check()) {
            if (Auth::user()->usertype=='Admin') {
               return redirect()->route('hr.dashboard');
            }elseif (Auth::user()->usertype=='User') {
              return redirect()->route('accounts.dashboard');
            }
        }else{
            return redirect('/login');
            //return redirect()->back();
        }
        
    }
}
