<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadPurchaseController extends Controller
{
    public function index(){
        $user= Auth::user();
        $leads = Lead::with(['inventories_car'])->get();
        // return  $leads;

        return view('dealer.lead purchase.lead_purchase',compact('user','leads'));
    }
    public function upgrade(){
        $user= Auth::user();
        $leads = Lead::with(['inventories_car'])->get();
        // return  $leads;

        return view('dealer.lead purchase.upgrade_listing',compact('user','leads'));
    }
}
