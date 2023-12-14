<?php
namespace App\Http\Controllers\Sales;
use App\Http\Controllers\Controller;
use App\Models\Sale;

use Illuminate\Http\Request;

class SalesManagementController extends Controller
{
    public function index(){
        $salers= Sale::get();

        return view('dealer.sales_management', compact('salers'));
    }
    public function salesAdd(Request $request){

        // $validate = Validator::make($request->all(),[
        //     'name'=>'required',
        //     'email'=>'required',
        //     'phone'=>'required',
        // ]);

        // if($validate->fails())
        // {
        //     return response()->json(['error'=>$validate->errors()]);
        // }

    //




        $sales= new Sale();
        $sales->name = $request->name;
        $sales->email = $request->email;
        $sales->address = $request->address;
        $sales->phone = $request->phone;
        $sales->save();


           return response()->json([
            'status'=>'success'
            // 'message'=>'Lead Create successfully'
           ]);

    }

    public function salesEdit(Request $request){
        Sale::where('id',$request->up_id)->update([
            'name'=>$request->up_name,
            'email'=>$request->up_email,
            'address'=>$request->up_address,
            'phone'=>$request->up_phone,
        ]);
        return response()->json([
            'status'=>'success',
         ]);
    }


    public function salesDelete (Request $request){
       Sale::find($request->id)->delete();

       return response()->json([
        'status'=>'success'
       ]);
    }
}
