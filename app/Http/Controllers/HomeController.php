<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $user = Auth::user();
      if($user->role == 1)
      {
        return redirect()->route('dashboard');

      }elseif($user->role == 2)
      {
        return redirect()->route('dealer.dashboard');

      }
      elseif($user->role == 0)
      {
        return redirect()->route('buyer.dashboard');
      }

    }

}
