<?php

namespace App\Http\Middleware;

use App\Models\Subscriber;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class Customer
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
        if (Auth::user()->role == ADMIN_ROLE && Auth::user()->status == USER_ACTIVE_STATUS) {
            $subscriber = Subscriber::whereHas('customer', function ($customer) {
                $customer->whereHas('user', function ($user) {
                   $user->where('id', Auth::id());
                });
            })->first();
            if (empty($subscriber)) {
                Auth::logout();
                return redirect()->route('signIn')->with(['error' => __('You are not authorized')]);
            }
            $subscriberEndDate = new Carbon($subscriber->end_date);
            $carbon = new Carbon();
            if ($subscriberEndDate->format('Y-m-d') < $carbon->now()->format('Y-m-d')) {
                Auth::logout();
                return redirect()->route('signIn')->with(['error' => __('Your subscription package has been expired')]);
            }

            return $next($request);
        }

        Auth::logout();
        return redirect()->route('signIn')->with(['error' => __('You are not authorized')]);
    }
}
