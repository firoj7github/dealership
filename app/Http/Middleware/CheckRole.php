<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {


        // dd(Auth::user());
        if (Auth::check() && Auth::user()->status != 1) {
            return redirect()->route('inactive');
        }elseif(Auth::check() && Auth::user()->is_verify_email != 1)
        {
            return redirect()->route('inactive');
        }


         $user = Auth::user();
         if(!$user)
         {
            return redirect('/login');
         }

            foreach ($roles as $role) {
                if ($user->role == $role) {
                    return $next($request);
                }
            }



        // Redirect or handle unauthorized user
        return redirect('/');
    }
}
