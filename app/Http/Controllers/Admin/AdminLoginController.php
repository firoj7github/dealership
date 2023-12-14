<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Tmp_inventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
       $users = User::all();
       $dealers = $users->where('role',2)->count();
       $inventories = Tmp_inventory::all()->count();
    //    $invoices = Invoice::with('inventory')->latest()->get();

    $today = Carbon::now()->toDateString();
    // $invoices = Invoice::with('inventory')
    // ->where('user_id', Auth::id())
    // ->whereDate('created_at', $today)
    // ->latest()
    // ->get();
    // return $invoices;
         return view('home',compact('users','dealers','inventories'));
    }
}
