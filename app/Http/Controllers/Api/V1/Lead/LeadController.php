<?php

namespace App\Http\Controllers\Api\V1\Lead;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function leadStore(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'email' =>'required|email',
            'phone' =>'required|numeric',
            'description' =>'required',

        ]);
        if($validator->fails())
        {
            return response()->json($validator->error());
        }

        $lead = new Lead();
        $lead->tmp_inventories_id = $request->tmp_inventories_id;
        $lead->customer_name = $request->first_name .' '. $request->last_name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->description = $request->description;
        $lead->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Lead Submit Successfully!',

        ]);

    }
}
