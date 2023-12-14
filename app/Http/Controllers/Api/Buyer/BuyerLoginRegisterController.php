<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BuyerLoginRegisterController extends Controller
{

    public function login()
    {
        return view('auth.buyer.login');
    }
    public function loginCheck(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',

       ]);

       if($validate->fails())
       {
        return response()->json($validate->errors());
       }


        if (Auth::attempt(['username'=>$request->email,'password'=>$request->password]))
        {
            $buyer = Auth::user();
            $token = $buyer->createToken($buyer->email)->accessToken;
            return response()->json(['status'=>true,'message'=>'Login  Successfully!','token'=>$token,'user'=>$buyer]);
        }

        elseif (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $buyer = Auth::user();
            $token = $buyer->createToken("name")->accessToken;
            return response()->json(['status'=>true,'message'=>'Login  Successfully!','token'=>$token,'user'=>$buyer]);
        }else
        {
            return response()->json(['status'=>false,'message'=>'user name or password invalid!']);
        }




    }

    public function registerView()
    {
        return view('auth.buyer.register');
    }

    public function register(Request $request)
    {
       $validate = Validator::make($request->all(),[

            'name' => 'required|string',
            'phone' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' =>'required|same:password'

       ]);

       if($validate->fails())
       {
        return response()->json($validate->errors());
       }else
       {
            $buyer = new User();
            $buyer->name = $request->name;
            $buyer->email = $request->email;
            $buyer->phone = $request->phone;
            $buyer->password = Hash::make($request->password);
            $buyer->save();
            return response()->json([
                'message' =>"User Registration successfully! ",
                'status' =>1,
                'user' =>$buyer,
            ]);

       }





    }



}


