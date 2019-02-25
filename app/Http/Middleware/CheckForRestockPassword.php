<?php

namespace App\Http\Middleware;

use Closure;

class CheckForRestockPassword
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

        if($request->session()->exists('hasRestockPassword') && $request->session('hasRestockPassword') == true)
        {
            return $next($request);
        }

         return redirect('home')->with('notice', 'You have not entered a Restock password.');
    }
}
