<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if(Auth::user() && Auth::user()->role->id == 1){
            return $next($request);
        }
        $notification = array(
            'message' => 'Na vykonanie tejto činnosti nemáte práva!',
            'alert-type' => 'error',
        );
        return Redirect()->route('admin.home')->with($notification);
    }
}
