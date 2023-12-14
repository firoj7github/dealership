<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ADFEmailLead;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdfEmailController extends Controller
{
    public function send(Request $request)
    {


        $lead = Lead::where('id',$request->id)->get();
        $inventory = Inventory::where('id',$request->inventory)->get();
        $email =  'ofarid27@gmail.com' ?? $inventory->first()->user->adf_email ;
        $customer = User::where('id',$request->customer)->first();

        $data = [
            'year'     => $inventory->first()->year,
            'make'     => $inventory->first()->make,
            'model'    => $inventory->first()->model,
            'customer_full_name' => $customer->username,
            'customer_phone' => $customer->phone,
        ];
        Mail::to($email)->send(new ADFEmailLead($data));
        return response()->json(['status'=>'success','message'=>'ADF mail sent successfully!']);

    }
}
